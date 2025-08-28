@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row align-items-lg-start">
                <div class="col-3">
                    <a href="{{route('admin.course.category.create')}}" class="btn btn-primary">+ Add Category</a>
                </div>
            </div><br>
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
                                            <a href="{{route('admin.course.category.subcategory.index',$row->id)}}" style="margin-right: 10px" class="text-warning btn-primary"><i class="ti ti-list"></i></a>
                                            <a href="{{route('admin.course.category.edit',$row->id)}}" class="btn-primary"><i class="ti ti-edit"></i></a>
                                            <a href="{{route('admin.course.category.destroy',$row->id)}}" class="text-danger delete-item" style="margin-left: 10px" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#modal-small">
                                                <i class="ti ti-trash-x"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">No Data Found !</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                            <div class="mt-4">{{$data->links()}}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
