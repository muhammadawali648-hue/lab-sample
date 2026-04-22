<!DOCTYPE html>
<html>
<head>
    <title>LabPrep | Admin Reset</title>
    
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
                        <p class="text-xs text-slate-500 dark:text-slate-400">Admin Reset Panel</p>
                    </div>
                </div>
                <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                    <i data-lucide="moon" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-accent-50 dark:bg-accent-900/20 border border-accent-200 dark:border-accent-800 rounded-lg p-4 flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-accent-600 dark:text-accent-400"></i>
                    <p class="text-sm font-medium text-accent-800 dark:text-accent-200">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Current Users Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        Current Users
                    </h2>
                </div>
                <div class="p-6">
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Username</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Created At</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @foreach($users as $user)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-slate-900 dark:text-slate-100">{{ $user->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">{{ $user->username }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $user->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i data-lucide="users" class="w-12 h-12 text-slate-400 mx-auto mb-4"></i>
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100">No users found</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Registration is available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Reset Form Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="key-round" class="w-5 h-5"></i>
                        Reset Credentials
                    </h2>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.reset.process') }}" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    Select User
                                </label>
                                <select name="user_id" id="user_id" required
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-lab-500 focus:border-lab-500">
                                    <option value="">Choose a user...</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }} (ID: {{ $user->id }})</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="new_username" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    New Username
                                </label>
                                <input type="text" name="new_username" id="new_username" required
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                                       placeholder="Enter new username">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    New Password
                                </label>
                                <input type="password" name="new_password" id="new_password" required
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                                       placeholder="Enter new password">
                            </div>
                            
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    Confirm Password
                                </label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-lab-500 focus:border-lab-500"
                                       placeholder="Confirm new password">
                            </div>
                        </div>

                        <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-lab-600 text-white text-sm font-medium rounded-lg hover:bg-lab-700 focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="key-round" class="w-4 h-4"></i>
                            Reset Credentials
                        </button>
                    </form>
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20">
                    <h2 class="text-lg font-semibold text-red-800 dark:text-red-200 flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                        Danger Zone
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            This action will delete ALL users and allow new registration. This cannot be undone.
                        </p>
                        <form method="POST" action="{{ route('admin.reset.clear') }}" onsubmit="return confirm('Are you sure you want to delete ALL users? This action cannot be undone!')">
                            @csrf
                            <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                Delete All Users
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lab-500 dark:focus:ring-offset-slate-800 transition-colors">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Back to Home
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-lab-600 text-white text-sm font-medium rounded-lg hover:bg-lab-700 focus:ring-2 focus:ring-lab-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                        <i data-lucide="log-in" class="w-4 h-4 mr-2"></i>
                        Go to Login
                    </a>
                    @if($users->count() == 0)
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-accent-600 text-white text-sm font-medium rounded-lg hover:bg-accent-700 focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition-colors">
                            <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                            Register New User
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>
