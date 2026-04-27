<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <form action="{{route('mahasiswa.edit', $mahasiswa->id)}}"  method="post">
        @csrf
        <input type="hidden" name="id" value="{{$mahasiswa->id}}">
        <input type="hidden" name="_method" value="PUT">
        <table class="table table-success table-striped-columns">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="Fullname" value="{{$mahasiswa->Fullname}}"></td>
            </tr>
            <tr>
                <td>Nomor Induk Mahasiswa</td>
                <td>:</td>
                <td><input type="text" name="NIM" value="{{$mahasiswa->NIM}}"></td>
            </tr>
            <tr>
                <td>Nomor Induk Siswa Nasional</td>
                <td>:</td>
                <td><input type="text" name="NIDN" value="{{$mahasiswa->NIDN}}"></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="Tempat_Lahir" value="{{$mahasiswa->Tempat_Lahir}}"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="text" name="Tanggal_Lahir" value="{{$mahasiswa->Tanggal_Lahir}}"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="Alamat">{{$mahasiswa->Alamat}}</textarea></td>
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