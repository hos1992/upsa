// add new user account & show user data
$(document).on('click', '#show, .show', function (e) {
    e.preventDefault();
    var action = $(this).attr('href');
    $.ajax({
        url: action,
        success: function (response) {
            $(document).find('#changable_content').html(response);
        }
    });
});

// submit add & update form
$(document).on('submit', '#submit', function (e) {
    e.preventDefault();
    $(document).find(".error").html("");
    var form = $(this),
        action = $(this).attr('action'),
        data = $(this).serialize(),
        method = $(this).attr('method'),
        submit_btn = $(this).find('#submit_btn');
    submit_btn.attr('disabled', true);

    $.ajax({
        dataType: 'json',
        url: action,
        type: "post",
        data: data,
        success: function (response) {
            if (response.status == 0) {
                for (var key in response.errors) {
                    $(document).find(".error-" + key).html(response.errors[key]);
                }
                submit_btn.attr('disabled', false);
            } else {
                if (!response.from_update) {
                    form.find('input').val("");
                } else {
                    form.find('#password').val("");
                }
                $(document).find('.msg').html('<div class="alert alert-success text-center">' + response.msg + '</div>');
                submit_btn.attr('disabled', false);

                // update users table
                $.ajax({
                    url: '/users/updated_user_table',
                    success: function (response) {
                        $(document).find('.users-table').html(response);
                    }
                })

            }
        }
    });


})

// delete user account
$(document).on('click', '.dlt_user', function (e) {
    e.preventDefault();
    var action = $(this).attr('href');
    if (confirm("Are you sure you want to delete this user !?")) {
        $.ajax({
            url: action,
            success: function (response) {
                response = JSON.parse(response);
                if (response.status == 1) {
                    $(document).find(".empty_" + response.delete_id).remove();
                }
            },
        });
    }


});
