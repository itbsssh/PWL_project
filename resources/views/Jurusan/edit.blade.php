<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mengubah Data Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
        body {
            background-color: #f8f9fa; /* Warna background abu-abu */
        }
    </style> 
</head>
  <body>
    <form action="{{route('jurusan.edit', $jurusan->id)}}"  method="post">
        @csrf
        <input type="hidden" name="id" value="{{$jurusan->id}}">
        <input type="hidden" name="_method" value="PUT">
        <table class="table table-success table-striped-columns">
            <tr>
                <td>Nama Jurusan</td>
                <td>:</td>
                <td><input type="text" name="nama_jurusan" value="{{$jurusan->nama_jurusan}}" size="30"></td>
            </tr>
             <tr>
                <td>Nomor Induk Pengajar</td>
                <td>:</td>
                <td><input type="text" name="kode_jurusan" value="{{$jurusan->kode_jurusan}}" size="30"></td>
            </tr>
        <tr>
                <td colspan="3">
                    <input type="submit" value="Update">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>