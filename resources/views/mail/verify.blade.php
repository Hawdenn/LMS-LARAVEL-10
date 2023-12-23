<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Akun Anda</title>
</head>
<body>
    <p>
        <b>
            Halo{{ $details['nama'] }} !
        </b>
    </p>
    <br>
    <p>
        Berikut Ini Adalah Data Anda :
    </p>
    <table>
        <tr>
            <td>Full Name</td>
            <td></td>
            <td>{{ $details ['nama'] }}</td>
        </tr>
        <tr>
            <td>Role</td>
            <td></td>
            <td>{{ $details ['role'] }}</td>
        </tr>
        <tr>
            <td>Website </td>
            <td></td>
            <td>{{ $details ['website'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Daftar</td>
            <td></td>
            <td>{{ $details ['datetime'] }}</td>
        </tr>
    <br><br><br>
    <center>
        <h3>Klik Dibawah ini Untuk Verifikasi Akun Anda !</h3>
        <a href="{{ $details['url'] }}" style="text-decoration: none; color: rgb(255, 255, 255); padding: 9px; background-color: blue; font-weight: bold; border-radius: 8%;">Verifikasi</a>
        <br><br><br>
        <p>
            Copy Right @2023 | Belajar Laravel D
        </p>
    </center>
    </table>
</body>
</html>
