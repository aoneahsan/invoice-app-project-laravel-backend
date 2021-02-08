<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends AuthenticatedSessionController
{
    public function loginView()
    {
        Inertia::setRootView('layouts.frontend.index');
        return Inertia::render("Frontend/Auth/SignIn/SignIn");
    }

    public function registerView(Request $request)
    {
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/Auth/SignUp/SignUp");
    }

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6']
        ]);

        $user = User::where('email', $request->email)->first();
        // $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Invalid Email.']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Invalid Password.']
            ]);
        }

        $result = $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });

        return response()->json(['data' => "Login Success"], 200);
    }

    public function checkEmailExists(Request $request)
    {
        $request->validate([
            "email" => ["required", "max:255", "email", "string"]
        ]);
        $userExists = User::where("email", $request->email)->first();
        return empty($userExists);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ["required", "string", "min:6", "confirmed"],
            "address" => ["required", "string"],
            "company" => ["required", "string"],
            "country" => ["required", "string"],
            "zipcode" => ["required"],
            "city" => ["required"],
            // "logo" => ["file"]
        ]);

        $user = User::create([
            'name' => $request->has('name') ? $request->name : null,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "state" => $request->state,
            "country" => $request->country,
            "logo" => $request->logo,
            'company' => $request->company,
            'company_registration_number' => $request->company_registration_number,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'vat_number' => $request->vat_number,
            'default_currency' => $request->default_currency
        ]);

        event(new Registered($user));

        $this->guard->login($user);
        if ($user) {
            return response()->json(['data' => "User Created"], 200);
        } else {
            return response()->json(['message' => "Error Occured while creating user."], 500);
        }
    }

    public function completeSignupView()
    {
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/Auth/CompleteSignUp/CompleteSignUp");
    }

    public function updateUserDetails(Request $request, $id)
    {
        $request->validate([
            "email" => ["required", "max:255", "email", "string"]
        ]);

        $filePath = null;
        if ($request->hasFile("logo")) {
            $filePath = $request->file("logo")->store("userdata");
        }

        $user = User::where("id", $request->user()->id)->first();
        $result = $user->update([
            'name' => $request->has('name') ? $request->name : $user->name,
            "phone_number" => $request->has("phone_number") ? $request->phone_number : $user->phone_number,
            "address" => $request->has("address") ? $request->address : $user->address,
            "state" => $request->has("state") ? $request->state : $user->state,
            "country" => $request->has("country") ? $request->country : $user->country,
            "company" => $request->has("company") ? $request->company : $user->company,
            "company_registration_number" => $request->has("company_registration_number") ? $request->company_registration_number : $user->company_registration_number,
            "city" => $request->has("city") ? $request->city : $user->city,
            "zipcode" => $request->has("zipcode") ? $request->zipcode : $user->zipcode,
            "vat_number" => $request->has("vat_number") ? $request->vat_number : $user->vat_number,
            "default_currency" => $request->has("default_currency") ? $request->default_currency : $user->default_currency,
            "logo" => $request->has("logo") ? $request->logo : $user->logo,
            "notes" => $request->has("notes") ? $request->notes : $user->notes
        ]);

        $updatedUser = User::where("email", $id)->first();

        return response()->json(['data' => new UserProfileResource($updatedUser)], 200);
    }

    public function showVerifyEmailView(Request $request)
    {
        if (!empty($request->user()->email_verified_at)) {
            return redirect("/createinvoice");
        }
        Inertia::setRootView('layouts.frontend.index');
        return Inertia::render("Frontend/Auth/NoticeEmailVerification/NoticeEmailVerification");
    }

    public function verifyEmailAction(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/createinvoice')->with("success_message", "Account Verified Successfully!");
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success_message', 'Verification link sent!');
    }

    public function logout(Request $request)
    {
        return $this->destroy($request);
    }
}
