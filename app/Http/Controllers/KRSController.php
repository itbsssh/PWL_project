<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\KRSDetail;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KRSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data user yang sedang login saat ini
    $user = auth()->user();

    // Jika role-nya adalah ADMIN atau DOSEN, lempar kembali dengan pesan peringatan
    if ($user->role === 'admin' || $user->role === 'dosen') {
        return redirect()->back()->with('akses_terkunci', [
            'title' => 'Akses Terbatas (Mahasiswa Only)',
            'message' => 'Fitur pendaftaran KRS ini telah selesai dibuat, namun berdasarkan aturan UAS, fitur ini hanya dapat diakses oleh Mahasiswa.',
            'status' => strtoupper($user->role)
        ]);
    }

    // Cari atau buat data mahasiswa otomatis (Jembatan untuk mahasiswa)
       $mahasiswa = Mahasiswa::updateOrCreate(
    ['NIM' => $user->email], // Kriteria pencarian
    [
        'fullname' => $user->name,
        'NISN'     => 'NISN Belum diisi',            // WAJIB: Sesuai struktur tabel Null: No
        'alamat'   => 'Alamat Belum diisi'   // WAJIB: Sesuai struktur tabel Null: No
    ]
);
        $krs = KRS::where('kode_mahasiswa', $mahasiswa->id)->get();
        
        return view('krs.index', [
            'krs' => $krs
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
  public function create(Request $request)
{
    $tahunAjaranList = \App\Models\Kelas::distinct()->pluck('tahun_ajaran');
    $daftar_kelas = [];

    // Jika user sudah memilih Tahun & Semester di tahap 1
    if ($request->has('tahun_ajaran') && $request->has('semester')) {
        $daftar_kelas = \App\Models\Kelas::where('tahun_ajaran', $request->tahun_ajaran)
                                         ->where('semester', $request->semester)
                                         ->get();
    }

    return view('krs.create', compact('tahunAjaranList', 'daftar_kelas'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'semester'     => 'required',
        'tahun_ajaran' => 'required',
        'total_sks'    => 'required|numeric',
        'kelas_id'     => 'required|array',
        ]);

      // PROTEKSI: Jika admin/dosen somehow mengakses via form, blokir
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'dosen') {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        // Jembatan Otomatis: Pastikan data mahasiswa ada sebelum buat KRS
        $mahasiswa = Mahasiswa::updateOrCreate(
            ['NIM' => auth()->user()->email],
            ['fullname' => auth()->user()->name,
            'NISN'     => '0',
        'alamat'   => 'Alamat Belum diisi'
    ]
);

        // Simpan ke tabel_krs (Header)
        $krs = KRS::create([
            'kode_mahasiswa' => $mahasiswa->id,
            'tahun_ajaran'   => $request->tahun_ajaran,
            'semester'       => $request->semester,
            'status'         => 'Pending',
            'total_sks'      => $request->total_sks,
        ]);

        // Simpan ke table_krs_detail (Detail)
        if ($krs && $request->has('kelas_id')) {
            foreach ($request->kelas_id as $kelas_id) {
                if ($kelas_id) {
                    KRSDetail::create([
                        'krs_id'   => $krs->id,
                        'kelas_id' => $kelas_id,
                        'status'   => 'Pending',
                    ]);
                }
            }
        }

        return redirect()->route('krs.index')->with('success', 'KRS Berhasil Diajukan!');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cari KRS berdasarkan ID beserta relasi yang sudah ditentukan dosenmu
        $krs = KRS::where('id', '=', $id)->with([
            'detail', 
            'mahasiswa',
            'detail.kelas', 
            'detail.kelas.dosen', 
            'detail.kelas.mata_kuliah'
        ])->firstOrFail();

        // PROTEKSI: Pastikan mahasiswa yang login hanya bisa melihat KRS miliknya sendiri
        $mahasiswa = Mahasiswa::where('NIM', auth()->user()->email)
            ->orWhere('fullname', auth()->user()->name)
            ->first();

        if (!$mahasiswa || $krs->kode_mahasiswa !== $mahasiswa->id) {
            abort(403, 'Akses Ditolak! Anda tidak diizinkan melihat KRS mahasiswa lain.');
        }

        return view('krs.show', [
            'krs' => $krs
        ]);
    }

 /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $krs = KRS::findOrFail($id);

        $krs->delete();

        return redirect('/krs')
            ->with('success', 'Data kelas berhasil dihapus');
    }
} 