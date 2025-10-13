<?php

namespace App\Http\Controllers\Instructor\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\CourseStore;
use App\Http\Requests\Instructor\CourseUpdate;
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

    public function edit( int $course_id , Request $request)
    {

        switch ($request->step){
            case 1:
                $course = Course::findOrFail($course_id) ;
                return view('instructor.courses.update-basic-info',compact('course')) ;
                break;
            case 2:
                $categories = CourseCategory::with('subCategories')->where('status', 1)->get();
                $levels = CourseLevel::all();
                $languages = CourseLanguage::all();
                $course = Course::findOrFail($course_id) ;
                return view('instructor.courses.create-more-info',compact('categories','levels','languages','course')) ;
                break;
            case 3:
                return "3" ;
                break;
        }
    }

    public function update(Request $request)
    {
        $course = Course::findOrFail($request->input('id'));
        $data = $request->except(['current_step','next_step']);
        switch ($request->current_step){
            case 1:
                try {
                    if ($request->hasFile('thumbnail')) {
                        $data['thumbnail'] = upload_file($data['thumbnail'],'thumbnails');
                    }
                    if ($request->hasFile('demo_video_source')) {
                        $data['demo_video_source'] = upload_file($data['demo_video_source'],'demo_video_source');
                    }
                    $data['slug'] = Str::slug($data['title']);

                    $data['instructor_id'] = Auth::guard('instructor')->id() ;
                    $course->update($data);
                    Session::put('course_id', $course->id);
                    return response([
                        'status' => 'success',
                        'message' => 'Course updated successfully.',
                        'redirect' => route('instructor.course.edit', ['course_id'=> $course->id ,'step'=> $request->next_step] )
                    ],200);
                }catch (\Exception $exception){
                    return response()->json(['error' => $exception->getMessage()],500);
                }
                break;
            case 2:
                try {
                    $data['qna'] = $request->has('qna') ? 1 : 0;
                    $data['certificate'] = $request->has('certificate') ? 1 : 0;
                    $course->update($data);
                    return response([
                        'status' => 'success',
                        'message' => 'Course created successfully.',
                        'redirect' => route('instructor.course.edit', ['course_id'=> $course->id ,'step'=> $request->next_step] )
                    ],200);
                }catch (\Exception $exception){
                    return response()->json(['error' => $exception->getMessage()],500);
                }
                break;
        }


    }

}
