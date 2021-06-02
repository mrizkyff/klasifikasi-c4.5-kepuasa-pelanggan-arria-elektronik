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
            $result = mysqli_query($mysqli, "DELETE FROM kepuasan_konsumen WHERE id=$id");
            
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

            $tangible = $_POST['tangible'];
            $empathy = $_POST['empathy'];
            $responsiveness = $_POST['responsiveness'];
            $assurance = $_POST['assurance'];
            $reliability = $_POST['reliability'];
            $hasil = $_POST['hasil'];


            // update user data
            $result = mysqli_query($mysqli, "UPDATE kepuasan_konsumen SET tangible='$tangible', empathy='$empathy', responsiveness='$responsiveness', assurance='$assurance', reliability='$reliability', hasil='$hasil' WHERE id=$id");
            
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