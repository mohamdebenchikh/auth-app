<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Session;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        if ($this->isRequestMethod('GET')) {
            return $this->view('auth/login');
        }
        $data = $this->request()->only(['email', 'password']);
        $validator = new Validator($data);

        $validator->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            $this->response()->setStatusCode(422);
            return redirect()->back()->withErrors($validator->errors())->withInputs($data);
        }

        if (Auth::attempt($data)) {
            return redirect()->to(url('/home'));
        }

        $this->response()->setStatusCode(422);
        return redirect()->back()->withError('email', 'Invalid email or password.')->withInputs($data);
    }


    public function register()
    {
        if ($this->isRequestMethod('GET')) {
            return $this->view('auth/register');
        }

        $data = $this->request()->only(['name', 'email', 'password', 'password_confirmation']);
        $validator = new Validator($data);

        $validator->validate([
            'name' => 'required|string|maxLength:50',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|minLength:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        if ($validator->fails()) {
            $this->response()->setStatusCode(422);
            return redirect()->back()->withErrors($validator->errors())->withInputs($data);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = (new User())->create($data);

        Auth::login($user);

        return $this->redirect()->to(url('/home'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to(url('/login'));
    }
}
