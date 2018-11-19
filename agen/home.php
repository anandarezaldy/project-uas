<?php 
  @session_start();

  include '../config/koneksi.php';
  $username = @$_SESSION['username'];
  mysql_query("SELECT `id_petugas` FROM `petugas` where `id_petugas` = '$username'");
  if (empty(@$_SESSION['username'])) {
    echo "<script>document.location.href='../index.php'</script>";
  }

  @$user = mysql_fetch_array(mysql_query("SELECT * FROM `petugas` where `id_petugas` = '$_SESSION[username]'")) or die(mysql_error());
 ?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../datatables/css/jquery.dataTables.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../datatables/css/jquery.dataTables.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../datatables/css/buttons.dataTables.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Lamstroom. PLN | Agen</title>
    </head>

    <body class="blue-grey lighten-5">
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper blue-grey darken-1">
            <a href="home.php" class="brand-logo" style="margin-left: 2%">Lamstroom. PLN</a>
            <ul class="right hide-on-med-and-down">
              <!-- Dropdown Trigger -->
              <li><a href="logout.php" onclick= "return confirm('Logout?')" >Logout</a></li>
            </ul>
          </div>
        </nav>
      </div>

      <!--Sidenav-->

      <ul id="slide-out" class="side-nav fixed" style="margin-top: 64px; z-index: -1000">
        <li>
          <div class="user-view">
            <div class="background">
              <img src="../images/office.jpg" alt="">
            </div>
            <a href="#!user"><img src="../images/man.png" class="circle" alt=""></a>
            <a href="#!nama"><span class="white-text"><?php echo $user[1]; ?></span></a>
            <a href="#!id"><span class="white-text email"><?php echo $_SESSION['username']; ?></span></a>
          </div>
        </li>

        <li>
          
          <a href="?menu=tagihan">Tagihan</a>
          <a href="?menu=pembayaran">Pembayaran</a>
        </li>
      </ul>
      <?php if (@$_GET['menu']) {
        
      }else{ ?>
        <div class="container white" style="float: right; width: 76%; margin-right: 1%;margin-top: 10px; height: 605px; color : rgba(0,0,0,0.87);"> 
          <p class="flow-text grey-text" style="padding: 25%">Selamat Datang di Lamstroom. PLN V.1.0.0</p>
        </div>     
      <?php } ?>

      <div class="konten">
        <?php 
        switch (@$_GET['menu']) {
          
          
          case 'tagihan':
            include 'tagihan.php';
            break;
          
          case 'pembayaran':
            include 'pembayaran.php';
            break;
        }
         ?>
      </div>

        
      
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
  </html>