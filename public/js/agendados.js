$(function() {

    clickBtnFilter3();
    clickBtnSaveInicio();
    clickBtnSaveEntrega();
    $('.btninicio').hide();
    $('.entrega').hide();
    $('#modalEntrega').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var status = button.data('status')
        var modal = $(this)
        modal.find('.modal-body #order_id').val(id);


    });

    $('#modalInicio').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var status = button.data('status')
        var modal = $(this)
        modal.find('.modal-body #id_order').val(id);

    });

});

const clickBtnFilter3 = () => {
    $('#btn_filter3').click(function(e) {
        e.preventDefault();
        filter3();
    });
}
const clickBtnSaveInicio = () => {
    $('#btnsave').click(function(e) {
        e.preventDefault();
        saveInicio();
    });
}
const clickBtnSaveEntrega = () => {
    $('#btnsave1').click(function(e) {
        e.preventDefault();
        saveEntrega();
    });
}


const filter3 = () => {

    let form = $('#form_filter3');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        success: function(data) {

            if (data.warning) {
                warning(data.warning);
            } else {
                var img = "<center><img src='https://pa1.narvii.com/6707/20576190733bb67e82c266681eaa9916a3960290_hq.gif'></center>";
                $('#datos').html(img);
                setTimeout(function() {
                    $('#datos').html(data);
                    $('#id_table').html("");
                    $('#id_table').html(data);

                    dataTableInit();
                    tooltipsMessages();
                }, 3000);

            }

        },
        error: function(data) {

            if (data.status === 422) {
                let errors = $.parseJSON(data.responseText);
                addErrorMessage(errors);
            }
        }
    });


}

const saveInicio = () => {
    let fecha = $('#date').val();
    let fechaA = $('#dateA').val();
    let id = $('#id_order').val();
    let form = $('#form_create');
    if (!Number($('#status').val()) > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Un Estado', 'warning');
    } else if (!$('#date').val().length > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Una Fecha', 'warning');

    } else if (fecha < fechaA) {
        swal('Datos Básicos', 'La Fecha No Puede ser Menor a la Fecha Actual', 'warning');


    } else if (!$('#weight').val().length > 0) {
        swal('Datos Básicos', 'Campo Peso Final', 'warning');

    } else if (!$('#hour').val().length > 0) {
        swal('Datos Básicos', 'Campo Hora Está Vacío', 'warning');

    } else {
        $.ajax({
            data: form.serialize(),
            url: form.attr('action'),
            type: form.attr('method'),
            success: function(data) {
                if (data.warning) {
                    warning(data.warning);
                } else {
                    success(data.success)
                    updateRow('Inicio Entrega', id);
                    $("#modalInicio").modal('hide'); //ocultamos el modal
                    form[0].reset();

                }

            },
            error: function(data) {

                if (data.status === 422) {
                    let errors = $.parseJSON(data.responseText);
                    addErrorMessage(errors);
                }
            }
        });
    }

}
const saveEntrega = () => {
    let fecha = $('#date3').val();
    let fechaA = $('#dateAA').val();
    let id = $('#order_id').val();
    let form = $('#form_create1');
    if (!Number($('#status1').val()) > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Un Estado', 'warning');
    } else if (!$('#date3').val().length > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Una Fecha', 'warning');
    } else if (fecha < fechaA) {
        swal('Datos Básicos', 'La Fecha No Puede ser Menor a la Fecha Actual', 'warning');

    } else if (!$('#weight1').val().length > 0) {
        swal('Datos Básicos', 'Campo Peso Final', 'warning');

    } else if (!$('#hour1').val().length > 0) {
        swal('Datos Básicos', 'Campo Hora Está Vacío', 'warning');

    } else {
        $.ajax({
            data: form.serialize(),
            url: form.attr('action'),
            type: form.attr('method'),
            success: function(data) {
                if (data.warning) {
                    warning(data.warning);
                } else {
                    success(data.success)
                    updateRow('Entregado', id);
                    $("#modalEntrega").modal('hide'); //ocultamos el modal
                    form[0].reset();

                }

            },
            error: function(data) {

                if (data.status === 422) {
                    let errors = $.parseJSON(data.responseText);
                    addErrorMessage(errors);
                }
            }
        });
    }

}

const updateRow = (status, id) => {

    $('#td-' + id).html("");

    if (status == "Inicio Entrega") {
        $('#td-' + id).addClass('tx-bold col-green');
        $('#btnentrega-' + id).removeAttr('style');
        $('#btninicio-' + id).hide();
        $('#modalInicio').modal('hide');
    }

    if (status == "Entregado") {
        $('#td-' + id).addClass('tx-bold col-green');
        $('#btnentrega-' + id).hide();
        $('#btninicio-' + id).hide();
        $('#modalInicio').modal('hide');

    }

    $('#td-' + id).html(status);

}