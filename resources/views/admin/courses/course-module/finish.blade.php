@extends('instructor.courses.create-page')
@section('course_content')
    <div class="dashboard_add_course_finish">
        <form action="#" class="more_info_from course-form">
           @method('PATCH')
            @csrf
                <input type="hidden" name="id" value="{{$course->id}}">
                <input type="hidden" name="current_step" value="4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_more_info_input">
                        <label for="#">Message for Reviewer</label>
                        <textarea name="message_for_reviewer" rows="7" placeholder="Message for Reviewer">{!! @$course?->message_for_reviewer !!}</textarea>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_more_info_input mb-0">
                        <label for="#">Status *</label>
                        <select class="select_2" name="activity_status">
                            <option value=""> Please Select</option>
                            <option @selected(@$course?->activity_status == 'active') value="active">Active</option>
                            <option @selected(@$course?->activity_status == 'inactive') value="inactive">In Active</option>
                            <option @selected(@$course?->activity_status == 'draft') value="draft">Draft</option>
                        
                        </select>
                        <button type="submit" class="common_btn mt_25">save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
