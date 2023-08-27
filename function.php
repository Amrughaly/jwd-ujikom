<?php
    // koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "hotel");

    // jika button submit ditekan akan ditambahkan ke database

    if(isset($_POST['button_pesan'])) {
        
        $nama_pemesan = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_identitas = $_POST['nik'];
        $tipe_kamar = $_POST['tipe_kamar'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $durasi = $_POST['durasi'];

        $breakfast = $_POST['breakfast'];
        if ($breakfast == "True") {
            $sarapan = True;
        } else {
            $sarapan = False;
        };
        
        $total = $_POST['total'];

        // echo "alert($npm, $id_beasiswa, $semester, $email, $no_telp, $file)";
        $pemesanan = mysqli_query($conn, "SELECT no_identitas FROM pemesan WHERE no_identitas = $no_identitas");
        $data = mysqli_fetch_assoc($pemesanan);       

        if ($data){
            $tambah_data_pemesanan = mysqli_query($conn, "INSERT INTO pemesanan (no_identitas, id_kamar, durasi, tanggal_pesan, breakfast, total) VALUES ('$no_identitas', '$tipe_kamar', '$durasi', '$tanggal_masuk', '$sarapan','$total',) ");
            if($tambah_data_pemesanan){ 
                header('location:pesanan.php'); 
            } else{ 
                header('location:form_pesan.php'); 
            };

        } else {
            $tambah_data_pemesan = mysqli_query($conn, "INSERT INTO pemesan  VALUES ('$no_identitas', '$nama_pemesan', '$jenis_kelamin') ");
            
            $tambah_data_pemesanan = mysqli_query($conn, "INSERT INTO pemesanan (no_identitas, id_kamar, durasi, tanggal_pesan, breakfast, total) VALUES ('$no_identitas', '$tipe_kamar', '$durasi', '$tanggal_masuk', '$sarapan','$total') ");
            
            if($tambah_data_pemesanan && $tambah_data_pemesan){ 
                header('location:pesanan.php'); 
            } else{ 
                header('location:index.php'); 
            };
        };
};

?>