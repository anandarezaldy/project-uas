<?php
	@session_start();
	include "../config/koneksi.php";
	$id = @$_SESSION['idpembayaran'];
	$nota = mysql_fetch_array(mysql_query("SELECT * FROM detail_pembayaran WHERE id_pembayaran = '$id'"));
	@$meterawal = @$_SESSION['meterawal'];
  @$meterakir = @$_SESSION['meterakir'];
	@$tarif = @$_SESSION['tarif'];
	@$daya = @$_SESSION['daya'];
  
 ?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      
      <style>
        html {
          font-family: GillSans, Calibri, Trebuchet, sans-serif;
          }
      </style>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue-grey lighten-5" style="padding: 0" onload="window.print()">
        
        <table width= "98%" style="margin-left: 1%; ">	
        	<tr>
        		<td colspan="9" style=" height: 30px;"><h4>Lampstrum.co</h4></td>
			
        	</tr>
          <tr>
            
      <td style="text-align: center;"><h4>STRUK PEMBAYARAN TAGIHAN LISTRIK</h4></td>
          </tr>
        </table>
        

		 <div class="container" style="width: 100%; height: 200px;">	
          <table width="98%" style="margin-left: 1%;height:50px;">
            <tr style="">
              
              <td colspan="7" style="height: 30px;"></td>

              
              
              
              <td colspan="3" style="text-align: left; width:14%; font-weight: bold">Tanggal : <?php echo date("d-m-Y"); ?></td>
            </tr>
          	<tr>
          		<td style=" width: 10%">ID PELANGGAN</td>
          		<td>:</td>
          		<td colspan="3"><?php 	echo @$nota[1]; ?></td>
              <td></td>
          		<td style="text-align: right;">BL/TH</td>
          		<td>:</td>
          		<td><?php echo @$nota[3]."/".@$nota[4] ?></td>
          		
          	</tr>

          	<tr>
          		<td>NAMA</td>
          		<td>:</td>
          		<td colspan="3"><?php 	echo @$nota[2]; ?></td>
          		<td></td>
          		<td style="text-align: right;">STAND METER</td>
          		<td>:</td>
          		
          		<td><?php echo "$meterawal - $meterakir" ?></td>
          		
          	</tr>
          	<tr>
          		<td>TARIF/DAYA</td>
          		<td>:</td>
          		<td colspan="6"><?php 	echo @$tarif."/".@$daya ?></td>
          		<td></td>
          	</tr>
          	<tr>
          		<td>TAGIHAN</td>
          		<td>:</td>
          		<td colspan="6">Rp. <?php echo number_format($nota[5],0,'.','.'); ?>,00</td>
          		<td></td>
          	</tr>
            <tr>
              <td style="font-weight: bold">REF</td>
              <td style="font-weight: bold">:</td>
              <td colspan="6" style="font-weight: bold"><?php echo (substr(@$nota[0],1,13)); ?><?php   echo substr(@$nota[1],1,4); ?></td>
              <td></td>
            </tr>
            
          	<tr><td></td>
          	<td colspan="8"><h5>PLN menyatakan struk ini sebagai bukti pembayaran yang sah, mohon disimpan.</h5></td>
          	
          	</tr>
          	<tr>
          		<td>BIAYA ADMIN</td>
          		<td>:</td>
          		<td colspan="6">Rp. <?php echo number_format($nota[6],0,'.','.'); ?>,00</td>
          		<td></td>
          		
          	</tr>
          	<tr>
          		<td>TOTAL BAYAR</td>
          		<td>:</td>
          		<td colspan="6">Rp. <?php echo number_format($nota[7],0,'.','.'); ?>,00</td>
          		<td></td>
          	</tr>
          	
          </table>
          <h5 style="text-align: center;">TERIMAKASIH <br>"Rincian tagihan dapat dilihat di PLN terdekat atau akses www.pln.com"</h5>
          <h5 style="text-align: center;">Informasi Hub: 1933 <br>MihixSentosa.pln</h5>
          	<h5 style="text-align: center;"></h5>
          </div>
          
        </div>     
      
      <!--Import jQuery before materialize.js-->
      
    </body>
  </html>
  