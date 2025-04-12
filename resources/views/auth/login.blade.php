<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-medical {
            background-image: url('/images/medical-symbol.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.5;
        }
        
        .hexagon-pattern {
            background-image: url('/images/hexagon-pattern.png');
            background-size: cover;
            background-position: center;
            opacity: 0.5;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <!-- Background layers with opacity -->
    <div class="fixed inset-0 bg-gradient-to-br from-blue-100 to-blue-200 opacity-50"></div>
    <div class="fixed inset-0 hexagon-pattern"></div>
    <div class="fixed inset-0 bg-medical"></div>
    
    <!-- Login card -->
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg relative z-10">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Masuk Sebagai Petugas</h1>
            <p class="text-sm text-gray-600 mt-1">Silahkan isi UIID Petugas Anda untuk masuk</p>
        </div>
        
        <form method="POST" action="" class="space-y-4">
            @csrf
            
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input id="username" type="text" name="username" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukkan username" required autofocus>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Masukkan password" required>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                    Masuk
                </button>
            </div>
            
            <div class="text-center">
          
            </div>
            
            <div class="text-center pt-2">
                <p class="text-sm text-gray-600">
                    Belum memiliki akun? 
                    <a href="{{ route('register.index') }}" class="text-blue-500 hover:underline">Register</a>
                </p>
            </div>
        </form>
    </div>
    
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle icon (optional enhancement)
            this.querySelector('svg').innerHTML = type === 'password' 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
        });
    </script>
</body>
</html>