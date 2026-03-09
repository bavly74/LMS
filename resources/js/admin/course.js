function updateCourseStatus(courseId, status) {
    $.ajax({
        url: '/admin/course/update-status/' + courseId,
        method: 'POST',
        data: {
            status: status
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            // Optionally, show a loading indicator
        },
        success: function(response) {
            alert('Course status updated successfully!');
        },
        error: function(xhr) {
            alert('An error occurred while updating the course status.');
        }
    });

}

$(function() {
    $('.update-course-status').change(function() {
        var courseId = $(this).data('id');
        var status = $(this).val();
        updateCourseStatus(courseId, status);
    });
});