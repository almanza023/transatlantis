$(function() {



    $('#id_product-999').selectpicker('refresh');
    $('#nid_customer').selectpicker('refresh');
    $('#id_type_payment').selectpicker('refresh');
    $('#id_time_payment').selectpicker('refresh');
    $('#priority').selectpicker('refresh');
    $('#departamento_customer_new').selectpicker('refresh');

    selectPrecioDb('#precio_db');



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#nid_customer').change(function(e) {
        let url = '../change/domiciles/';
        changeDomiciles(this.value, url, 1);
    });

    $('#btnHistory').click(function(e) {
        e.preventDefault();
        $("#modalHistoryOrder").modal("show");
    });
    $('#btnAdd').click(function(e) {
        e.preventDefault();
        addItems(tr);
    });

    $('#btnAprobar').click(function(e) {
        e.preventDefault();
        aprobar();
    });

    $('#btnguardar').click(function(e) {
        e.preventDefault();
        $('#response').html("");
        swal({
                title: "Confirmación",
                text: "¿Está Seguro de Registrar el Pedido?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            },
            function() {
                save();
            });
    });

    $('#btnupdate').click(function(e) {
        e.preventDefault();
        $('#response').html("");
        update();
    });

    $('#btnupdate2').click(function(e) {
        e.preventDefault();
        $('#response').html("");
        updateQuotation();
    });



    $('#btnsavedomicile').click(function(e) {
        e.preventDefault();
        saveDomicile();
    });





    $('#departamento_customer_new').change(function(e) {
        clearSelectMunicipalities();
        changeMunicipalitiesNew(this.value);
    });

    $('#modalDetail').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let url = button.data('href')

        let modal = $(this)

        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                modal.find('.modal-body').html(data);
                $('.show-tick').selectpicker("render");
            }
        });
    });


    $('#modalDetail').on('hide.bs.modal', function(e) {
        $(this).find('.modal-body').html("");
    });

    $('#modalProduct').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let opcion = button.data('opcion');
        let modal = $(this)

        if (opcion == 1) {
            let product = button.data('product');
            let amount = button.data('amount');
            let price = button.data('price');
            tr = button.data('tr');

            modal.find('.modal-body #id_product-999').val(product);
            $('#id_product-999').selectpicker('refresh');
            modal.find('.modal-body #amount-999').val(amount);
            modal.find('.modal-body #unit_price-999').val(price);
        }

        if (opcion == 2) {
            tr = 0;
        }

    });






});

const success = (mensaje) => {
    let success = swal("Exito!", `${mensaje}`, "success");
    $('#nid_customer').selectpicker('refresh');
    return success;
}

const warning = (mensaje) => {
    let warning = swal("Error!", `${mensaje}`, "warning");
    return warning;
}

const addItems = (tr) => {
    let form = $('#form_items');
    let product = $('#id_product-999').val();
    let amount = $('#amount-999').val();
    let price = $('#unit_price-999').val();

    if (validatedItems(product, amount, price)) {
        if (tr != 0) {
            deleteItem(tr);
            addTable(tr, product, amount, price);
        } else {

            x++;
            addTable(x, product, amount, price);
        }
        form[0].reset();
        $('#id_product-999').val('');
        $('#id_product-999').selectpicker('refresh');
        $('#modalProduct').modal('hide');
    } else {
        warning('POR FAVOR ESCOGER TODAS LAS OPCIONES DISPONIBLES')
    }


}


const addTable = (x, product, amount, price) => {
    let total = amount * price;
    total_factura += total;
    let name_producto = nameProduct(product);
    let htmlTags = '<tr id="item_' + x + '">' +
        '<td>' + x + '</td>' +
        '<td class="text-center">' + name_producto + '</td>' +
        '<td class="text-center">' + amount + '</td>' +
        '<td class="text-center">' + formatterPeso.format(price) + '</td>' +
        '<td class="text-center">' + formatterPeso.format(total) +
        '<i class=" fa fa-close btn-danger btn-sm btn-circle" onclick="deleteItem(' + x + ',' + total_factura + ')"></i>' +
        '<i class=" fa fa-edit btn-warning btn-sm btn-circle" href="#modalProduct" data-toggle="modal" data-tr="' + x + '"  data-opcion="1" data-product="' + product + '" data-amount="' + amount + '" data-price="' + price + '"></i>' +
        '</td>' +
        '</tr>';
    $('#table_items').append(htmlTags);

    $('#total_items').val('Total: ' + formatterPeso.format(total_factura));

    $('#clonar').append(cloneInputs(x, product, amount, price, total));


}


const nameProduct = (product) => {
    for (let i = 0; i < products.length; i++) {
        if (products[i].id_product == product) {
            return products[i].name_product;
        }
    }
}

const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
})

const validatedItems = (product, amount, price) => {

    if (product == '') {
        return false;
    }

    if (amount == '') {
        return false;
    }

    if (price == '') {
        return false;
    }

    return true;
}

const changePrice = (product) => {

    let id_product = product.id.split("-")[1];
    let value = product.value;

    for (let i = 0; i < products.length; i++) {

        if (products[i].id_product == value) {
            if (products[i].type_price == 1) {
                if ($('#precio_db').val() == 1) {
                    $("#unit_price-" + id_product).val(products[i].price_active[0].price);
                } else {
                    $('#unit_price-999').removeAttr('readonly');
                }
            } else {
                if ($('#precio_db').val() == 1) {
                    $("#unit_price-" + id_product).val(products[i].price);
                } else {
                    $('#unit_price-999').removeAttr('readonly');
                }
            }
        }

    }

}

