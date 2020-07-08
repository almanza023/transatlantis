$(function () {
    
    $('#btnAdd').click(function (e) {
        e.preventDefault();
        x++;
        $('#clonar').append(cloneInputs(x));
        addMunicipalitiesOrigin(x);
        addMunicipalitiesDestination(x);
        addVehicles(x);
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


const addVehicles = (x) => {

    for (let i = 0; i < vehicles.length; i++) {

        $("#placa-" + x).append('<option value="' + vehicles[i].placa + '">' + vehicles[i].brand + " - " + vehicles[i].placa + '</option>');
        $("#placa-" + x).val(vehicles[i].placa);

    }

    $("#placa-" + x).append('<option value="">Vehiculo</option>');
    $("#placa-" + x).val("");
    $("#placa-" + x).selectpicker("refresh");
    $("#placa-" + x).selectpicker("render");

}

const addMunicipalitiesOrigin = (x) => {

    for (let i = 0; i < municipalities.length; i++) {

        $("#id_municipality_origin-" + x).append('<option value="' + municipalities[i].id_municipality + '">' + municipalities[i].name_municipality + '</option>');
        $("#id_municipality_origin-" + x).val(municipalities[i].id_municipality);

    }

    $("#id_municipality_origin-" + x).append('<option value="">Origen</option>');
    $("#id_municipality_origin-" + x).val("");
    $("#id_municipality_origin-" + x).selectpicker("refresh");
    $("#id_municipality_origin-" + x).selectpicker("render");

}

const addMunicipalitiesDestination = (x) => {
    for (let i = 0; i < municipalities.length; i++) {

        $("#id_municipality_destination-" + x).append('<option value="' + municipalities[i].id_municipality + '">' + municipalities[i].name_municipality + '</option>');
        $("#id_municipality_destination-" + x).val(municipalities[i].id_municipality);

    }

    $("#id_municipality_destination-" + x).append('<option value="">Destino</option>');
    $("#id_municipality_destination-" + x).val("");
    $("#id_municipality_destination-" + x).selectpicker("refresh");
    $("#id_municipality_destination-" + x).selectpicker("render");

}

const cloneInputs = (x) => {
    return "<div id='clone-"+x+"'>" +
        "<div class='panel panel-deep-purple'>" +
        "<div class='panel-heading' role='tab' id='headingOne_1" + x + "'>" +
        "<h4 class='panel-title'>" +
        "<a role='button' data-toggle='collapse' href='#collapseOne_1" + x + "' aria-expanded='true' aria-controls='collapseOne_1" + x + "'>" +
        "<i class='material-icons'>perm_contact_calendar</i> " + x + ".) Vehiculo " +
        "</a>" +
        "</h4>" +
        "</div>" +
        "<div id='collapseOne_1" + x + "' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne_1" + x + "'>" +

        "<div class='panel-body'>" +

        "<div class='col-md-4'>" +
        "<label for='placa-" + x + "'>Vehiculos</label>" +
        "<div class='form-group'>" +
        "<div class='form-line'>" +
        "<select class='form-control show-tick' name='placa[]'" +
        "id='placa-" + x + "' data-live-search='true'" +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +

        "<div class='col-md-4'>" +
        "<label for='placa-" + x + "'>Vehiculos</label>" +
        "<div class='form-group'>" +
        "<div class='form-line'>" +
        "<select class='form-control show-tick' name='placa[]'" +
        "id='placa-" + x + "' data-live-search='true'" +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +


        "<div class='col-md-4'>" +
        "<label for='id_municipality_origin-" + x + "'>Origen</label>" +
        "<div class='form-group'>" +
        "<div class='form-line'>" +
        "<select class='form-control show-tick' name='id_municipality_origin[]'" +
        "id='id_municipality_origin-" + x + "' data-live-search='true'>" +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +

        "<div class='col-md-4'>" +
        "<label for='id_municipality_destination-" + x + "'>Destino</label>" +
        "<div class='form-group'>" +
        "<div class='form-line'>" +
        "<select class='form-control show-tick' name='id_municipality_destination[]'" +
        "id='id_municipality_destination-" + x + "' data-live-search='true'>" +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +


        "<div class='col-md-6'>" +
        "<label for='address_destination-" + x + "'>Direccion de Destino</label>" +
        "<div class='form-group'>" +
        "<div class='form-line'>" +
        "<textarea class='form-control' id='address_destination-" + x + "' name='address_destination[]'" +
        "minlength='5'></textarea>" +
        "</div>" +
        "</div>" +
        "</div>" +

        "<div class='col-md-6' >" +
        " <label for= 'description_carga-" + x + "' > Descripcion de Carga</label > " +
        "<div class='form-group' > " +
        " <div class='form-line' > " +
        "<textarea class='form-control' id = 'description_carga-" + x + "' name = 'description_carga[]' " +
        "minlength='5' ></textarea >" +
        "</div >" +
        "</div >" +
        "</div >" +

        "<div class='col-md-6' > " +
        "<label for= 'time_return-" + x + "' > Hora de Retorno</label >" +
        "<div class='form-group' >" +
        "<div class='form-line' >" +
        "<input type='time' name = 'time_return[]'' id = 'time_return-" + x + "' class='form-control' > " +
        "</div >" +
        "</div >" +
        "</div >" +

        "<div class='col-md-6' >" +
        "<label for= 'time_stimated-" + x + "' > Tiempo Estimado(Min ?)</label >" +
        "<div class='form-group' > " +
        " <div class='form-line' >" +
        " <input type='number' name = 'time_stimated[]'' id = 'time_stimated-" + x + "' class='form-control' >" +
        "</div >" +
        "</div >" +
        "</div >" +



        "</div >" +
        "</div >" +
        "</div >" +
        "</div >";

}




