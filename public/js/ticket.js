$(document).ready(function (e) {

    $(document).on('click', '.edit', function () {

        var ticket_id = $(this).attr('value');
        $.get('ticket/' + ticket_id, function (data) {
            $('#ticket_id').val(data.id);
            $('#issue_type').val(data.issue_type);
            $('#email').val(data.email);
            $('#description').val(data.description);
            $('#btn-save').val("update");
        })
    });

    $(document).on('click', '#pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=');
        //var search = $('#search').val();
        $.get("/ticket/list?page=" + page[1], function (data) {
            $('#ticket_data').html(data);
        })
    });

    $(document).on('submit', "#submitTicket", function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var state = $('#btn-save').val();
        var ticket_id = $('#ticket_id').val();
        var ajaxurl = 'ticket/add';
        if (state == "update") {
            ajaxurl = 'ticket/' + ticket_id;
        }
        console.log(formData);
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                $.get("/ticket/list", function (data) {
                    $('#ticket_data').html(data);
                });
                $('#submitTicket').trigger("reset");
                $('#ticketModal').modal('hide');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //js for message

    $(document).on('click', '.message', function () {

        var ticket_id = $(this).attr('value');
        $('#message_ticket_id').val(ticket_id);
        $.get('message/list/' + ticket_id, function (data) {
            $('#message_data').html(data);
        });
    });

    $(document).on('submit', "#submitMessage", function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);
        var ticket_id = $('#message_ticket_id').val();
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "message/add",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                $.get('message/list/' + ticket_id, function (data) {
                    $('#message_data').html(data);
                });
                $('#submitMessage').trigger("reset");
                //$('#messageModal').modal('hide');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


});