const filter = () => {
    let form = $('#form_filter');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'html',
        success: function() {
            var img = "<center><img src='https://pa1.narvii.com/6707/20576190733bb67e82c266681eaa9916a3960290_hq.gif'></center>";
            $('#datos').html(img);
            setTimeout(function() {
                //$('#datos').html(data);
            }, 3000);

        },
        error: function(data) {


        }
    });

}



const save = () => {
    let form = $('#form');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                $('#form')[0].reset();
                $('#btn_new_order').show();
                $('#btnguardar').hide();
                setTimeout(function() {
                    window.location.href = '../orders';
                }, 3000);
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

const update = () => {
    let form = $('#form');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                $('#form')[0].reset();
                $('#btn_new_order').show();
                $('#btnupdate').hide();
                setTimeout(function() {
                    window.location.href = '../orders';
                }, 3000);
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
const updateQuotation = () => {
    let form = $('#form');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                $('#form')[0].reset();
                $('#btn_new_order').show();
                $('#btnupdate').hide();
                setTimeout(function() {
                    window.location.href = '../';
                }, 3000);
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

const addErrorMessage = (errors) => {
    let messages = "";
    $.each(errors, function(key, value) {

        if ($.isPlainObject(value)) {
            $.each(value, function(key, value) {
                messages = messages + "<li><span class='font-bold col-pink'>" + value + "</span></li><br/>";

            });
        }
    });
    showErrorMessage(messages);
}


const showErrorMessage = (messages) => {
    swal({
        title: "<strong>Error: Datos Incorrectos</strong>!",
        text: messages,
        html: true
    });
}

const deleteItem = (value) => {
    $("#item_" + value).remove();
    let total = $('#total_item-' + value).val();
    total_factura -= total;
    $('#total_items').val('Total: ' + formatterPeso.format(total_factura));
    $('#clone-' + value).remove();
}


const saveDomicile = () => {
    let form = $('#form_domicile');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                $('#form_domicile')[0].reset();
                addCustomerDomicile(data.customerdomicile);
                addDomicile(data.domicile);
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

const changeMunicipalitiesNew = (id) => {
    $('#municipality_customer_new').find('option:not(:first)').remove();
    $("#municipality_customer_new").selectpicker("refresh");
    $("#municipality_customer_new").selectpicker("render");
    if (!id) {
        warning('SELECCIONE UN DEPARTAMENTO');
    } else {
        $.ajax({
            type: 'GET',
            url: '../change/municipalities/' + id,
            success: function(data) {
                addMunicipalitiesNew(data);
            }
        });
    }
}


const addMunicipalitiesNew = (data) => {

    for (let i = 0; i < data.length; i++) {

        $("#municipality_customer_new").append('<option value="' + data[i].id_municipality + '">' + data[i].name_municipality + '</option>');
        $("#municipality_customer_new").val(data[i].id_municipality);

    }

    $("#municipality_customer_new").val("");
    $("#municipality_customer_new").selectpicker("refresh");
    $("#municipality_customer_new").selectpicker("render");

}


const addCustomerDomicile = (customerdomicile) => {
    $("#id_customer_domicile").val(customerdomicile);
}

const addDomicile = (domicile) => {
    $('#customer_domicile').html("");
    $('#direction').html("");
    $('#customer_domicile').html(domicile);
    $('#direction').html(domicile);
}

const clearSelectMunicipalities = () => {
    $('#municipality_customer_new').find('option:not(:first)').remove();
    $("#municipality_customer_new").selectpicker("refresh");
    $("#municipality_customer_new").selectpicker("render");
}

const cloneInputs = (x, product, amount, price, total) => {

    return "<div id='clone-" + x + "'>" +

        "<input type='hidden' name='id_product[]' id='id_product-" + x + "' value=" + product + ">" +
        "<input type='hidden' name='amount[]' id='amount-" + x + "' value=" + amount + ">" +
        "<input type='hidden' name='unit_price[]' id='unit_price-" + x + "' value=" + price + ">" +
        "<input type='hidden' id='total_item-" + x + "' value=" + total + ">" +

        "</div>";
}

const changeDomiciles = (id, url, opcion) => {
    $.ajax({
        type: 'GET',
        url: url + id,
        success: function(data) {
            addInfo(data, opcion);
            addDomicile(data.address);
            addCustomerDomicile(data.customerdomicile);
            addCustomerNewDomicile(data.customer);
            $('#btnchagedomicile').show();
        }
    });
}

const addInfo = (data, opcion) => {
    clearInfo(opcion);
    let nro = 0;
    if (opcion == 1) {
        if (data.nro_order) {
            nro = data.nro_order.id_order + 1;
        } else {
            nro = 1;
        }
        $('#nro_order').html(nro);
    }


    $('#fecha_orden').html(data.fecha);
    $('#direction').html(data.address);
    $('#email_customer').html(data.email);
}

const clearInfo = (opcion) => {
    if (opcion == 1) {
        $('#nro_order').html('');
    }
    $('#fecha_orden').html('');
    $('#direction').html('');
    $('#email_customer').html('');
}

const addCustomerNewDomicile = (id) => {
    $("#id_customer").val(id);
}


const selectPrecioDb = (id) => {
    $(id).on('change', function() {
        var valor = $(this).val();
        if (valor == 2) {
            $("#unit_price-999").removeAttr('readonly');
        }
        if (valor == 1) {
            $('#unit_price-999').attr('readonly', 'readonly');

            $('#unit_price-999').val('');
        }

    });
}

const aprobar = () => {
    let form = $('#form');

    swal({
            title: "Confirmar",
            text: "¿Está seguro de aprobar la cotización?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    data: form.serialize(),
                    url: form.attr('action'),
                    type: form.attr('method'),
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            success(data.success);

                            setTimeout(function() {
                                window.location.href = '../quotation';
                            }, 3000);
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
        });

}