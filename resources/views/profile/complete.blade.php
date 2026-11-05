@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('warning'))
            <div class="mb-6 p-4 bg-amber-50 border-l-4 border-yota-lemon text-amber-900 rounded-r-2xl shadow-sm flex items-center gap-3">
                <svg class="w-6 h-6 text-yota-lemon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">{{ session('warning') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-2xl shadow-yota-dark/5 rounded-[2.5rem] overflow-hidden border border-slate-100">
            <div class="p-8 md:p-16">

                <header class="mb-12">
                    <h1 class="text-3xl font-black text-yota-dark tracking-tight">Lengkapi Profil Anggota <span class="text-yota-lime text-4xl">.</span></h1>
                    <p class="text-slate-500 mt-2 font-medium">Data ini bersifat rahasia dan digunakan untuk keperluan administratif YOTA.</p>
                </header>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" x-data="imageViewer()">
                    @csrf
                    @method('PATCH')

                    <div class="mb-16 bg-yota-dark/[0.02] p-10 rounded-[3rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center transition-all hover:border-yota-lemon group">
                        <div class="relative">
                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="w-44 h-44 rounded-full object-cover border-4 border-white shadow-2xl ring-8 ring-yota-lemon/20">
                            </template>

                            <template x-if="!imageUrl">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-44 h-44 rounded-full object-cover border-4 border-white shadow-2xl ring-8 ring-slate-100">
                                @else
                                    <div class="w-44 h-44 rounded-full bg-slate-200 flex items-center justify-center border-4 border-white shadow-inner">
                                        <svg class="w-20 h-20 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </template>

                            <label for="avatar" class="absolute bottom-1 right-1 bg-yota-dark hover:bg-yota-lemon text-white hover:text-yota-dark p-4 rounded-full shadow-xl cursor-pointer transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" @change="fileChosen">
                            </label>
                        </div>
                        <h3 class="mt-6 font-bold text-yota-dark uppercase tracking-widest text-xs">Foto Profil Resmi</h3>
                        <p class="text-[10px] text-slate-400 mt-1 uppercase">Format: JPG, PNG • Max 2MB</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <div class="space-y-6">
                            <h2 class="text-yota-dark font-black text-xs uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-8 h-1 bg-yota-lemon rounded-full"></span> 1. Identitas Dasar
                            </h2>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="name" value="Nama Lengkap" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200 focus:ring-yota-lemon focus:border-yota-dark" :value="old('name', auth()->user()->name)" required />
                                </div>

                                <div>
                                    <x-input-label for="nickname" value="Nama Panggilan" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('nickname', auth()->user()->nickname)" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="gender" value="Jenis Kelamin" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                        <select name="gender" class="mt-1 block w-full border-slate-200 focus:border-yota-dark focus:ring-yota-lemon rounded-2xl shadow-sm text-sm p-3">
                                            <option value="L" {{ old('gender', auth()->user()->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('gender', auth()->user()->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="dob" value="Tanggal Lahir" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                        <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('dob', auth()->user()->dob ? auth()->user()->dob->format('Y-m-d') : '')" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="pob" value="Tempat Lahir" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="pob" name="pob" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('pob', auth()->user()->pob)" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h2 class="text-yota-dark font-black text-xs uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-8 h-1 bg-yota-lemon rounded-full"></span> 2. Kontak & Domisili
                            </h2>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="phone_number" value="Nomor WhatsApp" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('phone_number', auth()->user()->phone_number)" placeholder="62812xxxx" />
                                </div>

                                <div>
                                    <x-input-label for="citizenship" value="Kewarganegaraan" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="citizenship" name="citizenship" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('citizenship', auth()->user()->citizenship)" />
                                </div>

                                <div>
                                    <x-input-label for="domicile_address" value="Alamat Lengkap" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <textarea id="domicile_address" name="domicile_address" rows="4" class="mt-1 block w-full border-slate-200 focus:border-yota-dark focus:ring-yota-lemon rounded-2xl shadow-sm text-sm">{{ old('domicile_address', auth()->user()->domicile_address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h2 class="text-yota-dark font-black text-xs uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-8 h-1 bg-yota-lemon rounded-full"></span> 3. Kompetensi
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="last_education" value="Pendidikan Terakhir" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="last_education" name="last_education" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('last_education', auth()->user()->last_education)" placeholder="S1 - Teknik..." />
                                </div>
                                <div>
                                    <x-input-label for="main_skill" value="Keahlian Utama" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="main_skill" name="main_skill" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('main_skill', auth()->user()->main_skill)" placeholder="Contoh: Digital Marketing, Medis" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h2 class="text-yota-dark font-black text-xs uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-8 h-1 bg-yota-lemon rounded-full"></span> 4. Medis & Darurat
                            </h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <x-input-label for="emergency_contact_name" value="Kontak Darurat (Nama)" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('emergency_contact_name', auth()->user()->emergency_contact_name)" />
                                </div>
                                <div>
                                    <x-input-label for="emergency_contact_phone" value="No. HP Darurat" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <x-text-input id="emergency_contact_phone" name="emergency_contact_phone" type="text" class="mt-1 block w-full !rounded-2xl border-slate-200" :value="old('emergency_contact_phone', auth()->user()->emergency_contact_phone)" />
                                </div>
                                <div>
                                    <x-input-label for="blood_type" value="Gol. Darah" class="text-xs font-bold uppercase text-slate-500 ml-1" />
                                    <select name="blood_type" class="mt-1 block w-full border-slate-200 focus:border-yota-dark focus:ring-yota-lemon rounded-2xl shadow-sm text-sm p-3">
                                        <option value="">-</option>
                                        @foreach(['A', 'B', 'AB', 'O'] as $bt)
                                            <option value="{{ $bt }}" {{ old('blood_type', auth()->user()->blood_type) == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-yota-lemon/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yota-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-yota-dark uppercase tracking-widest">Verifikasi Data</h4>
                                <p class="text-xs text-slate-400">Data Anda dilindungi enkripsi standar Internasional.</p>
                            </div>
                        </div>

                        <button type="submit" class="w-full md:w-auto bg-yota-dark hover:bg-yota-lemon text-white hover:text-yota-dark px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-yota-dark/20 transition-all duration-300 transform active:scale-95">
                            Simpan & Selesaikan Profil
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function imageViewer() {
        return {
            imageUrl: '',
            fileChosen(event) {
                if (! event.target.files.length) return
                let file = event.target.files[0],
                    reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = e => this.imageUrl = e.target.result
            }
        }
    }
</script>
@endsection
