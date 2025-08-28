<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LanguageController extends Controller
{
    public function index(){
        $data = CourseLanguage::all();
        return view('admin.courses.languages.index',compact('data'));
    }

    public function create(){
        return view('admin.courses.languages.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'language'=>'required|string|max:255',
        ]);
        $data['slug']=Str::slug( $data['language']) ;
        CourseLanguage::create($data);
        flash()->success('Language Added Successfully');
        return redirect()->back();
    }

    public function edit(CourseLanguage $language){
        return view('admin.courses.languages.edit',compact('language'));
    }

    public function update(Request $request , CourseLanguage $language){
        $data = $request->validate([
            'language'=>'required|string|max:255',
        ]);
        $data['slug']=Str::slug( $data['language']) ;
        $language->update($data);
        flash()->success('Language Added Successfully');
        return redirect()->back();
    }

    public function delete(CourseLanguage $language){
        try{
            $language->delete();
            flash()->success('Language Deleted Successfully');
            return response()->json([
                'message'=>'Language Deleted Successfully'
            ],200);
        }catch (\Exception $exception){
            logger($exception);
            return response()->json([
                'message'=>'Something Went Wrong',
            ],500);
        }

    }
}
