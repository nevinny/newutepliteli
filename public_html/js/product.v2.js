document.addEventListener('DOMContentLoaded', function () {

    let firstLoad = true;
    // Запуск
    // alert('firstLoad:'+firstLoad);
    // console.log(variants);
    selectSize(0, firstLoad);

});

function showToast(message = 'Товар добавлен в корзину', delay = 15000) {
    const toastElement = document.getElementById('cartToast');
    const toastMessage = document.getElementById('toastMessage');
    toastMessage.textContent = message;

    const toast = new bootstrap.Toast(toastElement, {
        delay: delay,
        autohide: true
    });
    toast.show();
}

function showTab(tabName) {
    document.querySelectorAll('[data-tab-content]').forEach(content => {
        content.classList.add('hidden');
    });

    document.querySelector(`[data-tab-content="${tabName}"]`).classList.remove('hidden');

    document.querySelectorAll('[data-tab-trigger]').forEach(button => {
        button.classList.remove('bg-white', 'border-gray-300', 'text-gray-900');
        button.classList.add('bg-gray-50', 'text-gray-500', 'hover:text-gray-700');
    });

    document.querySelector(`[data-tab-trigger="${tabName}"]`).classList.add('bg-white', 'border-gray-300', 'text-gray-900');
    document.querySelector(`[data-tab-trigger="${tabName}"]`).classList.remove('bg-gray-50', 'text-gray-500', 'hover:text-gray-700');
}

function addToCart() {
    const variant = variants[selectedVariantIndex];
    const variantId = variant.variantId;
    console.log(variant.variantId);
    // exit();
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({
            variantId: variantId,
            quantity: quantity
        })
    })
        .then(response => {
            if (!response.ok) throw new Error('Ошибка добавления в корзину');
            return response.json();
        })
        .then(data => {
            // alert('Товар добавлен в корзину!'); // Заменить на toast
            showToast(data.message, 5000); // например, 10 сек
        })
        .catch(error => {
            console.error(error);
            // alert('Ошибка при добавлении в корзину');
            showToast('Ошибка при добавлении в корзину:' + variantId, 2000); // например, 10 сек
        });
}

const mainImage = document.getElementById('main-image');
const mainImageDiv = document.getElementById('main-image-div');
const thumbnails = document.querySelectorAll('.image-thumbnail');
const variantButtons = document.querySelectorAll('.size-option');

const variants = JSON.parse(document.getElementById('variants-data').textContent);
const variantImages = JSON.parse(document.getElementById('variant-images').textContent);
let selectedVariantIndex = 0;
let quantity = 1;

function selectSize(index, initLoad) {
    selectedVariantIndex = index;
    // alert(selectedVariantIndex + ' ' + quantity + ' ' + variantImages[index]);
    // updatePrice();
    if (!initLoad) {
        selectVariantImage(selectedVariantIndex);
    }

    variantButtons.forEach((option, i) => {
        option.classList.remove('btn-outline-danger', 'btn-outline-secondary', 'active');
        if (i === index) {
            option.classList.add('btn-outline-danger', 'active');
        } else {
            option.classList.add('btn-outline-secondary');
        }
    });
}

function selectVariantImage(index) {
    selectedImage = index;
    // Эффект исчезновения
    // mainImageDiv.classList.add('transition-opacity', 'duration-500');
    // mainImageDiv.classList.remove('opacity-100');
    // mainImageDiv.classList.add('opacity-0');

    setTimeout(() => {
        // Эффект появления
        // mainImage.classList.remove('fade-out');
        // mainImage.classList.add('fade-in');
        // Смена изображения
        mainImage.src = variantImages[index];
        // Эффект появления
        // mainImageDiv.classList.remove('opacity-0');
        // mainImageDiv.classList.add('opacity-100');

        setTimeout(() => {
            // mainImageDiv.classList.remove('transition-opacity', 'duration-500');
        }, 150);

    }, 150);


    thumbnails.forEach((thumb, i) => {
        thumb.classList.toggle('border-red-600', i === index);
        thumb.classList.toggle('border-gray-200', i !== index);
    });
}
