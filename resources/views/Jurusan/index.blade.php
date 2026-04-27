<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tabel Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
        body {
            background-color: #f8f9fa; /* Warna background abu-abu */
        }
    </style>
  </head>
  <body>
    <br>
    <h1 class="text-center">Tabel Jurusan</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
    <a href="{{ action([App\Http\Controllers\JurusanController::class, 'create']) }}" 
   class="btn btn-primary btn-lg ms-4">
   Create
</a>
    <br>
    <br>
    <table class="table table-dark table-hover table-bordered">
        <thead>
            <th>No</th>
            <th>Nama Jurusan</th>
            <th>Kode Jurusan</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
        @foreach ($jurusan as $j)
        <tr>
            <td>{{$j->id}}</td>
            <td>{{$j->nama_jurusan}}</td>
            <td>{{$j->kode_jurusan}}</td>
            <td>{{$j->created_at}}</td>
             <td>
                <a href={{route('jurusan.update', $j->id)}}>
                    <input type="button" value="Edit">
                </a>
                <form action="{{route('jurusan.delete', $j->id)}}"  method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$j->id}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>