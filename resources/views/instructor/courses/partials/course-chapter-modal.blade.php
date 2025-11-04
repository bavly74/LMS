    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action=" {{ @$chapter ? route('instructor.course.course-chapter.update',$chapter->id) :  route('instructor.course.course-chapter.store', ['id'=>$course_id] ) }}" method="POST">
        {{ @$chapter ? method_field('PATCH') : '' }}
        <div class="modal-body">
          
            @csrf
            <div class="mb-3">
              <label for="chapter-title" class="form-label">Chapter Title</label>
              <input type="text" class="form-control" value="{{ @$chapter?->title  }}" name="title" id="chapter-title" placeholder="Enter chapter title">
            </div>
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>