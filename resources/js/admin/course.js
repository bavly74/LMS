
const base_url = $('meta[name="base_url"]').attr('content');
const basicInfoUrl = base_url + '/admin/course/store';
const moreInfoUrl = base_url + '/admin/course/update';
const csrfToken = $('meta[name="csrf-token"]').attr('content');
const notyf = new Notyf() ;
const loader = `<div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`;
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
        
        success: function(response) {
            window.location.reload();
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