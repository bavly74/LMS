<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStore;
use App\Http\Requests\Admin\CourseCategoryUpdate;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CourseCategory::whereNull('parent_id')->paginate(10);
        return view('admin.courses.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStore $request)
    {
        $data = $request->validated();
        $data['image'] = upload_file($data['image']  , 'categories');
        $data['status'] = $data['status'] ?? 0 ;
        $data['slug'] = Str::slug($data['name'])  ;
        $data['show_at_trending'] = $data['show_at_trending'] ?? 0 ;
        CourseCategory::create($data) ;
        flash()->success('Category Created Successfully');
        return redirect(route('admin.course.category.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $category)
    {
        return view('admin.courses.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdate $request, CourseCategory $category)
    {
       $data = $request->validated();
       if ($request->hasFile('image')) {
           if ($category->image && \Storage::disk('public')->exists($category->image)) {
               \Storage::disk('public')->delete($category->image);
           }
           $data['image'] = upload_file($data['image']  , 'categories');
       }
        $data['status'] = $data['status'] ?? 0 ;
        $data['slug'] = Str::slug($data['name'])  ;
        $data['show_at_trending'] = $data['show_at_trending'] ?? 0 ;
        $category->update($data) ;
       flash()->success('Category Updated Successfully');
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $category)
    {
        if ($category->subCategories()->exists()) {
            return response()->json([
                'message'=>'Cant delete this category because it has subcategories',
            ],422);
        }
        try{
            $category->delete();
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
