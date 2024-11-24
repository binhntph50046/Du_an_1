function updateQuantity(cartId, action) {
    const input = document.getElementById(`qty-${cartId}`);
    let value = parseInt(input.value);

    if (action === 'increase' && value < 10) {
        value++;
    } else if (action === 'decrease' && value > 1) {
        value--;
    } else if (action === 'input') {
        value = Math.min(Math.max(value, 1), 10);
    }

    input.value = value;

    fetch('?act=update-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            cart_id: cartId,
            quantity: value
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra khi cập nhật số lượng');
            }
        });
}

function removeItem(cartId) {
    if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        fetch('?act=remove-cart-item', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                cart_id: cartId
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Có lỗi xảy ra khi xóa sản phẩm');
                }
            });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    const confirmOrderBtn = document.getElementById('confirmOrderBtn');
    const totalElement = document.querySelector('.cart-total');
    let selectedTotal = 0;
    let selectedItems = [];

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const price = parseFloat(this.dataset.price);
            const cartId = this.dataset.id;

            if (this.checked) {
                selectedTotal += price;
                selectedItems.push(cartId);
            } else {
                selectedTotal -= price;
                selectedItems = selectedItems.filter(id => id !== cartId);
            }

            // Cập nhật trạng thái nút đặt hàng
            confirmOrderBtn.disabled = selectedItems.length === 0;

            updateTotal();
        });
    });

    function updateTotal() {
        const shippingFee = 30000;
        const finalTotal = selectedTotal + (selectedItems.length > 0 ? shippingFee : 0);

        document.querySelector('.subtotal-amount').textContent =
            new Intl.NumberFormat('vi-VN').format(selectedTotal) + '₫';
        document.querySelector('.total-amount').textContent =
            new Intl.NumberFormat('vi-VN').format(finalTotal) + '₫';

        // Cập nhật input hidden cho form đặt hàng
        document.querySelector('input[name="tong_tien"]').value = finalTotal;
    }
}); 