$(function() {
    $('#datos').hide();
    btnFilterLiquidacion();

});




const filtroLiquidacion = () => {
    let form = $('#form_filter_liquidacion');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'html',
        success: function(data) {
            if (data) {
                $('#datos').show();
                $('#resultado').html(data);

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

const btnFilterLiquidacion = () => {
    $('#btn_filter_liquidacion').click(function(e) {
        e.preventDefault();
        filtroLiquidacion();
    });
}


const success = (mensaje) => {
    let success = swal("Exito!", `${mensaje}`, "success");
    return success;
}

const warning = (mensaje) => {
    let warning = swal("Error!", `${mensaje}`, "warning");
    return warning;
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


const ajaxHeader = () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}