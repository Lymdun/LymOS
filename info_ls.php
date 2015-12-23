<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LymOS - Monitoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lymdun System">
    <meta name="author" content="lymdun">

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <style>
      body {
        visibility: hidden;
        padding-top: 60px;
      }
    </style>


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="/assets/ico/favicon.png">
	<embed src="../assets/ost/AI.mp3" autostart="true" loop="false" hidden="true"></embed>
    
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">LymOS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="../">Home</a></li>
			  <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Monitor<span class="caret"></span> &zwnj;<ul class="dropdown-menu">
  				<li class="active"><a tabindex="-1" href="info_ls.php">LymOS</a></li>
  				<li><a tabindex="-1" href="./info">Server</a></li>
			    </ul></a></li>
              <li><a href="./login">Login</li>
              <li><a href="./ls">Talk</li>
              <li><a href="./error">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <div class="glitch" data-text="LYMOS MONITORING"><h1>LymOS Monitoring</h1></div>
      <br><p>Vent: <font color="green">OK</font>
      <br>Temp: <font color="green">OK</font>
      <br>Network: <font color="orange">MINOR PROBLEMS</font>
      <br>Security: <font color="green">OK</font>
      <br>Core1: <font color="green">OK</font>
      <br>Reac1: <font color="green">OK</font>
      </p>
      <br>Version:
<?php
    $fileopen=(fopen('version.txt','r'));
    $line = fgets($fileopen);
    fclose($fileopen);
    echo"$line";
?>
    </div> <!-- /container -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>