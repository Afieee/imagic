<x-home-page-layout :user="$user">

    <head>
        <link rel="stylesheet" href="{{ asset('css/subscribe.css') }}">
        <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">

        {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script> --}}
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>

    </head>

    <div class="subscribe-container">
        <form action="/process-payment" id="subscribe-form" method="POST">
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->id }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="amount" value="1000">

            <div>

                @if (session('user_premium') == 'Premium' || $user->premium == 'Premium')
                    <p class="subscribe-text"> Thanks For Your Subscription, Enjoy Your Premium Feature
                    </p>
                    <p class="subscribe-description">
                        Your Post Will Be Highlighted & Prioritized For Everyone, You Have Your ⭐ Badge!
                    </p>
                    <button type="button" class="subscribe-btn" disabled style="background-color: gray">
                        You Are Already Premium User
                    </button>
                @else
                    <p class="subscribe-text">Subscribe Now to Get Prioritize Post!</p>
                    <p class="subscribe-description">
                        Join our community and enjoy premium features for just Rp 1.000. Get your Art to be
                        prioritized on the home page + get your ⭐ badge for premium user.
                    </p>
                    <button type="button" id="subscribe-btn" class="subscribe-btn">
                        <span class="subscribe-price">Rp 1.000</span> - Subscribe Now
                    </button>
                @endif

            </div>
        </form>
    </div>

    <script>
        const subscribeButton = document.getElementById('subscribe-btn');

        if (subscribeButton) {
            subscribeButton.addEventListener('click', function() {
                fetch('/process-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id_user: '{{ $user->id }}',
                            email: '{{ $user->email }}',
                            amount: 1000
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

                                    // Perbarui status premium di session
                                    sessionStorage.setItem('user_premium', 'Premium');
                                    window.location.href = '/subscribe';
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

    <script src="{{ asset('js/home-drop-down.js') }}"></script>

</x-home-page-layout>
