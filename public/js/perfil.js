$(function() {
    showModalPerfil();
});



const showModalPerfil = () => {
    $('#modalPerfil').on('show.bs.modal', function(event) {
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


}

var success1 = (mensaje) => {
    return swal("Exito!", `${mensaje}`, "success");
}

var warning1 = (mensaje) => {
    return swal("Error!", `${mensaje}`, "warning");
}