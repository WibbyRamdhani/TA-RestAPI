<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Data <small>Mahasiswa</small></h2>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add New</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th>NAMA</th>
                        <th>PRODI</th>
                        <th>QR CODE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datamhs as $row):?>
                    <tr>
                        <td style="vertical-align: middle;"><?php echo $row['nrp']?></td>
                        <td style="vertical-align: middle;"><?php echo $row['nama']?></td>
                        <td style="vertical-align: middle;"><?php echo $row['tipe_kuliah']?></td>
                        
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
 
    <!-- Modal add new mahasiswa-->
    <form action="<?php echo base_url().'index.php/mahasiswa/simpan'?>" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Mahasiswa</h4>
              </div>
              <div class="modal-body">
             
                  <div class="form-group">
                    <label for="nim" class="control-label">NIM:</label>
                    <input type="text" name="nim" class="form-control" id="nim">
                  </div>
                  <div class="form-group">
                    <label for="nama" class="control-label">NAMA:</label>
                    <input type="text" name="nama" class="form-control" id="nama">
                  </div>
                  <div class="form-group">
                    <label for="prodi" class="control-label">TIPE KULIAH:</label>
                    <select name="prodi" class="form-control" id="prodi">
                        <option>Regulrr</option>
                        <option>Profesional</option>
                    </select>
                  </div>
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>