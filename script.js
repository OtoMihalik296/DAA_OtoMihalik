document.addEventListener("DOMContentLoaded", function() {
const minPriceInput = document.getElementById('min-price');
const maxPriceInput = document.getElementById('max-price');
const productCards = document.querySelectorAll('.product-card');

const minLabel = document.querySelector('#price-range-slider span:first-child');
const maxLabel = document.querySelector('#price-range-slider span:last-child');

function filterProductsByPrice() {
    const minValue = parseInt(minPriceInput.value);
    const maxValue = parseInt(maxPriceInput.value);

    productCards.forEach(function(card) {
        const price = parseInt(card.querySelector('h4').textContent); // Get the price from each product card
        if (price >= minValue && price <= maxValue) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    minLabel.textContent = minValue + '€';
    maxLabel.textContent = maxValue + '€';
}

function syncSliders() {
    const minValue = parseInt(minPriceInput.value);
    const maxValue = parseInt(maxPriceInput.value);

    if (minValue > maxValue) {
        minPriceInput.value = maxValue;
    }

    filterProductsByPrice();
}

minPriceInput.addEventListener('input', syncSliders);
maxPriceInput.addEventListener('input', syncSliders);

// Initially filter products by price
filterProductsByPrice();

// Sorting functionality
document.getElementById('sort-by').addEventListener('change', function() {
    var sortBy = this.value;
    var productsContainer = document.querySelector('.products');
    var productCardsArray = Array.from(productCards);

    productCardsArray.sort(function(a, b) {
        var aValue, bValue;

        switch (sortBy) {
            case 'name_asc':
            case 'name_desc':
                aValue = a.querySelector('h3') ? a.querySelector('h3').textContent.toLowerCase() : '';
                bValue = b.querySelector('h3') ? b.querySelector('h3').textContent.toLowerCase() : '';
                break;
            case 'price_asc':
            case 'price_desc':
                aValue = parseFloat(a.querySelector('h4').textContent);
                bValue = parseFloat(b.querySelector('h4').textContent);
                break;
            case 'id_asc':
            case 'id_desc':
                aValue = parseInt(a.querySelector('p:nth-of-type(2)').textContent.split(':')[1].trim());
                bValue = parseInt(b.querySelector('p:nth-of-type(2)').textContent.split(':')[1].trim());
                break;
        }

        if (sortBy.endsWith('_asc')) {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });

    productsContainer.innerHTML = '';
    productCardsArray.forEach(function(card) {
        productsContainer.appendChild(card);
    });
});

const searchInput = document.getElementById('search-input');

searchInput.addEventListener('input', function() {
    const searchText = this.value.trim().toLowerCase();
    const productCards = Array.from(document.querySelectorAll('.product-card'));

    productCards.forEach(card => {
        const productNameElement = card.querySelector('h3');
        if (productNameElement) {
            const productName = productNameElement.textContent.toLowerCase();
            if (productName.includes(searchText)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });
}); 
});
