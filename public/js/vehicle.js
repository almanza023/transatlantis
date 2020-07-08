$(function () {

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
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


