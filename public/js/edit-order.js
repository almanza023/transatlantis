$(function () {

    
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    
    $('#btnAdd').click(function (e) {
        e.preventDefault();
        x++;
        $('#clonar').append(cloneInputs(x));
        addProducts(x);
    });

    $('#btnDel').click(function (e) {
        e.preventDefault();
        if (x != 1) {
            $("#clone-" + x).remove();
            x -= 1;
        }
    });

    $('#btnguardar').click(function (e) {
        e.preventDefault();
        $('#response').html("");
        save();
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



const addProducts = (x) => {

    for (let i = 0; i < products.length; i++) {

        $("#id_product-" + x).append('<option value="' + products[i].id_product + '">' + products[i].name_product + '</option>');
        $("#id_product-" + x).val(products[i].id_product);

    }

    $("#id_product-" + x).append('<option value="">Producto</option>');
    $("#id_product-" + x).val("");
    $("#id_product-" + x).selectpicker("refresh");
    $("#id_product-" + x).selectpicker("render");

}

const changePrice = (product) => {

    let id_product = product.id.split("-")[1];
    let value = product.value;

    for (let i = 0; i < products.length; i++) {

        if (products[i].id_product == value) {
            if (products[i].type_price == 1) {
                $("#unit_price-" + id_product).val(products[i].price_active[0].price);
            } else {
                $("#unit_price-" + id_product).val(products[i].price);
            }
        }

    }

}

const save = () => {
    let form = $('#form_validation');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                success(data.success);
                $('#form_validation')[0].reset();
            } else {
                warning(data.warning);
            }
        },
        error: function (data) {

            if (data.status === 422) {
                let errors = $.parseJSON(data.responseText);
                addErrorMessage(errors);
            }
        }
    });

}

const addErrorMessage = (errors) => {
    let messages = "";
    $.each(errors, function (key, value) {

        if ($.isPlainObject(value)) {
            $.each(value, function (key, value) {
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


const cloneInputs = (x) => {
    return "<div class='col-md-12' id='clone-" + x + "'>" +

        "<div class='col-md-4'>" +
        "<label for='id_product-" + x + "'>Productos</label>" +
        "<div class='form-group'>" +
        "<div" +
        " class='form-line'>" +
        "<select class='form-control show-tick' name='id_product[]'" +
        "id='id_product-" + x + "' data-live-search='true' onchange='changePrice(this);'>" +
        "</select>" +
        "</div>" +
        " </div>" +

        " </div>" +

        "<div class='col-md-4'>" +
        "<label for='amount-" + x + "'>Cantidad</label>" +
        "<div class='form-group'>" +
        "<div class='form-line'>" +
        "<input type='number' class='form-control' name='amount[]' id='amount-" + x + "'>" +
        "</div>" +
        "</div>" +
        "</div>" +

        "<div class='col-md-4'>" +
        "<label for='unit_price-" + x + "'>Precio</label>" +
        "<div class='form-group'>" +
        " <div class='form-line'>" +
        "<input type='number' class='form-control' name='unit_price[]' id='unit_price-" + x + "' readonly>" +
        "</div>" +
        " </div>" +
        " </div>" +

        "</div>";
}



