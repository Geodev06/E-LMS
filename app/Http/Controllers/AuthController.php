<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Helpers\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store_user(RegisterRequest $request)
    {

        try {
            DB::beginTransaction(); // Start the transaction

            $data = [
                'name' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            User::create($data);

            DB::commit(); // Commit the transaction

            return response()->json(
                [
                    'status' => 200,
                    'msg' => Constants::REGISTER_SUCCESS_MESSAGE
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack(); // Roll back the transaction

            return response()->json($th->getMessage(), 500); // Return the error message
        }
    }

    public function auth_user(Request $request)
    {
        try {
            DB::beginTransaction(); // Start the transaction

            // Validate the request data
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed
                $user = Auth::user();


                if ($user->role_code == 'ADMIN') {
                    return response()->json(['link' => route('admin.dashboard')]);
                }

                if ($user->role_code == 'USER') {
                    return response()->json(['link' => '/']);
                }

                DB::commit(); // Commit the transaction

            }
            DB::rollBack(); // Roll back the transaction
            return response()->json(Constants::LOGIN_FAILED_MESSAGE, 401);
        } catch (\Throwable $th) {
            DB::rollBack(); // Roll back the transaction

            return response()->json($th->getMessage(), 500); // Return the error message
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout(); // Log out the user
            // Optionally invalidate the session (this is generally handled by Auth::logout)
            request()->session()->invalidate();
            request()->session()->regenerateToken(); // Regenerate CSRF token

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully.',
                'link' => '/login'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'You are already logged out.',
            'link' => '/login'
        ]);
    }
}
