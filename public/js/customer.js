$(function() {
    $(".departaments").selectpicker("refresh");

    btnSave();
});

const changeDepartaments = (value, opcion) => {
    if (opcion == 1) {
        clearSelectMunicipalitiesCustomers();
        changeMunicipalities(value);
    } else {
        clearSelectMunicipalitiesCustomersEdit();
        changeMunicipalitiesEdit(value);
    }

}


const clearSelectMunicipalitiesCustomers = () => {
    $('#municipality').find('option:not(:first)').remove();
    $("#municipality").selectpicker("refresh");
    $("#municipality").selectpicker("render");
}

const clearSelectMunicipalitiesCustomersEdit = () => {
    $('#municipality-2').find('option:not(:first)').remove();
    $("#municipality-2").selectpicker("refresh");
    $("#municipality-2").selectpicker("render");
}


const changeMunicipalities = (id) => {
    if (!id) {
        warning('SELECCIONE UN DEPARTAMENTO');
    } else {
        addMunicipalities(id);
    }
}

const changeMunicipalitiesEdit = (id) => {
    if (!id) {
        warning('SELECCIONE UN DEPARTAMENTO');
    } else {
        addMunicipalitiesEdit(id);
    }
}

const addMunicipalities = (id) => {

    for (let m of municipalities) {
        if (m.id_departament == id) {
            $("#municipality").append('<option value="' + m.id_municipality + '">' + m.name_municipality + '</option>');
            $("#municipality").val(m.id_municipality);
        }
    }

    $("#municipality").val("");
    $("#municipality").selectpicker("refresh");
    $("#municipality").selectpicker("render");

}

const addMunicipalitiesEdit = (id) => {

    for (let m of municipalities) {
        if (m.id_departament == id) {
            $("#municipality-2").append('<option value="' + m.id_municipality + '">' + m.name_municipality + '</option>');
            $("#municipality-2").val(m.id_municipality);
        }
    }

    $("#municipality-2").val("");
    $("#municipality-2").selectpicker("refresh");
    $("#municipality-2").selectpicker("render");

}


const saveCustomer = () => {
    let form = $('#form_create');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                setTimeout(function() {
                    window.location.href = 'customers';
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

const btnSave = () => {
    $('#btnsave').click(function(e) {
        e.preventDefault();
        saveCustomer();
    });
}

const updateCustomer = () => {
    let form = $('#form_edit');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {

            if (data.success) {
                success(data.success);
                setTimeout(function() {
                    window.location.href = 'customers';
                }, 3000);
                $('#modalDetail').modal('hide');
                updateTable();
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