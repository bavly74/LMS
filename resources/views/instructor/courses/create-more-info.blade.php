@extends('instructor.courses.create-page')
@section('course_content')

    <div id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

        <div class="add_course_more_info">
            <form action="#" class="more_info_from course-form" method="post">
                <input type="hidden" name="id" value="{{$course->id}}">
                <input type="hidden" name="current_step" value="2">
                <input type="hidden" name="next_step"  value="3">

                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="#">Capacity</label>
                            <input type="text" placeholder="Capacity" name="capacity" value="{{$course->capacity ?? old('capacity')}}">
                            <p>leave blank for unlimited</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="#">Course Duration (Minutes)*</label>
                            <input type="text" placeholder="300" name="duration" value="{{$course->duration ?? old('duration')}}" >
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"   {{ old('qna', $course->qna) ? 'checked' : '' }}
                                       id="flexCheckDefault" name="qna">
                                <label class="form-check-label"
                                       for="flexCheckDefault">Q&A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{$course->certificate == 1 ? 'checked':''}}
                                       id="flexCheckDefault2" name="certificate">
                                <label class="form-check-label"
                                       for="flexCheckDefault2">Completion
                                    Certificate</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="add_course_more_info_input">
                            <label for="#">Category *</label>
                            <select class="select_2 form-control" name="category_id">
                                <option value=""> Please Select</option>
                                @foreach($categories as $category)
                                    @if($category->subCategories->isNotEmpty())
                                        <optgroup label="{{$category->name}}">
                                            @foreach($category->subCategories as $subCategory)
                                                <option {{$course->category_id == $subCategory->id ? 'selected':''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Level</h3>
                            @foreach($levels as $level)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{$level->id}}" {{$course->course_level == $level->id ? 'checked':''}}
                                           name="course_level" id="level-{{$level->id}}"
                                           >
                                    <label class="form-check-label" for="level-{{$level->id}}">
                                        {{$level->name}}
                                    </label>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Language</h3>
                            @foreach($languages as $language)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="course_language" id="language-{{ $language->id }}" {{$course->course_language == $language->id ? 'checked':''}}
                                          value="{{$language->id}}" >
                                    <label class="form-check-label" for=" language-{{ $language->id }}">
                                        {{ $language->language }}
                                    </label>
                                </div>
                            @endforeach



                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

