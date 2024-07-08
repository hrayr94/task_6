$(function () {
    let orders = JSON.parse(localStorage.getItem('orders')) || {};

    let orderItemsContainer = $('#order-items-container');
    let bill = 0;

    Object.values(orders).forEach(orderItem => {
        let order_price = orderItem.price;
        let order_quantity = orderItem.quantity;

        let orderCard = `
            <article id="${orderItem.product_id}" class="card-order">
                <img src="../Assets/images/${orderItem.image}" alt="Image" width="200" height="200">
                <div class="order-desc">
                    <h2>${orderItem.name}</h2>
                    <p>${order_price}$</p>
                    <p>${orderItem.description}</p>
                </div>
                <div class="order-quantity">
                    <p>QUANTITY: ${order_quantity}</p>
                </div>
            </article>
        `;

        orderItemsContainer.append(orderCard);

        bill += order_price * order_quantity;
    });

    // Update total bill amount
    $('#p-bill').text(`$ ${bill}`);
});
