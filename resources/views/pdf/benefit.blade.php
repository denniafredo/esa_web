@php use Carbon\Carbon; @endphp
        <!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
</head>
<body>
<style>
    table {
        border-collapse: collapse;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        width: 100%;
    }

    .border {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
    }
</style>

<table>
    <tr>
        <td><strong>PT ESA SEMARAK ABADI</strong></td>
        <td>Periode Gaji</td>
        <td align="right">{{ Carbon::parse($benefit->periode)->format('M-y') }}</td>
    </tr>
    <tr>
        <td>Jl. Maju Jaya RT 006/007</td>
        <td>Hari Kerja</td>
        <td align="right">{{ $benefit->day_of_works }}</td>
    </tr>
    <tr>
        <td>Kawasan Industri Bawen, Harjosari, Kab. Semarang</td>
        <td>No Rek. BCA</td>
        <td align="right">{{ $benefit->no_account }}</td>
    </tr>
</table>
<table>
    <tr>
        <td width="10%"><strong>NIK</strong></td>
        <td width="40%">: {{ $benefit->employment->nik }}</td>
        <td width="10%"><strong>JABATAN (Divisi)</strong></td>
        <td width="40%">: {{ $benefit->employment->employmentRole->name }}
            ({{$benefit->employment->employmentDivision->name}})
        </td>
    </tr>
    <tr>
        <td><strong>NAMA</strong></td>
        <td>: {{ $benefit->employment->name }}</td>
        <td><strong>TANGGAL CETAK</strong></td>
        <td>: {{ Carbon::now()->format('d F Y') }}</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td width="50%"><strong>PENDAPATAN</strong></td>
        <td width="50%"><strong>POTONGAN</strong></td>
    </tr>
</table>
<?php
$hariKerja = $benefit->day_of_works;

$gajiPokok = $benefit->basic_salary;
$makan = $benefit->meal_allowances;
$transport = $benefit->transport_allowances;
$kinerja = $benefit->performance_allowances;

$persenBPJSPPH = $benefit->persenpph;

$transportPerBulan = intval($transport) * intval($hariKerja);
$makanPerBulan = intval($makan) * intval($hariKerja);

$BPJSKesehatanPendapatan = intval($gajiPokok) * 0.04;
$BPJSJHTPendapatan = intval($gajiPokok) * 0.037;
$BPJSJKKPendapatan = intval($gajiPokok) * 0.0054;
$BPJSJKMPendapatan = intval($gajiPokok) * 0.003;
$BPJSPensiunPendapatan = intval($gajiPokok) * 0.02;
$totalPendapatan = intval($gajiPokok) + intval($kinerja) + intval($transportPerBulan) + intval($makanPerBulan) +
    intval($BPJSKesehatanPendapatan) + intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan);

$leaves = intval($benefit->leaves);
$sick_leaves = intval($benefit->sick_leaves);
$absence_leaves = intval($benefit->absence_leaves);
$totalHariMasuk = intval($hariKerja) - intval($leaves) - intval($sick_leaves) - intval($absence_leaves);

$pot_absensi = floor((intval($absence_leaves) / intval($hariKerja)) * (intval($gajiPokok) + intval($kinerja)));
$pot_transport = floor((intval($leaves) + intval($sick_leaves) + intval($absence_leaves)) / intval($hariKerja) * intval($transportPerBulan));
$pot_makan = floor((intval($leaves) + intval($sick_leaves) + intval($absence_leaves)) / intval($hariKerja) * intval($makanPerBulan));
$pot_bpjs_kes = floor(0.01 * intval($gajiPokok));
$pot_bpjs_tk = floor(0.03 * intval($gajiPokok));

$burden = $benefit->burden;

$totalPotongan = intval($pot_absensi) + intval($pot_transport) + intval($pot_makan) + intval($burden) + intval($pot_bpjs_kes) + intval($pot_bpjs_tk) +
    intval($BPJSKesehatanPendapatan) + intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan);

$thp = $totalPendapatan - $totalPotongan;

?>
<table>
    <tr>
        <td width="15%">GAJI POKOK</td>
        <td width="35%">Rp. {{ number_format($benefit->basic_salary, 0, '.', ',') }}</td>
        <td width="5%">ABSENSI</td>
        <td width="20%"><b>{{$benefit->absence_leaves+$benefit->sick_leaves+$benefit->leaves}}</b> hari</td>
        <td width="25%">Rp. {{ number_format($pot_absensi, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td width="15%">TUNJANGAN</td>
        <td width="35%"></td>
        <td width="15%" colspan="2">Tunjangan BPJS TK</td>
        <td width="35%">Rp. {{ number_format(0, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- Kinerja</td>
        <td>Rp. {{ number_format($benefit->performance_allowances, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Tunjangan BPJS Kesehatan</td>
        <td width="35%">Rp. {{ number_format(0, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- Transport</td>
        <td>Rp. {{ number_format($benefit->transport_allowances, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Potongan BPJS TK Karyawan</td>
        <td width="35%">Rp. {{ number_format($pot_bpjs_tk, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- Makan</td>
        <td>Rp. {{ number_format($benefit->meal_allowances, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Potongan BPJS Kesehatan Karyawan</td>
        <td width="35%">Rp. {{ number_format($pot_bpjs_kes, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- BPJS TK</td>
        <td>Rp. {{ number_format($benefit->fixed_allowances, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">PPh pasal 21 ({{$benefit->persenpph}}%)</td>
        <td width="35%">Rp. {{ number_format(0, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- BPJS Kesehatan</td>
        <td>Rp. {{ number_format($benefit->fixed_allowances, 0, '.', ',') }}</td>
    </tr>
    <tr class="border">
        <td width="15%"><strong>JUMLAH PENDAPATAN</strong></td>
        <td width="35%">Rp. {{ number_format($totalPendapatan, 0, '.', ',') }}</td>
        <td width="15%" colspan="2"><strong>JUMLAH POTONGAN</strong></td>
        <td width="35%">Rp. {{ number_format($totalPotongan, 0, '.', ',') }}</td>
    </tr>
</table>
<br>
<table style="border: none !important;">
    <tr>
        <td width="10%">Hak Cuti</td>
        <td width="40%">:</td>
        <td width="25%"><b>GAJI BERSIH DITERIMA</b></td>
        <td width="25%">Rp. {{ number_format($thp, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td width="10%">Diambil</td>
        <td width="40%">:</td>
        <td width="25%"></td>
        <td width="25%" align="center">Ungaran, {{ Carbon::now()->format('d F Y') }}</td>
    </tr>
    <tr>
        <td width="10%">Sisa</td>
        <td width="40%">:</td>
        <td width="25%"></td>
        <td width="25%" align="center">HRD</td>
    </tr>
</table>
</body>
</html>
