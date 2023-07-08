<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    private static $user;

    /**
     * Perform user login
     *
     * @param User $user
     * @return bool
     */
    public static function login($user)
    {
        $auth = [
            'status' => true,
            'user_id' => $user->id,
        ];
        Session::set('auth', $auth);
        return true;
    }

    /**
     * Perform user logout
     *
     * @return bool
     */
    public static function logout()
    {
        Session::remove('auth');
        Session::regenerate();
        self::$user = null; // Clear the cached user
        return true;
    }

    /**
     * Attempt user login with provided credentials
     *
     * @param array $credentials
     * @return bool
     */
    public static function attempt($credentials)
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        // Retrieve the user from the database based on the email
        $user = (new User())->where('email', '=', $email)->first();

        if (!$user) {
            return false; // User not found
        }

        // Verify the password
        if (password_verify($password, $user->password)) {
            // Password matches, perform login
            self::login($user);
            return true;
        }

        return false; // Invalid credentials
    }

    /**
     * Check if a user is currently logged in
     *
     * @return bool
     */
    public static function check()
    {
        $auth = Session::get('auth');
        return isset($auth['status']) && $auth['status'] === true;
    }

    /**
     * Retrieve the currently logged in user
     *
     * @return User|null
     */
    public static function user()
    {
        if (self::check()) {
            if (!self::$user) {
                $id = Session::get('auth')['user_id'];
                self::$user = (new User())->find($id);
            }
            return self::$user;
        }
        return null;
    }
}
