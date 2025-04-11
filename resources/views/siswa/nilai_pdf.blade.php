<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: sans-serif;
      font-size: 12px;
    }

    .kop-surat {
      position: relative;
      text-align: center;
      margin-bottom: 5px;
    }

    .kop-logo {
      position: absolute;
      top: 0;
      left: 0;
      width: 80px;
    }

    .kop-text {
      display: inline-block;
      margin-left: 90px;
      width: 80%;
    }

    .kop-border {
      border-bottom: 2px solid black;
      margin-top: 5px;
      margin-bottom: 1px;
    }

    .kop-border2 {
      border-bottom: 2px solid black;
      margin-top: 1px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 5px;
      text-align: center;
    }

    .no-border {
      border: none;
    }

    .ttd {
      margin-top: 30px;
      width: 100%;
    }

    .ttd td {
      vertical-align: top;
      padding: 10px;
      border: none;
      padding-top: 60px;
    }

    .ttd u {
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="kop-surat">
    <img src="{{ public_path('images/logo.png') }}" class="kop-logo">
    <div class="kop-text">
      <p style="font-size: 20px;"><strong>YAYASAN XAVERIUS TANJUNG KARANG<br>SMP XAVERIUS 2</strong></p>
      <p style="font-size: 10px;">
        <strong>STATUS: TERAKREDITASI A (AMAT BAIK) – NPSN: 10807158 – NSS: 202.126.005.018</strong><br>
        Jl. Cendana No. 31 Rawalaut Enggal Bandar Lampung 35127 Telp. (0721) 250 433
      </p>
    </div>
  </div>

  <div class="kop-border"></div>
  <div class="kop-border2"></div>

  <h4 style="text-align: center; margin-bottom: 10px;">LAPORAN HASIL BELAJAR PESERTA DIDIK<br>TENGAH SEMESTER GANJIL</h4>

  <!-- <h4 style="margin-bottom: 1px;">Nama  : {{ $siswa->nama }}</h4>
  <h4 style="margin-bottom: 1px;">NIS   : {{ $siswa->user->nisn }}</h4>
  <h4>Kelas : {{ $siswa->kelas }}</h4> -->

  <table style="margin-bottom: 20px;">
    <tr>
      <td>Nama</td>
      <td>{{ $siswa->nama }}</td>
    </tr>
    <tr>
      <td>NIS</td>
      <td>{{ $siswa->user->nisn }}</td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>{{ $siswa->kelas }}</td>
    </tr>
  </table>

  <table class="table-nilai">
    <thead style="background-color: #3751CF; color: white;">
      <tr>
        <th rowspan="2">MATA PELAJARAN</th>
        <th colspan="4">NILAI</th>
      </tr>
      <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>LUS</th>
      </tr>
    </thead>
    <tbody>
      @php
      $mapel = [
      'Pendidikan Agama' => 'AGM',
      'Pendidikan Pancasila' => 'PKN',
      'Bahasa Indonesia' => 'BI',
      'Matematika' => 'MTK',
      'IPA' => 'IPA',
      'IPS' => 'IPS',
      'Bahasa Inggris' => 'BING',
      'Seni Budaya' => 'SB',
      'Penjasorkes' => 'PJS',
      'Informatika' => 'INF',
      'Bahasa Lampung' => 'BLM',
      'Bahasa Mandarin' => 'BMN',
      'PAK' => 'PAK'
      ];
      @endphp
      @foreach($mapel as $label => $prefix)
      <tr>
        <td style="text-align: left;">{{ $label }}</td>
        <td>{{ $nilai->{$prefix.'1'} }}</td>
        <td>{{ $nilai->{$prefix.'2'} }}</td>
        <td>{{ $nilai->{$prefix.'3'} }}</td>
        <td>{{ $nilai->{$prefix.'_LUS'} }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <table class="ttd">
    <tr>
      <td style="text-align: left;">
        Mengetahui<br>Kepala Sekolah<br>
        <div style="height: 150px;"></div>
        <u>Sisilia Surasi Andriani, S.Si., M.M</u>
      </td>
      <td style="text-align: right;">
        Bandar Lampung, 14 April 2025<br>
        Waka.Kurikulum<br>
        <div style="height: 150px;"></div>
        <u>Agustinus Kusharyanto, S.Si</u>
      </td>
    </tr>
  </table>

</body>

</html>