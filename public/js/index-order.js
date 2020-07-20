$(function() {
    modalScrolling();
    clickBtnAdd();
    clickBtnFilter();
    showModalVehicles();
    showModalDetailProducts();
    showModalInvoice();
    showModalReversar();
    clickBtnSaveInvoice();
    clickBtnReversar();
    clickBtnSaveCarga();
    $('.editar').hide();
    clickBtnFilter2();
});

const clickBtnSaveCarga = () => {
    $('#btnsavecarga').click(function(e) {
        e.preventDefault();
        saveCarga();
    });
}


const clickBtnSaveInvoice = () => {
    $('#btn_save-invoice').click(function(e) {
        e.preventDefault();
        saveInvoice();
    });
}

const clickBtnReversar = () => {
    $('#btnreversar').click(function(e) {
        e.preventDefault();
        saveReversar();
    });
}

const showModalInvoice = () => {
    $('#modalInvoiceOrder').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let url = button.data('href')
        let modal = $(this)
        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                modal.find('.modal-body').html(data);
            }
        });
    });

    $('#modalProduct').on('hide.bs.modal', function(e) {
        $(this).find('.modal-body').html("");
    });

}

const showModalReversar = () => {
    $('#modalReversar').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let id = button.data('id');
        let modal = $(this);
        modal.find('#id_order').val(id);
    });

}

const saveInvoice = () => {

    let id = $('#id_order').val();
    let form = $('#form_invoice');
    var vf = $('#total_fact').val()
    var vd = $('#discount').val()
    var tot = vf - vd;
    let fecha = $('#date').val();
    let fechaA = $('#dateA').val();

    if (!Number($('#id_order').val()) > 0 && !Number($('#id_admin').val()) > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Un dato de la Tabla', 'warning');
    } else if (!$('#date').val().length > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Una Fecha', 'warning');

    } else if (fecha < fechaA) {
        swal('Datos Básicos', 'La Fecha No Puede ser Menor a la Fecha Actual', 'warning');

    } else if (!$('#total').val().length > 0 && !Number($('#total').val())) {
        swal('Datos Básicos', 'Campo Total está Vacio', 'warning');

    } else if (Number($('#total').val()) > Number(tot)) {
        swal('Datos Básicos', 'Valor a Facturar Supera el Precio de la Orden', 'warning');
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
                    updateRow('Facturado', id);
                    $("#modalInvoiceOrder").modal('hide'); //ocultamos el modal

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

const saveReversar = () => {

    let id = $('#id_order').val();
    let form = $('#form_reversar');
    if (!Number($('#id_order').val()) > 0 && !Number($('#id_admin').val()) > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Un dato de la Tabla', 'warning');
    } else if (!$('#status').val().length > 0) {
        swal('Datos Básicos', 'Debe Seleccionar Un Estado', 'warning');

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

const clickBtnAdd = () => {
    $('#btnAdd').click(function(e) {
        e.preventDefault();
        addItems(tr);
    });
}

const clickBtnFilter = () => {
    $('#btn_filter').click(function(e) {
        e.preventDefault();
        filter();
    });
}

const showModalDetailProducts = () => {
    $('#modalProduct').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let url = button.data('href')
        let modal = $(this)
        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                modal.find('.modal-body').html(data);
            }
        });
    });

    $('#modalProduct').on('hide.bs.modal', function(e) {
        $(this).find('.modal-body').html("");
    });
}

const saveApprove = (context) => {

    let button = context.id;
    let url = $('#' + button).data('href');

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                updateRow(data.status, data.order);
                $('#' + button).attr("disabled", true);
            } else {
                warning(data.warning);
            }
        },
    });


}

const saveDeny = (context) => {

    let button = context.id;
    let url = $('#' + button).data('href');

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                updateRow(data.status, data.order);
                $('#' + button).attr("disabled", true);
            } else {
                warning(data.warning);
            }
        },
    });


}

const updateinputRow = (tr) => {
    let val = tr.split("-")
    $('#td_current').val(val[1]);
}

const selectProvider = (context) => {
    let val = context.value;
    let checked = $(".check_provider:checked").length;
    if (val != '') {
        if (checked) {
            $('.show-tick').val(val);
            $('.show-tick').selectpicker("refresh");
            $('.show-tick').selectpicker("render");
        }
    }
}

