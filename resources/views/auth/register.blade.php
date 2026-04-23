<!DOCTYPE html>
<html>
<head>
    <title>LabPrep | Register</title>
    
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
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <!-- THEME TOGGLE SCRIPT -->
    <script>
        // Toggle theme
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
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

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-lab-600 rounded-xl flex items-center justify-center">
                <i data-lucide="flask-conical" class="w-8 h-8 text-white"></i>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-slate-900 dark:text-white">LabPrep</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Laboratory Sample Management</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white dark:bg-slate-800 py-8 px-6 shadow-xl rounded-2xl border border-slate-200 dark:border-slate-700">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-accent-50 dark:bg-accent-900/20 border border-accent-200 dark:border-accent-800 rounded-lg p-4 flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-accent-600 dark:text-accent-400"></i>
                        <p class="text-sm font-medium text-accent-800 dark:text-accent-200">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 flex items-center gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There were errors with your submission:</h3>
                                <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Username
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-slate-400"></i>
                        </div>
                        <input id="username" name="username" type="text" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-2.5 border border-slate-300 dark:border-slate-600 placeholder-slate-400 dark:placeholder-slate-500 text-sm text-slate-900 dark:text-slate-100 bg-white dark:bg-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-lab-500 focus:border-lab-500 focus:z-10"
                               placeholder="Enter your username"
                               pattern="[a-zA-Z]+" 
                               onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                               title="Username hanya boleh mengandung huruf, tidak boleh angka atau karakter khusus.">
                    </div>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Username hanya boleh mengandung huruf (a-z, A-Z)</p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-2.5 border border-slate-300 dark:border-slate-600 placeholder-slate-400 dark:placeholder-slate-500 text-sm text-slate-900 dark:text-slate-100 bg-white dark:bg-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-lab-500 focus:border-lab-500 focus:z-10"
                               placeholder="Enter your password"
                               pattern="[a-zA-Z].*" 
                               title="Password harus dimulai dengan huruf, tidak boleh angka atau karakter khusus di karakter pertama.">
                    </div>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Password harus dimulai dengan huruf (a-z, A-Z)</p>
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-2.5 border border-slate-300 dark:border-slate-600 placeholder-slate-400 dark:placeholder-slate-500 text-sm text-slate-900 dark:text-slate-100 bg-white dark:bg-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-lab-500 focus:border-lab-500 focus:z-10"
                               placeholder="Confirm your password">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-lab-600 hover:bg-lab-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lab-500 dark:focus:ring-offset-slate-800 transition-colors">
                        <span class="flex items-center gap-2">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                            Register
                        </span>
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-lab-600 hover:text-lab-500 dark:text-lab-400 dark:hover:text-lab-300">
                        Login
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                © 2026 LabPrep. All rights reserved.
            </p>
        </div>
    </div>
</div>

</body>
</html>