$(function() {
    $("#form_validation").submit(function(event) {

        event.preventDefault();
        login();
    });
});

const login = () => {
    let form = $('#form_validation');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'html',
        success: function(data) {
            if (data == 1) {
                $.toast({
                    heading: 'Ingreso',
                    text: 'Bienvenido al Sistema',
                    showHideTransition: 'slide',
                    icon: 'success'
                })
                setTimeout(function() {
                    window.location.href = "home";
                }, 4000)

            } else {
                $.toast({
                    heading: 'Error',
                    text: 'Datos Incorrectos. Intente Nuevamente',
                    showHideTransition: 'fade',
                    icon: 'error'
                })
            }
        },
        error: function(data) {
            if (data.status === 422) {


            }
        }
    });

}