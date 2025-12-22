const base_url = $('meta[name="base_url"]').attr('content');
const basicInfoUrl = base_url + '/instructor/course/store';
const moreInfoUrl = base_url + '/instructor/course/update';
const csrfToken = $('meta[name="csrf-token"]').attr('content');
const notyf = new Notyf() ;
const loader = `<div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`;
$('.course-tab').on('click', function(e){
    e.preventDefault();
    // console.log('yaa');
   let step = $(this).data('step');
   $('.course-form').find('input[name="next_step"]').val(step);
    $('.course-form').trigger('submit');
});

$(document).ready(function() {
    $(document).on('change','.demo_video_storage', function() {
        let value = $(this).val();
        $('.demo_video_source').val('');

        if (value === 'upload') {
            $('.video_source_input').removeClass('d-none');
            $('.video_text_input').addClass('d-none');
        } else {
            $('.video_source_input').addClass('d-none');
            $('.video_text_input').removeClass('d-none');
        }
    });
});



$('.basic_info_form').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
       method: 'POST',
       url: basicInfoUrl,
       data: formData ,
        contentType: false,
        processData: false,

       beforeSend: function() {
            $('.save_basic_info').text('loading...');
       } ,
        success: function(data) {

            if (data.status == 'success') {

                window.location.href = data.redirect;
                notyf.error(data.message);
            }
        },
        error: function(xhr, status, error) {
            if (xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                       notyf.error(value[0]);
                    });

                }
            }

        } ,
        complete: function() {
            $('.save_basic_info').text('Save');
        },

    });
})

$('.update_basic_info_form').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        method: 'POST',
        url: moreInfoUrl,
        data: formData ,
        contentType: false,
        processData: false,

        beforeSend: function() {
            $('.save_basic_info').text('loading...');
        } ,
        success: function(data) {

            if (data.status == 'success') {

                window.location.href = data.redirect;

            }
        },
        error: function(xhr, status, error) {
            if (xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        notyf.error(value[0]);
                    });

                }
            }

        } ,
        complete: function() {
            $('.save_basic_info').text('Save');
        },

    });
})
$('.more_info_from').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        method: 'POST',
        url: moreInfoUrl,
        data: formData ,
        contentType: false,
        processData: false,


        beforeSend: function() {

        },
        success: function(data) {
            if (data.status=='success') {
                window.location.href = data.redirect;
            }
        },
        error: function(xhr, status, error) {
            if (xhr.responseJSON) {
                console.log(xhr.responseJSON)
                if (xhr.responseJSON.error) {
                    notyf.error(xhr.responseJSON.error);
                }
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, value) {
                        notyf.error(value[0]);
                    });

                }
            }

        } ,
    })
})


// Course Content Js
$('.dynamic-modal-btn').on('click', function(e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    var course_id = $(this).data('id');
    $.ajax({
        method: 'GET',
        url: base_url + '/instructor/course/course-chapter-modal/'+ course_id,
        data:{} ,
        beforeSend: function() {
            $('.dynamic-modal-content').html(loader);
            
        },
        success: function(data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function(xhr, status, error) {
            // $('#dynamic-modal .modal-body').html('<h3 class="text-center text-danger">An error occurred. Please try again.</h3>');
        }
    });
});


$('.add-lesson').on('click', function(e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    var chapter_id = $(this).data('chapter-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/instructor/course/course-lesson-modal/'+ chapter_id,
        data:{} ,
        beforeSend: function() {
            $('.dynamic-modal-content').html(loader);
            
        },
        success: function(data) {
           
            $('.dynamic-modal-content').html(data);
        },
        error: function(xhr, status, error) {
            // $('#dynamic-modal .modal-body').html('<h3 class="text-center text-danger">An error occurred. Please try again.</h3>');
        }
    });
});

$('.edit_lesson').on('click', function(e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    var lesson_id = $(this).data('lesson-id');
    var chapter_id = $(this).data('chapter-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/instructor/course/course-lesson-edit-modal/'+ lesson_id +'/'+ chapter_id,
        data:{} ,
        beforeSend: function() {
            $('.dynamic-modal-content').html(loader);
            
        },
        success: function(data) {
           
            $('.dynamic-modal-content').html(data);
        },
        error: function(xhr, status, error) {
            // $('#dynamic-modal .modal-body').html('<h3 class="text-center text-danger">An error occurred. Please try again.</h3>');
        }
    });
});

$('.edit-chapter').on('click',function(e){
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    var chapter_id = $(this).data('chapter-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/instructor/course/course-chapter-edit-modal/'+ chapter_id,
        data:{} ,
        beforeSend: function() {
            $('.dynamic-modal-content').html(loader);
            
        },
        success: function(data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function(xhr, status, error) {
            // $('#dynamic-modal .modal-body').html('<h3 class="text-center text-danger">An error occurred. Please try again.</h3>');
        }
    })
});


$('.delete-chapter').on('click', function(e){
    e.preventDefault();
    let chapter_id = $(this).data('chapter-id');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
        });
    swalWithBootstrapButtons.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel!",
    reverseButtons: true
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            method:"GET",
            url: base_url + '/instructor/course/course-chapter/delete/'+ chapter_id,
            data:{},
            success:function(data){
                swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: data.success ,
                icon: "success"
                });
                window.location.reload();
            }
        });
    }})
});

if ($('.item_list li').length) {
    // console.log($('.item_list').length);
    $('.item_list').sortable({
        "ui-sortable": "highlight",
        containment: "parent",
        cursor: "move",
        handle: ".handle",
        items: "> li",
        update:function( event, ui ){
            var sortedIDs = $(this).sortable("toArray",{attribute: 'data-lesson-id'});
            // console.log(sortedIDs);
            var chapter_id = ui.item.data('chapter-id');
            // console.log(chapter_id);
            $.ajax({
                method: 'POST',
                url: base_url + '/instructor/course/course-lesson/sort/' + chapter_id,
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

$('.sort-chapter-btn').on('click',function(e){
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    var course_id = $(this).data('course-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/instructor/course/course-chapter-sort/'+ course_id,
        data:{} ,
        beforeSend: function() {
            $('.dynamic-modal-content').html(loader);
            
        },
        success: function(data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function(xhr, status, error) {
            // $('#dynamic-modal .modal-body').html('<h3 class="text-center text-danger">An error occurred. Please try again.</h3>');
        }
    })
});