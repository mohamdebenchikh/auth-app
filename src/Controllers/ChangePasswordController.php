<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Validator;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $this->view('change-password', ['user' => $user]);
    }

    public function update()
    {
        $data = $this->request->only(['old_password', 'password', 'password_confirmation']);

        $validator = new Validator($data);
        $user = Auth::user();

        $validator->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|minLength:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if (password_verify($data['old_password'], $user->password)) {
            (new User)->where('id', '=', $user->id)->update([
                'password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);
            return redirect()->to(url('/profile'))->with('success', 'Your password has been change.');
        }

        return redirect()->back()->withError('old_password', 'The old password is incorrect.');
    }
}
