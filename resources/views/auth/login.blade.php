<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Yota Adiwidya Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-yota { background-color: #064e3b; }
        .text-lime-yota { color: #bef264; }
        .btn-yota { background-color: #064e3b; color: #bef264; transition: all 0.3s ease; }
        .btn-yota:hover { background-color: #053f30; transform: translateY(-2px); }

        /* Overlay untuk gambar latar belakang agar teks tetap terbaca */
        .bg-overlay {
            background: linear-gradient(to bottom, rgba(6, 78, 59, 0.9), rgba(6, 78, 59, 0.7));
        }
    </style>
</head>
<body class="bg-slate-50">

    <div class="min-h-screen flex flex-col md:flex-row">

        <div class="hidden md:flex md:w-1/2 relative flex-col justify-between p-12 overflow-hidden bg-yota">
<img
    src="{{ asset('image/bg.jpg') }}"
    alt="Workspace Background"
    class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-30"
>

            <div class="absolute top-0 right-0 w-64 h-64 bg-lime-400 opacity-5 rounded-full -mr-32 -mt-32"></div>

            <div class="relative z-10">
<div class="inline-flex items-center justify-center mb-12">
    <img
        src="{{ asset('image/logoputih.png') }}"
        alt="YOTA Logo"
        class="w-40 h-auto object-contain drop-shadow-[0_16px_36px_rgba(0,0,0,0.45)]"
    >
</div>

                <h1 class="text-5xl font-black text-white leading-tight uppercase tracking-tighter">
                    Executive<br>
                    <span class="text-lime-yota">Workspace.</span>
                </h1>
                <div class="w-20 h-1.5 bg-lime-yota mt-6 rounded-full"></div>
            </div>

            <div class="relative z-10">
                <blockquote class="text-xl italic text-white font-serif leading-relaxed mb-8 opacity-90">
                    "Tempat kolaborasi khusus pengurus Yota Adiwidya Center untuk mewujudkan inovasi dan dampak sosial yang nyata."
                </blockquote>
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-[#064e3b] bg-slate-400"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#064e3b] bg-slate-500"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#064e3b] bg-lime-400 flex items-center justify-center text-[10px] font-bold text-[#064e3b]">+12</div>
                    </div>
                    <p class="text-[10px] font-black text-white uppercase tracking-[0.2em] opacity-60">Active Collaborators</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-3xl font-black text-[#064e3b] uppercase tracking-tighter mb-2">Selamat Datang</h2>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Silahkan masuk ke akun Anda</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-lime-50 border border-lime-100 rounded-2xl text-xs font-bold text-lime-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Pengurus</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-[#064e3b] focus:outline-none focus:ring-2 focus:ring-lime-400 focus:bg-white transition-all"
                                placeholder="admin@yota.id">
                            <i class="fas fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        </div>
                        @if($errors->has('email'))
                            <p class="mt-2 text-[10px] font-bold text-red-500 uppercase ml-1">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Kata Sandi</label>

                            <a href="https://wa.me/6282129711623?text=Halo,%20saya%20lupa%20kata%20sandi%20untuk%20login%20ke%20Workspace.%20Mohon%20bantuannya."
                               target="_blank"
                               class="text-[9px] font-black text-lime-600 uppercase tracking-widest hover:text-[#064e3b] flex items-center gap-1">
                                <i class="fab fa-whatsapp"></i> Lupa Sandi?
                            </a>
                        </div>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-[#064e3b] focus:outline-none focus:ring-2 focus:ring-lime-400 focus:bg-white transition-all"
                                placeholder="••••••••">
                            <i class="fas fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        </div>
                        @if($errors->has('password'))
                            <p class="mt-2 text-[10px] font-bold text-red-500 uppercase ml-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#064e3b] focus:ring-lime-400">
                            <span class="ms-2 text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-[#064e3b] transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-yota w-full py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-lg shadow-lime-100">
                            Masuk ke Workspace
                        </button>
                    </div>
                </form>

                <div class="mt-12 pt-8 border-t border-slate-100 text-center">
                    <p class="text-[9px] font-bold text-slate-300 uppercase tracking-[0.4em] leading-relaxed">
                        &copy; 2026 Yota Adiwidya Center<br>
                        <span class="opacity-50">Yayasan Yota Wujudkan Asa</span>
                    </p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