const savePurchase = () => {
    let form = $('#form_purchase');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                form[0].reset();
                $('#btnsavepurchase').hide();
                $('#btnprint').show();
                updateRow(data.status, data.order)
            } else {
                warning(data.warning);
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

const saveCarga = () => {
    let form = $('#form_carga');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                form[0].reset();
                $('#btnsavecarga').hide();
                $('#btnprint').show();
                $('#modalDetail').modal('hide');
                $('#btn_carga-' + data.order).css("display", "none");

            } else {
                warning(data.warning);
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

const saveSchedule = () => {
    let form = $('#form_schedule');
    let fecha = $('#date_departure').val();
    let fechaA = $('#dateA').val();

    if (fecha >= fechaA) {
        $.ajax({
            data: form.serialize(),
            url: form.attr('action'),
            type: form.attr('method'),
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    success(data.success);
                    form[0].reset();
                    $('#btnsaveschedule').hide();
                    $('#modalDetail').modal('hide');
                    //$('#btnprint').show();
                    updateRow(data.status, data.order)
                } else {
                    warning(data.warning);
                }
            },
            error: function(data) {

                if (data.status === 422) {
                    let errors = $.parseJSON(data.responseText);
                    addErrorMessage(errors);
                }
            }
        });
    } else {
        warning('La Fecha debe ser mayor a la de Hoy');
    }


}

const updateRow = (status, id) => {

    $('#td-' + id).html("");

    if (status == 'Aprobado') {
        $('#td-' + id).addClass('tx-bold tx-green');
        $('#btn_compra-' + id).show();
        $('#btn_edit-' + id).hide();
        $('#btnapprove-' + id).hide();
        $('#modalDetail').modal('hide');
    }


    if (status == 'Rechazado') {
        $('#td-' + id).addClass('tx-bold tx-purple');
        $('#btn_edit-' + id).hide();
        $('#btnapprove-' + id).hide();
        $('#btndeny-' + id).show();
        $('#modalDetail').modal('hide');
    }

    if (status == 'Compra') {
        $('#td-' + id).addClass('tx-bold tx-pink');
        $('#btn_agenda-' + id).show();
        $('#btn_compra-' + id).hide();
        $('#btn_imprimir-' + id).show();

        $('#modalDetail').modal('hide');
    }





    if (status == 'Agendado') {
        $('#td-' + id).addClass('tx-bold tx-indigo');
        $('#btn-ea-' + id).removeAttr('style');
        $('#btn_agenda-' + id).hide();
        $('#btn_carga-' + id).hide();

        $('#modalDetail').modal('hide');


    }



    $('#td-' + id).html(status);

}

