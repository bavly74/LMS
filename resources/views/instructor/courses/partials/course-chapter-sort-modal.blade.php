    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="">
            <div class="modal-body">
                @csrf
                        <ul class="item_list">
                          @foreach($chapters as $chapter)
                            <li>
                                <span>{{ $chapter->title }}</span>
                                <div class="add_course_content_action_btn">
                                    
                                    <a class="arrow handle" href="javascript:;"><i
                                            class="fas fa-arrows-alt" aria-hidden="true"></i></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
