$(function () {


    $('#departamento_customer_new').change(function (e) {
        clearSelectMunicipalities();
        changeMunicipalitiesNew(this.value);
    });


    $('#modalDomicile').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var url = button.data('href');
        var modal = $(this);
        changeDomiciles(url);
    });

    $('#modalDetail').on('hide.bs.modal', function (e) {
        $('#customer_domicile').html("");
    });

    $('#btnsavedomicile').click(function (e) {
        e.preventDefault();
        saveDomicile();
    });



});


const clearSelectMunicipalities = () => {
    $('#municipality_customer_new').find('option:not(:first)').remove();
    $("#municipality_customer_new").selectpicker("refresh");
    $("#municipality_customer_new").selectpicker("render");
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
            success: function (data) {
                addMunicipalitiesNew(data);
            }
        });
    }
}


const addDomicile = (domicile) => {
    $('#customer_domicile').html("");
    $('#customer_domicile').html(domicile);
}

const addCustomerDomicile = (customerdomicile) => {
    $("#id_customer_domicile").val(customerdomicile);
}

const addCustomerNewDomicile = (id) => {
    $("#id_customer").val(id);
}


const changeDomiciles = (url) => {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            addDomicile(data.address);
            addCustomerDomicile(data.customerdomicile);
            addCustomerNewDomicile(data.customer);
        }
    });

}


const saveDomicile = () => {
    let form = $('#form_domicile');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                success(data.success);
                $('#form_domicile')[0].reset();
                addCustomerDomicile(data.customerdomicile);
                addDomicile(data.domicile);
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


const addMunicipalitiesNew = (data) => {

    for (let i = 0; i < data.length; i++) {

        $("#municipality_customer_new").append('<option value="' + data[i].id_municipality + '">' + data[i].name_municipality + '</option>');
        $("#municipality_customer_new").val(data[i].id_municipality);

    }

    $("#municipality_customer_new").val("");
    $("#municipality_customer_new").selectpicker("refresh");
    $("#municipality_customer_new").selectpicker("render");

}



