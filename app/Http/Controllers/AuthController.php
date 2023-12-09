<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserLoginResource;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Login
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {

            $credentials = $request->only(['username', 'password']);

            if (!auth()->attempt($credentials)) {
                return apiResponse(
                    false,
                    'Wrong Credentials !',
                    422,
                );
            }

            return $this->respondWithToken(auth()->user(), 'Login Success');
        } catch (\Throwable $th) {
            Log::error($th);
            return apiResponse(
                false,
                'Some Thing Went Wrong !',
                500
            );
        }
    }

    /**
     * Register a new User
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $request['password'] = bcrypt($request->password);

            $model = new User();

            $user = User::create($request->all());

            if($request->has('avatar')){
                $fileName = uploadFile($request->avatar, $model->uploadDirectory);
                $fileService = new FileService();
                $fileService->addFile($user, $fileName, $model->uploadDirectory, 'avatar',$model->fileRelationName);
            }

            return $this->respondWithToken(User::find($user->id), 'Register Success');
        } catch (\Throwable $th) {
            Log::error($th);
            return apiResponse(
                false,
                'Some Thing Went Wrong !',
                500
            );
        }
    }



    /**
     * Get the token array structure.
     * @param  $user
     * @param  $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($user, $message)
    {
        $data = [
            'user' => new UserLoginResource($user),
            'token' => Auth::guard('api')->login($user)
        ];

        return apiResponse(
            true,
            $message,
            200,
            $data
        );
    }
}
