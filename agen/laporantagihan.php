<?php 
	@session_start();
	include '../config/koneksi.php';
	@$status = $_SESSION['status'];
	
	header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=laporan.xls");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center><h4>LAPORAN PELANGGAN</h4></center>
	<table border="1" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pengguna</th>
                  <th>Nama</th>
                  
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Jumlah Meter</th>
                  <th>Status</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 0;
                  @$sql = mysql_query("SELECT * FROM viewtagihan");
                  while ($f = mysql_fetch_array(@$sql)) {
                    $no++;
                 ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $f[1]; ?></td>
                  <td><?php echo $f[6]; ?></td>
                  
                  <td><?php echo $f[2]; ?></td>
                  <td><?php echo $f[3]; ?></td>
                  <td><?php echo $f[4]; ?></td>
                  <td><?php echo $f[5]; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>

</body>
</html>