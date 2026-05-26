<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tabel Mata Kuliah</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
        body {
            background-color: #f8f9fa; /* Warna background abu-abu */
        }
    </style>
</head>
<body>
   <br>
   
    <h1 class="text-center">Tabel Mata Kuliah</h1>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">

        <div class="container-fluid">

            <!-- LOGO -->
            <a class="navbar-brand"
                href="{{ url('/') }}">

                <img src="{{ asset('asetgmbr/ITB-SS.jpg') }}"
                    alt="Logo"
                    width="50">

            </a>

            <!-- TOGGLER -->
            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse"
                id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <!-- HOME -->
                    <li class="nav-item">

                        <a class="nav-link active"
                            href="{{ url('/') }}">

                            Home

                        </a>

                    </li>

                    <!-- DROPDOWN -->
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            Menu

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\MahasiswaController::class, 'index'])}}">

                                    Mahasiswa

                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\DosenController::class, 'index'])}}">

                                    Dosen

                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\JurusanController::class, 'index'])}}">

                                    Jurusan

                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\MatakuliahController::class, 'index'])}}">

                                    Mata Kuliah

                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container mt-4">

        <div class="table-container">

            <!-- BUTTON CREATE -->
            <a href="{{ action([App\Http\Controllers\MatakuliahController::class, 'create']) }}" 
            class="btn btn-primary btn-lg ms-4">
            Create
            </a>
            <br>
            <br>

            <!-- TABLE -->
            <table class="table table-dark table-hover table-bordered">
                <thead>
                        <th>No</th>
                        <th>Jurusan ID</th>
                        <th>Kode MK</th>
                        <th>Nama MK</th>
                        <th>SKS</th>
                        <th>Dosen ID</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($mata_kuliah as $mk)
                    <tr>
                        <td>{{$mk->id}}</td>
                        <td>{{$mk->jurusan_id}}</td>
                        <td>{{$mk->kode_mk}}</td>
                        <td>{{$mk->nama_mk}}</td>
                        <td>{{$mk->sks}}</td>
                        <td>{{$mk->dosen_id}}</td>
                        <td>{{$mk->created_at}}</td>
                        <td>

                            <!-- EDIT -->
                            <a href={{route('matakuliah.update', $mk->id)}}>
                            <input type="button" value="Edit">
                            </a>

                            <!-- DELETE -->
                            <form action="{{route('matakuliah.delete', $mk->id)}}"  method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$mk->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                           <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </table>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>