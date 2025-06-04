@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4">Pembayaran Pesanan</h2>
    <div id="snap-container"></div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            window.location.href = "{{ route('pages.order-history') }}";
        },
        onPending: function(result) {
            alert("Menunggu pembayaran...");
        },
        onError: function(result) {
            alert("Terjadi kesalahan.");
        },
        onClose: function() {
            alert("Pembayaran dibatalkan.");
        }
    });
</script>
@endsection
