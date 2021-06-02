<?php
include_once("config.php");

        if(isset($_POST['Submit'])){
            $tangible = $_POST['tangible'];
            $empathy = $_POST['empathy'];
            $responsiveness = $_POST['responsiveness'];
            $assurance = $_POST['assurance'];
            $reliability = $_POST['reliability'];
            $hasil = $_POST['hasil'];

                    
            // Insert data ke database
            $result = mysqli_query($mysqli, "INSERT INTO kepuasan_konsumen(tangible, empathy, responsiveness, assurance, reliability, hasil) VALUES('$tangible','$empathy','$responsiveness','$assurance','$reliability','$hasil')");
            
            // redirect setelah sukses
            if($result){
                header("Location:../index.php");
            }
            else{
                echo 'error!';
            }

        }

        if(isset($_POST['Delete'])){
            $id = $_POST['id_hapus'];

            // Delete user row from table based on given id
            $result = mysqli_query($mysqli, "DELETE FROM penyakit WHERE id=$id");
            
            // After delete redirect to Home, so that latest user list will be displayed.
            if($result){
                header("Location:../index.php");
            }
            else{
                echo 'error!';
            }
        }

        if(isset($_POST['Update'])){
            $id = $_POST['id_update'];

            $nama_desa = $_POST['nama_desa'];
            $mental = $_POST['mental'];
            $imt = $_POST['imt'];
            $tek_darah = $_POST['tek_darah'];
            $hb_kurang = $_POST['hb_kurang'];
            $kolesterol = $_POST['kolesterol'];
            $dm = $_POST['dm'];
            $as_urat = $_POST['as_urat'];
            $ginjal = $_POST['ginjal'];
            $kognitif = $_POST['kognitif'];
            $pengelihatan = $_POST['pengelihatan'];
            $pendengaran = $_POST['pendengaran'];

            // update user data
            $result = mysqli_query($mysqli, "UPDATE penyakit SET nama_desa='$nama_desa',mental='$mental',imt='$imt',tek_darah='$tek_darah',hb_kurang='$hb_kurang',kolesterol='$kolesterol',dm='$dm',asam_urat='$as_urat',ginjal='$ginjal',kognitif='$kognitif',pengelihatan='$pengelihatan',pendengaran='$pendengaran' WHERE id=$id");
            
            // Redirect to homepage to display updated user in list
            if($result){
                header("Location:../index.php");
            }
            else{
                echo 'error!';
            }

            // return $result;

        }
    ?>