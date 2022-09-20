jQuery(document).ready(function ($) {
    ////----- Open the modal to CREATE a link -----////
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#modalFormData').trigger("reset");
        jQuery('#linkEditorModal').modal('show');
    });

    ////----- Open the modal to UPDATE a link -----////
    jQuery('body').on('click', '.open-modal', function () {

        var blog_id = $(this).val();
        $.get('blog/' + blog_id, function (data) {
            $('#blog_id').val(data.id);
            $('#user_id').val(data.user_id);
            jQuery('#blog_name').val(data.blog_name);
            jQuery('#description').val(data.description);
            jQuery('#blog_date').val(data.blog_date);
            jQuery('#btn-save').val("update");
            jQuery('#linkEditorModal').modal('show');
        })
    });

    $(document).on('click', '#pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=');
        var search = $('#search').val();
        $.get("/dashboard?page=" + page[1] + "&search=" + search, function (data) {
            $('#table_data').html(data);
        })
    });

    $('#search').keyup(function (e) {
        e.preventDefault();
        var search = $(this).val();
        $.get("/dashboard?search=" + search, function (data) {
            $('#table_data').html(data);
        })
    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            blog_name: jQuery('#blog_name').val(),
            description: jQuery('#description').val(),
            blog_date: $('#blog_date').val(),
            blog_image: $('#blog_image').attr('files'),
            user_id: $('#user_id').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var blog_id = jQuery('#blog_id').val();
        var ajaxurl = 'blog';
        if (state == "update") {
            type = "PUT";
            ajaxurl = 'blog/' + blog_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var link = '<tr id="blog' + data.id + '"><td>' + data.id + '</td><td>' + data.blog_name + '</td><td>' + data.description + '</td><td>' + data.blog_date + '</td>';
                link += '<td>';
                if (data.can_edit) {
                    link += '<button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>';
                }
                if (data.can_delete) {
                    link += ' <button class="btn btn-danger delete-blog" value="' + data.id + '">Delete</button>';
                }
                link += '</td ></tr > ';
                if (state == "add") {
                    jQuery('#blogs-list').append(link);
                } else {
                    $("#blog" + blog_id).replaceWith(link);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#linkEditorModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    ////----- DELETE a link and remove from the page -----////
    jQuery('.delete-blog').click(function () {
        var blog_id = $(this).val();
        alert(blog_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: 'blog/' + blog_id,
            success: function (data) {
                console.log(data);
                $("#blog" + blog_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});