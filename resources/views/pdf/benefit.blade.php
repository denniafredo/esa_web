@php use Carbon\Carbon; @endphp
        <!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
</head>
<body>
<h1>Data Karyawan</h1>
<table>
    <tr>
        <td><strong>Nama</strong></td>
        <td>: {{ $benefit->employment->name }}</td>
    </tr>
    <tr>
        <td><strong>NIK</strong></td>
        <td>: {{ $benefit->employment->nik }}</td>
    </tr>
    <tr>
        <td><strong>Jabatan (Divisi)</strong></td>
        <td>: {{ $benefit->employment->employmentRole->name }} ({{$benefit->employment->employmentDivision->name}})</td>
    </tr>
    <tr>
        <td><strong>Tanggal Cetak</strong></td>
        <td>: {{ Carbon::now()->format('d F Y') }}</td>
    </tr>
    <!-- Add more employee data fields here as needed -->
</table>
<?php
$gajiPokok = $benefit->basic_salary;
$tunjanganTetap = $benefit->fixed_allowances;
$uangMakan = $benefit->meal_allowances;
$uangTransport = $benefit->transport_allowances;
$uangLembur = $benefit->overtime_allowances;
$persenBPJSKesehatan = 1;
$persenBPJSJHT = 2;
$persenBPJSPensiun = 1;
$persenBPJSPPH = $benefit->persenpph;

// Perform calculations
$total = $gajiPokok + $tunjanganTetap;
$total_all = $total + $uangMakan + $uangTransport + $uangLembur;
$bpjs_kesehatan = $total * ($persenBPJSKesehatan / 100);
$bpjs_jht = $total * ($persenBPJSJHT / 100);
$bpjs_pensiun = $total * ($persenBPJSPensiun / 100);
$pph = $total_all * ($persenBPJSPPH / 100);
$thp = $total_all - $bpjs_kesehatan - $bpjs_jht - $bpjs_pensiun - $pph;
?>
<h1>Benefit</h1>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Keterangan</th>
        <th>Jumlah</th>
    </tr>
    <tr>
        <td>GAJI POKOK</td>
        <td>{{ number_format($benefit->basic_salary, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>TUNJANGAN TETAP</td>
        <td>{{ number_format($benefit->fixed_allowances, 0, '.', ',') }}</td>
    </tr>

    <tr>
        <td>UANG MAKAN</td>
        <td>{{ number_format($benefit->meal_allowances, 0, '.', ',') }}</td>
    </tr>

    <tr>
        <td>UANG TRANSPORT</td>
        <td>{{ number_format($benefit->transport_allowances, 0, '.', ',') }}</td>
    </tr>

    <tr>
        <td>UANG LEMBUR</td>
        <td>{{ number_format($benefit->overtime_allowances, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td><i>POTONGAN BPJS KESEHATAN (1%)</i></td>
        <td>{{ number_format($bpjs_kesehatan, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td><i>POTONGAN BPJS JHT (2%)</i></td>
        <td>{{ number_format($bpjs_jht, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td><i>POTONGAN BPJS PENSIUN (1%)</i></td>
        <td>{{ number_format($bpjs_pensiun, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td><i>POTONGAN PPH ({{$benefit->persenpph}}%)</i></td>
        <td>{{ number_format($pph, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td><b>TAKE HOME PAY</b></td>
        <td>{{ number_format($thp, 0, '.', ',') }}</td>
    </tr>
</table>
</body>
</html>
