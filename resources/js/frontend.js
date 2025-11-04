const base_url = $('meta[name="base_url"]').attr('content');
$('.delete-lesson').on('click', function(e) {
    e.preventDefault();
    var lesson_id = $(this).data('lesson-id');
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
            url: base_url + '/instructor/course/course-lesson-delete/'+ lesson_id,
            data:{},
            success:function(data){
                swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: data.success ,
                icon: "success"
                });
                window.location.reload();
                // console.log(data);
                // $('#lesson-item-' + lesson_id).remove();
            }

        });

    } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire({
        title: "Cancelled",
        text: "Your imaginary file is safe :)",
        icon: "error"
        });
    }
    });
});

