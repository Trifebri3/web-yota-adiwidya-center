<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - Yota Adiwidya Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fafafa; }
        .yota-card { background: #ffffff; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 20px 50px rgba(6, 78, 59, 0.05); }
        .btn-yota { background-color: #064e3b; color: #bef264; transition: all 0.3s ease; }
        .btn-yota:hover { background-color: #053f30; transform: translateY(-2px); }
        .btn-whatsapp { background-color: #25D366; color: white; transition: all 0.3s ease; }
        .btn-whatsapp:hover { background-color: #128C7E; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(37, 211, 102, 0.2); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#064e3b] rounded-[22px] mb-4 shadow-xl shadow-lime-100">
                <span class="text-2xl font-black text-[#bef264]">Y</span>
            </div>
            <h1 class="text-2xl font-black text-[#064e3b] uppercase tracking-tighter">
                Yota <span class="italic font-serif text-slate-400">Adiwidya</span> Center
            </h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-1">Security Authentication</p>
        </div>

        <div class="yota-card p-10">
            <div class="mb-8">
                <h2 class="text-lg font-black text-[#064e3b] uppercase leading-tight mb-2">Atur Ulang Kata Sandi</h2>
                <p class="text-xs text-slate-500 leading-relaxed uppercase font-bold tracking-wider">Silahkan tentukan kata sandi baru Anda.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Terdaftar</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-400 focus:outline-none cursor-not-allowed">
                    @if($errors->has('email'))
                        <p class="mt-2 text-[10px] font-bold text-red-500 uppercase ml-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kata Sandi Baru</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-[#064e3b] focus:outline-none focus:ring-2 focus:ring-lime-400 focus:bg-white transition-all">
                    @if($errors->has('password'))
                        <p class="mt-2 text-[10px] font-bold text-red-500 uppercase ml-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-[#064e3b] focus:outline-none focus:ring-2 focus:ring-lime-400 focus:bg-white transition-all">
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-yota w-full py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-lg shadow-lime-100">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>

            <div class="relative my-10">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                <div class="relative flex justify-center text-[10px] uppercase font-black text-slate-300 bg-white px-4 tracking-widest">Atau Butuh Bantuan?</div>
            </div>

            <a href="https://wa.me/6282129711623?text=Halo%20Admin%20Yota,%20saya%20mengalami%20kesulitan%20saat%20melakukan%20reset%20password%20pada%20Workspace."
               target="_blank"
               class="btn-whatsapp w-full py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] flex items-center justify-center gap-3 shadow-md">
                <i class="fab fa-whatsapp text-lg"></i>
                Hubungi Admin Yota
            </a>
        </div>

        <div class="mt-10 text-center">
            <p class="text-[9px] font-bold text-slate-300 uppercase tracking-[0.5em]">&copy; 2026 PT YOTA INOVASI NUSANTARA</p>
        </div>
    </div>

</body>
</html>
