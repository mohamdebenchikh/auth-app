<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Validator;
use App\Models\Post;

class PostController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $text = $this->request->input('text');
        
        $validator = new Validator(['text'=>$text]);

        $validator->validate([
            'text' => 'required|string|maxLength:500',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInputs(['text'=>$text]);
        }

        (new Post)->create(['user_id'=>$user->id,'text'=>$text]);
        return redirect()->back()->with('success','Your post has been pubished');
    }
}
