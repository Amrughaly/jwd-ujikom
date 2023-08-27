<?php
include "function.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<!-- Header -->
<?php include "header.php"; ?>

<body>
    <br>
    <br>


    <section>
        <div class="container py-5">

            <div class="container py-5">
                <div class="text-center">
                    <h1>Pesan Kamar Anda Sekarang</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center"> Form Pemesanan</h4>

                        <form method="post">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nama">Nama pemesan</label>
                                <div class="col-sm-10">
                                    <input id="nama" type="text" class="form-control" name="nama" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="form-check form-check-inline col-sm-6 col-md-8">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki"
                                            value="Laki-Laki">
                                        <label class="form-check-label" for="laki">Laki - Laki </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                            value="Perempuan">
                                        <label class="form-check-label" for="perempuan"> Perempuan</label>
                                    </div>

                                </div>
                            </div>




                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nik">Nomor Identitas</label>
                                <div class="col-sm-10">
                                    <input id="nik" name="nik" type="number" class="form-control" maxlength="16"
                                        required>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tipe_kamar">Tipe Kamar</label>
                                <div class="col-sm-10">
                                    <select name="tipe_kamar" class="form-control" id="tipe_kamar"
                                        onchange="showHargaKamar()">
                                        <option value=''>
                                            Pilih Tipe Kamar
                                        </option>

                                        <!-- tipe kamar ambil dari database -->
                                        <?php
                                        $kamar = mysqli_query($conn, "SELECT * FROM kamar");
                                        while (
                                            $data_kamar = mysqli_fetch_array($kamar)
                                        ) {
                                            echo '<option value="' . $data_kamar['id_kamar'] . '">' . $data_kamar['tipe_kamar'] . '</option>';
                                        }
                                        ;

                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="harga_kamar">Harga</label>
                                <div class="col-sm-10">
                                    <input id="harga_kamar" type="number" class="form-control" name="harga_kamar"
                                        readonly>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tanggal_masuk">Tanggal Pesan</label>
                                <div class="col-sm-10">
                                    <input id="tanggal_masuk" type="date" class="form-control" name="tanggal_masuk"
                                        required min="2023-08-26">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="durasi">Durasi Menginap
                                </label>
                                <div class="col-sm-10">
                                    <input id="durasi" type="number" class="form-control" name="durasi" required>
                                </div>
                            </div>



                            <div class="col mb-3">
                                <label class="col-sm-2 col-form-label" for="flexCheckChecked">Termasuk sarapan</label>
                                <div class="form-check form-check-inline col-sm-6 col-md-8">
                                    <input class="form-check-input" type="checkbox" name="breakfast" value="True"
                                        id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ya
                                    </label>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="total">Total Bayar
                                </label>
                                <div class="col-sm-10">
                                    <input id="total" type="number" class="form-control" name="total" readonly>
                                </div>
                            </div>

                            <div class="container text-center">
                                <div class="row">
                                    <div class="col">
                                        <button id="hitung" type="button" class="btn btn-success">Hitung Total
                                            Bayar</button>
                                    </div>
                                    <div class="col">
                                        <button id="button_pesan" type="submit" class="btn btn-primary"
                                            name="button_pesan">Pesan Kamar</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <?php include 'footer.php'; ?>

</body>
<script>
    function showHargaKamar() {
        var id_kamar = document.getElementById("tipe_kamar").value;
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "get_harga_kamar.php?id_kamar=" + id_kamar, true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var harga = this.responseText;
                document.getElementById("harga_kamar").value = harga;
            }
        }
    };

    function hitung() {
        var id_kamar = document.getElementById("tipe_kamar").value;
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "get_harga_kamar.php?id_kamar=" + id_kamar, true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var harga = this.responseText;
                var durasi = document.getElementById("durasi").value;

                document.getElementById("harga_kamar").value = harga;
                var checkbox = document.getElementById("flexCheckChecked");

                if (durasi >= 3) {
                    if (checkbox.checked == true) {
                        var jumlah = ((durasi * harga) * 0.90 + (durasi * 80000));
                    } else {
                        var jumlah = durasi * harga * 0.90;
                    };
                } else {
                    if (checkbox.checked == true) {
                        var jumlah = ((durasi * harga) + (durasi * 80000));
                    } else {
                        var jumlah = durasi * harga;
                    };
                };
                document.getElementById("total").value = jumlah;
            }
        }
    };

    document.getElementById("hitung").addEventListener("click", hitung);
</script>

</html>