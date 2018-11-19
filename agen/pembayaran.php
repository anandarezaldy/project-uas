<?php 
    @session_start();
  @$table = "pembayaran";
  @$tabletagihan = "tagihan";
  @$where = "id_pembayaran = '$_GET[id]'";
  @$i1 = $_POST['i1'];
  @$i2 = $_POST['i2'];
  @$i3 = $_POST['i3'];
  @$i4 = $_POST['i4'];
  @$i5 = $_POST['i5'];
  @$i6 = $_POST['i6'];
  @$i7 = $_POST['i7'];
  @$i8 = $_POST['i8'];
  @$i9 = $_POST['i9'];
  @$i10 = $_POST['i10'];
  @$i11 = $_POST['i11'];
  @$wheretagihan = "id_pelanggan = '$i1'";
  $tampil = mysql_query("SELECT * FROM $table");
  if (isset($_GET['hapus'])) {
    mysql_query("DELETE FROM $table WHERE $where") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=pembayaran'</script>";
  }

  
    $tinput = "Pembayaran";



  

  if (isset($_POST['update'])) {
    mysql_query("UPDATE $table SET `bulan` = '$i2', `password` = '$i3' WHERE id_pembayaran = '$_GET[id]'") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=pembayaran'</script>";
  }


  if (isset($_POST['cek'])) {
    @$cek = mysql_num_rows(mysql_query("SELECT * FROM pelanggan  WHERE id_pelanggan = '$_POST[i1]'"));
    if (@$cek > 0) {
      @$cek = mysql_num_rows(mysql_query("SELECT * FROM tagihan WHERE id_pelanggan = '$_POST[i1]' AND status = 'belum'"));
      if (@$cek == 0) {
        @$cek = mysql_num_rows(mysql_query("SELECT * FROM tagihan WHERE id_pelanggan = '$_POST[i1]' AND status = 'sudah'"));
        if (@$cek > 0 ) {
          echo "<script>alert('Anda sudah melakukan pembayaran di bulan ini!');</script>";    
        }else{
          echo "<script>alert('Belum ada tagihan');</script>";    
        }
      }else{
        if (@$cek == 1 ) {
          @$pel = mysql_fetch_array(mysql_query("SELECT * FROM tagihan WHERE id_pelanggan = '$_POST[i1]' AND status = 'belum'"));
          @$nama = mysql_fetch_array(mysql_query("SELECT * FROM pelanggan  WHERE id_pelanggan = '$pel[1]'"));
          @$tarif = mysql_fetch_array(mysql_query("SELECT * FROM tarif WHERE kodetarif = '$nama[4]'")); 
          @$meter = mysql_fetch_array(mysql_query("SELECT * FROM penggunaan WHERE id_penggunaan = '$pel[0]'")); 
          @$tagihan = @$pel[4] * @$tarif[2];
          @$total = @$tagihan + 5000;
          $_SESSION['meterawal'] = @$meter[4];
          $_SESSION['meterakir'] = @$meter[5];
          $_SESSION['tarif'] = @$tarif[2];
          $_SESSION['daya'] = @$tarif[1];
        }elseif(@$cek > 1){
          echo "<script>alert('Pelanggan belum membayar selama $cek bulan, harap dibayar!');</script>";
          @$pel = mysql_fetch_array(mysql_query("SELECT * FROM tagihan WHERE id_pelanggan = '$_POST[i1]' AND status = 'belum'"));
          @$nama = mysql_fetch_array(mysql_query("SELECT * FROM pelanggan  WHERE id_pelanggan = '$pel[1]'"));
          @$tarif = mysql_fetch_array(mysql_query("SELECT * FROM tarif WHERE kodetarif = '$nama[4]'")); 
          @$meter = mysql_fetch_array(mysql_query("SELECT * FROM penggunaan WHERE id_penggunaan = '$pel[0]'")); 
          @$tagihan = @$pel[4] * @$tarif[2];
          @$total = @$tagihan + 5000;
          $_SESSION['meterawal'] = @$meter[4];
          $_SESSION['meterakir'] = @$meter[5];
          $_SESSION['tarif'] = @$tarif[2];
          $_SESSION['daya'] = @$tarif[1];
        }
      }
    }else{
      echo "<script>alert('ID salah!');</script>";
    }
  }

  

  if (isset($_POST['simpan'])) {
    $tanggal = date("Y-m-d");
    $_SESSION['idpembayaran'] = @$i11;
    mysql_query("INSERT INTO $table values('$i11', '$i1', '$tanggal', '$i3')") or die(mysql_error());
    mysql_query("INSERT INTO detail_pembayaran values('$i11', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9')") or die(mysql_error());
    mysql_query("UPDATE tagihan SET status = 'sudah' WHERE id_pelanggan = '$i1' AND id_tagihan = '$pel[0]'");
    echo "<script>alert('Berhasil!');document.location.href='nota.php'; target='_blank'</script>";
  }
  

  $cariid = mysql_query("select max(id_pembayaran)as kode from $table");
  $fetchcari = mysql_fetch_array($cariid);
  $idpel = substr($fetchcari['kode'],10,4);
  $tambah= $idpel+1;
  if ($tambah < 10) {
    @$id = "T".date("dmY")."000".$tambah;
  }else{
    @$id = "T".date("dmY")."00".$tambah;
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
                    <input type="text" name="i11" class="validate" placeholder="" value="<?php echo @$id ?>">
                    <label for="">Id Pembayaran</label>
                  </div>
            

                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <input type="text" name="i1" class="validate" placeholder="" value="<?php echo @$pel[1] ?>">
                    <label for="">Id pelanggan</label>
                  </div>
                  <div class="input-field cols s4">
                    <button class="btn" type="submit" name="cek">Cek</button>
                  </div>

                </div>     

                <div class="row">
                  <div class="input-field col s7">
                    <input type="text" name="i2" readonly class="validate" placeholder="" value="<?php echo @$nama[2]; ?>">
                    <label for="">Nama</label>
                  </div>

                  <div class="input-field col s5">
                    <input type="text" name="i10" readonly class="validate" placeholder="" value="<?php echo @$nama[1]; ?>">
                    <label for="">Nomor Meter</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s5">
                    <input type="text" name="i3" readonly class="validate" placeholder="" value="<?php echo @$pel[2] ?>">
                    <label for="">Bulan</label>
                  </div>

                  <div class="input-field col s5">
                    <input type="text" name="i4" readonly class="validate" placeholder="" value="<?php echo @$pel[3] ?>">
                    <label for="">Tahun</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s4">
                    <input type="text" name="i5" id="i5" readonly class="validate" placeholder="" value="<?php echo@$tagihan?>">
                    <label for="">Jumlah Tagihan</label>
                  </div>

                  <div class="input-field col s4">
                    <input type="text" name="i6" id="i6" readonly class="validate" placeholder="" value="5000">
                    <label for="">Biaya Administrasi</label>
                  </div>

                  <div class="input-field col s4">
                    <input type="text" name="i7" id="i7" onkeyup="kembali()" readonly class="validate" placeholder="" value="<?php echo @$total?>">
                    <label for="">Total</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s5">
                    <input type="text"  onkeypress="return event.charCode >= 48 && event.charCode <=57" name="i8" onkeyup="kembali()" id="i8" class="validate" placeholder="Rp. " value="">
                    <label for="">Bayar</label>
                  </div>

                  <div class="input-field col s5">
                    <input type="text" name="i9" id="i9" readonly onkeyup="total()" class="validate" placeholder="Rp. " value="">
                    <label for="">Kembali</label>
                  </div>  
                </div>
              <br>
              <div class="row">
                
                <button type="submit" id="simpan" disabled="disabled" class="btn" name="simpan" style="float: right; margin-right: 80px">Bayar</button>
                
              </div>


                
                

            </div>
          </div>
          
          

        </div>     
        <!-- <div class="container" style="width: 90%">
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
                  <td colspan="2" style="text-align: center;"><a href="?menu=pembayaran&hapus&id=<?php echo $f[0] ?>" class="btn">hapus</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div> -->
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
        function kembali(){
          var total = document.getElementById('i7').value *1;
          var bayar = document.getElementById('i8').value *1;
          document.getElementById('i9').value = bayar - <?php echo @$total; ?>;
          var plus = bayar+1;
          if(bayar > total){
            $('#simpan').removeAttr('disabled');
          }else{
            $('#simpan').attr('disabled', 'disabled');
          }
        }
        
          
          
        
      </script>
    </body>
  </html>