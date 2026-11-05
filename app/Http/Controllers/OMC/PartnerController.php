<?php
namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('order', 'asc')->paginate(15);
        return view('omc.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('omc.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:1024',
            'type' => 'required|in:Government,NGO,Corporate,Community',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('logo');

        // Mapping Multibahasa JSON
        $data['description'] = [
            'id' => $request->description_id ?? '-',
            'en' => $request->description_en ?? '-'
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($data);
        return redirect()->route('omc.partners.index')->with('success', 'Mitra Strategis Berhasil Ditambahkan!');
    }

    public function edit(Partner $partner)
    {
        return view('omc.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
        ]);

        $data = $request->except('logo');

        // Mapping Multibahasa JSON
        $data['description'] = [
            'id' => $request->description_id,
            'en' => $request->description_en
        ];

        if ($request->hasFile('logo')) {
            // Hapus Logo Lama
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);
        return redirect()->route('omc.partners.index')->with('success', 'Data Mitra Telah Diperbarui!');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();
        return redirect()->route('omc.partners.index')->with('success', 'Mitra Telah Dihapus dari Sistem.');
    }
}
