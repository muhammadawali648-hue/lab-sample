<!DOCTYPE html>
<html>
<head>
    <title>Edit Sampel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen p-10">

<div class="max-w-xl mx-auto">

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-xl p-8">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-blue-700">
                ✏️ Edit Data Sampel
            </h1>
            <p class="text-gray-500 text-sm">
                Perbarui informasi sampel laboratorium
            </p>
        </div>

        <!-- FORM -->
        <form method="POST" action="/samples/{{ $sample->id }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nomor Sampel -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nomor Sampel
                </label>
                <input 
                    name="nomor_sample"
                    value="{{ $sample->nomor_sample }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300 focus:outline-none transition"
                    required>
            </div>

            <!-- Nama Sampel -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nama Sampel
                </label>
                <input 
                    name="nama_sample"
                    value="{{ $sample->nama_sample }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300 focus:outline-none transition"
                    required>
            </div>

            <!-- Tanggal Masuk -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Tanggal Masuk
                </label>
                <input 
                    type="date"
                    name="tanggal_masuk"
                    value="{{ $sample->tanggal_masuk }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300 focus:outline-none transition"
                    required>
            </div>

            <!-- LAB TUJUAN -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Lab Tujuan
                </label>

                <select 
                    name="lab_tujuan"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300 focus:outline-none transition"
                    required>

                    <option value="Ankom" {{ $sample->lab_tujuan=='Ankom'?'selected':'' }}>
                        Ankom
                    </option>

                    <option value="Makmin" {{ $sample->lab_tujuan=='Makmin'?'selected':'' }}>
                        Makmin
                    </option>

                </select>
            </div>

            <!-- STOK -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Status Stok
                </label>

                <select 
                    name="stok"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300 focus:outline-none transition">

                    <option value="Ada" {{ $sample->stok=='Ada'?'selected':'' }}>
                        Ada
                    </option>

                    <option value="Habis" {{ $sample->stok=='Habis'?'selected':'' }}>
                        Tidak Ada Stok
                    </option>

                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between pt-4">

                <a href="/"
                   class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg shadow transition">
                    ← Kembali
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                    💾 Update
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>