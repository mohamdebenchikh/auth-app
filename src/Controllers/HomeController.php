<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = (new Post)
            ->select([
                'posts.*', 'users.name AS user_name', 'users.photo AS user_photo'
            ])
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10)
            ->get();
        return $this->view('home', ['user' => $user, 'posts' => $posts]);
    }
}
