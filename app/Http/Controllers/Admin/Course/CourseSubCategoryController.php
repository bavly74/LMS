<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSubCategoryStore;
use App\Http\Requests\Admin\CourseSubCategoryUpdate;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseSubCategoryController extends Controller
{
    public function index(CourseCategory $category){
        //$data = CourseCategory::getSubCategories($category->id);
        $data = $category->subCategories;
        return view('admin.courses.subcategories.index', compact('category','data'));
    }

    public function create(CourseCategory $category){
        return view('admin.courses.subcategories.create', compact('category'));
    }

    public function store(CourseSubCategoryStore $request, CourseCategory $category ){
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = upload_file($data['image'], 'categories');
        }
        $data['status'] = $data['status'] ?? 0 ;
        $data['slug'] = Str::slug($data['name'])  ;
        $data['show_at_trending'] = $data['show_at_trending'] ?? 0 ;
        $data['parent_id']=$category->id ;
        CourseCategory::create($data);
        flash()->success('sub category created successfully');
        return redirect()->route('admin.course.category.subcategory.index', compact('category'));
    }

    public function edit( CourseCategory $subCategory)
    {
        return view('admin.courses.subcategories.edit', compact('subCategory'));
    }

    public function update(CourseSubCategoryUpdate $request ,  CourseCategory $subCategory)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = upload_file($data['image'], 'categories');
        }
        $data['status'] = $data['status'] ?? 0 ;
        $data['slug'] = Str::slug($data['name'])  ;
        $data['show_at_trending'] = $data['show_at_trending'] ?? 0 ;
        $subCategory->update($data);
        flash()->success('sub category created successfully');
        return redirect()->back();
    }

    public function destroy(CourseCategory $subCategory)
    {

        try{
            $subCategory->delete();
            flash()->success('Category Deleted Successfully');
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
