<x-home-page-layout :user="$user">

    <head>
        <link rel="stylesheet" href="{{ asset('css/subscribe.css') }}">
        <!-- Midtrans Snap.js -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    </head>

    <div class="subscribe-container">

        <form action="/process-payment" id="subscribe-form" method="POST">
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->id }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="amount" value="25000">

            <div>
                <p class="subscribe-text">Subscribe Now to Get Prioritize Post!</p>
                <p class="subscribe-description">
                    Join our community and enjoy premium features for just Rp 25.000 per month. Get your Art to be
                    prioritized on the home page + get your ⭐ badge for premium user.
                </p>

                <!-- Jika user premium, tampilkan tombol "Anda adalah user premium" -->
                @if ($user->premium == 'Premium')
                    <button type="button" class="subscribe-btn" disabled style="background-color: gray">
                        Anda adalah user premium
                    </button>
                @else
                    <!-- Jika user belum premium, tampilkan tombol Subscribe yang bisa diklik -->
                    <button type="button" id="subscribe-btn" class="subscribe-btn">
                        <span class="subscribe-price">Rp 25.000</span> - Subscribe Now
                    </button>
                @endif

            </div>
        </form>
    </div>

    <script>
        // Pastikan bahwa tombol dengan ID subscribe-btn ada sebelum menambahkan event listener
        const subscribeButton = document.getElementById('subscribe-btn');

        if (subscribeButton) {
            subscribeButton.addEventListener('click', function() {
                // Mengirim request ke server untuk mendapatkan Snap Token
                fetch('/process-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id_user: '{{ $user->id }}',
                            email: '{{ $user->email }}',
                            amount: 25000
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snapToken) {
                            // Memanggil Midtrans Snap
                            window.snap.pay(data.snapToken, {
                                onSuccess: function(result) {
                                    alert('Pembayaran berhasil! Terima kasih telah berlangganan.');
                                    console.log(result);
                                },
                                onPending: function(result) {
                                    alert('Pembayaran Anda sedang diproses.');
                                    console.log(result);
                                },
                                onError: function(result) {
                                    alert('Terjadi kesalahan saat memproses pembayaran.');
                                    console.error(result);
                                }
                            });
                        } else {
                            alert('Error: ' + (data.error || 'Gagal memproses pembayaran.'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan, coba lagi nanti.');
                    });
            });
        }
    </script>
</x-home-page-layout>
