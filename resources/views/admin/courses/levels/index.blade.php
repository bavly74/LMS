@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row align-items-lg-start">
                <div class="col-3">
                    <a href="{{route('admin.course.level.create')}}" class="btn btn-primary">+ Add Level</a>
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
                                    <th>Action</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $i=>$row)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$row->name}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('admin.course.level.edit',$row->id)}}" class="btn-primary"><i class="ti ti-edit"></i></a>
                                            <a href="{{route('admin.course.level.delete',$row->id)}}" class="text-danger delete-item" style="margin-left: 10px" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#modal-small">
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
