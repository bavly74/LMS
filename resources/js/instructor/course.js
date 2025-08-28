const base_url = $('meta[name="base_url"]').attr('content');
const basicInfoUrl = base_url + '/instructor/course/store';
const csrfToken = $('meta[name="csrf-token"]').attr('content');

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
            }
        },
        error: function(xhr, status, error) {

        },
        complete: function() {
            $('.save_basic_info').text('Save');
        },

    });
})
