<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Yota Adiwidya Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fafafa;
        }
        .yota-card {
            background: #ffffff;
            border-radius: 40px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 20px 50px rgba(6, 78, 59, 0.05);
        }
        .btn-yota {
            background-color: #064e3b;
            color: #bef264;
            transition: all 0.3s ease;
        }
        .btn-yota:hover {
            background-color: #053f30;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(6, 78, 59, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#064e3b] rounded-[20px] mb-4 shadow-lg shadow-lime-100">
                <span class="text-2xl font-black text-[#bef264]">Y</span>
            </div>
            <h1 class="text-2xl font-black text-[#064e3b] uppercase tracking-tighter">
                Yota <span class="italic font-serif text-slate-400">Adiwidya</span> Center
            </h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-1">Recovery System</p>
        </div>

        <div class="yota-card p-10">
            <div class="mb-8">
                <h2 class="text-lg font-black text-[#064e3b] uppercase leading-tight mb-2">Lupa Password?</h2>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan tautan pemulihan kata sandi baru.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-lime-50 border border-lime-100 rounded-2xl text-xs font-bold text-lime-700 uppercase tracking-wide">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Alamat Email</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="nama@email.com"
                           class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-[#064e3b] focus:outline-none focus:ring-2 focus:ring-lime-400 focus:bg-white transition-all">

                    @if($errors->get('email'))
                        <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-wide ml-1">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-yota w-full py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em]">
                        Kirim Tautan Pemulihan
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-400 hover:text-[#064e3b] uppercase tracking-widest transition-colors">
                     Kembali ke Login
                </a>
            </div>
        </div>

        <p class="text-center mt-10 text-[9px] font-bold text-slate-300 uppercase tracking-[0.5em]">
            &copy; 2026 PT Yota Inovasi Nusantara
        </p>
    </div>

</body>
</html>
