<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function getUser()
    {
        $user = auth()->user();
        $data = $user->getForApi();

        return response()->json(['user' => $data]);
    }

    public function updateUser(UserRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => [
                        'The password is invalid.',
                    ]
                ]
            ], 422);
        }

        $data = $request->all();

        if ($newPwd = $request->input('new_password')) {
            $data['password'] = Hash::make($newPwd);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json('ok');
    }
}
