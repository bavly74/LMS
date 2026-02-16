    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="">
            <div class="modal-body">
                @csrf
                        <ul class="item_list chapter_sortable_list" data-course-id = {{ $course->id }}>
                          @foreach($chapters as $chapter)
                            <li data-chapter-id="{{ $chapter->id }}" data-course-id = {{ $course->id }}>
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

<script>
    var base_url= $('meta[name="base-url"]').attr('content');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($('.chapter_sortable_list li').length) {
        // console.log($('.chapter_sortable_list').length);
        $('.chapter_sortable_list').sortable({
            "ui-sortable": "highlight",
            containment: "parent",
            cursor: "move",
            handle: ".handle",
            items: "> li",
            update:function( event, ui ){
                var sortedIDs = $(this).sortable("toArray",{attribute: 'data-chapter-id'});
                // console.log(sortedIDs);
                var course_id = ui.item.data('course-id');
                // console.log(course_id);
                $.ajax({
                    method: 'POST',
                    url:  '/instructor/course/course-chapter-sort/' + course_id,
                    data: {
                        _token: csrfToken,
                        sortedIDs: sortedIDs
                    },
                    beforeSend: function() {
                        
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            notyf.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {}
                })
                
            }
        }
        )
    }
</script>