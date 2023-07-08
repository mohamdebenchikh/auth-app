<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Storage;
use App\Core\Validator;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $this->view('profile', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();
        return $this->view('edit-profile', ['user' => $user]);
    }

    public function update()
    {
        $data = $this->request->all();
        unset($data['url']);

        $photo = null;
        $cover = null;

        $validator = new Validator($data);
        $user = Auth::user();

        $validator->validate([
            'name' => 'required|string|maxLength:55',
            'email' => 'required|email|unique:users,id,' . $user->id,
            'bio' => 'string|maxLength:500',
            'location' => 'string|maxLength:55',
            'job_title' => 'string|maxLength:55',
            'phone' => 'phone',
            'birthday' => 'date',
            'gender' => 'in:male,female',
        ]);


        if ($this->request->hasFile('photo')) {
            $photo = $this->request->file('photo');
            $validator->addField('photo', $photo)
                ->validate(['photo' => 'file|image:jpg,jpeg,png|maxSize:2048']);
        }

        if ($this->request->hasFile('cover')) {
            $cover = $this->request->file('cover');
            $validator->addField('cover', $cover)
                ->validate(['cover' => 'file|image:jpg,jpeg,png|maxSize:2048']);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInputs($data);
        }

        if (empty($data['birthday'])) $data['birthday'] = null;
        if (empty($data['gender'])) $data['gender'] = null;

        if($photo) $data['photo'] = (new Storage)->store($photo,'images/users');
        if($cover) $data['cover'] = (new Storage)->store($cover,'images/users');

        if((new User)->where('id','=',$user->id)->update($data)){
            return redirect()->to(url('/profile'))->with('success','Your profile information updated');
        }
        return redirect()->back()->with('error','Something is wrong please try again.');

    }
}
