<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LymOS - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lymdun System">
    <meta name="author" content="lymdun">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <style>
      body {
      	visibility: hidden;
        padding-top: 40px;
        padding-bottom: 40px;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        border: 2px solid #e5e5e5;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="/assets/ico/favicon.png">

	<!-- Import jQuery and bootstrap -->
	<script src="../assets/js/jquery.min.js" type=text/javascript></script>
	<script src="../assets/js/bootstrap.js" type=text/javascript></script>

	<!-- Block the form if its values are not correct -->
	<script>
		function formCheck(form) {
			if (form.username !== "" && form.password !== "")  {
				return true
			} else {
				return false
			}
			// return (form.username !== "" && form.password !== "")
		}
	</script>

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
  				<li><a tabindex="-1" href="../info_ls.php">LymOS</a></li>
  				<li><a tabindex="-1" href="../info">Server</a></li>
			    </ul></a></li>
              <li class="active"><a href="#">Login</li>
              <li><a href="../ls">Talk</li>
              <li><a href="../error">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <form class="form-signin" onsubmit="return formCheck();"> <!-- Strange syntaxe but it's the way it has to be done. -->
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" class="input-block-level" placeholder="Username" name="username" id="username" required>
        <input type="password" class="input-block-level" placeholder="Password" name="password" id="password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Login</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>
