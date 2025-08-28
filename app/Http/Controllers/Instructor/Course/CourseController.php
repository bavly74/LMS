<?php

namespace App\Http\Controllers\Instructor\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\CourseStore;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(){
        return view('instructor.courses.index');
    }

    public function create(){
        return view('instructor.courses.create-basic-info');
    }
    public function store(CourseStore $request){
         $data = $request->validated();
        try {
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = upload_file($data['thumbnail'],'thumbnails');
            }
            if ($request->hasFile('demo_video_source')) {
                $data['demo_video_source'] = upload_file($data['demo_video_source'],'demo_video_source');
            }
            $data['slug'] = Str::slug($data['title']);
            $data['instructor_id'] = Auth::guard('instructor')->id() ;
            $data['category_id'] = 6 ;
            $course = Course::create($data);
            Session::put('course_id', $course->id);
            return response([
                'status' => 'success',
                'message' => 'Course created successfully.',
                'redirect' => route('instructor.course.edit', ['course_id'=> $course->id ,'step'=> $request->next_step] )
            ],200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()],500);
        }

    }

    public function edit($id , Request $request)
    {
        switch ($request->step){
            case 1:
                return "1" ;
                break;
            case 2:
                $categories = CourseCategory::with('subCategories')->where('status', 1)->get();
                $levels = CourseLevel::all();
                $languages = CourseLanguage::all();
                return view('instructor.courses.create-more-info',compact('categories','levels','languages')) ;
                break;
            case 3:
                return "3" ;
                break;
        }
    }

}
