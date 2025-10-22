    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST">
        <div class="modal-body">
          
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Title *</label>
                        <input type="text" placeholder="Title" name="title" value="{{$course->title ?? old('title')}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Source </label>
                        <select class="select_js demo_video_storage" name="demo_video_storage">
                            <option value=""> Please Select</option>
                            @foreach(config('course.storages') as $key => $source)
                            <option value="{{ $key }}">{{ $source }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('demo_video_storage')" class="mt-2"/>
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