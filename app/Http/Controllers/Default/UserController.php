<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Http\Resources\Default\UserResource;
use App\Mail\OTPMail;
use App\Models\Default\User;
use App\Zaions\Enums\OnboardingEnum;
use App\Zaions\Helpers\ZHelpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function changeEmailAndPassword(Request $request)
    {
        try {
            $user = User::where('id', $request->user()->id)->first();

            $request->validate([
                "email" => ['required', 'string'],
                "password" => ['required', 'string'],
            ]);

            if ($user) {
                $user->forceFill([
                    'email' => $request->has('email') ? $request->email : $user->email,
                    'password' => $request->has('password') ? $request->password : $user->password,
                ])->save();
                $updatedUserInfo = User::where('id', $request->user()->id)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserResource($updatedUserInfo)
                ]);
            } else {
                return ZHelpers::sendBackBadRequestResponse([
                    'user' => ['Invalid Request, No User found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    //
    public function profileDetails(Request $request)
    {
        try {
            $user = User::where('id', $request->user()->id)->first();

            $request->validate([
                "company" => ['required', 'string'],
                "address" => ['required', 'string'],
                "zipcode" => ['required', 'string'],
                "city" => ['required', 'string'],
                "country" => ['required', 'string'],
                "registration_number" => ['required', 'string'],
                "vat_number" => ['required', 'string'],
            ]);

            $onboarding_details = null;
            if ($user->onboarding_details === null || $user->onboarding_details[OnboardingEnum::profile->value] !== true) {
                $onboarding_details = [
                    ...($user->onboarding_details ?? []),
                    OnboardingEnum::profile->value => true,
                ];
            }

            if ($user) {
                $user->forceFill([
                    'company' => $request->has('company') ? $request->company : $user->company,
                    'address' => $request->has('address') ? $request->address : $user->address,
                    'zipcode' => $request->has('zipcode') ? $request->zipcode : $user->zipcode,
                    'city' => $request->has('city') ? $request->city : $user->city,
                    'country' => $request->has('country') ? $request->country : $user->country,
                    'registration_number' => $request->has('registration_number') ? $request->registration_number : $user->registration_number,
                    'vat_number' => $request->has('vat_number') ? $request->vat_number : $user->vat_number,
                    'onboarding_details' => $onboarding_details ?? $user->onboarding_details,
                ])->save();
                $updatedUserInfo = User::where('id', $request->user()->id)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserResource($updatedUserInfo)
                ]);
            } else {
                return ZHelpers::sendBackBadRequestResponse([
                    'item' => ['Invalid Request, No User found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    public function currencyDetails(Request $request)
    {
        try {
            $user = User::where('id', $request->user()->id)->first();

            $request->validate([
                "logo" => ['required', 'json'],
                "default_currency" => ['required', 'json'],
            ]);

            $onboarding_details = null;
            if ($user->onboarding_details === null || !array_key_exists(OnboardingEnum::currency->value, $user->onboarding_details) || $user->onboarding_details[OnboardingEnum::currency->value] !== true) {
                $onboarding_details = [
                    ...($user->onboarding_details ?? []),
                    OnboardingEnum::currency->value => true,
                ];
            }

            if ($user) {
                $user->forceFill([
                    'logo' => $request->has('logo') ? ZHelpers::zJsonDecode($request->logo) : $user->logo,
                    'default_currency' => $request->has('default_currency') ? ZHelpers::zJsonDecode($request->default_currency) : $user->default_currency,
                    'onboarding_details' => $onboarding_details ?? $user->onboarding_details,
                ])->save();
                $updatedUserInfo = User::where('id', $request->user()->id)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserResource($updatedUserInfo)
                ]);
            } else {
                return ZHelpers::sendBackBadRequestResponse([
                    'user' => ['Invalid Request, No User found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    public function bankDetails(Request $request)
    {
        try {
            $user = User::where('id', $request->user()->id)->first();

            $request->validate([
                "bank_details" => ['required', 'string'],
                "logo" => ['nullable', 'string'],
            ]);

            $onboarding_details = null;
            if ($user->onboarding_details === null || !array_key_exists(OnboardingEnum::bank_details->value, $user->onboarding_details) || $user->onboarding_details[OnboardingEnum::bank_details->value] !== true) {
                $onboarding_details = [
                    ...($user->onboarding_details ?? []),
                    OnboardingEnum::bank_details->value => true,
                ];
            }

            if ($user) {
                $user->forceFill([
                    'logo' => $request->has('logo') ? $request->logo : $user->logo,
                    'bank_details' => $request->has('bank_details') ? $request->bank_details : $user->bank_details,
                    'onboarding_details' => $onboarding_details ?? $user->onboarding_details,
                ])->save();
                $updatedUserInfo = User::where('id', $request->user()->id)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserResource($updatedUserInfo)
                ]);
            } else {
                return ZHelpers::sendBackBadRequestResponse([
                    'user' => ['Invalid Request, No User found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }


    // 
    public function generateAndSentOTP(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user) {
                $otp = ZHelpers::generateUniqueNumericOTP();
                $otpValidTime =  Carbon::now()->addMinutes(config('zconfig.optExpireAddTime'));

                $user->update([
                    'otp_code' => $otp,
                    'otp_code_valid_till' => $otpValidTime
                ]);

                $user = User::where('email', $request->email)->first();

                if ($user->otp_code) {
                    // Send mail.
                    Mail::send(new OTPMail($user, $user->otp_code, 'Verify OTP'));


                    return ZHelpers::sendBackRequestCompletedResponse([
                        'item' => [
                            'success' => true,
                            'email' => $user->email,
                            'otp_code_valid_till' => $otpValidTime
                        ],
                    ]);
                }
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invalid Request, No User found.']
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string',
                'otp_code' => 'required|string|max:6|min:6',
                'otp_code_valid_till' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user) {
                $currentTime = Carbon::now();
                if ($user->otp_code_valid_till >= $currentTime) {
                    if (!empty($user->otp_code) && $user->otp_code === $request->otp_code) {
                        $user->update([
                            'otp_code' => null,
                            'otp_code_valid_till' => null,
                            'can_reset_password' => true
                        ]);

                        return ZHelpers::sendBackRequestCompletedResponse([
                            'item' => [
                                'email' => $user->email,
                                'success' => true,
                            ],
                        ]);
                    } else {
                        return ZHelpers::sendBackBadRequestResponse([
                            'otp_code' => ['Incorrect OTP.']
                        ]);
                    }
                } else {
                    return ZHelpers::sendBackBadRequestResponse([
                        'otp_code' => ['Invalid OTP, please resend otp.']
                    ]);
                }
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invalid Request, No User found.']
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->can_reset_password) {
                $user->update([
                    'password' => $request->password ?? $user->password,
                    'can_reset_password' => false
                ]);

                // Creating a new token
                $token = $user->createToken('auth');

                // Returning user and token.
                return ZHelpers::sendBackRequestCompletedResponse([
                    'success' => true,
                    'user' => new UserResource($user),
                    'token' => $token->plainTextToken
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Invalid Request'],
                    'c' => $user->can_reset_password
                ]);
            }
        } else {
            return ZHelpers::sendBackNotFoundResponse([
                'item' => ['Invalid Request, No User found.']
            ]);
        }
    }
}
