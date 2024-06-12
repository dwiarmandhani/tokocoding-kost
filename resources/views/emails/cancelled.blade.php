@component('mail::message')
# Pemesanan Dibatalkan!

Maaf pemesanan kamar Anda kami batalkan, karena bukti pembayaran tidak sesuai dengan nominal,
pengembalian pembayaran akan segera kami proses! <br>
Pastikan nomor rekening dan bank sesuai pada profil sudah sesuai !

<br>
Salam Hangat,<br>
{{ config('app.name') }}
@endcomponent
