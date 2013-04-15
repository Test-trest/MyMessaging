<?php 
  session_start();
	if(isset($_SESSION['username'])) {
		header("Location: menu.php");
	}
	if(isset($_POST['submit'])) {
		$connect = mysql_connect("wm24.wedos.net", "a29689_koreni", "fERkAV9S");
	    if(!$connect) {
	        die(mysql_error());
	    }
	    $db = mysql_select_db("d29689_koreni", $connect);
	    if(!$db) {
	        die(mysql_error());
	    }
	    $q = "SELECT * 
		      FROM user
		      WHERE name = '".mysql_real_escape_string($_POST['user'])."'
		      AND password = '".md5($_POST['pass'])."'";
		      
		$result = mysql_query($q);
		if(!$result) {
			die(mysql_error());
		}
		if(mysql_num_rows($result) != 0) {
			while($row = mysql_fetch_object($result)) {
				$_SESSION['username'] = $row->name;
			}
			header("Location: menu.php");
		} else {
			echo "Špatné údaje";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">

  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta http-equiv="content-language" content="cs" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="copyright" content="Administrační systém - Hoker" />
    <meta name="author" content="Jan Hoker" />
    
    <link rel="stylesheet" type="text/css" href="css/admin.css" media="all" />
        
    <title>Administrační systém</title>
  </head>

  <body>
  	 <div id="main">
      <h1>Přihlášení</h1>
      <form id="logFrm" action="" method="post">
        <div id="label">
          <label for="user">Uživatelské jméno :</label>
          <label for="pass">Heslo :</label> 
        </div>
        <div id="text">
   	      <input type="text" name="user" />
   	      <input type="password" name="pass" />
   	      <input id="submit" type="submit" name="submit" value="Přihlásit" />
   	    </div>
      </form>
    </div>
  </body>

</html>