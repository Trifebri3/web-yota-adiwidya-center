@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Update Profile - YOTA')

@section('content')
<style>
    .update-container { font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; background: #FDFDFB; min-height: 100vh; }
    .executive-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); }

    .section-title { font-size: 14px; font-weight: 900; color: #002c16; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
    .section-title::after { content: ""; flex: 1; height: 1px; background: #f1f5f9; }

    .form-group { margin-bottom: 20px; }
    .label-yota { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; display: block; }
    .input-yota { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 18px; padding: 14px 20px; font-size: 14px; font-weight: 700; color: #002c16; outline: none; transition: 0.3s; }
    .input-yota:focus { border-color: #BEF264; background: #fff; }

    .avatar-wrapper { position: relative; width: 140px; height: 140px; margin: 0 auto 30px auto; }
    .avatar-preview { width: 100%; height: 100%; border-radius: 45px; object-fit: cover; border: 5px solid #BEF264; background: #f1f5f9; transition: 0.3s; }
    .upload-hint { position: absolute; bottom: -10px; right: -10px; background: #002c16; color: #BEF264; width: 40px; height: 40px; border-radius: 15px; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="update-container">
    <div style="max-width: 1100px; margin: 0 auto;">

        @if (session('status'))
            <div style="background: #f0fdf4; border: 1px solid #dcfce7; color: #15803d; padding: 15px; border-radius: 15px; margin-bottom: 25px; font-size: 12px; font-weight: 700;">
                {{ session('status') }}
            </div>
        @endif

        <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="font-size: 32px; font-weight: 900; color: #002c16; letter-spacing: -1.5px; margin: 0;">PENGATURAN <span style="color: #84cc16;">PROFIL</span></h1>
                <p style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Update Informasi Personal & Keamanan</p>
            </div>
            <a href="{{ route('dashboard') }}" style="text-decoration: none; font-size: 11px; font-weight: 900; color: #002c16; background: #BEF264; padding: 12px 25px; border-radius: 12px;">KEMBALI KE DASHBOARD</a>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div style="display: grid; grid-template-columns: 320px 1fr; gap: 40px;">

                <div style="display: flex; flex-direction: column; gap: 25px;">
                    <div class="executive-card" style="padding: 40px 30px; text-align: center;">
                        <div class="avatar-wrapper">
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=BEF264&color=002c16' }}"
                                 id="preview-img" class="avatar-preview">
                            <label for="avatar-input" class="upload-hint">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            </label>
                            <input type="file" id="avatar-input" name="avatar" style="display: none;" accept="image/*" onchange="previewImage(this)">
                        </div>
                        <h2 style="font-size: 18px; font-weight: 900; color: #002c16; margin-bottom: 5px;">{{ $user->name }}</h2>
                        <span style="background: #f1f5f9; color: #64748b; padding: 5px 15px; border-radius: 100px; font-size: 10px; font-weight: 800; text-transform: uppercase;">{{ $user->role->value }}</span>
                    </div>

                    <div class="executive-card" style="padding: 35px;">
                        <h3 class="section-title" style="font-size: 11px;">Keamanan Akun</h3>
                        <div class="form-group">
                            <label class="label-yota">Password Baru</label>
                            <input type="password" name="password" placeholder="••••••••" class="input-yota" autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label class="label-yota">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" class="input-yota">
                        </div>
                    </div>
                </div>

                <div class="executive-card">
                    <h3 class="section-title">Informasi Dasar</h3>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="label-yota">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-yota" required>
                        </div>
                        <div class="form-group">
                            <label class="label-yota">Nickname</label>
                            <input type="text" name="nickname" value="{{ old('nickname', $user->nickname) }}" class="input-yota">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="label-yota">WhatsApp</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="input-yota" required>
                        </div>
                        <div class="form-group">
                            <label class="label-yota">Gender</label>
                            <select name="gender" class="input-yota" required>
                                <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="label-yota">Tempat Lahir</label>
                            <input type="text" name="pob" value="{{ old('pob', $user->pob) }}" class="input-yota" required>
                        </div>
                        <div class="form-group">
                            <label class="label-yota">Tanggal Lahir</label>
                            <input type="date" name="dob" value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}" class="input-yota" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-yota">Alamat Domisili</label>
                        <textarea name="domicile_address" class="input-yota" style="min-height: 80px; resize: none;" required>{{ old('domicile_address', $user->domicile_address) }}</textarea>
                    </div>

                    <div style="margin-top: 40px; border-top: 1px solid #f1f5f9; padding-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
                        <button type="submit" style="background: #002c16; color: #BEF264; padding: 18px 45px; border-radius: 18px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; cursor: pointer; letter-spacing: 1px;">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
