$(function() {
    $(".departaments").selectpicker("refresh");
    $('#resultado').hide();
    btnFilter();
});








const consultar = () => {
    let form = $('#form');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'html',
        success: function(data) {
            if (data) {
                $('#resultado').show();
                $('#datos').html(data);
            } else {
                warning('No Existen Datos');
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

const btnFilter = () => {
    $('#btn_filter').click(function(e) {
        e.preventDefault();
       
            consultar();
        

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

const success = (mensaje) => {
    return swal("Exito!", `${mensaje}`, "success");
}

const warning = (mensaje) => {
    return swal("Error!", `${mensaje}`, "warning");
}