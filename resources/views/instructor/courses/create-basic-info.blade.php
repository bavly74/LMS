@extends('instructor.courses.create-page')
@section('course_content')


<div class="tab-pane fade show active" id="pills-home" role="tabpanel"
     aria-labelledby="pills-home-tab" tabindex="0">
    <div class="add_course_basic_info">
        <form action="#" class="basic_info_form course-form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="1" name="current_step">
            <input type="hidden" value="2" name="next_step">

            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Title *</label>
                        <input type="text" placeholder="Title" name="title" value="{{$course->title ?? old('title')}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Seo description</label>
                        <input type="text" placeholder="Seo description" name="seo_description" value="{{$course->seo_description ?? old('seo_description')}}">
                        <x-input-error :messages="$errors->get('seo_description')" class="mt-2" />
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Thumbnail *</label>
                        <input type="file" name="thumbnail">
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Demo Video Storage <b>(optional)</b></label>
                        <select class="select_js demo_video_storage" name="demo_video_storage">
                            <option value=""> Please Select</option>
                            <option value="upload">Upload</option>
                            <option value="youtube">Youtube</option>
                            <option value="vimeo">Vimeo</option>
                            <option value="external_link">External Link</option>
                        </select>
                        <x-input-error :messages="$errors->get('demo_video_storage')" class="mt-2"/>
                    </div>
                </div>
                <div class="col-xl-6">
                    <label for="#">Path</label>
                    <div class="input-group">
                        <input id="thumbnail" class="form-control source-text" type="text" name="filepath">
                        <span class="input-group-btn">
                             <a id="lfm" data-input="thumbnail"  data-preview="holder" class="btn btn-primary source-file d-none">
                               <i class="fa fa-picture-o"></i> Choose
                             </a>
                           </span>

                    </div>
                    <div id="holder" class="source-file d-none" style="margin-top:15px;max-height:100px;"></div>

                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Price *</label>
                        <input type="text" placeholder="Price" name="price" value="{{$course->price ?? old('price')}}">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        <p>Put 0 for free</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Discount Price</label>
                        <input type="text" placeholder="Price" value="{{$course->discount ?? old('discount')}}"  name="discount">
                        <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput mb-0">
                        <label for="#">Description</label>
                        <textarea rows="8" placeholder="Description" name="description"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        <button type="submit" class="common_btn mt_20 save_basic_info">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('#lfm').filemanager('image', {prefix: '/instructor/laravel-filemanager'});
    </script>
@endpush
