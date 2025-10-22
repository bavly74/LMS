<?php

namespace App\Http\Controllers\Instructor\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseChapter;
use function Termwind\render;

class CourseContentController extends Controller
{
    public function courseChapterModal($course_id): string{
        return view('instructor.courses.partials.course-chapter-modal',compact('course_id'))->render();
    }

    public function storeCourseChapter(Request $request,$course_id){
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        CourseChapter::create([
            'title' => $data['title'],
            'course_id' => $course_id,
            'order'=> CourseChapter::where('course_id', $course_id)->count() + 1,
        ]);

        return redirect()->back()->with(['success' => 'Chapter created successfully']);
    }

    public function courseLessonModal($chapter_id){
        
        return view('instructor.courses.partials.course-lesson-modal',compact('chapter_id'))->render();
    }
}
