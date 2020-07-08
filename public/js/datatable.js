$(function() {
    dataTableInit();
    ajaxHeader();
    tooltipsMessages();
    showModalDetail();
});


const dataTableInit = () => {
    $('.js-basic-example').DataTable({
        responsive: true,
        lengthMenu: [
            [5, 10, 60, -1],
            [5, 10, 60, "Todo"]
        ],
        ordering: false,
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

const updateTable = () => {
    let form = $('#form_hidden');
    $.ajax({
        data: form.serialize(),
        url: form.attr('action'),
        type: form.attr('method'),
        success: function(data) {
            if (data.warning) {
                warning(data.warning);
            } else {
                $('#id_table').html("");
                $('#id_table').html(data);
                dataTableInit();
                tooltipsMessages();
            }
        }
    });
}


const ajaxHeader = () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

const tooltipsMessages = () => {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
}

const showModalDetail = () => {
    $('#modalDetail').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let url = button.data('href')
        let modal = $(this)
        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                modal.find('.modal-body').html(data);
                $(".show-tick").selectpicker("refresh");
            }
        });
    });

    $('#modalDetail').on('hide.bs.modal', function(e) {
        $(this).find('.modal-body').html("");
    });
}

const success = (mensaje) => {
    return swal("Exito!", `${mensaje}`, "success");
}

const warning = (mensaje) => {
    return swal("Error!", `${mensaje}`, "warning");
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