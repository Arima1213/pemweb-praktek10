<?php
include('koneksi.php');

$datacovid = mysqli_query($koneksi, "SELECT * FROM covid");
$negara = [];
$jumlah_kasus = [];
$jumlah_kematian = [];
$jumlah_sembuh = [];
$active_cases = [];
$total_tests = [];

$latar_belakang = [
    "rgba(255, 183, 197, 1)",    // Warna merah muda
    "rgba(255, 221, 181, 1)",    // Warna persik
    "rgba(255, 242, 179, 1)",    // Warna kuning pucat
    "rgba(202, 239, 233, 1)",    // Warna hijau pucat
    "rgba(186, 207, 231, 1)",    // Warna biru langit
    "rgba(224, 206, 255, 1)",    // Warna ungu muda
    "rgba(255, 221, 181, 1)",    // Warna oranye pucat
    "rgba(149, 255, 149, 1)",    // Warna hijau muda
    "rgba(255, 247, 147, 1)",    // Warna kuning muda
    "rgba(161, 205, 255, 1)"     // Warna biru muda
];

$latar_batas = [
    "rgba(255, 255, 255, 1)"
];



while ($row = mysqli_fetch_array($datacovid)) {
    $negara[] = $row['negara'];

    $query = mysqli_query($koneksi, "SELECT kasus, kematian, disembuhkan, `kasus aktif`, `total test` FROM covid WHERE id_negara=" . $row['id_negara']);
    $row = $query->fetch_array();

    $jumlah_kasus[] = $row['kasus'];
    $jumlah_kematian[] = $row['kematian'];
    $jumlah_sembuh[] = $row['disembuhkan'];
    $active_cases[] = $row['kasus aktif'];
    $total_tests[] = $row['total test'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Membuat Grafik Menggunakan Chart JS</title>
    <script src="node_modules/chart.js/dist/chart.umd.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="row gap-3">
            <div class="col-12 card">
                <canvas id="myChart3"></canvas>
            </div>

            <div class="row">
                <div class="col-6 card mx-auto">
                    <canvas id="myChart1"></canvas>
                </div>

                <div class="col-6 card mx-auto">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx1 = document.getElementById("myChart1").getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [
                    {
                        label: 'Kasus',
                        data: <?php echo json_encode($jumlah_kasus); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Kematian',
                        data: <?php echo json_encode($jumlah_kematian); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Disembuhkan',
                        data: <?php echo json_encode($jumlah_sembuh); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Kasus aktif',
                        data: <?php echo json_encode($active_cases); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Total Tests',
                        data: <?php echo json_encode($total_tests); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    }
                ]
            }
        });


        var ctx2 = document.getElementById("myChart2").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [
                    {
                        label: 'Kasus',
                        data: <?php echo json_encode($jumlah_kasus); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Kematian',
                        data: <?php echo json_encode($jumlah_kematian); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Disembuhkan',
                        data: <?php echo json_encode($jumlah_sembuh); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Kasus aktif',
                        data: <?php echo json_encode($active_cases); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Total Tests',
                        data: <?php echo json_encode($total_tests); ?>,
                        backgroundColor: <?php echo json_encode($latar_belakang); ?>,
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    }
                ]
            }
        });


        var ctx3 = document.getElementById("myChart3").getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [
                    {
                        label: 'Kasus',
                        data: <?php echo json_encode($jumlah_kasus); ?>,
                        backgroundColor: "rgba(255, 183, 197, 1)",
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Kematian',
                        data: <?php echo json_encode($jumlah_kematian); ?>,
                        backgroundColor: "rgba(255, 221, 181, 1)",
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Disembuhkan',
                        data: <?php echo json_encode($jumlah_sembuh); ?>,
                        backgroundColor: "rgba(255, 242, 179, 1)",
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Kasus aktif',
                        data: <?php echo json_encode($active_cases); ?>,
                        backgroundColor: "rgba(202, 239, 233, 1)",
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    },
                    {
                        label: 'Total Tests',
                        data: <?php echo json_encode($total_tests); ?>,
                        backgroundColor: "rgba(186, 207, 231, 1)",
                        borderColor: <?php echo json_encode($latar_batas); ?>,
                        borderWidth: 1
                    }
                ]
            }

        });
    </script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
