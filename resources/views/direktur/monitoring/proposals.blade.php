@extends('direktur.layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Proposal & Budget Tracking</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-800 text-white text-xs uppercase">
                <tr>
                    <th class="p-4">Reference</th>
                    <th class="p-4">Judul Proposal</th>
                    <th class="p-4">Divisi</th>
                    <th class="p-4">Estimasi Biaya</th>
                    <th class="p-4 text-center">Status</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($proposals as $prop)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-xs font-mono text-gray-400">{{ $prop->reference_number }}</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-sm">{{ $prop->title }}</div>
                        <div class="text-[10px] text-indigo-500 uppercase">{{ $prop->category_label }}</div>
                    </td>
                    <td class="p-4 text-sm">{{ $prop->division->name }}</td>
                    <td class="p-4 font-bold text-emerald-600 text-sm">{{ $prop->formatted_cost }}</td>
                    <td class="p-4 text-center">
                        <span class="px-2 py-1 rounded text-[10px] font-bold {{ $prop->status_color }}">
                            {{ strtoupper($prop->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ $prop->document_url }}" target="_blank" class="text-xs bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg font-bold hover:bg-indigo-600 hover:text-white transition">
                            LIHAT PDF
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
