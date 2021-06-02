<?php
// Create database connection using config file
include_once("core/config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM kepuasan_konsumen ORDER BY id ASC");
?>
 
<html>
<head>    
    <title>Dataset</title>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    
    </head>
</head>
 
<body>
<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Algoritma C.45</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Dataset</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="core/kmeans.php">Hasil Klastering</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- navigation bar -->
 
    <div class="container mt-5 ">
        <h1 class="text-center">Sistem Klasifikasi Pelayanan Konsumen</h1>
        <h1 class="text-center mb-3">Arria Elektronik</h1>
        <div class="card">
            <div class="card-body">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5>Uji Kepuasan Konsumen</h5>
                        <table class="table table-bordered" width="100%">
                            <tr>
                                <td width="33%">
                                    <div class="form-group">
                                        <label for="tangible">Tangible *</label>
                                        <input required class="form-control" type="number" step="0.01" name="tangible" id="tangible">
                                    </div>
                                </td>
                                <td width="33%">
                                    <div class="form-group">
                                        <label for="assurance">Assurance *</label>
                                        <input required class="form-control" type="number" step="0.01" name="assurance" id="assurance">
                                    </div>
                                </td>
                                <td>
                                    <h3 class="mt-2 text-center">Hasil Klasifikasi C4.5</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="empathy">Empathy *</label>
                                        <input required class="form-control" type="number" step="0.01" name="empathy" id="empathy">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="reliability">Reliability *</label>
                                        <input required class="form-control" type="number" step="0.01" name="reliability" id="reliability">
                                    </div>
                                </td>
                                <td>
                                    <h2 class="text-center">PUAS</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="responsiveness">Responsiveness *</label>
                                        <input required class="form-control" type="number" step="0.01" name="responsiveness" id="responsiveness">
                                    </div>
                                </td>
                                <td colspan="2">
                                    <button class="mt-3 btn btn-primary" style="float:right; padding-right: 30px; padding-left: 30px;"><i class="fas fa-cogs"></i> Hitung</button>
                                    <button type="reset" style="float:right; padding-right: 16.5px; padding-left: 16.5px; margin-right: 10px;" class="mt-3 btn btn-secondary"><i class="fas fa-undo "></i> Reset Form</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                            <h5>Data Kepuasan Pelayanan Konsumen</h5>
                            </div>
                            <div class="col">
                                <a href="#" style="float: right; padding-right: 12.5px; padding-left: 12.5px;" class="mb-2 btn btn-success"         data-bs-toggle="modal" data-bs-target="#modalTambah"> <i class="fas fa-plus    "></i> Tambah Data</a>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered mb-5" style="width:100%" id="table_dataset">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tangible (X1)</th>
                                    <th>Empathy (X2)</th>
                                    <th>Responsiveness (X3)</th>
                                    <th>Assurance (X4)</th>
                                    <th>Reliability (X5)</th>
                                    <th width="160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                $no = 1;
                                while($user_data = mysqli_fetch_array($result)) {         
                                ?>
                                
                                <tr>
                                    <td class='text-center'><?=$no?></td>
                                    <td class='text-center'><?=$user_data['tangible']?></td>
                                    <td class='text-center'><?=$user_data['empathy']?></td>
                                    <td class='text-center'><?=$user_data['responsiveness']?></td>
                                    <td class='text-center'><?=$user_data['assurance']?></td>
                                    <td class='text-center'><?=$user_data['reliability']?></td>
                                    <td width='130px;'><button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#modalEdit<?= $user_data['id']?>'><i class="fas fa-pencil    "></i> Edit</button> | <form class='d-inline' method='POST' action='core/crud.php'> <input type='hidden' name='id_hapus' value='<?= $user_data["id"] ?>'> <button type='submit' name='Delete' value='Delete' class='btn btn-danger btn-sm'><i class="fas fa-trash    "></i> Hapus</button></form></td>
                                    <!-- modal edit data -->
                                    <div class="modal fade" id="modalEdit<?= $user_data['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <input type="hidden" name="id_edit">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- <div class="modal-body">
                                                <form action="core/crud.php" method="POST">
                                                    <div class="form-group">
                                                        <label for="nama_desa">Nama Desa</label>
                                                        <input type="hidden" value="<?= $user_data['id']?>" name="id_update">
                                                        <input class="form-control form-control-sm" value="<?= $user_data["nama_desa"] ?>" type="text" name="nama_desa">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="mental">Gangguan Mental</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["mental"] ?>" type="number" name="mental">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="imt">IMT</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["imt"] ?>" type="number" name="imt">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="tek_darah">Tekanan Darah</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["tek_darah"] ?>" type="number" name="tek_darah">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="hb_kurang">Hb Kurang</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["hb_kurang"] ?>" type="number" name="hb_kurang">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="kolesterol">Koleseterol</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["kolesterol"] ?>" type="number" name="kolesterol">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="dm">Diabetes Melitus</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["dm"] ?>" type="number" name="dm">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="as_urat">Asam Urat</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["asam_urat"] ?>" type="number" name="as_urat">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="ginjal">Gangguan Ginjal</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["ginjal"] ?>" type="number" name="ginjal">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="kognitif">Gangguan Kognitif</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["kognitif"] ?>" type="number" name="kognitif">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="pengelihatan">Gangguan Pengelihatan</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["pengelihatan"] ?>" type="number" name="pengelihatan">
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="pendengaran">Gangguan Pendengaran</label>
                                                        <input class="form-control form-control-sm" value="<?= $user_data["pendengaran"] ?>" type="number" name="pendengaran">
                                                    </div>  
                                            </div> -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" name="Update" value="Simpan" class="btn btn-success">
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- akhir modal edit data -->
                                </tr>
                                <?php   
                                    $no += 1;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- modal tambah data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <input type='hidden' name='id_hapus' id=''>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="core/crud.php" method="POST">
                    <div class="form-group">
                        <label for="nama_desa">Nama Desa</label>
                        <input class="form-control form-control-sm" type="text" name="nama_desa" required>
                    </div>  
                    <div class="form-group">
                        <label for="mental">Gangguan Mental</label>
                        <input class="form-control form-control-sm" type="number" name="mental" required>
                    </div>  
                    <div class="form-group">
                        <label for="imt">IMT</label>
                        <input class="form-control form-control-sm" type="number" name="imt" required>
                    </div>  
                    <div class="form-group">
                        <label for="tek_darah">Tekanan Darah</label>
                        <input class="form-control form-control-sm" type="number" name="tek_darah" required>
                    </div>  
                    <div class="form-group">
                        <label for="hb_kurang">Hb Kurang</label>
                        <input class="form-control form-control-sm" type="number" name="hb_kurang" required>
                    </div>  
                    <div class="form-group">
                        <label for="kolesterol">Koleseterol</label>
                        <input class="form-control form-control-sm" type="number" name="kolesterol" required>
                    </div>  
                    <div class="form-group">
                        <label for="dm">Diabetes Melitus</label>
                        <input class="form-control form-control-sm" type="number" name="dm" required>
                    </div>  
                    <div class="form-group">
                        <label for="as_urat">Asam Urat</label>
                        <input class="form-control form-control-sm" type="number" name="as_urat" required>
                    </div>  
                    <div class="form-group">
                        <label for="ginjal">Gangguan Ginjal</label>
                        <input class="form-control form-control-sm" type="number" name="ginjal" required>
                    </div>  
                    <div class="form-group">
                        <label for="kognitif">Gangguan Kognitif</label>
                        <input class="form-control form-control-sm" type="number" name="kognitif" required>
                    </div>  
                    <div class="form-group">
                        <label for="pengelihatan">Gangguan Pengelihatan</label>
                        <input class="form-control form-control-sm" type="number" name="pengelihatan" required>
                    </div>  
                    <div class="form-group">
                        <label for="pendengaran">Gangguan Pendengaran</label>
                        <input class="form-control form-control-sm" type="number" name="pendengaran" required>
                    </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="Submit" value="Tambah" class="btn btn-success">
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- akhir modal tambah data -->

    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function () {
        console.log('haloo');
        $('#table_dataset').dataTable( {
            "columnDefs": [
                { "orderable": false, "targets": 6 }
            ]
        } );
    });
    </script>
</body>
</html>