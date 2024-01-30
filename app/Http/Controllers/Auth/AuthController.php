<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Default\UserResource;
use App\Models\Default\User;
use App\Zaions\Enums\OnboardingEnum;
use App\Zaions\Enums\RolesEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * Register 
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => ['required', 'string', 'min:6'],
                'username' => [
                    'nullable', 'string', 'max:255',
                    Rule::unique(User::class),
                ],
                "address" => ['nullable', 'string'],
                "company" => ['nullable', 'string'],
                "country" => ['nullable', 'string'],
                "zipcode" => ['nullable', 'string'],
                "city" => ['nullable', 'string'],
                "logo" => ['nullable', 'string'],
                "phone_number" => ['nullable', 'string'],
                "country_code" => ['nullable', 'string'],
                "country_code_text" => ['nullable', 'string'],
                "location" => ['nullable', 'string'],
                "profile_publicly_visible" => ['nullable', 'string'],
                "profile_photo_path" => ['nullable', 'string'],
                "state" => ['nullable', 'string'],
                "company_registration_number" => ['nullable', 'string'],
                "vat_number" => ['nullable', 'string'],
                "default_currency" => ['nullable', 'string'],
                "notes" => ['nullable', 'string'],
                "bank_details" => ['nullable', 'string'],
                "is_active" => ['nullable', 'string'],
                "onboarding_details" => ['nullable', 'json'],
                "extra_attributes" => ['nullable', 'json'],
            ]);
            $onboarding_details = [
                OnboardingEnum::register->value => true,
                OnboardingEnum::profile->value => false,
                OnboardingEnum::currency->value => false,
                OnboardingEnum::bank_details->value => false,
            ];
            $user = User::create([
                'unique_id' => uniqid(),
                'username' => $request->has('username') ? $request->username : null,
                'email' => $request->has('email') ? $request->email : null,
                'password' => $request->has('password') ? Hash::make($request->password) : null,
                'address' => $request->has('address') ? $request->address : null, 
                "state" => $request->has('state') ? $request->state : null,
                'company' => $request->has('company') ? $request->company : null,
                "country" => $request->has('country') ? $request->country : null,
                'zipcode' => $request->has('zipcode') ? $request->zipcode : null,
                'city' => $request->has('city') ? $request->city : null,
                "logo" => $request->has('logo') ? $request->logo : null,
                'company_registration_number' => $request->has('company_registration_number') ? $request->company_registration_number : null,
                'vat_number' => $request->has('vat_number') ? $request->vat_number : null,
                'default_currency' => $request->has('default_currency') ? $request->default_currency : null,
                'notes' => $request->has('notes') ? $request->notes : null,
                'bank_details' => $request->has('bank_details') ? $request->bank_details : null,
                'onboarding_details' => $onboarding_details ?? null,
                'is_active' => $request->has('is_active') ? $request->is_active : null,
                'extra_attributes' => $request->has('extra_attributes') ? $request->extra_attributes : null,
            ]);

            // Getting user role
            $userRole = Role::where('name', RolesEnum::user->name)->get();

            // Assign the role to new user
            $user->assignRole($userRole);

            // Creating a new token
            $token = $user->createToken('auth');

            // Returning user and token.
            return ZHelpers::sendBackRequestCompletedResponse([
                'user' => new UserResource($user),
                'token' => $token->plainTextToken
            ]);
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /** 
     * Login
     */
    public function Login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6']
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    // Creating a new token
                    $token = $user->createToken('auth');

                    // Returning user and token.
                    return ZHelpers::sendBackRequestCompletedResponse([
                        'user' => new UserResource($user),
                        'token' => $token->plainTextToken
                    ]);
                } else{
                    return ZHelpers::sendBackNotFoundResponse([
                        'item' => ['Incorrect email or password']
                    ]);
                }
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Incorrect email or password']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /** 
     * Logout
     */
   public function Logout(Request $request) {
        try {
            $user = $request->user();

            if($user){
                $user->tokens()->delete();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'isSuccess' => true
                ]);
            }else{
                return ZHelpers::sendBackBadRequestResponse([
                    'user' => 'User not Found!'
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    public function verifyAuthState(Request $request)
    {
        return response()->json(['data' => true]);
    }
}