const modalScrolling = () => {
    $('.modal').on("hidden.bs.modal", function(e) {
        if ($('.modal:visible').length) {
            $('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
            $('body').addClass('modal-open');
        }
    }).on("show.bs.modal", function(e) {
        if ($('.modal:visible').length) {
            $('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
            $(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
        }
    });
}


const addItems = (tr) => {
    let form = $('#form_items');
    let placa = $('#placa-999').val();
    let time = $('#time_stimated-999').val();
    let viaje = $('#nro_viaje-999').val();
    let description = $('#description_carga-999').val();

    if (validatedItems(placa, time, description, viaje)) {
        if (tr != 0) {
            deleteItem(tr);
            addTable(tr, placa, time, description, viaje);
            tr = 0;
        } else {
            x++;
            addTable(x, placa, time, description, viaje);
        }
        form[0].reset();
        $('#placa-999').val('');
        $('#placa-999').selectpicker('refresh');
        $('#modalVehicle').modal('hide');
    } else {
        warning('POR FAVOR ESCOGER TODAS LAS OPCIONES DISPONIBLES')
    }


}


const validatedItems = (placa, time, description, viaje) => {

    if (placa == '') {
        return false;
    }

    if (time == '') {
        return false;
    }

    if (description == '') {
        return false;
    }

    if (viaje == '') {
        return false;
    }

    return true;
}


const deleteItem = (value) => {
    $("#item_" + value).remove();
    $('#clone-' + value).remove();
}

const addTable = (x, placa, time, description, viaje) => {
    let name_vehiculo = nameVehicle(placa);
    let htmlTags = '<tr id="item_' + x + '">' +
        '<td>' + x + '</td>' +
        '<td class="text-center">' + placa + '</td>' +
        '<td class="text-center">' + description + '</td>' +
        '<td class="text-center">' + viaje + '</td>' +
        '<td class="text-center">' + time + '</td>' +
        '<td><i class="fa fa-close btn btn-danger" onclick="deleteItem(' + x + ')"></i>' +
        '<i class="fa fa-edit btn btn-warning"" href="#modalVehicle" data-toggle="modal" data-tr="' + x + '"  data-opcion="1" data-viaje="' + viaje + '" data-placa="' + placa + '" data-time="' + time + '" data-description="' + description + '"></i>' +
        '</td>' +
        '</tr>';
    $('#table_items').append(htmlTags);

    $('#clonar').append(cloneInputs(x, placa, time, description, viaje));


}

const nameVehicle = (placa) => {
    for (let i = 0; i < vehicles.length; i++) {
        if (vehicles[i].placa == placa) {
            return vehicles[i].placa + ' - ' + vehicles[i].type_vehicle;
        }
    }
}

const cloneInputs = (x, placa, time, description, viaje) => {

    return "<div id='clone-" + x + "'>" +

        "<input type='hidden' name='placa[]' id='placa-" + x + "' value=" + placa + ">" +
        "<input type='hidden' name='time[]' id='time-" + x + "' value=" + time + ">" +
        "<input type='hidden' name='description[]' id='description-" + x + "' value=" + description + ">" +
        "<input type='hidden' name='viaje[]' id='viaje-" + x + "' value=" + viaje + ">" +

        "</div>";
}

const findDriver = (context) => {

    let value = context.value;

    $("#chofer").html("");
    $("#capacidad").html("");
    $("#volumen").html("");

    for (let i = 0; i < vehicles.length; i++) {

        if (vehicles[i].placa == value) {
            let name = vehicles[i].first_name + " " + vehicles[i].last_name;
            $("#chofer").html(name);
            $("#capacidad").html(vehicles[i].capacity + ' KG');
            $("#volumen").html(vehicles[i].volume + ' M3');
        }

    }

}

const saveDiscount = (context) => {

    let form = $('#form_discount');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                $('#input_discount').val(data.discount);
                configDiscount(data.discount);
            } else {
                warning(data.warning);
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

const configDiscount = (discount) => {
    let total = $('#sub_total_update').val();
    let discount_total = discount;
    let total_factura = total - discount_total;

    $('#descuento_total_update').val('Descuento: ' + formatterPeso.format(discount_total));
    $('#total_items_update').val('Total: ' + formatterPeso.format(total_factura));

    $('#col_descuento').show();
    $('#col_items').show();

    $('.col_descuento').hide();

    $('#text_descuento').html("");

    $('#text_descuento').html("Descuento: " + discount + "%");

}

const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
})



const filter = () => {

    let form = $('#form_filter');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        success: function(data) {

            if (data.warning) {
                warning(data.warning);
            } else {
                $('#id_table').html("");
                $('#id_table').html(data);
                dataTableInit();
                tooltipsMessages();
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


const showModalVehicles = () => {
    $('#modalVehicle').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let opcion = button.data('opcion');
        let modal = $(this);


        if (opcion == 1) {
            let placa = button.data('placa');
            let time = button.data('time');
            let description = button.data('description');
            let viaje = button.data('viaje');
            tr = button.data('tr');

            modal.find('.modal-body #placa-999').val(placa);
            $('#placa-999').selectpicker('refresh');
            modal.find('.modal-body #time_stimated-999').val(time);
            modal.find('.modal-body #description_carga-999').val(description);
            modal.find('.modal-body #nro_viaje-999').val(viaje);

        }

        if (opcion == 2) {
            tr = 0;
            $('#placa-999').val("");
            $('#placa-999').selectpicker('refresh');
            $('#date-order').val($('#date_departure').val());
            $('#date-time').val($('#time_departure').val());
            $('#lbl-date').text('Fecha: ' + $('#date_departure').val());
            $('#lbl-hour').text('Hora: ' + $('#time_departure').val());
            $('#id-order').val($('#id_order').val());

        }



    });

}

const clickBtnFilter2 = () => {
    $('#btn_filter2').click(function(e) {
        e.preventDefault();
        filter2();
    });
}
const filter2 = () => {

    let form = $('#form_filter2');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        success: function(data) {

            if (data.warning) {
                warning(data.warning);
            } else {
                $('#id_table').html("");
                $('#id_table').html(data);
                dataTableInit();
                tooltipsMessages();
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