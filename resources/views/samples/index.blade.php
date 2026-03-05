<!DOCTYPE html>
<html>
<head>
    <title>Logbook Preparasi Lab</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DARK MODE CONFIG -->
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- DARK MODE SCRIPT -->
    <script>
        function toggleDarkMode() {
            const html = document.documentElement;

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme
        window.onload = function() {
            const theme = localStorage.getItem('theme');
            if(theme === 'dark'){
                document.documentElement.classList.add('dark');
            }
        }
    </script>

</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen p-10 text-gray-800 dark:text-gray-200">

<div class="max-w-7xl mx-auto">

<!-- HEADER -->
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-4xl font-bold text-blue-700 dark:text-blue-400">
            {{ $title ?? '🧪 Logbook Preparasi Lab' }}
        </h1>

        <p class="text-gray-500 dark:text-gray-400">
            PENGARSIPAN DATA SAMPEL PREPARASI
        </p>
    </div>

    <div class="flex gap-3">

        <!-- DARK MODE BUTTON -->
        <button onclick="toggleDarkMode()"
           class="bg-yellow-400 text-black px-4 py-2 rounded-xl shadow hover:bg-yellow-500 transition">
           🌙 / ☀️
        </button>

        <a href="/trash"
           class="bg-red-600 text-white px-5 py-2 rounded-xl shadow hover:bg-red-700 transition">
            🗑 Data Terhapus
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-gray-800 text-white px-5 py-2 rounded-xl shadow hover:bg-black transition">
                Logout
            </button>
        </form>

    </div>

</div>

<!-- FILTER LAB -->
<div class="flex gap-3 mb-8">

<a href="{{ route('samples.index') }}"
   class="px-6 py-2 rounded-xl font-semibold shadow
   {{ request('lab')==null ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-700 hover:bg-blue-50 border dark:border-gray-600' }}">
   Semua
</a>

@foreach($labs as $lab)
<a href="{{ route('samples.index', ['lab'=>$lab]) }}"
   class="px-6 py-2 rounded-xl font-semibold shadow transition
   {{ request('lab')==$lab ? 'bg-green-600 text-white' : 'bg-white dark:bg-gray-700 hover:bg-green-50 border dark:border-gray-600' }}">
   {{ $lab }}
</a>
@endforeach

</div>

<!-- CARD -->
<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg mb-8">

<!-- EXPORT PDF -->
<form action="{{ route('samples.export.pdf') }}" method="GET" target="_blank" class="flex gap-3 mb-5 items-center">
    
    <select name="bulan" required class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2">
        <option value="">Pilih Bulan</option>
        @for($i=1; $i<=12; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <select name="tahun" required class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2">
        <option value="">Pilih Tahun</option>
        @for($y=date('Y'); $y>=2020; $y--)
            <option value="{{ $y }}">{{ $y }}</option>
        @endfor
    </select>

    <button type="submit"
        class="bg-purple-600 text-white px-5 py-2 rounded-lg shadow hover:bg-purple-700 transition">
        Export PDF
    </button>

</form>

<!-- SEARCH -->
<form method="GET" class="flex gap-2 mb-5">
    <input
        name="search"
        value="{{ request('search') }}"
        placeholder="🔍 Cari sampel..."
        class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 w-64 focus:ring-2 focus:ring-blue-300 outline-none"
    >

    <button class="bg-blue-600 text-white px-5 rounded-lg hover:bg-blue-700 transition">
        Search
    </button>
</form>

<!-- TAMBAH SAMPLE -->
<form action="/samples" method="POST" class="flex flex-wrap gap-3">
@csrf

    <input name="nomor_sample"
           placeholder="Nomor Sampel"
           class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2"
           required>

    <input name="nama_sample"
           placeholder="Nama Sampel"
           class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2"
           required>

    <input type="date"
           name="tanggal_masuk"
           class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2"
           required>

    <select name="lab_tujuan"
            class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2">
        @foreach($labs as $lab)
            <option value="{{ $lab }}">{{ $lab }}</option>
        @endforeach
    </select>

    <select name="stok"
            class="border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2">
        <option value="Ada">Ada</option>
        <option value="Habis">Tidak Ada Stok</option>
    </select>

    <button class="bg-green-600 text-white px-6 rounded-lg shadow hover:bg-green-700 transition">
        + Tambah
    </button>

</form>

</div>

<!-- TABLE -->
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-blue-600 text-white">
<tr>
<th class="p-3">No</th>
<th>Nomor</th>
<th>Nama</th>
<th>Lab</th>
<th>Tanggal</th>
<th>Stok</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($samples as $s)
<tr class="text-center border-t dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-gray-700 transition">

<td class="p-3">{{ $loop->iteration }}</td>
<td class="font-semibold text-blue-700 dark:text-blue-400">{{ $s->nomor_sample }}</td>
<td>{{ $s->nama_sample }}</td>

<td>
<span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
{{ $s->lab_tujuan }}
</span>
</td>

<td>{{ $s->tanggal_masuk }}</td>

<td>
@if($s->stok=='Ada')
<span class="bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-300 px-3 py-1 rounded-full text-xs">
Ada
</span>
@else
<span class="bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-300 px-3 py-1 rounded-full text-xs">
Habis
</span>
@endif
</td>

<td class="flex justify-center gap-2 p-2">

<a href="/samples/{{ $s->id }}/edit"
class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
Edit
</a>

<form action="/samples/{{ $s->id }}" method="POST">
@csrf
@method('DELETE')
<button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
Hapus
</button>
</form>

</td>

</tr>

@empty
<tr>
<td colspan="7" class="p-8 text-gray-400 text-center">
Belum ada data sampel
</td>
</tr>
@endforelse

</tbody>
</table>

</div>

</div>
</body>
</html>