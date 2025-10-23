<?php

namespace App\Http\Controllers\Instructor\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseChapter;
use function Termwind\render;
use App\Http\Requests\Instructor\chapterLessonStore;
use App\Models\CourseChapterLesson;

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

    public function storeLesson(chapterLessonStore $request,$chapter_id){
        $data = $request->validated();
        $data['chapter_id'] = $chapter_id;
        $data['slug'] = \Str::slug($data['title']);
        $data['order'] = CourseChapterLesson::where('chapter_id', $chapter_id)->count() + 1;
        $data['is_preview'] = $data['is_preview'] ?? 0;
        $data['is_downloadable'] = $data['is_downloadable']??0;
        $data['file_path'] = $data['storage'] == 'upload' ? $data['file_path'] : $data['url'];
        unset($data['url']);
        CourseChapterLesson::create($data);
        return redirect()->back()->with(['success' => 'Lesson created successfully']);
    }
        
    public function editCourseLessonModal($lesson_id,$chapter_id){
        $lesson = CourseChapterLesson::findOrFail($lesson_id);
        return view('instructor.courses.partials.course-lesson-modal',compact('lesson','chapter_id'))->render();
    }

}
