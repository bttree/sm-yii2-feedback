function initFeedbackFormAjax(formSelector, url) {

    $(document).on('beforeSubmit', formSelector, function (event) {
        event.preventDefault()

        var form = $(formSelector)
        if (url === undefined) {
            url = form.attr('action')
        }
        console.log(form.yiiActiveForm('validate', true))

        $('.feedback-label').remove()
        $.ajax({
                   type   : 'POST',
                   url    : url,
                   data   : form.serialize(),
                   success: function (data) {
                       if (data.result) {
                           form.prepend('<div class="feedback-label label label-success">' +
                                        data.message +
                                        '</div>')
                       } else {
                           form.prepend('<div class="feedback-label label label-danger">' +
                                        data.message +
                                        '</div>')
                       }

                   },
                   error  : function (data) {
                       form.prepend('<div class="feedback-label label label-danger">' +
                                    data.message +
                                    '</div>')
                   }
               })
    })
    $(document).on('submit', formSelector, function (event) {
        event.preventDefault()
    })
}