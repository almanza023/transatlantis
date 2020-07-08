$('#modalDetail').on('show.bs.modal', function(event) {
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

$('#modalDetail').on('hide.bs.modal', function(e) {
    $(this).find('.modal-body').html("");
});