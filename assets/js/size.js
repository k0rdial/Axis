const sizeButtons = document.querySelectorAll('.size-options button');
const sizeInput = document.getElementById('selected-size');
const cartBTN = document.getElementById('add-to-cart');

sizeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        sizeButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        cartBTN.disabled = false;
        sizeInput.value = btn.textContent;
    });
});



// TEMPORARY

document.addEventListener('DOMContentLoaded', () => {
    const cartMSG = document.querySelector('.cart-msg');
    const cartSTTS = document.querySelector('.cart-status');
    const errorMessage = document.querySelector('.cart-error');
    if (cartMSG) {
        setTimeout(() => {
            cartMSG.classList.add('hidden');
            setTimeout(() => cartMSG.remove(), 500);
        }, 3000);
    } else if (cartSTTS) {
        setTimeout(() => {
            cartSTTS.classList.add('hidden');
            setTimeout(() => cartSTTS.remove(), 500);
        }, 3000);
    } else if (errorMessage) {
        setTimeout(() => {
            errorMessage.classList.add('hidden');
            setTimeout(() => errorMessage.remove(), 500);
        }, 3000);
    }
});