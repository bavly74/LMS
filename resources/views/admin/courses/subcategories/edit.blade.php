@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Sub Category</h3>
                    <div class="card-actions">
                        <a href="{{route('admin.course.category.index')}}" class="btn btn-primary" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.course.category.subcategory.update',['subCategory'=>$subCategory->id])}}" class="add-lang" method="post" enctype="multipart/form-data" >
                        @csrf
                        @method('PATCH')
                        @if($subCategory->image)
                            <div class="row mb-4">
                                <x-image-view src="{{asset('storage/'.$subCategory->image)}}" />
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-6">
                                <x-input-block name="name" value="{{$subCategory->name}}" placeholder="Enter Name" type="text" label="Name" />
                            </div>

                            <div class="col-6">
                                <x-input-block name="icon" value="{{$subCategory->icon}}" placeholder="Enter Icon" type="text" label="Icon" />
                            </div>

                            <div class="col-12">
                                <x-input-file-block name="image" label="Image" />
                            </div>

                            <div class="col-3">
                                <x-input-toggle-block name="show_at_trending" checked="{{$subCategory->show_at_trending==1 ? 'true' : ''}}"  label="show at trending" />
                            </div>

                            <div class="col-3">
                                <x-input-toggle-block name="status" checked="{{$subCategory->status==1 ? 'true' : ''}}" label="status" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div>
            </div>

@endsection
