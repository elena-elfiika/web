document.getElementById('calculate-btn').addEventListener('click', function () {
    const serviceSelect = document.getElementById('service-select');
    const quantity = parseInt(document.getElementById('quantity').value, 10) || 1;

    const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
    const priceWon = parseInt(selectedOption.value, 10);
    const priceUsd = parseInt(selectedOption.getAttribute('data-usd'), 10);

    const totalWon = priceWon * quantity;
    const totalUsd = priceUsd * quantity;

    document.getElementById('total-won').textContent = totalWon.toLocaleString();
    document.getElementById('total-usd').textContent = totalUsd.toLocaleString();
});
