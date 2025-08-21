<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ProfileUpdate;
use App\Models\User;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profile ;
    public function __construct(ProfileRepository $profile){
        $this->profile = $profile;
    }

    public function index() {
        return $this->profile->index(Auth::guard()) ;
    }

    public function update(ProfileUpdate $request , User $user) {
        return $this->profile->update($request , $user) ;
    }

}
