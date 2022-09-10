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
              location.reload();
            } else {
                $('.txt').html('что то пошло не так');
            }
        }
    });
});
