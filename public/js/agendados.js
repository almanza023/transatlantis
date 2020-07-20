$(function() {

    clickBtnFilter3();
    clickBtnSaveInicio();
    clickBtnSaveEntrega();
    $('.btninicio').hide();
    $('.entrega').hide();
    $('#modalEntrega').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var placa = button.data('placa')
        var nid = button.data('nid')
        var type = button.data('type')
        var status = button.data('status')
        var modal = $(this)
        modal.find('.modal-body #order_id').val(id);
        modal.find('.modal-body #type_invoice').val(type);
        modal.find('.modal-body #placa1').val(placa);
        modal.find('.modal-body #nid_driver1').val(nid);

        if (type == 1) {
            $('#resultado').hide();
        } else {
            $('#resultado').show();
        }
        var html = "";

        $.get("products/order", { id: id, placa: placa, nid: nid }, function(data) {
            $.each(data, function(i, item) {
                html += "<option value=" + item.id_product + ">" + item.name_product + "</option>"
                console.log(item);
            });
            $('#id_product').html(html);
        });

    });

    $('#modalInicio').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var status = button.data('status')
        var modal = $(this)
        modal.find('.modal-body #id_order').val(id);

    });

    $('#status1').on('change', function() {

        if (this.value == 2) {
            $('#mostrarTicket').hide();
        } else {
            $('#mostrarTicket').show();
        }


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

                    if ($('#status1').val() == 1) {
                        $("#modalEntrega").modal('hide'); //ocultamos el modal
                        updateRow('Entregado', id);
                    } else {
                        $("#modalEntrega").modal('hide'); //ocultamos el modal
                        updateRow('Entregado Parcialmente', id);
                    }
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

    if (status == "Entregado Parcialmente") {
        $('#td-' + id).addClass('txt-bold col-blue');
        $('#btnentrega-' + id).show();
        $('#btninicio-' + id).hide();
        $('#modalInicio').modal('hide');

    }

    $('#td-' + id).html(status);

}