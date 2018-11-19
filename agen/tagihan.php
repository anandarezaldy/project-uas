<?php 
  @session_start();
  @$table = "tagihan";
  @$where = "id_tagihan = '$_GET[id]'";
  @$i1 = $_POST['i1'];
  @$i2 = $_POST['i2'];
  @$i3 = $_POST['i3'];
  @$i4 = $_POST['i4'];
  @$i5 = $_POST['i5'];
  @$i6 = $_POST['i6'];
  @$i7 = $_POST['i7'];
  @$status = $_POST['status'];
  $tampil = mysql_query("SELECT * FROM $table");
  if (isset($_GET['hapus'])) {
    mysql_query("DELETE FROM $table WHERE $where");
    echo "<script>alert('Berhasil!');document.location.href='?menu=tagihan'</script>";
  }


    $tinput = "Tagihan";


  if (isset($_POST['simpan'])) {
    mysql_query("INSERT INTO $table values(null, '$i1', '$i3', '$i4', '$i5', '$i6')") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=tagihan'</script>";
  }

  if (isset($_POST['update'])) {
    mysql_query("UPDATE $table SET `nama` = '$i2', `password` = '$i3' WHERE id_penggunaan = '$_GET[id]'") or die(mysql_error());
    echo "<script>alert('Berhasil!');document.location.href='?menu=penggunaan'</script>";
  }
  
  if (isset($_POST['cek'])) {
    @$sql = mysql_query("SELECT * FROM viewtagihan WHERE id_pelanggan LIKE '%$i7%' or bulan LIKE '%$i7%' or tahun LIKE '%$i7%' or jumlahmeter LIKE '%$i7%' or status LIKE '%$i7%' or nama LIKE '%$i7%' or nometer LIKE '%$i7%'");
  }else{
      @$sql = mysql_query("SELECT * FROM viewtagihan");
  }

  if (isset($_POST['filter'])) {
    @$sql = mysql_query("SELECT * FROM viewtagihan WHERE status = '$_POST[status]'");
  }

  
  

?>
 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="../datatable/skin/bootstrap/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../datatable/jquery.dataTables.min.css">
      


      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue-grey lighten-5">
      <form action="" method="post">
        <div class="container white" style="float: right; width: 76%; margin-right: 1%;margin-top: 10px; color : rgba(0,0,0,0.87);"> 
          <h3 class="blue-grey-text center"><?php echo $tinput; ?></h3>
        <div class="container" style="width: 90%; padding-bottom: 50px;" >
            <div class="row"> 
              <div class="col s12">
                <div class="row">

                </div>    
              </div>
            </div>            
          
            <table class="bordered centered dataTable" width="100%" id="tagihan">
              <thead>
                <tr>
                  
                  <th>ID Pengguna</th>
                  <th>Nama</th>
                  <th>No Meter</th>
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Jumlah Meter</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 0;
                  while ($f = mysql_fetch_array(@$sql)) {
                    
                 ?>
                <tr>
                  
                  <td><?php echo $f[1]; ?></td>
                  <td><?php echo $f[6]; ?></td>
                  <td><?php echo $f[7]; ?></td>
                  <td><?php echo $f[2]; ?></td>
                  <td><?php echo $f[3]; ?></td>
                  <td><?php echo $f[4]; ?></td>
                  <td><?php echo $f[5]; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           <br>
          </div>
      </form>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../datatable/jquery.js"></script>
      <script type="text/javascript" src="../datatable/jquery.dataTables.js"></script>
      <script type="text/javascript" src="../datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/buttons.flash.min.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/jszip.min.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/pdfmake.min.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/vfs_fonts.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/buttons.html5.min.js"></script>
      <script type="text/javascript" src="../datatable/extensions/export/buttons.print.min.js"></script>
      <script type="text/javascript">
        $('#tagihan').DataTable( {
          dom: 'Bfrtip',
          buttons: [
            'copy', 'excel', 'pdf'
        ]
    } );
      
     
  
        

      </script>
      <script src="../datatable/jquery-datatable.js"></script>
    </body>
  </html>