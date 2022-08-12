$('#formId').on("submit", function(e) {
    e.preventDefault();

    let self = this;
    $.ajax({
        url:  this.action,
        type: "POST",
        data: $(this).serialize(),
        dataType: 'JSON',

        success: function (data) {
            if (data.status == 'ok') {
                self.reset();
                $('.mess').html('вы ответили');
            } else {
                $('.mess').html('что то пошло не так');
            }
        }
    });
});
