<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabPrep | Deleted Samples</title>
    
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
                        <p class="text-xs text-slate-500 dark:text-slate-400">Deleted Samples</p>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="trash-2" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Deleted Samples</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Manage and restore deleted sample records</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    <span>{{ $samples->count() }} deleted samples</span>
                </div>
            </div>

            <!-- Deleted Samples Table -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="archive" class="w-5 h-5"></i>
                        Sample Archive
                    </h2>
                </div>
                
                @if($samples->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sample ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Laboratory</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($samples as $s)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-mono font-medium text-slate-900 dark:text-slate-100">{{ $s->nomor_sample }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-900 dark:text-slate-100">{{ $s->nama_sample }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-lab-100 text-lab-800 dark:bg-lab-900/30 dark:text-lab-300">
                                                <i data-lucide="microscope" class="w-3 h-3 mr-1"></i>
                                                {{ $s->lab_tujuan }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $s->tanggal_masuk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i>
                                                Deleted
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center gap-2">
                                                <form action="/restore/{{ $s->id }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-accent-700 dark:text-accent-200 bg-accent-100 dark:bg-accent-900/30 hover:bg-accent-200 dark:hover:bg-accent-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500 dark:focus:ring-offset-slate-800">
                                                        <i data-lucide="rotate-ccw" class="w-3 h-3 mr-1"></i>
                                                        Restore
                                                    </button>
                                                </form>
                                                <form action="/samples/{{ $s->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this sample? This action cannot be undone!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-slate-800">
                                                        <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i>
                                                        Delete Forever
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <i data-lucide="archive" class="w-16 h-16 text-slate-400 mx-auto mb-4"></i>
                        <p class="text-lg font-medium text-slate-900 dark:text-slate-100 mb-2">No deleted samples</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">The trash is empty. All samples are active.</p>
                        <a href="{{ route('samples.index') }}" class="inline-flex items-center px-4 py-2 bg-lab-600 text-white text-sm font-medium rounded-lg hover:bg-lab-700 focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                            <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i>
                            View Active Samples
                        </a>
                    </div>
                @endif
            </div>

            <!-- Bulk Actions -->
            @if($samples->count() > 0)
                <div class="mt-6 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                        Bulk Actions
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <button onclick="confirm('Are you sure you want to restore all deleted samples?')" class="inline-flex items-center px-4 py-2 bg-accent-600 text-white text-sm font-medium rounded-lg hover:bg-accent-700 focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                            <i data-lucide="rotate-ccw" class="w-4 h-4 mr-2"></i>
                            Restore All
                        </button>
                        <button onclick="confirm('Are you sure you want to permanently delete all samples in trash? This action cannot be undone!')" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                            Empty Trash
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </main>
</div>

</body>
</html>
