<x-app-layout>
<div class="p-6">

<h2 class="text-xl font-bold mb-4">Tambah Sampel</h2>

<form action="/samples" method="POST" class="space-y-3">
@csrf

<input name="nama_pelanggan" placeholder="Nama Pelanggan" class="border p-2 w-full">

<input name="jenis_sample" placeholder="Jenis Sampel" class="border p-2 w-full">

<input type="date" name="tanggal_masuk" class="border p-2 w-full">

<textarea name="keterangan" placeholder="Keterangan" class="border p-2 w-full"></textarea>

<button class="bg-green-500 text-white px-4 py-2 rounded">
Simpan
</button>

</form>

</div>
</x-app-layout>
