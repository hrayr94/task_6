$(function () {
    $('.sidebar-toggle').click(function () {
        $('.sidebar').toggleClass('toggle');
    });
    $('#btn-add').click(function () {
        let name = $('#input-cat').val();
        console.log(name)
        $.ajax({
            url: "../Controller/add_category.php",
            method: 'post',
            dataType: 'html',
            data: {
                name,
                action: 'add'
            },
            success: (response) => {
                if (response === 'error') {
                    $('#p-mess').html('Empty field');
                } else {
                    location.reload()
                }
            }
        })
    })

    $('.btn-upd').click(function () {
        let id = $(this).parents('.inner-cat').attr('id');
        let name = $(this).parents('.inner-cat').find('h2').html();

        $.ajax({
            url: "../Controller/add_category.php",
            method: 'post',
            data: {
                id, name,
                action: 'update'
            },
            success: () => {
                location.reload();
            }
        })
    })

    $('.btn-del').click(function () {
        let id = $(this).parents('.inner-cat').attr('id');

        $.ajax({
            url: "../Controller/add_category.php",
            method: 'post',
            data: {
                id,
                action: 'delete'
            },
            success: () => {
                location.reload();
            }
        })
    })
})