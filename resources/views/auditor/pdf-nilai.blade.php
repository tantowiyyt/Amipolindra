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
  @endforeach  
</table>

</body>
</html>
