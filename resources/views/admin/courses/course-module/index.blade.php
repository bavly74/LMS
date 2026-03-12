@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row align-items-lg-start">
                <div class="col-3">
                    <a href="{{route('admin.course.create')}}" class="btn btn-primary">+ Add Course</a>
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
                                    <th>Instructor</th>
                                    <th>Price</th>
                                    <th>status</th>
                                    <th>Action</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $i=>$row)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->instructor->name}}</td>
                                        <td>{{$row->price}}</td>
                                        <td>
                                            <span class="badge bg-{{ match($row->status) {
                                                'pending' => 'warning',
                                                'approved' => 'success',
                                                default => 'danger'
                                            } }}" 
                                            style="color:white">
                                                {{ $row->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm update-course-status" data-id="{{$row->id}}">
                                                <option value="pending" {{$row->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                                <option value="approved" {{$row->status == 'approved' ? 'selected' : ''}}>Approved</option>
                                                <option value="rejected" {{$row->status == 'rejected' ? 'selected' : ''}}>Rejected</option>
                                            </select>
                                        </td>
                                        {{-- <td class="d-flex">
                                            <a href="{{route('admin.course.level.edit',$row->id)}}" class="btn-primary"><i class="ti ti-edit"></i></a>
                                            <a href="{{route('admin.course.level.delete',$row->id)}}" class="text-danger delete-item" style="margin-left: 10px" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#modal-small">
                                                <i class="ti ti-trash-x"></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">No Data Found !</td>
                                    </tr>
                                @endforelse

                                </tbody>
                                
                            </table>
                            <div class="mt-4 text-center">{{ $data->links() }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
@vite(['resources/js/admin/course.js'])
@endpush