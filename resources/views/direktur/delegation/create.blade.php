@extends('direktur.layouts.app')

@section('title', 'Keluarkan Mandat Baru - YOTA')

@section('content')
<style>
    .mandate-create-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: #0F172A; }

    .form-group { margin-bottom: 25px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 14px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #BEF264; background: #fff; }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 250px; outline: none; line-height: 1.6; resize: none; }
</style>

<div class="mandate-create-container">
    <div style="max-width: 1000px; margin: 0 auto;">

        <div style="margin-bottom: 40px;">
            <a href="{{ route('direktur.delegation.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">← Kembali</a>
            <h1 style="font-size: 40px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 15px;">
                Tulis <span style="font-family: serif; font-style: italic; color: #84cc16;">Mandat</span>
            </h1>
        </div>

        <div class="executive-card">
            <form action="{{ route('direktur.delegation.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 50px;">
                    <div style="border-right: 1px solid #f1f5f9; padding-right: 50px;">
                        <div class="form-group">
                            <label class="label-executive">Subjek Mandat</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Misal: Audit Internal Keuangan Cabang" required class="input-executive">
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Isi Instruksi Mandat (Rahasia/Khusus)</label>
                            <textarea name="instruction" placeholder="Tulis instruksi mendalam Anda di sini..." required class="textarea-executive">{{ old('instruction') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="label-executive">Penerima Mandat (Individu)</label>
                            <select name="user_id" required class="input-executive">
                                <option value="" disabled selected>Pilih Staf Terpercaya</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Deadline Penyelesaian</label>
                            <input type="datetime-local" name="deadline" value="{{ old('deadline') }}" required class="input-executive">
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Link Lampiran Tambahan (G-Drive)</label>
                            <input type="url" name="instruction_attachment" value="{{ old('instruction_attachment') }}" placeholder="https://..." class="input-executive">
                        </div>

                        <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #f1f5f9;">
                            <button type="submit" style="width: 100%; background: #0F172A; color: #BEF264; padding: 22px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; cursor: pointer;">
                                Kirim Mandat Resmi
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
