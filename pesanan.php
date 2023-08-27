<?php
include "function.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<!-- Header -->
<?php include 'header.php'; ?>
<body>
    <br>
    <br>
    

    <section class="py-5" id="bagian-1">
        <div class="container py-5">
            <div class="container py-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1>Pesanan Anda </h1>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pemesan</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Identitas </th>
                                            <th>Tipe Kamar </th>
                                            <th>Harga</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Durasi Menginap</th>
                                            <th>Termasuk Sarapan
                                            <th>Total Bayar


                                        </tr>
                                    </thead>
                                    <?php
                                    $i = 1;
                                    $pemesanan = mysqli_query($conn, "
                                            SELECT 
                                                pemesan.nama_pemesan AS pemesan, 
                                                pemesan.jenis_kelamin AS jenis_kelamin, 
                                                pemesan.no_identitas AS no_identitas,
                                                kamar.tipe_kamar AS tipe_kamar,
                                                kamar.harga_kamar AS harga,
                                                pemesanan.tanggal_pesan AS tanggal_masuk,
                                                pemesanan.durasi AS durasi,
                                                pemesanan.breakfast AS breakfast,
                                                pemesanan.total AS total
                                            FROM
                                                pemesan, kamar, pemesanan
                                            WHERE
                                                pemesan.no_identitas = pemesanan.no_identitas AND kamar.id_kamar = pemesanan.id_kamar");

                                    while ($data = mysqli_fetch_assoc($pemesanan)) {
                                        $pemesan = $data['pemesan'];
                                        $jenis_kelamin = $data['jenis_kelamin'];
                                        $no_identitas = $data['no_identitas'];
                                        $tipe_kamar = $data['tipe_kamar'];
                                        $harga = $data['harga'];
                                        $tanggal_masuk = $data['tanggal_masuk'];
                                        $durasi = $data['durasi'];

                                        $breakfast = $data['breakfast'];
                                        if ($breakfast == true) {
                                            $sarapan = "Ya";
                                        } else {
                                            $sarapan = "-";
                                        };

                                        $total = $data['total'];
                                    ?>
                                        <tr>
                                            <td align="center"><?= $i++; ?></td>
                                            <td><?= $pemesan; ?></td>
                                            <td><?= $jenis_kelamin; ?></td>
                                            <td><?= $no_identitas; ?></td>
                                            <td><?= $tipe_kamar; ?></td>
                                            <td><?= $harga; ?></td>
                                            <td><?= $tanggal_masuk; ?></td>
                                            <td><?= $durasi; ?></td>
                                            <td><?= $sarapan; ?></td>
                                            <td><?= $total; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
</body>
<!-- Footer -->

</html>