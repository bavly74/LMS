@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
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
                                    <th>Email</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $i=>$row)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td><a href="{{asset('storage'.$row->document)}}" download  ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-bar-to-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20l16 0" /><path d="M12 14l0 -10" /><path d="M12 14l4 -4" /><path d="M12 14l-4 -4" /></svg></a> </td>
                                        <td class="d-flex">
                                            <a href="{{route('admin.instructor.approve',['instructor'=>$row->id])}}" class="btn btn-success w-20">Approve</a>
                                            <a href="{{route('admin.instructor.reject',['instructor'=>$row->id])}}" class="btn btn-danger w-20" style="margin-left: 10px">Reject</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        Empty
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
