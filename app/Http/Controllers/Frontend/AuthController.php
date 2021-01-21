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
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ["required", "string", "min:6"]
        ]);

        $user = User::create([
            'name' => $request->has('name') ? $request->name : null,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
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

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            "email" => ["required", "max:255", "email", "string"]
        ]);

        $user = User::where("email", $request->email)->first();
        $result = User::where("email", $request->email)->update([
            "phone_number" => $request->phone_number,
            "mobile_number" => $request->mobile_number,
            "phone_number_alert" => $request->has('phone_number') && $request->phone_number_alert,
            "mobile_number_alert" => $request->has('mobile_number') && $request->mobile_number_alert,
            "address" => $request->address,
            "dvc_policy_accepted" => $request->has('dvc_policy_accepted') ? $request->dvc_policy_accepted : $user->dvc_policy_accepted,
            "role" => $request->has('role') ? $request->role : $user->role
        ]);

        $updatedUser = User::where("email", $request->email)->with('user_details')->first();

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
