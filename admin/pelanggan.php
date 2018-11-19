<?php 
  @$table = "pelanggan";
  @$where = "id_pelanggan = '$_GET[id]'";
  @$i1 = $_POST['i1'];
  @$i2 = $_POST['i2'];
  @$i3 = $_POST['i3'];
  @$i4 = $_POST['i4'];
  @$i5 = $_POST['i5'];
  @$i6 = $_POST['i6'];
  $tampil = mysql_query("SELECT * FROM $table");
  if (isset($_GET['hapus'])) {
    mysql_query("DELETE FROM $table WHERE $where");
    echo "<script>alert('Berhasil!');document.location.href='?menu=pelanggan'</script>";
  }

  if (isset($_GET['edit'])) {
    $edit = mysql_fetch_array(mysql_query("SELECT * FROM $table WHERE $where"));
    $tinput = "Input Pelanggan";
  }else{
    $tinput = "Edit Pelanggan";
  }

  if (isset($_POST['simpan'])) {
    mysql_query("INSERT INTO $table VALUES('$i1', '$i2', '$i3', '$i4', '$i5', '$i6')");
    echo "<script>alert('Berhasil!');document.location.href='?menu=pelanggan'</script>";
  }

  if (isset($_POST['update'])) {
    mysql_query("UPDATE $table SET `nometer` = '$i2', `nama` = '$i3', `alamat` = '$i4', `kodetarif` = '$i5', `tanggal_daftar` = '$i6' WHERE id_pelanggan = '$_GET[id]'");
    echo "<script>alert('Berhasil!');document.location.href='?menu=pelanggan'</script>";
  }

  $cariid = mysql_query("select max(id_pelanggan)as kode from $table");
  $fetchcari = mysql_fetch_array($cariid);
  $idpel = substr($fetchcari['kode'],1,4);
  $tambah= $idpel+1;
  if ($tambah < 10) {
    @$id = "P000".$tambah;
  }else{
    @$id = "P00".$tambah;
  }

  $carinometer = mysql_query("select max(nometer)as kode from $table");
  $fetchcarinometer = mysql_fetch_array($carinometer);
  $idpelnometer = substr($fetchcari['kode'],1,4);
  $tambah1= $idpel+1;
  if ($tambah1 < 10) {
    $nom = "1000".date("dmY").$tambah1;
  }else{
    $nom = "100".date("dmY").$tambah1;
  }
?>
 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue-grey lighten-5">
      <form action="" method="post">
        <div class="container white" style="float: right; width: 76%; margin-right: 1%;margin-top: 10px; color : rgba(0,0,0,0.87);"> 
          <h3 class="blue-grey-text center">Input Pelanggan</h3>
          <div class="container" style="margin-top: 70px; padding-bottom: 50px;" >
            <div class="row">
              <div class="col s12">
                <div class="row">
                  <div class="input-field col s6">
                    <input type="text" name="i1" class="validate" readonly placeholder="" value="<?php if(@$_GET['id']){ echo $edit[0]; }else{ echo @$id; } ?>">
                    <label for="">Id Pelanggan</label>
                  </div>

                  <div class="input-field col s6">
                    <input type="text" name="i2" class="validate" readonly placeholder="" value="<?php if(@$_GET['id']){ echo $edit[1]; }else{ echo @$nom; } ?>">
                    <label for="">No Meter</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s8">
                    <input type="text" name="i3" class="validate" placeholder="" value="<?php echo @$edit[2] ?>">
                    <label for="">Nama</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s7">
                    <textarea id="textarea1" placeholder="" required name="i4" class="materialize-textarea"><?php echo @$edit[3]; ?></textarea>
                    <label for="">Alamat</label>
                </div>
              </div>
              
              <div class="row">
                <div class="input-field col s4">
                    <select name="i5" placeholder="">
                      <option value="" disabled <?php if(@$_GET['id']){ }else{ echo "selected"; } ?> >Chose Your Option.</option>
                      <?php
                          $ids = mysql_query("SELECT * FROM tarif");
                          while ($g = mysql_fetch_array($ids)) {
                        ?>
                        <option value="<?php echo @$g[0] ?>" <?php  if (@$edit[4] == @$g[0]) { echo "selected";
                        } ?> ><?php echo $g[1] ?>VA Rp. <?php echo $g[2] ?> / KWH</option>
                        <?php } ?>
                    </select>
                    <label for="">Daya</label>
                </div>

                <div class="input-field col s5">
                  <input type="date" class="datepicker"  required placeholder="" name="i6" value="<?php echo @$edit[5] ?>">
                  <label for="date">Tanggal Daftar</label>
                </div>
              </div>
              <br>
              <div class="row">
                <?php 
                  if (isset($_GET['edit'])) {
                ?>
                <button type="submit" class="btn" name="update" style="float: right; margin-right: 80px">Update</button>
                <?php 
                  }else{
                    ?>
                <button type="submit" class="btn" name="simpan" style="float: right; margin-right: 80px">Simpan</button>
                    <?php
                  }
                 ?>
                
              </div>

            </div>
          </div>
          
          

        </div>     
        <div class="container" style="width: 90%">
            <table class="bordered highlight">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pelanggan</th>
                  <th>No Meter</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Kode Tarif</th>
                  <th>Tanggal Daftar</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 0;
                  while ($f = mysql_fetch_array(@$tampil)) {
                    $no++;
                 ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $f['0']; ?></td>
                  <td><?php echo $f['1']; ?></td>
                  <td><?php echo $f['2']; ?></td>
                  <td><?php echo $f['3']; ?></td>
                  <td><?php echo $f['4']; ?></td>
                  <td><?php echo $f['5']; ?></td>
                  <td colspan="2" style="text-align: center;"><a href="?menu=pelanggan&hapus&id=<?php echo $f[0] ?>" class="btn">hapus</a><a href="?menu=pelanggan&edit&id=<?php echo $f[0] ?>" class="btn">edit</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
      </form>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript">
        $('select').material_select();
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            format: "yyyy-mm-dd",
            selectYears: 15 // Creates a dropdown of 15 years to control year
  });
      </script>
    </body>
  </html>