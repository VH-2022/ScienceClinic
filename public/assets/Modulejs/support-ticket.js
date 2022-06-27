jQuery(document).ready(function($){
    function ajaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#response_id').html("");
                $('#response_id').html(res);
            }

        })
    }

    ajaxList(1);
    $('#btn-save').click(function(e) {
        var name = $('#message').val();
        var cnt = 0;
        $('#message_error').html("");
        if (name == '') {
            $('#message_error').html("Please enter Message");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    $('#btn-update').click(function(e) {
        var name = $('#message_edit').val();
        var cnt = 0;
        $('#message_edit_error').html("");
        if (name == '') {
            $('#message_edit_error').html("Please enter Message");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    $('body').on('click', '.edit-details', function (e) {
        var id = $(this).attr('data-id');
        $('#editid').val(id);
        if (id != "") {
            $('#editajax-crud-modal').modal('show');
            $.ajax({
                url: _GET_DATA_TICKET + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#message_edit").val(val.support_msg);
                }
            });

        }
    });

    $('body').on('click', '.delete-details', function (e) {
        e.preventDefault(); // prevent form submit
        var id = $(this).attr('data-id');
        $.confirm({
            title: 'Delete!',
            content: 'you want to delete this Ticket?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: _DELETE_TICKET + '/' + id,
                        type: "DELETE",
                        data: {
                            _token: _TOKEN,
                            _method: "DELETE"
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                },
                cancel: function() {}
            }
        });
    });
});