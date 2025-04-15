
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('logo/favicon.ico') }}" type="image/x-icon">
    <title>Registrasi Petugas</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
    <div class="absolute inset-0 z-0 opacity-20 bg-center bg-no-repeat bg-contain" style="background-image: url('/images/medical-symbol.png')"></div>
    
    <div class="w-full max-w-md p-8 space-y-6 bg-white/80 backdrop-blur-sm rounded-lg shadow-lg relative z-10">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Sebagai Petugas</h1>
            <p class="text-sm text-gray-600 mt-1">Silahkan lengkapi data diri Anda untuk mendaftar</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
           
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input id="username" type="text" name="name" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukkan username" required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukkan email" required>
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
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Konfirmasi password" required>
                    <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                    Daftar
                </button>
            </div>
            
            <div class="text-center pt-2">
                <p class="text-sm text-gray-600">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Masuk</a>
                </p>
            </div>
        </form>
    </div>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
        
        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPassword = document.getElementById('password_confirmation');
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
        });
    </script>
</body>
</html>