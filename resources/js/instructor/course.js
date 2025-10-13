const base_url = $('meta[name="base_url"]').attr('content');
const basicInfoUrl = base_url + '/instructor/course/store';
const moreInfoUrl = base_url + '/instructor/course/update';
const csrfToken = $('meta[name="csrf-token"]').attr('content');
const notyf = new Notyf() ;
$('.course-tab').on('click', function(e){
    e.preventDefault();
    // console.log('yaa');
   let step = $(this).data('step');
   $('.course-form').find('input[name="next_step"]').val(step);
    $('.course-form').trigger('submit');
});

$('.demo_video_storage').on('change', function() {
    let value = $(this).val();
    if (value == 'upload') {
        $('.source-file').removeClass('d-none');
        $('.source-text').addClass('d-none');
    } else {
        $('.source-file').addClass('d-none');
        $('.source-text').removeClass('d-none');
    }
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




