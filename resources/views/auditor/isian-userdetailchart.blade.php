@extends('auditor-chart')

@section('title', ' Isian Borang User')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Isian Borang</h1>
                        <table>
                            <tr>
                                <th>Jurusan</th>
                                <th>&nbsp:&nbsp</th>
                                <th> 
                                    @foreach($jurusan as $nama)
                                        {{ $nama->nama_jurusan }}
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>Tahun</th>
                                <th>&nbsp:&nbsp</th>
                                <th>{{ $tahun }}</th>
                            </tr>
                        </table> 
                        <div class="col-md-7" style="margin-top:5px;">
                        <ul class="nav nav-pills">
                          <li><a href="/isian/@foreach($jurusan as $id){{ $id->id }}@endforeach/{{ $tahun }}">Isian Borang</a></li>
                          <li><a href="/isian/@foreach($jurusan as $id){{ $id->id }}@endforeach/{{ $tahun }}/full">Isian Borang Full</a></li>
                          <li class="active"><a href="#">Chart</a></li>
                        </ul>
                        @include('partials._message')
                        </div>
                        <div class="col-md-12">    
                        <canvas id="canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $butir = array();
            foreach ($jawabans as $butirs) {
                $nobutir = $butirs->butir->no_butir;
                array_push($butir, $nobutir);
            }
        ?>

@endsection

@section('scripts')
<script type="text/javascript" src="http://demo.itsolutionstuff.com/demoTheme/js/Chart.bundle.js"></script>
<script>
    var no_butir = <?php echo json_encode($butir); ?>;
    var nilai = {{ json_encode($nilai) }};

    var barChartData = {
        labels: no_butir,
        datasets: [{
            label: 'Skor Borang',
            backgroundColor: ["rgb(255, 99, 132)","rgb(75, 192, 192)","rgb(255, 205, 86)","rgb(201, 203, 207)","rgb(54, 162, 235)", "rgb(26, 188, 156)", "rgb(22, 160, 133)", "rgb(241, 196, 15)", "rgb(243, 156, 18)", "rgb(46, 204, 113)", "rgb(39, 174, 96)", "rgb(230, 126, 34)", "rgb(211, 84, 0)", "rgb(52, 152, 219)", "rgb(41, 128, 185)", "rgb(231, 76, 60)", "rgb(192, 57, 43)", "rgb(155, 89, 182)", "rgb(142, 68, 173)", "rgb(236, 240, 241)", "rgb(189, 195, 199)", "rgb(52, 73, 94)", "rgb(44, 62, 80)", "rgb(149, 165, 166)", "rgb(127, 140, 141)"],
            data: nilai
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'polarArea',
            data: barChartData,
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Skor per Nomor Butir'
                }
            }
        });

    };
</script>
@endsection