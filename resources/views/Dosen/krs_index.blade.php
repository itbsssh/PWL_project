<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dosen</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

    <!-- JUDUL -->
    <h1 class="text-center mt-4 mb-4">
        Table KRS
    </h1>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">

        <div class="container-fluid">

            <!-- LOGO -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/ITB-SS.jpg') }}"
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
                                    href="{{ action([App\Http\Controllers\MahasiswaController::class, 'index']) }}">
                                    Mahasiswa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\DosenController::class, 'index']) }}">
                                    Dosen
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\JurusanController::class, 'index']) }}">
                                    Jurusan
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\MatakuliahController::class, 'index']) }}">
                                    Mata Kuliah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ action([App\Http\Controllers\KelasController::class, 'index']) }}">
                                    Kelas
                                </a>
                            </li>

                        </ul>

                    </li>

                </ul>

                <!-- SEARCH -->
                <form class="d-flex" role="search">

                    <input class="form-control me-2"
                        type="search"
                        placeholder="Search"
                        aria-label="Search">

                    <button class="btn btn-outline-success"
                        type="submit">

                        Search

                    </button>

                </form>

            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="container mt-4">

        <div class="table-container">

            <!-- BUTTON CREATE -->
            <a href="{{ action([App\Http\Controllers\KRSController::class, 'create']) }}">
                <input type="button"
                    class="btn btn-primary btn-lg"
                    value="Create">
            </a>

            <br><br>

            <table class="table">
    <thead>
        <tr>
            <th>Mahasiswa</th>
            <th>Tahun Ajaran</th>
            <th>Total SKS</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($krs_list as $krs)
        <tr>
            <td>{{ $krs->mahasiswa->fullname }}</td>
            <td>{{ $krs->tahun_ajaran }}</td>
            <td>{{ $krs->total_sks }}</td>
            <td>
                <span class="badge {{ $krs->status == 'Disetujui' ? 'bg-success' : ($krs->status == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                    {{ $krs->status }}
                </span>
            </td>
            <td>
                <!-- Tombol Action -->
                @if($krs->status == 'pending')
                    <form action="{{ route('dosen.krs.update', $krs->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                       <button name="status" value="approved" class="btn btn-sm btn-success">Approve</button>
<button name="status" value="declined" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                @else
                    <span class="text-muted">Sudah diproses</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>