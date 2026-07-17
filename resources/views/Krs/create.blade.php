<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
   <form action="{{ action([App\Http\Controllers\KRSController::class, 'create']) }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <label class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran" class="form-select" required>
                <option value="" disabled selected>-- Pilih Tahun --</option>
                @foreach($tahunAjaranList as $ta)
                    <option value="{{ $ta }}" {{ request('tahun_ajaran') == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Semester</label>
            <select name="semester" class="form-select" required>
                <option value="" disabled selected>-- Pilih Semester --</option>
                <option value="ganjil" {{ request('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                <option value="genap" {{ request('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-info text-white">Filter Kelas</button>
        </div>
    </div>
</form>

<hr>

<!-- Tampilkan form pendaftaran HANYA jika filter sudah dipilih -->
@if(request()->has('tahun_ajaran') && request()->has('semester'))
    <form action="{{ action([App\Http\Controllers\KRSController::class, 'store']) }}" method="post">
        @csrf
        
        <!-- Input Hidden agar data filter tetap terkirim ke store -->
        <input type="hidden" name="tahun_ajaran" value="{{ request('tahun_ajaran') }}">
        <input type="hidden" name="semester" value="{{ request('semester') }}">
        <input type="hidden" name="kode_mahasiswa" value="{{ auth()->user()->email }}">
        <input type="hidden" name="status" value="Pending">

        <div class="mb-3">
            <label>Kode Mahasiswa :</label>
            <span class="fw-bold">{{ auth()->user()->email }}</span>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Kelas</label>
            <select name="kelas_id[]" class="form-select" style="width: 300px;" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($daftar_kelas as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->kode_kelas }} - {{ $kelas->mata_kuliah->nama_mk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Total SKS</label>
            <input type="number" name="total_sks" class="form-control" style="width: 300px;" required>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <button type="reset" class="btn btn-primary">Clear</button>
    </form>
@else
    <div class="alert alert-warning">Silakan pilih Tahun Ajaran dan Semester terlebih dahulu untuk melihat daftar kelas.</div>
@endif
</html>