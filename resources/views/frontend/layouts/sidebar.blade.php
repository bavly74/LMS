@if(auth()->guard()->name == "web")
    <div class="col-xl-3 col-md-4 wow fadeInLeft">
        <div class="wsus__dashboard_sidebar">
            <div class="wsus__dashboard_sidebar_top">
                <div class="dashboard_banner">
                    <img src="{{asset('frontend/assets/images/single_topic_sidebar_banner.jpg')}}" alt="img" class="img-fluid">
                </div>
                <div class="img">
                    <img src="{{asset(auth()->user()->image)}}" alt="profile" class="img-fluid w-100">
                </div>
                <h4>{{auth()->user()->name}}</h4>
                <p>Student</p>
            </div>
            <ul class="wsus__dashboard_sidebar_menu">
                <li>
                    <a href="dashboard.html" class="active">
                        <div class="img">
                            <img src=" {{asset('frontend/assets/images/dash_icon_8.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('student.profile.index')}}">
                        <div class="img">
                            <img src=" {{asset('frontend/assets/images/dash_icon_1.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="javascript: ;" onclick=" event.preventDefault() ; $('.std-logout').submit()">
                        <div class="img">
                            <img src=" {{asset('frontend/assets/images/dash_icon_16.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Logout
                    </a>
                </li>
                <!-- Authentication -->
                <form method="POST" class="std-logout" action="{{ route('logout') }}">
                    @csrf


                </form>
            </ul>

        </div>
    </div>
@else
    <div class="col-xl-3 col-md-4 wow fadeInLeft">
        <div class="wsus__dashboard_sidebar">
            <div class="wsus__dashboard_sidebar_top">
                <div class="dashboard_banner">
                    <img src="{{asset('frontend/assets/images/single_topic_sidebar_banner.jpg')}}" alt="img" class="img-fluid">
                </div>
                <div class="img">
                    <img src="{{asset( auth()->guard('instructor')->user()->image ) }}" alt="profile" class="img-fluid w-100">
                </div>
                <h4>{{auth()->guard('instructor')->name}}</h4>
                <p>Instructor</p>
            </div>
            <ul class="wsus__dashboard_sidebar_menu">
                <li>
                    <a href="{{route('instructor.dashboard')}}" class="active">
                        <div class="img">
                            <img src="{{asset('frontend/assets/images/dash_icon_8.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('instructor.profile.index')}}">
                        <div class="img">
                            <img src="{{asset('frontend/assets/images/dash_icon_1.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="{{route('instructor.course.index')}}">
                        <div class="img">
                            <img src="{{asset('frontend/assets/images/dash_icon_1.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Courses
                    </a>
                </li>

                <li>
                    <a href="javascript: ;" onclick="event.preventDefault(); $('#logout').submit()">
                        <div class="img">
                            <img src="{{asset('frontend/assets/images/dash_icon_16.png')}}" alt="icon" class="img-fluid w-100">
                        </div>
                        Sign Out
                    </a>
                    <!-- Authentication -->
                    <form method="POST" id="logout" action="{{ route('instructor.logout') }}">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endif
