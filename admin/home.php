<?php 
  @session_start();

  include '../config/koneksi.php';
  mysql_query("SELECT `id_admin` FROM `admin` where `id_admin` = '$_SESSION[username]'");
  if (empty(@$_SESSION['username'])) {
    echo "<script>document.location.href='../index.php'</script>";
  }

  @$user = mysql_fetch_array(mysql_query("SELECT * FROM `admin` where `id_admin` = '$_SESSION[username]'")) or die(mysql_error());
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
      <title>MIhixSentosa. PLN | Admin</title>
    </head>

    <body class="blue-grey lighten-5">
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper blue-grey darken-1">
            <a href="home.php" class="brand-logo" style="margin-left: 2%">MIhixSentosa. PLN</a>
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
          <a href="?menu=pelanggan">Pelanggan</a>
          <a href="?menu=penggunaan">Penggunaan</a>
          <a href="?menu=petugas">Petugas Agen</a>
          <a href="?menu=tarif">Tarif</a>
        </li>
      </ul>
      <?php if (@$_GET['menu']) {
        
      }else{ ?>
        <div class="container white" style="float: right; width: 76%; margin-right: 1%;margin-top: 10px; height: 605px; color : rgba(0,0,0,0.87);"> 
          <p class="flow-text grey-text" style="padding: 25%">Selamat Datang di MIhixSentosa. PLN</p>
        </div>     
      <?php } ?>

      <div class="konten">
        <?php 
        switch (@$_GET['menu']) {
          case 'pelanggan':
            include 'pelanggan.php';
            break;

          case 'penggunaan':
            include 'penggunaan.php';
            break;
          
          case 'tarif':
            include 'tarif.php';
            break;
          
          case 'petugas':
            include 'petugas.php';
            break;
        }

         ?>
      </div>

        
      
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
  </html>