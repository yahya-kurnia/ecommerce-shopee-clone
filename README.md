document.addEventListener('DOMContentLoaded', function () {
    const courierInputs = document.querySelectorAll('input[name="courier"]');
    const summaryTotal = document.querySelector('.summary-total strong');

    if (courierInputs.length && summaryTotal) {
        const prices = {
            jne: 15000,
            jnt: 17000,
            sicepat: 14000
        };

        courierInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                const fee = prices[input.value] || 0;
                const subtotalText = document.querySelectorAll('.summary-item strong')[1]?.textContent || 'Rp 0';
                const subtotalValue = parseInt(subtotalText.replace(/[^\d]/g, ''), 10) || 0;
                const total = subtotalValue + fee;
                summaryTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
            });
        });
    }

    const quantityLinks = document.querySelectorAll('.qty-btn');
    quantityLinks.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = btn.getAttribute('href');
        });
    });
});
