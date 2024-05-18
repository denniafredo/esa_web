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
        <td rowspan="3" width="120px"><img src="{{public_path('images/logo_esa.png')}}" width="100px"></td>
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
        <td><strong>TMK</strong></td>
        <td>: {{ Carbon::parse($benefit->employment->date_start_of_work)->format('d F Y') }}</td>
    </tr>
</table>
<br>
<?php
$hariKerja = $benefit->day_of_works;

$gajiPokok = $benefit->basic_salary;
$makan = $benefit->meal_allowances;
$transport = $benefit->transport_allowances;
$kinerja = $benefit->performance_allowances;
$lembur = $benefit->overtime_allowances;
$pendapatan_lainnya = $benefit->other_allowances;

$transportPerBulan = intval($transport) * intval($hariKerja);
$makanPerBulan = intval($makan) * intval($hariKerja);

$BPJSKesehatanPendapatan = intval($gajiPokok) * 0.04;
$BPJSJHTPendapatan = intval($gajiPokok) * 0.037;
$BPJSJKKPendapatan = intval($gajiPokok) * 0.0054;
$BPJSJKMPendapatan = intval($gajiPokok) * 0.003;
$BPJSPensiunPendapatan = intval($gajiPokok) * 0.02;
$totalBPJKTK = $BPJSJHTPendapatan + $BPJSJKKPendapatan + $BPJSJKMPendapatan + $BPJSPensiunPendapatan;
$totalPendapatan = intval($gajiPokok) + intval($kinerja) + intval($transportPerBulan) + intval($makanPerBulan) +
    intval($BPJSKesehatanPendapatan) + intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan) + intval($lembur) + intval($pendapatan_lainnya);

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
$potongan_pph_21 = $benefit->potongan_pph_21;

$sub_bpjs_kes = $BPJSKesehatanPendapatan;
$sub_bpjs_tk = intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan);
$totalPotongan = intval($pot_absensi) + intval($pot_transport) + intval($pot_makan) + intval($burden) + intval($pot_bpjs_kes) + intval($pot_bpjs_tk) +
    intval($BPJSKesehatanPendapatan) + intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan)
    + intval($potongan_pph_21);

$thp = $totalPendapatan - $totalPotongan;

$totalAbsensi = intval($benefit->absence_leaves) + intval($benefit->sick_leaves) + intval($benefit->leaves);
$sisaCuti = $benefit->leave_rights - $totalAbsensi;
?>
<br>

<table>
    <tr style="border-bottom: 2px double black;border-top: 2px double black">
        <td width="50%" colspan="2"><strong>PENDAPATAN</strong></td>
        <td width="50%" colspan="3"><strong>POTONGAN</strong></td>
    </tr>
    <tr>
        <td width="15%">GAJI POKOK</td>
        <td width="35%">Rp. {{ number_format($benefit->basic_salary, 0, '.', ',') }}</td>
        <td width="5%">ABSENSI</td>
        <td width="20%"><b>{{$totalAbsensi}}</b> hari</td>
        <td width="25%">Rp. {{ number_format($pot_absensi, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td width="15%">TUNJANGAN</td>
        <td width="35%"></td>
        <td width="15%" colspan="2">Potongan Uang Transport</td>
        <td width="35%">Rp. {{ number_format($pot_transport, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- Kinerja</td>
        <td>Rp. {{ number_format($benefit->performance_allowances, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Potongan Uang Makan</td>
        <td width="35%">Rp. {{ number_format($pot_makan, 0, '.', ',') }}</td>

    </tr>
    <tr>
        <td>- Transport</td>
        <td>Rp. {{ number_format($transportPerBulan, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Pinjaman / Tanggungan</td>
        <td width="35%">Rp. {{ number_format($burden, 0, '.', ',') }}</td>

    </tr>
    <tr>
        <td>- Makan</td>
        <td>Rp. {{ number_format($makanPerBulan, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Potongan BPJS Kesehatan</td>
        <td width="35%">Rp. {{ number_format($pot_bpjs_kes, 0, '.', ',') }}</td>

    </tr>
    <tr>
        <td>- BPJS TK</td>
        <td>Rp. {{ number_format($totalBPJKTK, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Potongan BPJS TK Karyawan</td>
        <td width="35%">Rp. {{ number_format($pot_bpjs_tk, 0, '.', ',') }}</td>

    </tr>
    <tr>
        <td>- BPJS Kesehatan</td>
        <td>Rp. {{ number_format($BPJSKesehatanPendapatan, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Subsidi BPJS Kesehatan</td>
        <td width="35%">Rp. {{ number_format($sub_bpjs_kes, 0, '.', ',') }}</td>

    </tr>
    <tr>
        <td>- Lembur</td>
        <td>Rp. {{ number_format($lembur, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">Subsidi BPJS TK</td>
        <td width="35%">Rp. {{ number_format($sub_bpjs_tk, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td>- Pendapatan Lainnya</td>
        <td>Rp. {{ number_format($pendapatan_lainnya, 0, '.', ',') }}</td>
        <td width="15%" colspan="2">PPh Pasal 21</td>
        <td width="35%">Rp. {{ number_format($potongan_pph_21, 0, '.', ',') }}</td>
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
        <td width="35%">: {{ $benefit->leave_rights }}</td>
        <td width="30%"><b>GAJI BERSIH DITERIMA</b></td>
        <td width="25%">Rp. {{ number_format($thp, 0, '.', ',') }}</td>
    </tr>
    <tr>
        <td width="10%">Diambil</td>
        <td width="40%">: {{ $totalAbsensi }}</td>
        <td width="25%" colspan="2" align="center">Ungaran, {{ Carbon::now()->format('d F Y') }}</td>
    </tr>
    <tr>
        <td width="10%">Sisa</td>
        <td width="40%">: {{$sisaCuti}}</td>
        <td width="25%" colspan="2" align="center">HRD</td>
    </tr>
</table>
</body>
</html>
