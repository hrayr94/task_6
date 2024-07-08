$(function () {
    $('.btn-add-to-cart').click(function () {
        // Retrieve product ID from the parent card element
        let product_id = $(this).parents('.card').attr('id');
        let product_name = $(this).parents('.card').find('.card-title').text().trim();
        let product_price = $(this).parents('.card').find('.card-text').text().trim().replace('$', '');
        let quantity = 1; // Default quantity for simplicity

        // Construct cart item object
        let cartItem = {
            product_id: product_id,
            name: product_name,
            price: parseFloat(product_price),
            quantity: quantity
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        // Check if the product is already in the cart
        if (cart[product_id]) {
            cart[product_id].quantity++; // Increase quantity if product exists
            alert(`${product_name} quantity updated in cart!`);
        } else {
            cart[product_id] = cartItem; // Add new product to cart
            alert(`${product_name} added to cart!`);
        }

        localStorage.setItem('cart', JSON.stringify(cart));

    });


});
