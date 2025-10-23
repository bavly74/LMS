    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('instructor.course.store-course-lesson',['id'=>$chapter_id]) }}" method="POST">
            <div class="modal-body">

                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Title *</label>
                            <input type="text" placeholder="Title" name="title"
                                value="{{ @$lesson?->title ?? old('title') }}" required>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Source </label>
                            <select class="form-control  select_js demo_video_storage" name="storage" required>
                                <option value=""> Please Select</option>
                                @foreach (config('course.storages') as $key => $source)
                                    <option @selected(@$lesson?->storage == $key) value="{{ $key }}">{{ $source }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('demo_video_storage')" class="mt-2" />
                        </div>

                    </div>

                    <div class="col-xl-6">
                        <label for="#">Path</label>
                        {{-- <div class="input-group">
                            <input id="thumbnail" class="form-control source-text" type="text" name="filepath">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail"  data-preview="holder" class="btn btn-primary source-file d-none">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>

                        </div> --}}
                        <!-- رفع فيديو -->
                        <div class="input-group video_source_input mt-2">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control demo_video_source" type="text" value="{{ @$lesson?->file_path }}"
                                name="file_path">
                        </div>

                        <!-- إدخال رابط -->
                        <div class="input-group video_text_input mt-2 d-none">
                            <input type="text" class="form-control demo_video_source" name="url" value="{{ @$lesson?->file_path }}">
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="add_course_basic_info_imput">
                            <label for="#">File Type </label>
                            <select class="form-control  select_js demo_video_storage" name="file_type" required>
                                <option value=""> Please Select</option>
                                @foreach (config('course.file_type') as $key => $source)
                                    <option @selected(@$lesson->file_type == $key) value="{{ $key }}">{{ $source }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('file_type')" class="mt-2" />
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Duration </label>
                            <input type="text" placeholder="Duration" name="duration" value="{{ @$lesson?->duration  }}" required>

                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" @checked(@$lesson?->is_preview===1)
                                    {{ old('is_preview') ? 'checked' : '' }} id="flexCheckDefault" name="is_preview">
                                <label class="form-check-label" for="flexCheckDefault">Is Preview</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" @checked(@$lesson?->is_downloadable===1)
                                    {{ old('is_downloadable') ? 'checked' : '' }} id="flexCheckDefault2"
                                    name="is_downloadable">
                                <label class="form-check-label" for="flexCheckDefault2">Downloadable</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput mb-0">
                            <label for="#">Description</label>
                            <textarea rows="8" placeholder="Description" name="description" required>{!! @$lesson?->description !!}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm').filemanager('file', {
            prefix: '/instructor/laravel-filemanager'
        });
    </script>
