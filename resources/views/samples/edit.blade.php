<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabPrep | Edit Sample</title>
    
    <!-- Google Fonts - Modern & Clean -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DARK MODE CONFIG -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        'lab': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'accent': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
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
            
            // Initialize Lucide icons
            lucide.createIcons();
        }
    </script>

</head>

<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 font-sans antialiased min-h-screen">

<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-lab-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="flask-conical" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">LabPrep</h1>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Edit Sample</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('samples.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lab-500 dark:focus:ring-offset-slate-800 transition-colors">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Back to Samples
                    </a>
                    <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <i data-lucide="moon" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-lab-100 dark:bg-lab-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="edit-3" class="w-6 h-6 text-lab-600 dark:text-lab-400"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Sample</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Update sample information and details</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                    <span class="font-mono bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded">{{ $sample->nomor_sample }}</span>
                    <span>•</span>
                    <span>{{ $sample->nama_sample }}</span>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        Sample Details
                    </h2>
                </div>
                
                <form method="POST" action="/samples/{{ $sample->id }}" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Sample ID -->
                    <div>
                        <label for="nomor_sample" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Sample ID
                        </label>
                        <input 
                            id="nomor_sample"
                            name="nomor_sample"
                            type="text"
                            value="{{ $sample->nomor_sample }}"
                            class="w-full px-3 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm font-mono text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                            required>
                    </div>

                    <!-- Sample Name -->
                    <div>
                        <label for="nama_sample" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Sample Name
                        </label>
                        <input 
                            id="nama_sample"
                            name="nama_sample"
                            type="text"
                            value="{{ $sample->nama_sample }}"
                            class="w-full px-3 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                            required>
                    </div>

                    <!-- Date Received -->
                    <div>
                        <label for="tanggal_masuk" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Date Received
                        </label>
                        <input 
                            id="tanggal_masuk"
                            name="tanggal_masuk"
                            type="date"
                            value="{{ $sample->tanggal_masuk }}"
                            class="w-full px-3 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                            required>
                    </div>

                    <!-- Laboratory -->
                    <div>
                        <label for="lab_tujuan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Laboratory
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="microscope" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <select 
                                id="lab_tujuan"
                                name="lab_tujuan"
                                class="w-full pl-10 pr-3 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-lab-500 focus:border-lab-500 appearance-none"
                                required>
                                <option value="Ankom" {{ $sample->lab_tujuan=='Ankom'?'selected':'' }}>
                                    Ankom
                                </option>
                                <option value="Makmin" {{ $sample->lab_tujuan=='Makmin'?'selected':'' }}>
                                    Makmin
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Status -->
                    <div>
                        <label for="stok" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Stock Status
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="package" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <select 
                                id="stok"
                                name="stok"
                                class="w-full pl-10 pr-3 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-lab-500 focus:border-lab-500 appearance-none">
                                <option value="Ada" {{ $sample->stok=='Ada'?'selected':'' }}>
                                    In Stock
                                </option>
                                <option value="Habis" {{ $sample->stok=='Habis'?'selected':'' }}>
                                    Out of Stock
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('samples.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lab-500 dark:focus:ring-offset-slate-800 transition-colors">
                            <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-lab-600 text-white text-sm font-medium rounded-lg hover:bg-lab-700 focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                            Update Sample
                        </button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="mt-6 bg-white dark:bg-slate-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20">
                    <h2 class="text-lg font-semibold text-red-800 dark:text-red-200 flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                        Danger Zone
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-900 dark:text-white">Delete Sample</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Permanently remove this sample from the system</p>
                        </div>
                        <form action="/samples/{{ $sample->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sample? This action cannot be undone!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>