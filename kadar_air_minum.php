<?php
include 'koneksi.php';
//perintah untuk memastikan apakah sudah login
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Halaman Dashboard | Simkasu</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="dashboard_style/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html"><img width="60" height="60px" src="dashboard_style/docs/images/logo.png" </a>
            <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <!-- Navbar Right Menu-->
            <ul class="app-nav">
                <li class="app-search">
                    <input class="app-search__input" type="search" placeholder="Search">
                    <button class="app-search__button"><i class="fa fa-search"></i></button>
                </li>
                <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><?php echo '<img src="dashboard_style/docs/images/' . $_SESSION['username'] . '.png" width="40px" height="40px"/>'; ?>
            <div>
                <p class="app-sidebar__user-name"><?php echo $_SESSION['username'];  ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <li><a class="app-menu__item active" href="kadar_air_minum.php"><i class="app-menu__icon fa fa-tint"></i><span class="app-menu__label">Kadar Air Minum</span></a></li>
            <li><a class="app-menu__item" href="suhu_kandang.php"><i class="app-menu__icon fa fa-fire"></i><span class="app-menu__label">Suhu Kandang</span></a></li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-tint"></i> Kadar Air Minum</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Kadar Air Minum</a></li>
            </ul>
        </div>
        <div class="container" style="margin-top:20px">
            <a class="btn btn-primary" href="tambah_kam.php" role="button">Tambah Data</a>
            <hr>
            <table class="table table-striped table-hover table-sm table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Id Kandang</th>
                        <th>Ph Before</th>
                        <th>Ph After</th>
                        <th>Waktu Perbaikan</th>
                        <th>Kontrol Pompa</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //query ke database SELECT tabel ph urut berdasarkan id_ph yang paling besar
                    $sql = mysqli_query($koneksi, "SELECT * FROM ph ORDER BY id_ph DESC") or die(mysqli_error($koneksi));
                    //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                    if (mysqli_num_rows($sql) > 0) {
                        //membuat variabel $no untuk menyimpan nomor urut
                        $no = 1;
                        //melakukan perulangan while dengan dari dari query $sql
                        while ($data = mysqli_fetch_assoc($sql)) {
                            $batas = 10;
                            //menampilkan data perulangan
                            echo '
						<tr>
							<td>' . $no . '</td>
                            <td>' . $data['id_kandang'] . '</td>
							<td>' . $data['ph_before'] . '</td>
							<td>' . $data['ph_after'] . '</td>
							<td>' . $data['waktu_perbaikan'] . '</td>
                            ';
                            if ($data['ph_after'] < $batas) {
                                echo "<td>Pompa Air Tidak Aktif</td>";
                            } else
                                echo "<td>Pompa Air Aktif</td>";
                            if ($data['ph_after'] > 6 || $data['ph_after'] < 10) {
                                echo "<td>Ph Ideal</td>";
                            } else
                                echo "<td>Ph Tidak Ideal</td>";
                            echo '
							<td>
								<a href="edit_kam.php?id_ph=' . $data['id_ph'] . '" class="badge badge-warning">Edit</a>
								<a href="delete_kam.php?id_ph=' . $data['id_ph'] . '" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
                            $no++;
                        }
                        //jika query menghasilkan nilai 0
                    } else {
                        echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
                    }
                    ?>
                <tbody>
            </table>

        </div>
</body>

</html>
</main>
<!-- Essential javascripts for application to work-->
<script src="dashboard_style/docs/js/jquery-3.3.1.min.js"></script>
<script src="dashboard_style/docs/js/popper.min.js"></script>
<script src="dashboard_style/docs/js/bootstrap.min.js"></script>
<script src="dashboard_style/docs/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="dashboard_style/docs/js/js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="dashboard_style/docs/js/plugins/chart.js"></script>
<script type="text/javascript">
    var pdata = [{
            value: <?php
                    $jumlah_ph_before = mysqli_query($koneksi, "select ph_before from ph");
                    echo mysqli_num_rows($jumlah_ph_before);
                    ?>,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Complete"
        },
        {
            value: <?php
                    $jumlah_ph_after = mysqli_query($koneksi, "select ph_after from ph");
                    echo mysqli_num_rows($jumlah_ph_after);
                    ?>,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "In-Progress"
        }
    ]

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
</script>
<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>
</body>

</html>