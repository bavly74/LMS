<?php

namespace App\Http\Controllers\Instructor\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Termwind\render;

class CourseContentController extends Controller
{
    public function courseChapterModal(): string{
        return view('instructor.courses.partials.course-chapter-modal')->render();
    }
}
