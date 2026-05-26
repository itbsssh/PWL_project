<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mengisi Tabel Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
        body {
            background-color: #f8f9fa; /* Warna background abu-abu */
        }
    </style>   
</head>
  <body>
        <form action="{{route('dosen.save')}}"  method="post">
        @csrf
        <table class="table table-dark table-striped-columns">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="fullname"></td>
            </tr>
             <tr>
                <td>Nomor Induk Pengajar</td>
                <td>:</td>
                <td><input type="text" name="NIP"></td>
            </tr>
             <tr>
                <td>Nomor Induk Dosen Nasional</td>
                <td>:</td>
                <td><input type="text" name="NIDN"></td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td><input type="text" name="pendidikan_terakhir"></td>
            </tr>
            <tr>
                <td>Jurusan Id</td>
                <td>:</td>
                <td><input type="text" name="jurusan_id"></td>
            </tr>
             <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="tempat_lahir"></td>
            </tr>
             <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" name="tanggal_lahir"></td>
            </tr>
             <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="alamat"></textarea></td>
            </tr>
       <tr>
                <td colspan="3">
                    <input type="submit" value="Add">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
      </html>