@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="dashboard_add_courses">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="" class="nav-link course-tab {{ request('step') == 1 ? 'active' : '' }}"
                                data-step="1">Basic Infos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="" class="nav-link course-tab {{ request('step') == 2 ? 'active' : '' }}"
                                data-step="2">More Infos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="" class="nav-link course-tab {{ request('step') == 3 ? 'active' : '' }}"
                                data-step="3">Course Contents</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="" class="nav-link course-tab {{ request('step') == 4 ? 'active' : '' }}"
                                data-step="4">Finish</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @yield('tab_content')
                    </div>
                </div>
            </div>


        </div>
        <div>
        @endsection


        @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

            <script>
                $('#lfm').filemanager('file', {
                    prefix: '/admin/laravel-filemanager'
                });
            </script>
        @endpush
