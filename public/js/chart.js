// checkout

/* <script>
        var cart = @json($checkout);
        var totalHarga = {{ $total }};

        document.getElementById('member_status').addEventListener('change', function () {
            const isMember = this.value === 'member';
            document.getElementById('phone-container').classList.toggle('d-none', !isMember);
            document.getElementById('is-member-input').value = isMember ? 1 : 0;
        });

        document.getElementById('total_bayar').addEventListener('input', function () {
            let value = this.value.replace(/[^0-9]/g, '');
            this.value = value ? 'Rp ' + new Intl.NumberFormat('id-ID').format(value) : '';
        });

        document.getElementById('checkout_form').addEventListener('submit', function (e) {
            const totalBayar = parseInt(document.getElementById('total_bayar').value.replace(/[^0-9]/g, '')) || 0;
            const isMember = document.getElementById('member_status').value === 'member';
            const phone = document.getElementById('phone_number').value;

            if (totalBayar < totalHarga) {
                alert('Uang tidak cukup!');
                e.preventDefault();
                return;
            }

            if (isMember && phone.trim() === '') {
                alert('Nomor telepon wajib diisi untuk member.');
                e.preventDefault();
                return;
            }

            document.getElementById('cart-input').value = JSON.stringify(cart);
            document.getElementById('amount-paid-input').value = totalBayar;
            document.getElementById('no-telp-input').value = isMember ? phone : '';
        });
</script> */

// member
/* <script>
        const checkbox = document.getElementById('use_point');
        const label = document.getElementById('use_point_label');
        const pointInfo = document.getElementById('point-info');
        const usePointsHidden = document.getElementById('usePointsHidden');

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                label.classList.add('text-success');
                pointInfo.style.display = 'block';
            } else {
                label.classList.remove('text-success');
                pointInfo.style.display = 'none';
            }
        });

        document.getElementById('member-form').addEventListener('submit', function () {
            document.getElementById('cart-input').value = JSON.stringify(@json($cartItems));
            usePointsHidden.value = checkbox.checked ? "1" : "0";
        });
</script> */

// product
/* <script>
        let cart_checkout = [];

        function updateQuantity(id, change, maxStock) {
            const qtyInput = document.getElementById('qty-' + id);
            let qty = parseInt(qtyInput.value) || 0;
            let newQty = qty + change;

            newQty = Math.max(0, Math.min(newQty, maxStock));
            qtyInput.value = newQty;

            const index = cart_checkout.findIndex(item => item.id === id);
            if (index > -1) {
                if (newQty === 0) {
                    cart_checkout.splice(index, 1);
                } else {
                    cart_checkout[index].qty = newQty;
                }
            } else if (newQty > 0) {
                cart_checkout.push({ id: id, qty: newQty });
            }
        }

        document.getElementById('checkout-form').addEventListener('submit', function () {
            document.getElementById('cart_checkout').value = JSON.stringify(cart_checkout);
        });
</script> */

// member
/* <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: {!! json_encode($totals) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                scales: { y: { beginAtZero: true } }
            }
        });

        const productChart = new Chart(document.getElementById('productChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($product_name) !!},
                datasets: [{
                    data: {!! json_encode($product_qty) !!},
                    backgroundColor: [
                        '#f87171', '#60a5fa', '#facc15', '#34d399', '#a78bfa', '#fb923c'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false
            }
        });
</script> */

// createproduct
// <script>
//     const priceDisplay = document.getElementById('price_display');
//     const priceHidden = document.getElementById('price');

//     priceDisplay.addEventListener('input', function () {
//         let raw = this.value.replace(/[^\d]/g, '');
//         let formatted = new Intl.NumberFormat('id-ID').format(raw);
//         this.value = 'Rp. ' + formatted;
//         priceHidden.value = raw;
//     });
// </script>

// edit
// <script>
//     const priceDisplay = document.getElementById('price_display');
//     const priceHidden = document.getElementById('price');

//     priceDisplay.addEventListener('input', function () {
//         let raw = this.value.replace(/[^\d]/g, '');
//         let formatted = new Intl.NumberFormat('id-ID').format(raw);
//         this.value = 'Rp. ' + formatted;
//         priceHidden.value = raw;
//     });
// </script>