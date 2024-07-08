$(function () {
    // Function to handle adding a product to cart
    $('.btn-add-to-cart').click(function () {
        let product_id = $(this).parents('.card').attr('id');
        let product_name = $(this).parents('.card').find('.card-title').text().trim();
        let product_price = $(this).parents('.card').find('.card-text').text().trim().replace('$', '');
        let quantity = 1; // Default quantity for simplicity

        let cartItem = {
            product_id: product_id,
            name: product_name,
            price: parseFloat(product_price),
            quantity: quantity
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        if (cart[product_id]) {
            cart[product_id].quantity++;
            alert(`${product_name} quantity updated in cart!`);
        } else {
            cart[product_id] = cartItem;
            alert(`${product_name} added to cart!`);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
    });

    // Function to handle adding a product to orders
    $('.btn-add-to-order').click(function () {
        let product_id = $(this).parents('.card').attr('id');
        let product_name = $(this).parents('.card').find('.card-title').text().trim();
        let product_price = $(this).parents('.card').find('.card-text').text().trim().replace('$', '');
        let quantity = 1; // Default quantity for simplicity

        let orderItem = {
            product_id: product_id,
            name: product_name,
            price: parseFloat(product_price),
            quantity: quantity
        };

        let orders = JSON.parse(localStorage.getItem('orders')) || {};

        if (orders[product_id]) {
            orders[product_id].quantity++;
            alert(`${product_name} quantity updated in orders!`);
        } else {
            orders[product_id] = orderItem;
            alert(`${product_name} added to orders!`);
        }

        localStorage.setItem('orders', JSON.stringify(orders));
    });
});
