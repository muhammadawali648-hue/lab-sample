<x-app-layout>
<div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">

<div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 p-6 sm:p-8">
    <div class="flex items-center gap-3 mb-6 sm:mb-8">
        <div class="w-10 h-10 bg-lab-600 rounded-lg flex items-center justify-center">
            <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">Tambah Sampel</h2>
    </div>

    <form action="/samples" method="POST" class="space-y-4 sm:space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label for="nama_pelanggan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Pelanggan
                </label>
                <input 
                    id="nama_pelanggan"
                    name="nama_pelanggan" 
                    placeholder="Masukkan nama pelanggan" 
                    required
                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-lab-500 focus:border-lab-500 dark:bg-slate-700 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition-colors"
                >
            </div>

            <div>
                <label for="jenis_sample" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Jenis Sampel
                </label>
                <input 
                    id="jenis_sample"
                    name="jenis_sample" 
                    placeholder="Masukkan jenis sampel" 
                    required
                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-lab-500 focus:border-lab-500 dark:bg-slate-700 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition-colors"
                >
            </div>
        </div>

        <div>
            <label for="tanggal_masuk" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Tanggal Masuk
            </label>
            <input 
                id="tanggal_masuk"
                type="date" 
                name="tanggal_masuk" 
                required
                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-lab-500 focus:border-lab-500 dark:bg-slate-700 dark:text-white transition-colors"
            >
        </div>

        <div>
            <label for="keterangan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Keterangan
            </label>
            <textarea 
                id="keterangan"
                name="keterangan" 
                placeholder="Masukkan keterangan tambahan" 
                rows="4"
                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-lab-500 focus:border-lab-500 dark:bg-slate-700 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition-colors resize-none"
            ></textarea>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4">
            <button 
                type="submit" 
                class="flex-1 sm:flex-none bg-lab-600 hover:bg-lab-700 text-white font-medium px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
            >
                <span class="flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Sampel
                </span>
            </button>
            
            <a 
                href="{{ route('samples.index') }}" 
                class="flex-1 sm:flex-none bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 font-medium px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 text-center"
            >
                <span class="flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </span>
            </a>
        </div>
    </form>
</div>

</div>

<script>
    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
</x-app-layout>
