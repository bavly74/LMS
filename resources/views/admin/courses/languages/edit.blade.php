@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <form action="{{route('admin.course.language.update',$language->id)}}" class="add-lang" method="post" >
                    @csrf
                    @method("PATCH")
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Add Language</h3>
                                <div class="input-icon">
                                    <input type="text" value="{{$language->language}}" name="language" class="form-control" placeholder="Language…" >
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div>
@endsection
