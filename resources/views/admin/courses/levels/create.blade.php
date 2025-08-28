@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <form action="{{route('admin.course.level.store')}}" class="add-lang" method="post" >
                    @csrf
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Add Level</h3>
                                <div class="input-icon">
                                    <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Level…" >
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
