$('#view').on("click", function(e) {
    e.preventDefault();

        $.ajax({
            url: "/admin/feedback_answers",
            type: "POST",
            data: $("form").serialize(),
            dataType: 'JSON',
            success: function (data) {

                if (data.status == 'ok') {
                    $('form')[0].reset();
                    $('.mess').html('вы ответили');
                } else {
                    $('.mess').html('что то пошло не так');

                }
            }
        });
});
