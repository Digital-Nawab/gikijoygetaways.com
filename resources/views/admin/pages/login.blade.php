<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 flex items-center justify-center px-4">

    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-blue-500 opacity-20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500 opacity-20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl p-8">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center text-4xl shadow-lg">
                    🔐
                </div>
            </div>

            <h2 class="text-4xl font-bold text-center text-white mb-2">
                Admin Login
            </h2>

            <p class="text-center text-gray-300 mb-8">
                Sign in to access your dashboard
            </p>

            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-400 text-red-200 px-4 py-3 rounded-xl mb-5">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">
                        Email Address
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400">
                            📧
                        </span>

                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Enter your email"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400">
                            🔒
                        </span>

                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Enter your password"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                            required
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="remember" class="rounded border-gray-500 text-blue-500 focus:ring-blue-500">
                        Remember Me
                    </label>

                    <a href="#" class="text-blue-400 hover:text-blue-300 transition">
                        Forgot Password?
                    </a>
                </div>

                <button 
                    type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold text-lg shadow-lg hover:scale-[1.02] hover:shadow-blue-500/30 transition duration-300"
                >
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-400 text-sm">
                    Protected Admin Access Only
                </p>
            </div>
        </div>
    </div>

</body>
</html>