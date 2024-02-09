<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Http\Resources\Default\UserDetailResource;
use App\Models\Default\UserDetails;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::create_user_detail->name));

            $request->validate([
                "user_intro" => ['nullable', 'string'],
                "user_description" => ['nullable', 'string'],
                "user_average_response_time" => ['nullable', 'string'],
                "user_languages" => ['nullable', 'json'],
                "user_skills" => ['nullable', 'json'],
                "user_education" => ['nullable', 'json'],
                "cnic" => ['nullable', 'string'],
                "address" => ['nullable', 'string'],
                "city" => ['nullable', 'string'],
                "country" => ['nullable', 'string'],
                "cnic_front" => ['nullable', 'string'],
                "cnic_back" => ['nullable', 'string'],
                "facebook_link" => ['nullable', 'string'],
                "linkedin_link" => ['nullable', 'string'],
                "twitter_link" => ['nullable', 'string'],
                "github_link" => ['nullable', 'string'],
                "is_active" => ['nullable', 'string'],
                "extra_attributes" => ['nullable', 'json'],
            ]);

            $result = UserDetails::create([
                "unique_id" => uniqid(),
                "user_id" => $user->id,
                'user_intro' => $request->has('user_intro') ? $request->user_intro : null,
                'user_description' => $request->has('user_description') ? $request->user_description : null,
                'user_average_response_time' => $request->has('user_average_response_time') ? $request->user_average_response_time : null,
                'user_languages' => $request->has('user_languages') ?  ZHelpers::zJsonDecode($request->user_languages) : null,
                'user_skills' => $request->has('user_skills') ?  ZHelpers::zJsonDecode($request->user_skills) : null,
                'user_education' => $request->has('user_education') ?  ZHelpers::zJsonDecode($request->user_education) : null,
                'cnic' => $request->has('cnic') ?  $request->cnic : null,
                'address' => $request->has('address') ?  $request->address : null,
                'city' => $request->has('city') ?  $request->city : null,
                'country' => $request->has('country') ?  $request->country : null,
                'cnic_front' => $request->has('cnic_front') ?  $request->cnic_front : null,
                'cnic_back' => $request->has('cnic_back') ?  $request->cnic_back : null,
                'facebook_link' => $request->has('facebook_link') ? $request->facebook_link : null,
                'linkedin_link' => $request->has('linkedin_link') ? $request->linkedin_link : null,
                'twitter_link' => $request->has('twitter_link') ? $request->twitter_link : null,
                'github_link' => $request->has('github_link') ? $request->github_link : null,
                'is_active' => $request->has('is_active') ? $request->is_active : true,
                'extra_attributes' => $request->has('extra_attributes') ?  ZHelpers::zJsonDecode($request->extra_attributes) : null,
            ]);

            if ($result) {
                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserDetailResource($result)
                ]);
            } else {
                return ZHelpers::sendBackRequestFailedResponse(['message' => "Error occurred while adding details."]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::view_invoice->name));

            $userDetail = UserDetails::where('user_id', $user->id)->first();

            if ($userDetail) {
                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserDetailResource($userDetail)
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Detail is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::update_client->name));

            $userDetail = UserDetails::where('user_id', $user->id)->first();

            if ($userDetail) {
                $request->validate([
                    "user_intro" => ['nullable', 'string'],
                    "user_description" => ['nullable', 'string'],
                    "user_average_response_time" => ['nullable', 'string'],
                    "user_languages" => ['nullable', 'json'],
                    "user_skills" => ['nullable', 'json'],
                    "user_education" => ['nullable', 'json'],
                    "cnic" => ['nullable', 'string'],
                    "address" => ['nullable', 'string'],
                    "city" => ['nullable', 'string'],
                    "country" => ['nullable', 'string'],
                    "cnic_front" => ['nullable', 'string'],
                    "cnic_back" => ['nullable', 'string'],
                    "facebook_link" => ['nullable', 'string'],
                    "linkedin_link" => ['nullable', 'string'],
                    "twitter_link" => ['nullable', 'string'],
                    "github_link" => ['nullable', 'string'],
                    "is_active" => ['nullable', 'string'],
                    "extra_attributes" => ['nullable', 'json'],
                ]);

                $userDetail->update([
                    'user_intro' => $request->has('user_intro') ? $request->user_intro : $userDetail->user_intro,
                    'user_description' => $request->has('user_description') ? $request->user_description : $userDetail->user_description,
                    'user_average_response_time' => $request->has('user_average_response_time') ? $request->user_average_response_time : $userDetail->user_average_response_time,
                    'user_languages' => $request->has('user_languages') ?  ZHelpers::zJsonDecode($request->user_languages) : $userDetail->user_languages,
                    'user_skills' => $request->has('user_skills') ?  ZHelpers::zJsonDecode($request->user_skills) : $userDetail->user_skills,
                    'user_education' => $request->has('user_education') ?  ZHelpers::zJsonDecode($request->user_education) : $userDetail->user_education,
                    'cnic' => $request->has('cnic') ?  $request->cnic : $userDetail->cnic,
                    'address' => $request->has('address') ?  $request->address : $userDetail->address,
                    'city' => $request->has('city') ?  $request->city : $userDetail->city,
                    'country' => $request->has('country') ?  $request->country : $userDetail->country,
                    'cnic_front' => $request->has('cnic_front') ?  $request->cnic_front : $userDetail->cnic_front,
                    'cnic_back' => $request->has('cnic_back') ?  $request->cnic_back : $userDetail->cnic_back,
                    'facebook_link' => $request->has('facebook_link') ? $request->facebook_link : $userDetail->facebook_link,
                    'linkedin_link' => $request->has('linkedin_link') ? $request->linkedin_link : $userDetail->linkedin_link,
                    'twitter_link' => $request->has('twitter_link') ? $request->twitter_link : $userDetail->twitter_link,
                    'github_link' => $request->has('github_link') ? $request->github_link : $userDetail->github_link,
                    'is_active' => $request->has('is_active') ? $request->is_active : $userDetail->is_active,
                    'extra_attributes' => $request->has('extra_attributes') ?  ZHelpers::zJsonDecode($request->extra_attributes) : $userDetail->extra_attributes,
                ]);

                $userDetail = UserDetails::where('user_id', $user->id)->first();

                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => new UserDetailResource($userDetail)
                ]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Detail is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    function destroy(Request $request)
    {
        try {
            $user = $request->user();

            Gate::allowIf($user->hasPermissionTo(PermissionsEnum::delete_client->name));

            $userDetail = UserDetails::where('user_id', $user->id)->first();

            if ($userDetail) {
                $userDetail->delete();
                return ZHelpers::sendBackRequestCompletedResponse(['item' => ['success' => true]]);
            } else {
                return ZHelpers::sendBackNotFoundResponse([
                    'item' => ['Detail is not found.']
                ]);
            }
        } catch (\Throwable $th) {
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }
}
