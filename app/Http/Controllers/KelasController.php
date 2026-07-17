<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data asli dari database dengan format [id => nama]
        $mata_kuliah = \App\Models\MataKuliah::pluck('nama_mk', 'id');
        $dosen = \App\Models\Dosen::pluck('fullname', 'id');

        return view('kelas.create', compact('mata_kuliah', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'kode_mata_kuliah' => 'required',
            'kode_dosen' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'tahun_ajaran' => 'required',
            'ruang_kelas' => 'required',
            'jumlah_max' => 'required',
            'semester' => 'required'
        ]);

        Kelas::create($request->all());

        return redirect('/kelas')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect('/kelas')
            ->with('success', 'Data kelas berhasil dihapus');
    }
}