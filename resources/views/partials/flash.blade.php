{{-- Menampilkan pesan sukses (status) dan error validasi sebagai alert, sama seperti halaman pelanggan. --}}
@if (session('status'))
<script>alert(@json(session('status')));</script>
@endif
@if ($errors->any())
<script>alert(@json($errors->first()));</script>
@endif
