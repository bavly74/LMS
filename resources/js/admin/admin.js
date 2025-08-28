import $ from 'jquery' ;
// import flasher from '@flasher/flasher';

var delete_url = null ;
var csrf_token =$('meta[name="csrf-token"]').attr('content');

$('.delete-item').on('click', function() {

    delete_url = $(this).attr('href');

});

$(".delete-modal-btn").on('click', function() {
    console.log(delete_url);
   $.ajax({
       method:"DELETE",
       url:delete_url,
       data:{
           _token:csrf_token,
       },
       beforeSend: function() {
           $(".delete-modal-btn").text('deleting ...')
       },
       success: function(data) {

           window.location.reload();
       },
       error: function(xhr, status, error) {
            let errorMsg = xhr.responseJSON.message;
           flasher.error(errorMsg);
       }
   })
});


