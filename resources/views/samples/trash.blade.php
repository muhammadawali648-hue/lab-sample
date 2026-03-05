<!DOCTYPE html>
<html>
<head>
    <title>Data Terhapus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-10 bg-red-50">

<h1 class="text-2xl font-bold mb-6 text-red-700">
🗑 Sampel Terhapus
</h1>

<a href="/" class="bg-blue-600 text-white px-4 py-2 rounded">
← Kembali
</a>

<table class="w-full mt-6 bg-white shadow rounded">
    <thead class="bg-red-500 text-white">
        <tr>
            <th class="p-3">Nomor</th>
            <th>Nama</th>
            <th>Lab</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach($samples as $s)
    <tr class="border-t text-center">
        <td class="p-2">{{ $s->nomor_sample }}</td>
        <td>{{ $s->nama_sample }}</td>
        <td>{{ $s->lab_tujuan }}</td>
        <td>
            <form action="/restore/{{ $s->id }}" method="POST">
                @csrf
                <button class="bg-green-600 text-white px-3 py-1 rounded">
                    Restore
                </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
