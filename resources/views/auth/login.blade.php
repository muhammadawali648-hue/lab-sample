<!DOCTYPE html>
<html>
<head>
    <title>LabPrep | Login</title>
    
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
            
            // Prevent back navigation after logout
            if (window.history && window.history.pushState) {
                window.history.pushState('forward', null, './#login');
                window.addEventListener('popstate', function(event) {
                    // Always redirect to login when back button is pressed
                    window.location.href = '{{ route("login") }}';
                });
            }
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

        <!-- Login Form -->
        <div class="bg-white dark:bg-slate-800 py-8 px-6 shadow-xl rounded-2xl border border-slate-200 dark:border-slate-700">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
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
                               placeholder="Enter your username">
                    </div>
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
                               placeholder="Enter your password">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-lab-600 hover:bg-lab-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lab-500 dark:focus:ring-offset-slate-800 transition-colors">
                        <span class="flex items-center gap-2">
                            <i data-lucide="log-in" class="w-4 h-4"></i>
                            Sign In
                        </span>
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-lab-600 hover:text-lab-500 dark:text-lab-400 dark:hover:text-lab-300 transition-colors">
                        Register here
                    </a>
                </p>
            </div>
        </div>

        <!-- Admin Reset Link -->
        <div class="text-center">
            <a href="/admin/reset" class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                Admin Reset Panel
            </a>
        </div>
    </div>
</div>

</body>
</html>