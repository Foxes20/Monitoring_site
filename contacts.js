//  ********************************* contacs
$('#sendClick').on("click", function(e){
    e.preventDefault();

    formData = {
        'name': $('input[name=name]').val(),
        'email': $('input[name=email]').val(),
        'subject': $('input[name=subject]').val(),
        'message': $('textarea[name=message]').val()
    };
    console.log("suka");
    $.ajax({
        url: "/request_contacts",
        type: "POST",
        data: formData,
        dataType: 'json',
        success: function (data) {
            if (data.status == 'ok') {
                $('#contact-form')[0].reset();
                $('#status').html('Всё заебись');
            } else if(data.status == 'no') {
                $('#status').html('Ошибка отправки письма');
            }
        },
        error: function (data) {
            $('#status').html(data);
        }
    });
})
