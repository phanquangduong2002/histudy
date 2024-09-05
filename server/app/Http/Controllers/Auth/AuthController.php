<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseResourceCollection;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\Course;
use App\Models\User;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh']]);
    }


    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'username.required' => 'Name is required.',
            'username.string' => 'Name must be a string.',
            'username.unique' => 'This username already exists.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email format is invalid.',
            'email.max' => 'Email may not be greater than 100 characters.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 5 characters.',
            'password.max' => 'Password may not be greater than 100 characters.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:5|max:100',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]
        ));

        Cart::createCart();
        Wishlist::createWishlist();

        $token =  Auth::login($user);

        $refreshToken = $this->createRefreshToken();

        return $this->createNewToken($token, $refreshToken);
    }

    public function login(Request $request)
    {

        $messages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Email format is invalid.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 5 characters.',
            'password.max' => 'Password may not be greater than 100 characters.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:100'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        if (!$token = Auth::attempt($validator->validated())) {
            return response()->json(['success' => false, 'errors' => ['email' => ['Wrong account or password'], 'password' => ['Wrong account or password']]], 422);
        }

        $refreshToken = $this->createRefreshToken();

        return $this->createNewToken($token, $refreshToken);
    }

    public function profile()
    {
        try {
            $user = Auth::user();

            return response()->json(
                [
                    'success' => true,
                    'user' => new UserResource($user),
                ],
                200
            );
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }
    }

    public function updateProfile(UserRequest $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);

        $user->updateUser($request->all());

        return response()->json(
            [
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => new UserResource($user),
            ],
            200
        );
    }

    public function changePassword(Request $request)
    {

        $messages = [
            'password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least :min characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ];

        $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|min:5|confirmed',
        ], $messages);


        $userId = Auth::id();
        $user = User::find($userId);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'password' => ['Wrong password']
                ]
            ], 422);
        }

        $user->updateUser([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully!',
        ], 200);
    }

    public function logout()
    {
        try {
            Auth::logout();
            return response()->json(['success' => true, 'message' => 'User successfully signed out']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function refresh()
    {
        $refreshToken = request()->refresh_token;
        try {
            $decoded = JWTAuth::getJWTProvider()->decode($refreshToken);

            $user = User::find($decoded['sub']);

            if (!$user) return response()->json(['success' => false, 'error' => 'User not found', 404]);

            // Auth::invalidate();

            $token = Auth::login($user);
            $refreshToken = $this->createRefreshToken();


            return $this->createNewToken($token, $refreshToken);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Refresh token Invalid'], 500);
        }
    }

    private function createNewToken($token, $refreshToken)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'access_token' => $token,
                'refresh_token' => $refreshToken,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => Auth::user()
            ]
        ]);
    }

    private function createRefreshToken()
    {
        $data = [
            'sub' => Auth::user()->id,
            'random' => rand() . time(),
            'exp' => time() + config('jwt.refresh_ttl')
        ];

        $refreshToken = JWTAuth::getJWTProvider()->encode($data);

        return $refreshToken;
    }
}
