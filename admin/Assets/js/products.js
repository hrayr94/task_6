$(function () {
    $('.sidebar-toggle').click(function () {
        $('.sidebar').toggleClass('toggle');
    });
    $('.btn-upd').click(function () {
        let self = $(this).parents('.card');
        let id = self.attr('id');
        let name = self.find('.p-name').html();
        let desc = self.find('.p-desc').html();
        let price = self.find('.p-price').html();

        $.ajax({
            url: "../Controller/add_product.php",
            method: 'post',
            data: {
                name, desc, price, id,
                action: 'update'
            },
            success: () => {
                location.reload();
            }
        })
    })

    $('.btn-del').click(function () {
        let id = $(this).parents('.card').attr('id');

        $.ajax({
            url: "../Controller/add_product.php",
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

