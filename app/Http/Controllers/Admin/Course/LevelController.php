<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LevelController extends Controller
{
    public function index(){
        $data = CourseLevel::all();
        return view('admin.courses.levels.index',compact('data'));
    }

    public function create(){
        return view('admin.courses.levels.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $data['slug']=Str::slug( $data['name']) ;
        CourseLevel::create($data);
        flash()->success('Level Added Successfully');
        return redirect()->back();
    }

    public function edit(CourseLevel $level){
        return view('admin.courses.levels.edit',compact('level'));
    }

    public function update(Request $request , CourseLevel $level){
        $data = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $data['slug']=Str::slug( $data['name']) ;
        $level->update($data);
        flash()->success('Level Added Successfully');
        return redirect()->back();
    }

    public function delete(CourseLevel $level){
        try{
            $level->delete();
            flash()->success('Level Deleted Successfully');
            return response()->json([
                'message'=>'Level Deleted Successfully'
            ],200);
        }catch (\Exception $exception){
            logger($exception);
            return response()->json([
                'message'=>'Something Went Wrong',
            ],500);
        }

    }
}
