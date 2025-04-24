<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::all();

        return view('pages.resident.index', [
            'residents' => $residents,
        ]);
    }

    public function create()
    {
        return view('pages.resident.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => ['required', Rule::in(['pria', 'wanita'])],
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'alamat' => 'required|string',
            'agama' => 'required|string|max:50',
            'status_menikah' => ['required', Rule::in(['belum_menikah', 'menikah', 'cerai'])],
            'pekerjaan' => 'required|string|max:100',
            'telepon' => 'required|string|max:15',
            'status' => Rule::in(['aktif', 'pindah', 'meninggal'])
        ]);

        $prefix = '327703';
        $tanggal = Carbon::parse($validated['tanggal_lahir'])->format('dmy');
        $nik_prefix = $prefix . $tanggal;

        $lastResident = Resident::where('nik', 'like', "$nik_prefix%")
            ->orderBy('nik', 'desc')
            ->first();

        if ($lastResident) {
            $lastSequence = (int) substr($lastResident->nik, -4);
            $newSequence = str_pad($lastSequence + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newSequence = '0001';
        }

        $nik = $nik_prefix . $newSequence;

        $resident = new Resident();
        $resident->id = Str::uuid();
        $resident->nik = $nik;
        $resident->nama = $validated['nama'];
        $resident->jenis_kelamin = $validated['jenis_kelamin'];
        $resident->tanggal_lahir = $validated['tanggal_lahir'];
        $resident->tempat_lahir = $validated['tempat_lahir'];
        $resident->alamat = $validated['alamat'];
        $resident->agama = $validated['agama'];
        $resident->status_menikah = $validated['status_menikah'];
        $resident->pekerjaan = $validated['pekerjaan'];
        $resident->telepon = $validated['telepon'];
        $resident->status = $validated['status'] ?? 'aktif';
        $resident->save();

        return redirect('/resident')->with('success', 'Berhasil menambah data');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);

        return view('pages.resident.edit', [
            'resident' => $resident,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => ['required', Rule::in(['pria', 'wanita'])],
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'alamat' => 'required|string',
            'agama' => 'required|string|max:50',
            'status_menikah' => ['required', Rule::in(['belum_menikah', 'menikah', 'cerai'])],
            'pekerjaan' => 'required|string|max:100',
            'telepon' => 'required|string|max:15',
            'status' => Rule::in(['aktif', 'pindah', 'meninggal'])
        ]);

        $resident = Resident::findOrFail($id);

        $resident->nama = $validated['nama'];
        $resident->jenis_kelamin = $validated['jenis_kelamin'];
        $resident->tanggal_lahir = $validated['tanggal_lahir'];
        $resident->tempat_lahir = $validated['tempat_lahir'];
        $resident->alamat = $validated['alamat'];
        $resident->agama = $validated['agama'];
        $resident->status_menikah = $validated['status_menikah'];
        $resident->pekerjaan = $validated['pekerjaan'];
        $resident->telepon = $validated['telepon'];
        $resident->status = $validated['status'] ?? $resident->status;

        $resident->save();

        return redirect('/resident')->with('success', 'Berhasil mengubah data');
    }


    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect('/resident')->with('success', 'Berhasil menghapus data.');
    }
}
