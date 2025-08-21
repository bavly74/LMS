@extends('frontend.layouts.master')

@section('content')
    <!--===========================
        BREADCRUMB START
    ============================-->
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Student Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        BREADCRUMB END
    ============================-->


    <!--===========================
        DASHBOARD OVERVIEW START
    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                            <div class="wsus__dashboard_profile_delete">
                                <a href="#" class="common_btn">Delete Profile</a>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                            <div class="img">
                                <img src="{{asset($data->image)}}" alt="profile" class="img-fluid w-100">
                                <label for="profile_photo">
                                    <img src="{{asset('frontend/assets/images/dash_camera.png')}}" alt="camera" class="img-fluid w-100">
                                </label>

                            </div>
                            <div class="text">
                                <h6>{{$data->name}}</h6>
                                <p>PNG or JPG no bigger than 400px wide and tall.</p>
                            </div>
                        </div>

                        <form action="{{route('instructor.profile.update',$data->id)}}" method="post" class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <input type="file" name="image" accept=".jpg,.jpeg" id="profile_photo" hidden="">
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{$data->name}}" placeholder="Enter your name">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{$data->email}}" placeholder="Enter your email">                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                </div>


                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>headline</label>
                                        <input type="text" name="headline" value="{{$data->headline}}" placeholder="Enter headline">
                                        <x-input-error :messages="$errors->get('headline')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="{{$data->facebook}}" placeholder="Enter FaceBook ">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>x</label>
                                        <input type="text" name="x" value="{{$data->x}}"  placeholder="Enter X ">
                                        <x-input-error :messages="$errors->get('x')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Linked In</label>
                                        <input type="text" name="linkedin" value="{{$data->linkedin}}" placeholder="Enter linkedin ">
                                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Website</label>
                                        <input type="text" name="website" value="{{$data->website}}" placeholder="Enter website ">
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>git hub</label>
                                        <input type="text" name="github"  value="{{$data->github}}" placeholder="Enter github ">
                                        <x-input-error :messages="$errors->get('github')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Gender</label>
                                        <select class="select_2 select2-hidden-accessible" name="gender">
                                            <option value=""    >Choose...</option>
                                            <option @selected($data->gender=='male') value="male">Male</option>
                                            <option @selected($data->gender=='female') value="female">Female</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Bio</label>
                                        <textarea rows="7" name="bio" placeholder="Your text here">{{$data->bio}}</textarea>
                                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Password</label>
                                        <input type="password" name="password"  placeholder="password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Password Confirmation</label>
                                        <input type="password" name="password_confirmation"  placeholder="password confirmation">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        DASHBOARD OVERVIEW END
    ============================-->
@endsection
