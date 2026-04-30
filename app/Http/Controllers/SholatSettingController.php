<?php

namespace App\Http\Controllers;

use App\Models\SholatSetting;
use Illuminate\Http\Request;

class SholatSettingController extends Controller
{
    private const SHOLAT_OPTIONS = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

    public function index()
    {
        $order = array_flip(self::SHOLAT_OPTIONS);

        $settings = SholatSetting::query()
            ->get()
            ->sortBy(function ($item) use ($order) {
                return $order[$item->nama_sholat] ?? 999;
            })
            ->values();

        return view('absen-sholat.pengaturan.index', compact('settings'));
    }

    public function create()
    {
        $usedNames = SholatSetting::query()->pluck('nama_sholat')->toArray();
        $availableNames = array_values(array_diff(self::SHOLAT_OPTIONS, $usedNames));

        return view('absen-sholat.pengaturan.create', compact('availableNames'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sholat' => 'required|in:' . implode(',', self::SHOLAT_OPTIONS) . '|unique:sholat_settings,nama_sholat',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'is_active' => 'nullable|boolean',
        ]);

        SholatSetting::create([
            'nama_sholat' => $validated['nama_sholat'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()
            ->route('absen.sholat.pengaturan.index')
            ->with('success', 'Pengaturan jam sholat berhasil ditambahkan.');
    }

    public function edit(SholatSetting $sholatSetting)
    {
        return view('absen-sholat.pengaturan.edit', compact('sholatSetting'));
    }

    public function update(Request $request, SholatSetting $sholatSetting)
    {
        $validated = $request->validate([
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'is_active' => 'nullable|boolean',
        ]);

        $sholatSetting->update([
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()
            ->route('absen.sholat.pengaturan.index')
            ->with('success', 'Pengaturan jam sholat berhasil diperbarui.');
    }

    public function destroy(SholatSetting $sholatSetting)
    {
        SholatSetting::destroy($sholatSetting->id);

        return redirect()
            ->route('absen.sholat.pengaturan.index')
            ->with('success', 'Pengaturan jam sholat berhasil dihapus.');
    }
}
