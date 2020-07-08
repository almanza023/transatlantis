$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#modalDetail').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget)
        let url = button.data('href')

        let modal = $(this)

        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                modal.find('.modal-body').html(data);
            }
        });
    });


    $('#modalDetail').on('hide.bs.modal', function (e) {
        $(this).find('.modal-body').html("");
    });


    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });


   
});

const success = (mensaje) => {
    let success = swal("Exito!", `${mensaje}`, "success");
    return success;
}

const warning = (mensaje) => {
    let warning = swal("Error!", `${mensaje}`, "warning");
    return warning;
}







