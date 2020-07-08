$(function() {

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });



    btnUpdate();
    btnSave();

});


const save = () => {
    let form = $('#form_create');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);
                $('#form_create')[0].reset();

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
    let form = $('#form_update');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                success(data.success);

                setTimeout(function() {
                    window.location.href = '../../user';
                }, 2000);


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
        save();
    });
}

const btnUpdate = () => {
    $('#btnUpdate').click(function(e) {
        e.preventDefault();
        update();
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