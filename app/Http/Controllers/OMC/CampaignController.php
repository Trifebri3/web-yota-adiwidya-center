<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Menampilkan daftar semua kampanye penggalangan dana.
     */
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('omc.campaign.index', compact('campaigns'));
    }

    /**
     * Form untuk membuat kampanye baru.
     */
    public function create()
    {
        return view('omc.campaign.create');
    }

    /**
     * Menyimpan kampanye ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title.id' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1000',
            'end_date' => 'required|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns/covers', 'public');
        }

        Campaign::create($data);

        return redirect()->route('omc.campaign.index')
            ->with('success', 'Kampanye penggalangan dana berhasil diterbitkan!');
    }

    /**
     * Form edit kampanye.
     */
    public function edit(Campaign $campaign)
    {
        return view('omc.campaign.edit', compact('campaign'));
    }

    /**
     * Memperbarui data kampanye.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title.id' => 'required|string|max:255',
            'target_amount' => 'required|numeric',
            'status' => 'required|in:active,completed,paused',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $data['image'] = $request->file('image')->store('campaigns/covers', 'public');
        }

        $campaign->update($data);

        return redirect()->route('omc.campaign.index')
            ->with('success', 'Data kampanye berhasil diperbarui.');
    }

    /**
     * Menghapus kampanye.
     */
    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect()->route('omc.campaign.index')
            ->with('success', 'Kampanye telah dihapus.');
    }
}
