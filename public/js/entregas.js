$(function() {

    btnSave();





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

    const btnSave = () => {
        $('#btnsave').click(function(e) {
            e.preventDefault();
            save();
        });
    }




    const success = (mensaje) => {
        let success = swal("Exito!", `${mensaje}`, "success");
        return success;
    }

    const warning = (mensaje) => {
        let success = swal("Advertencia!", `${mensaje}`, "warning");
        return success;
    }

});