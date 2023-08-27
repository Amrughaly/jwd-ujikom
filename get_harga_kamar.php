<?php
include "function.php";
$id_kamar = $_REQUEST["id_kamar"];
$result = mysqli_query($conn, "SELECT * FROM kamar where id_kamar = $id_kamar");

$data_kamar = mysqli_fetch_assoc($result);
$harga = $data_kamar['harga_kamar'];

echo $harga;
