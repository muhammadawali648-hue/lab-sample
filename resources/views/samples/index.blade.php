<!DOCTYPE html>
<html>
<head>
    <title>LabPrep | Laboratory Sample Management</title>
    
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

        // Toggle dropdown menu
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const button = event.target.closest('button[onclick="toggleDropdown()"]');
            
            if (!button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</head>

<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 font-sans antialiased">

<div class="flex h-screen">

<!-- SIDEBAR -->
<div class="w-64 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 flex flex-col">

    <!-- Sidebar Header -->
    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-lab-600 rounded-lg flex items-center justify-center">
                <i data-lucide="flask-conical" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <h1 class="text-lg font-semibold text-slate-900 dark:text-white">LabPrep</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">Sample Management</p>
            </div>
        </div>
    </div>

    <!-- Filter Lab Buttons -->
    <div class="flex-1 p-4">
        <h3 class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">Laboratory</h3>
        
        <div class="space-y-1">
            <a href="{{ route('samples.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               {{ request('lab')==null ? 'bg-lab-100 text-lab-700 dark:bg-lab-900/30 dark:text-lab-300' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/50' }}">
                <i data-lucide="layers" class="w-4 h-4"></i>
                All Samples
            </a>

            @foreach($labs as $lab)
            <a href="{{ route('samples.index', ['lab'=>$lab]) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               {{ request('lab')==$lab ? 'bg-accent-100 text-accent-700 dark:bg-accent-900/30 dark:text-accent-300' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/50' }}">
                <i data-lucide="microscope" class="w-4 h-4"></i>
                {{ $lab }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Settings Section -->
    <div class="p-4 border-t border-slate-200 dark:border-slate-700">
        <h3 class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">System</h3>
        
        <!-- SETTINGS DROPDOWN -->
        <div class="relative">
            <button onclick="toggleDropdown()" 
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-all">
                <i data-lucide="settings" class="w-4 h-4"></i>
                Settings
                <i data-lucide="chevron-up" class="w-4 h-4 ml-auto"></i>
            </button>
            
            <!-- DROPDOWN MENU -->
            <div id="dropdownMenu" class="hidden absolute bottom-full left-0 mb-2 w-56 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 z-50">
                <div class="p-1">
                    <!-- RESET ACCOUNT -->
                    <a href="/admin/reset" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                        <i data-lucide="key-round" class="w-4 h-4 text-orange-500"></i>
                        <div>
                            <div class="font-medium">Reset Account</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">Change credentials</div>
                        </div>
                    </a>
                    
                    <div class="my-1 border-t border-slate-200 dark:border-slate-700"></div>
                    
                    <!-- DARK MODE -->
                    <button onclick="toggleDarkMode()" 
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-md text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                        <i data-lucide="moon" class="w-4 h-4 text-slate-500"></i>
                        <div class="text-left">
                            <div class="font-medium">Dark Mode</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">Toggle theme</div>
                        </div>
                    </button>
                    
                    <!-- TRASH DATA -->
                    <a href="/trash" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
                        <div>
                            <div class="font-medium">Deleted Data</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">View deleted samples</div>
                        </div>
                    </a>
                    
                    <!-- LOGOUT -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-md text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4 text-slate-500"></i>
                            <div class="text-left">
                                <div class="font-medium">Logout</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">Sign out</div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MAIN CONTENT -->
<div class="flex-1 flex flex-col overflow-hidden bg-slate-50 dark:bg-slate-900">

    <!-- HEADER -->
    <div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-slate-900 dark:text-white">
                        Sample Management
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                        {{ request('lab') ? 'Laboratory: ' . request('lab') : 'All Samples' }}
                    </p>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    <span>{{ $samples->count() }} samples</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT AREA -->
    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Actions Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">

                <!-- Export Section -->
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        Export Data
                    </h3>
                    <form action="{{ route('samples.export.pdf') }}" method="GET" target="_blank" class="flex flex-wrap gap-3">
                        <select name="bulan" required class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-lab-500 focus:border-lab-500">
                            <option value="">Select Month</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <select name="tahun" required class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-lab-500 focus:border-lab-500">
                            <option value="">Select Year</option>
                            @for($y=date('Y'); $y>=2020; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="px-4 py-2 bg-lab-600 text-white text-sm font-medium rounded-lg hover:bg-lab-700 focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                            Export PDF
                        </button>
                    </form>
                </div>

                <!-- Search & Add Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <!-- Search -->
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            Search Samples
                        </h3>
                        <form method="GET" class="flex gap-2">
                            <input
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search by sample name or number..."
                                class="flex-1 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                            >
                            <button class="px-4 py-2 bg-lab-600 text-white text-sm font-medium rounded-lg hover:bg-lab-700 focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Add Sample -->
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            Add New Sample
                        </h3>
                        <form action="/samples" method="POST" class="flex flex-wrap gap-2">
                            @csrf
                            <input name="nomor_sample"
                                   placeholder="Sample No."
                                   class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                                   required>

                            <input name="nama_sample"
                                   placeholder="Sample Name"
                                   class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                                   required>

                            <input type="date"
                                   name="tanggal_masuk"
                                   class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                                   required>

                            <select name="lab_tujuan"
                                    class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                                @foreach($labs as $lab)
                                    <option value="{{ $lab }}">{{ $lab }}</option>
                                @endforeach
                            </select>

                            <select name="stok"
                                    class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                                <option value="Ada">In Stock</option>
                                <option value="Habis">Out of Stock</option>
                            </select>

                            <button class="px-4 py-2 bg-accent-600 text-white text-sm font-medium rounded-lg hover:bg-accent-700 focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors flex items-center gap-2">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                Add
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Samples Table -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="table" class="w-5 h-5"></i>
                        Sample Registry
                    </h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sample ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Laboratory</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @forelse($samples as $s)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 dark:text-slate-100">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-mono font-medium text-lab-600 dark:text-lab-400">{{ $s->nomor_sample }}</span>
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
                                    @if($s->stok=='Ada')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-100 text-accent-800 dark:bg-accent-900/30 dark:text-accent-300">
                                            <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                            Available
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="/samples/{{ $s->id }}/edit" class="inline-flex items-center px-3 py-1.5 border border-slate-300 dark:border-slate-600 shadow-sm text-xs font-medium rounded text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lab-500 dark:focus:ring-offset-slate-800">
                                            <i data-lucide="edit-2" class="w-3 h-3 mr-1"></i>
                                            Edit
                                        </a>
                                        <form action="/samples/{{ $s->id }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-slate-800">
                                                <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i data-lucide="inbox" class="w-12 h-12 text-slate-400 mb-4"></i>
                                        <p class="text-sm font-medium text-slate-900 dark:text-slate-100">No samples found</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Get started by adding your first sample</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

</body>
</html>