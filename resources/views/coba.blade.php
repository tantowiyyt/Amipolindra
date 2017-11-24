<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://demo.itsolutionstuff.com/demoTheme/js/Chart.bundle.js"></script>
<script>
    var year = ['2013','2014','2015', '2016'];
    var data_click = [8,6,5,11];
    var data_viewer = [11,5,3,15];

    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Click',
            backgroundColor: ["rgb(255, 99, 132)","rgb(75, 192, 192)","rgb(255, 205, 86)","rgb(201, 203, 207)","rgb(54, 162, 235)"],
            data: data_click
        }, {
            label: 'View',
            backgroundColor: ["rgb(255, 99, 132)","rgb(75, 192, 192)","rgb(255, 205, 86)","rgb(201, 203, 207)","rgb(54, 162, 235)"],
            data: data_viewer
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'polarArea',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Yearly Website Visitor'
                }
            }
        });

    };
</script>