<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar Akun - CateringYuk!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <script>
          tailwind.config = {
            theme: {
              extend: {
                colors: { 'brand-green': '#228B22', 'brand-cream': '#F5F5DC', 'brand-brown': '#8B4513' },
                fontFamily: { 'public-sans': ['Public Sans', 'sans-serif'] }
              }
            }
          }
    </script>
</head>
<body class="min-h-screen bg-brand-cream flex items-center justify-center p-4 font-public-sans">
    <div class="w-full max-w-[420px] bg-white rounded-2xl p-10 shadow-[0_10px_30px_rgba(139,69,19,0.1)] border border-brand-brown/5">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-brand-green tracking-tight">CateringYuk!</h1>
            <p class="text-sm text-brand-brown/70 mt-2">Buat akun baru</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="block text-sm font-bold text-brand-brown">Email</label>
                <input name="email" value="{{ old('email') }}" required
                       class="w-full px-3.5 py-2.5 bg-white rounded-lg border border-gray-300 focus:border-brand-green focus:ring-1 focus:ring-brand-green focus:outline-none transition-all text-sm placeholder-gray-400" 
                       placeholder="Masukkan alamat email" type="email"/>
            </div>

            <div class="space-y-1.5">
                <label class="block text-sm font-bold text-brand-brown">Username</label>
                <input name="username" value="{{ old('username') }}" required
                       class="w-full px-3.5 py-2.5 bg-white rounded-lg border border-gray-300 focus:border-brand-green focus:ring-1 focus:ring-brand-green focus:outline-none transition-all text-sm placeholder-gray-400" 
                       placeholder="Masukkan username" type="text"/>
            </div>

            <div class="space-y-1.5">
                <label class="block text-sm font-bold text-brand-brown">Password</label>
                <input name="password" required
                       class="w-full px-3.5 py-2.5 bg-white rounded-lg border border-gray-300 focus:border-brand-green focus:ring-1 focus:ring-brand-green focus:outline-none transition-all text-sm placeholder-gray-400" 
                       placeholder="Masukkan password" type="password"/>
            </div>

            <div class="space-y-1.5">
                <label class="block text-sm font-bold text-brand-brown">Konfirmasi Password</label>
                <input name="password_confirmation" required
                       class="w-full px-3.5 py-2.5 bg-white rounded-lg border border-gray-300 focus:border-brand-green focus:ring-1 focus:ring-brand-green focus:outline-none transition-all text-sm placeholder-gray-400" 
                       placeholder="Ulangi password" type="password"/>
            </div>

            <button type="submit" 
                    class="w-full bg-brand-green text-white py-3 rounded-xl font-semibold text-sm hover:bg-opacity-95 active:scale-[0.99] transition-all shadow-md shadow-brand-green/10 mt-4">
                Daftar
            </button>

            <div class="text-center pt-2 text-xs text-brand-brown/70">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-brand-brown hover:text-brand-green underline transition-colors">Login di sini</a>
            </div>
        </form>
    </div>
</body>
</html>