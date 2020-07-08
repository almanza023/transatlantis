$(function () {

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();

    $('.js-basic-example').DataTable({
        responsive: true,
        lengthMenu: [[20, 40, 60, -1], [20, 40, 60, "Todo"]],
        ordering: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    });

    $('#modalEditTypeUnit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var typeunit = button.data('typeunit')
        var description = button.data('description')
        var modal = $(this)

        modal.find('.modal-body #id_type_unit').val(id);
        modal.find('.modal-body #type_unit_e').val(typeunit);
        modal.find('.modal-body #description_e').val(description);


    });

    $('#form_edit').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('focused error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('focused error');
            $(input).parents('.form-line').addClass('focused success');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });


});

const success = (mensaje) => {
    let success = swal("Exito!", `${mensaje}`, "success");
    return success;
}


