@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-3">
                    <h3>Sub categories for {{$category->name}}</h3>
                </div>
            </div>
            <div class="row align-items-lg-start justify-content-between">
                <div class="col-3">
                    <a href="{{route('admin.course.category.subcategory.create',$category->id)}}" class="btn btn-primary">+ Add Sub Category</a>
                </div>
                <div class="col-1">
                    <a href="{{route('admin.course.category.index')}}" class="btn btn-dark"><i class="ti ti-arrow-left"></i> Back</a>
                </div>
            </div>

            <br>
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table
                                class="table table-vcenter card-table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Slug</th>
                                    <th>Trending</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $i=>$row)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$row->name}}</td>
                                        <td><i class="{{$row->name}}"></i></td>
                                        <td>{{$row->slug}}</td>
                                        <td> <span class="badge bg-{{$row->show_at_trending == 1?'lime':'red'}} text-lime-fg">{{$row->show_at_trending == 1 ? 'Yes': 'No'}}</span></td>
                                        <td><span class="badge bg-{{$row->status == 1?'lime':'red'}} text-lime-fg">{{$row->status == 1 ? 'Yes': 'No'}}</span></td>
                                        <td class="d-flex">
                                            <a href="{{route('admin.course.category.subcategory.edit',['subCategory'=>$row->id])}}" class="btn-primary"><i class="ti ti-edit"></i></a>
                                            <a href="{{route('admin.course.category.subcategory.destroy',$row->id)}}" class="text-danger delete-item" style="margin-left: 10px" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#modal-small">
                                                <i class="ti ti-trash-x"></i>
                                            </a>
{{--                                            <a href="{{route('admin.course.category.subcategory.destroy',['subCategory'=>$row->id])}}" class="text-danger" >--}}
{{--                                                <i class="ti ti-trash-x"></i>--}}
{{--                                            </a>--}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">No Data Found !</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
