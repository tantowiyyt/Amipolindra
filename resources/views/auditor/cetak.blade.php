<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

	@foreach($jurusan as $nama_jurusan)
	Jurusan : {{ $nama_jurusan->nama_jurusan }}<br>
	@endforeach
	Tahun Isian : {{ $tahun }}<br>
<table>
  <tr>
    <th>No. Butir </th>
    <th>Bobot</th>
    <th>Skor</th>
    <th>Skor Akhir</th>
  </tr>
  <?php 
    $total = 0;
  ?>
  @foreach($jawabans as $jawab)
  <?php
  	$nilai_akhir = ($jawab->bobot * $jawab->nilai);
  ?>	
  <tr>
    <td>{{ $jawab->butir->no_butir }}</td>
    <td>{{ $jawab->bobot }}</td>
    <td>{{ $jawab->nilai }}</td>
    <td>{{ $nilai_akhir }}</td>
  </tr>
  <?php 
    $total = $total + $nilai_akhir;
  ?>
  @endforeach
  <tr>
    <td></td>
    <td></td>
    <td>Nilai Borang Akreditasi</td>
    <td><?php echo $total; ?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Grade</td>
    <td>@if($total >=361 && $total <= 400){{'A'}}@elseif($total >= 301 && $total <= 360){{'B'}}@elseif($total >= 200 && $total <=300){{'C'}}@elseif($total < 200){{ 'Tidak Terakreditasi' }}@endif</td>
  </tr>  
</table>

</body>
</html>
