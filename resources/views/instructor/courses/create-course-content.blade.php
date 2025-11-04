@extends('instructor.courses.create-page')
@section('course_content')
<div class="tab-pane fade show active" id="pills-contact" role="tabpanel"
     aria-labelledby="pills-contact-tab" tabindex="0">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
        
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="add_course_content">
        <form action="" class="more_info_from course-form" method="post">
            @method('PATCH')
            @csrf
                <input type="hidden" name="id" value="{{$course_id}}">
                <input type="hidden" name="current_step" value="3">
                <input type="hidden" name="next_step"  value="4">
        </form>
        <div
            class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
            <a class="common_btn dynamic-modal-btn" data-id="{{ $course_id }}" href="#" >Add New Chapter</a>
            <a class="common_btn" href="#">Short Chapter</a>
        </div>
        <div class="accordion" id="accordionExample">
            @foreach($chapters as $chapter)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $chapter->id }}"
                            aria-expanded="true" aria-controls="collapseOne">
                        <span>{{ $chapter->title }}</span>
                    </button>
                    <div class="add_course_content_action_btn">
                        <div class="dropdown">
                            <div class="btn btn-secondary dropdown-toggle" type="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-plus"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="add-lesson" data-chapter-id= {{ $chapter->id }}><a class="dropdown-item" href="#">Add Lesson</a></li>
                                <li><a class="dropdown-item" href="#">Add Document</a></li>
                                <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                            </ul>
                        </div>
                        <a class="edit edit-chapter" href="javascript:;" data-chapter-id="{{ $chapter->id }}"><i class="far fa-edit"></i></a>
                        <a class="del delete-chapter" data-chapter-id="{{ $chapter->id }}" href="javascript:;"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </h2>
                <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="item_list sortable_list">
                            @foreach($chapter->lessons ?? [] as $lesson)
                            <li data-lesson-id="{{ $lesson->id }}">
                                <span>{{ $lesson->title }}</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit edit_lesson"
                                    data-lesson-id="{{ $lesson->id }}"
                                    data-chapter-id="{{ $chapter->id }}"
                                     href="javascript:;"><i class="far fa-edit"></i></a>
                                    <a class="del delete-lesson" href="javascript:;" data-lesson-id= {{ $lesson->id }} ><i class="fas fa-trash-alt"></i></a>
                                    <a class="arrow handle" href="javascript:;"><i class="fas fa-arrows-alt"></i></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                       
                    </div>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

