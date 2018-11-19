<?php 
  @$table = "penggunaan";
  @$tabletagihan = "tagihan";
  @$where = "id_penggunaan = '$_GET[id]'";
  @$wheretagihan = "id_tagihan = '$_GET[id]'";
  @$i1 = $_POST['i1'];
  @$i2 = $_POST['i2'];
  @$i3 = $_POST['i3'];
  @$i4 = $_POST['i4'];
  @$i5 = $_POST['i5'];
  @$i6 = $_POST['i6'];
  $tampil = mysql_query("SELECT * FROM $table");
  if (isset($_GET['hapus'])) {
    mysql_query("DELETE FROM $table WHERE $where") or die(mysql_error());
    mysql_query("DELETE FROM $tabletagihan WHERE $wheretagihan") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=penggunaan'</script>";
  }

  
    $tinput = "Input penggunaan";

  if (isset($_POST['simpan'])) {
    if (@$i6 < @$i5) {
      
    }
    @$jmlmeter = @$i6 - @$i5;
    mysql_query("INSERT INTO $table values(null, '$i1', '$i3', '$i4', '$i5', '$i6')") or die(mysql_error());
    mysql_query("INSERT INTO $tabletagihan values (null, '$i1', '$i3', '$i4', '$jmlmeter', 'belum')") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=penggunaan'</script>";
  }

  if (isset($_POST['update'])) {
    mysql_query("UPDATE $table SET `bulan` = '$i2', `password` = '$i3' WHERE id_penggunaan = '$_GET[id]'") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=penggunaan'</script>";
  }

  if (isset($_POST['cek'])) {
    @$sql = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan = '$_POST[i1]'");
    $pel = mysql_fetch_array($sql);
    $cek = mysql_num_rows($sql);
    if ($cek>0) {
      $pen = $pel;
      $tes = mysql_query("SELECT * FROM Penggunaan WHERE id_pelanggan = '$i1'");
      $tbln = mysql_fetch_array($tes);
      $set = mysql_num_rows($tes);
      if ($set >= 1) {
        @$maxbln = mysql_query("select max(bulan)as bln from penggunaan");
        @$bln = mysql_fetch_array(@$maxbln);
        @$bulan = @$bln['bln'];
        @$bulan = @$bulan+1;
        @$maxmeter = mysql_query("select max(meterakhir)as meter from penggunaan");
        @$mtr = mysql_fetch_array(@$maxmeter);
        @$meter = @$mtr['meter'];
        
        @$maxthn = mysql_query("select max(tahun)as thn from penggunaan");
        @$thn = mysql_fetch_array(@$maxthn);
        @$tahun = @$thn['thn'];
        if (@$bulan > 12) {
          @$bulan = 1;
          
          @$tahun = @$tahun+1;
        }else{
          @$tahun = substr(@$pen[5], 0,4);
        }
      }else{
        @$bulan = substr(@$pen[5], 6,1);
        @$tahun = substr(@$pen[5], 0,4);
        @$meter = 0;
      }
    }else{
      echo "<script>alert('Tidak Terdaftar!');document.location.href='?menu=penggunaan'</script>";   
    }
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
          <h3 class="blue-grey-text center"><?php   echo $tinput; ?></h3>
          <div class="container" style="margin-top: 70px; padding-bottom: 50px;" >
            <div class="row">
              <div class="col s12">
                <div class="row">
                  <div class="input-field col s4">
                    <input type="text" name="i1" class="validate" placeholder="" value="<?php echo @$pel[0] ?>">
                    <label for="">Id pelanggan</label>
                  </div>

                  <div class="input-field cols s4">
                    <button class="btn" type="submit" name="cek">Cek</button>
                  </div>

                </div>     
                <div class="row">
                  <div class="input-field col s7">
                    <input type="text" name="i2" readonly class="validate" placeholder="" value="<?php echo @$pen[2]; ?>">
                    <label for="">Nama</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s5">
                    <input type="text" name="i3" readonly class="validate" placeholder="" value="<?php echo @$bulan ?>">
                    <label for="">Bulan</label>
                  </div>

                  <div class="input-field col s5">
                    <input type="text" name="i4" readonly class="validate" placeholder="" value="<?php echo @$tahun ?>">
                    <label for="">Tahun</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s5">
                    <input type="text" name="i5" readonly class="validate" onkeyup="meteran()" id="mawal" placeholder="" value="<?php echo @$meter  ?>">
                    <label for="">Meter Awal</label>
                  </div>

                  <div class="input-field col s5">
                    <input type="text" name="i6" class="validate" onkeyup="meteran()" id="makir" onkeypress="return event.charCode >=48 && event.charCode <=57" placeholder="" value="<?php @$edit[0];?>">
                    <label for="">Meter Akhir</label>
                  </div>
                </div>
              <br>
              <div class="row">
                
                <button type="submit" class="btn" name="simpan" id="simpan" disabled="disabled" style="float: right; margin-right: 80px">Simpan</button>
                
                
              </div>

            </div>
          </div>
          
          

        </div>     
        <div class="container" style="width: 90%">
            <table class="bordered centered highlight">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pengguna</th>
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Meter Awal</th>
                  <th>Meter Akhir</th>
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
                  <td><?php echo $f['1']; ?></td>
                  <td><?php echo $f['2']; ?></td>
                  <td><?php echo $f['3']; ?></td>
                  <td><?php echo $f['4']; ?></td>
                  <td><?php echo $f['5']; ?></td>
                  <td colspan="2" style="text-align: center;"><a href="?menu=penggunaan&hapus&id=<?php echo $f[0] ?>" class="btn">hapus</a></td>
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
      <script type="text/javascript">
        function meteran(){
          var mawal = document.getElementById('mawal').value *1;
          var makir = document.getElementById('makir').value *1;
          var plus = makir+1;
          if(makir > mawal){
            $('#simpan').removeAttr('disabled');
          }else{
            $('#simpan').attr('disabled', 'disabled');
          }
        }
      </script>
    </body>
  </html>