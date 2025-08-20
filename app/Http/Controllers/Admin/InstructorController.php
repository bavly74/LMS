<?php

namespace App\Http\Controllers\Admin;

use App\Events\InstructorMailEvent;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class InstructorController extends Controller
{
    public function index()
    {
        $data = Instructor::pending()->get();
        return view('admin.instructor.index', compact('data'));
    }
    public function approve(Instructor $instructor)
    {
        if ($instructor){
            $instructor->update(['status' => 'approved']);
            event(new InstructorMailEvent($instructor ,'approved'));
        }else{
            abort(404);
        }
        return redirect()->route('admin.instructor.pending');
    }
    public function reject(Instructor $instructor)
    {
        if ($instructor){
            $instructor->update(['status' => 'rejected']);
            event(new InstructorMailEvent($instructor ,'rejected'));
        }else{
            abort(404);
        }
        return redirect()->route('admin.instructor.pending');
    }
}
