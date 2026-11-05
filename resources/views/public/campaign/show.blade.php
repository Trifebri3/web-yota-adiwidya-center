@extends('public.layouts.app')

@section('content')
<main class="bg-white min-h-screen pt-44 pb-32 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6">

        <nav class="mb-10">
            <a href="{{ route('public.campaign.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-[#052c24] flex items-center gap-2 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg> Kembali ke Daftar Donasi
            </a>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

            <div class="lg:col-span-8">
                <div class="relative aspect-video rounded-[3.5rem] overflow-hidden mb-12 shadow-2xl">
                    <img src="{{ asset('storage/'.$campaign->image) }}" class="w-full h-full object-cover">
                    <div class="absolute top-8 left-8">
                        <span class="px-6 py-3 bg-white/90 backdrop-blur-md text-[#052c24] text-xs font-black uppercase tracking-[0.2em] rounded-full shadow-xl">
                            {{ strtoupper($campaign->status) }}
                        </span>
                    </div>
                </div>

                <div class="max-w-3xl">
                    <h1 class="text-5xl md:text-6xl font-black text-[#052c24] leading-[0.9] tracking-tighter uppercase mb-8">
                        {{ $campaign->title[app()->getLocale()] ?? $campaign->title['id'] }}
                    </h1>

                    <div class="prose prose-lg prose-slate font-medium text-slate-600 leading-relaxed mb-20">
                        {!! nl2br(e($campaign->description[app()->getLocale()] ?? $campaign->description['id'])) !!}
                    </div>

                    <div class="pt-12 border-t border-slate-100">
                        <h4 class="text-sm font-black text-[#052c24] uppercase tracking-widest mb-8">
                            Donatur Terbaru ({{ $campaign->donations()->paid()->count() }})
                        </h4>
                        <div class="space-y-4">
                            @forelse($recentDonations as $dn)
                            <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-lime-400 flex items-center justify-center font-black text-[#052c24] text-xs uppercase">
                                        {{ substr($dn->donor_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#052c24] text-sm">{{ $dn->donor_name }}</p>
                                        <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">{{ $dn->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="font-black text-slate-900 text-sm">
                                    Rp {{ number_format($dn->amount, 0, ',', '.') }}
                                </div>
                            </div>
                            @empty
                            <p class="text-slate-400 italic text-sm text-center py-10 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                                Belum ada donasi. Jadilah yang pertama berbagi kebaikan.
                            </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 sticky top-44">
                <div class="bg-[#052c24] rounded-[3rem] p-10 text-white shadow-3xl shadow-[#052c24]/20 overflow-hidden relative">
                    <div class="relative z-10">
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-lime-400">Pencapaian Dana</span>
                            <span class="text-3xl font-black">{{ $campaign->progress_percentage }}%</span>
                        </div>

                        <div class="w-full h-3 bg-white/10 rounded-full overflow-hidden mb-6">
                            <div class="h-full bg-lime-500" style="width: {{ $campaign->progress_percentage }}%"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <div>
                                <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Terkumpul</p>
                                <p class="text-lg font-black italic">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Target</p>
                                <p class="text-lg font-black text-white/50">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <form id="donation-form" class="space-y-6">
                            @csrf
                            <div class="space-y-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Informasi Donatur</label>
                                <input type="text" name="donor_name" placeholder="Nama Lengkap" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-sm text-white focus:ring-2 focus:ring-lime-500 transition-all outline-none" required>
                                <input type="email" name="donor_email" placeholder="Email Aktif" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-sm text-white focus:ring-2 focus:ring-lime-500 transition-all outline-none" required>

                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 block pt-2">Nominal Donasi</label>
                                <div class="grid grid-cols-2 gap-3 mb-2">
                                    @foreach(['50000', '100000', '250000', '500000'] as $preset)
                                    <button type="button" onclick="document.getElementById('custom_amount').value = '{{ $preset }}'"
                                            class="py-3 bg-white/5 border border-white/10 rounded-xl text-[10px] font-black hover:bg-lime-500 hover:text-[#052c24] transition-all">
                                        Rp {{ number_format($preset, 0, ',', '.') }}
                                    </button>
                                    @endforeach
                                </div>
                                <input type="number" id="custom_amount" name="amount" placeholder="Nominal Lainnya (Min 10.000)"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-sm font-bold text-[#BEF264] focus:ring-2 focus:ring-lime-500 outline-none" required>
                            </div>

                            <button type="submit" id="pay-button" class="w-full py-5 bg-lime-400 text-[#052c24] rounded-2xl font-black uppercase text-[11px] tracking-[0.2em] hover:bg-white transition-all shadow-xl shadow-lime-500/20">
                                Lanjutkan Pembayaran
                            </button>
                        </form>
                    </div>

                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-lime-500/10 rounded-full blur-3xl"></div>
                </div>

                <div class="mt-6 p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-widest text-[#052c24]">Waktu Tersisa</span>
                    </div>
                    <span class="text-sm font-black text-slate-900 italic">{{ $campaign->days_left }} Hari</span>
                </div>
            </div>

        </div>
    </div>
</main>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    // Gunakan DOMContentLoaded agar form dipastikan sudah ada saat script berjalan
    document.addEventListener('DOMContentLoaded', function() {
        const donationForm = document.getElementById('donation-form');
        const payButton = document.getElementById('pay-button');

        if (donationForm) {
            donationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                payButton.innerHTML = "MEMPROSES...";
                payButton.disabled = true;

                const formData = new FormData(this);

                fetch("{{ route('public.donation.checkout', $campaign->slug) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(text) });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = "{{ route('public.campaign.index') }}?status=success";
                            },
                            onPending: function(result) {
                                alert("Mohon selesaikan pembayaran Anda.");
                                location.reload();
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal.");
                                location.reload();
                            },
                            onClose: function() {
                                payButton.innerHTML = "Lanjutkan Pembayaran";
                                payButton.disabled = false;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error Detail:', error);
                    alert("Gagal memproses transaksi. Cek koneksi atau console.");
                    payButton.innerHTML = "Lanjutkan Pembayaran";
                    payButton.disabled = false;
                });
            });
        }
    });
</script>
@endsection
