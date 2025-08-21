<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\ProfileUpdate;
use App\Models\Instructor;
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

    public function update(ProfileUpdate $request , Instructor $instructor) {

        return $this->profile->update($request , $instructor) ;
    }
}
