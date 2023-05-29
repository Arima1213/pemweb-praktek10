<?php
    include('koneksi.php');
    $datacovid = mysqli_query($koneksi,"select * from covid");
    while($row = mysqli_fetch_array($datacovid)){
        $negara[] = $row['negara'];  
        $query = mysqli_query($koneksi,"select kasus from
        covid where id_negara=".$row['id_negara']."");
        $row = $query->fetch_array();
        $jumlah_kasus[] = $row['kasus'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Membuat Grafik Menggunakan Chart JS</title>
    <script src="node_modules/chart.js/dist/chart.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div style="width: 800px;height: 800px">
        <canvas id="myChart"></canvas>
    </div>

    <div id="canvas-holder" style="width:50%">
        <canvas id="chart-area"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    label: 'Grafik Kasus Covid',
                    data: <?php echo json_encode($jumlah_kasus);?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });


        var config = {
        type: 'pie',
        data: {
        datasets: [{
        data:<?php echo json_encode($jumlah_kasus);?>,

        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
        ],
        label: 'Presentase Kasus Covid'
        }],
        labels: <?php echo json_encode($negara); ?>},
        options: {
            responsive: true
        }
    };
    window.onload = function() {

        var ctx2 = document.getElementById('chart-area').getContext('2d');
        window.myPie = new Chart(ctx2, config);
    };
    document.getElementById('randomizeData').addEventListener('click',
         function() {

            config.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
                });
            });
            window.myPie.update();
        }
    );
    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click',

    function() {

        var newDataset = {
            backgroundColor: [],
            data: [],
            label: 'New dataset ' +
            config.data.datasets.length,
        };
        for (var index = 0; index < config.data.labels.length;++index) {

            newDataset.data.push(randomScalingFactor());
            var colorName = colorNames[index %

            colorNames.length];

            var newColor = window.chartColors[colorName];
            newDataset.backgroundColor.push(newColor);
        }
        config.data.datasets.push(newDataset);
        window.myPie.update();
    });

    document.getElementById('removeDataset').addEventListener('click',
    function() {

        config.data.datasets.splice(0, 1);
        window.myPie.update();
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>