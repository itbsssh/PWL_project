<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tabel Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<style>
        body {
            background-color: #f8f9fa; /* Warna background abu-abu */
        }
    </style>
</head>
  <body>
    <br>
    <h1 class="text-center">Tabel Dosen</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
    <a href="{{ action([App\Http\Controllers\DosenController::class, 'create']) }}" 
   class="btn btn-primary btn-lg ms-4">
   Create
    </a>
    <br>
    <br>
    <table class="table table-dark table-hover table-bordered">
        <thead>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>NIP</th>
            <th>NIDN</th>
            <th>Pendidikan Terakhir</th>
            <th>Jurusan ID</th>
            <th>Tempat/Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
            @foreach ($dosen as $d)
            <tr>
            <td>{{$d->id}}</td>
            <td>{{$d->fullname}}</td>
            <td>{{$d->NIP}}</td>
            <td>{{$d->NIDN}}</td>
            <td>{{$d->pendidikan_terakhir}}</td>
            <td>{{$d->jurusan_id}}</td>
            <td>{{$d->tempat_lahir}}/{{$d->tanggal_lahir}}</td>
            <td>{{$d->alamat}}</td>
                <td>{{$d->created_at}}</td>
              <td>
                <a href={{route('dosen.update', $d->id)}}>
                    <input type="button" value="Edit">
                </a>
                <form action="{{route('dosen.delete', $d->id)}}"  method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$d->id}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
            @endforeach
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>