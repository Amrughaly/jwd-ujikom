<?php
include "function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Harga Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<!-- Header -->
<?php include "header.php"; ?>

<body>
    <br>
    <br>




    <section class="py-5" id="bagian-1">

        <div class="container py-5">
            <div class="container py-5">
                <div class="text-center">
                    <h1>Daftar Harga Kelas Kamar Bell Hotel </h1>
                </div>
                <div class=" card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Kelas Kamar </th>
                                        <th>Harga</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Mengambil data kamar diambil dari database -->
                                    <?php
                                    $i = 1;
                                    $kamar = mysqli_query($conn, "
                                            SELECT 
                                                *
                                            FROM
                                                kamar");

                                    while ($data = mysqli_fetch_assoc($kamar)) {
                                        $tipe_kamar = $data['tipe_kamar'];
                                        $harga_kamar = $data['harga_kamar'];
                                        ?>
                                        <tr align="center">
                                            <!-- data di ambil dari database -->
                                            <td align="center">
                                                <?= $i++; ?>
                                            </td>
                                            <td>
                                                <?= $tipe_kamar; ?>
                                            </td>
                                            <td>
                                                <?= $harga_kamar; ?>
                                            </td>
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

    <?php include 'footer.php'; ?>
</body>

</html>