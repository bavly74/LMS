<?php

namespace App\Repositories;

use App\Interfaces\ProfileInterface;
use App\Models\Instructor;
use App\Models\User;

class ProfileRepository implements ProfileInterface
{
    public function index($guard){
        if ($guard->name == "web"){
            $data = User::findorfail($guard->user()->id);
            return view('student.profile.index', compact('data')) ;
        }else{
            $data = Instructor::findorfail($guard->user()->id);
            return view('instructor.profile.index', compact('data')) ;
        }
    }

    public function update($request , $user){
        $data = $request->validated();

        if ($request->file('image')) {
            $image = upload_file($request->file('image') , 'images');
            $data['image'] = $image;
        }
        if ($request->file('document')) {
            $image = upload_file($request->file('document') , 'document');
            $data['document'] = $image;
        }

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data) ;
        flash()->success('Your Profile Updated Successfully');
        return redirect()->back();

    }

}
