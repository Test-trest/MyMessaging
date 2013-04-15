<?php 
	session_start();
	if(!isset($_SESSION['username'])) {
		header("Location: almedic/index.php");
	}
	if(isset($_POST['logout'])){
		unset($_SESSION['username']);
		header("Location: admin/index.php");	
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
	  <h1>Vítejte v Administračním systému</h1>
          <form id="logOut" action="#" method="post">
              <div>
                    <input type="submit" name="logout" value="Odhlásit" style="border:0;background:0;float:right;margin-right:20px;" />
              </div>
          </form>
   	  <div id="content">
   	    <a href="uvod.php">Úvod</a>   
	    <a href="metodacic.php">Metoda C.I.C.</a>
	    <a href="detox.php">Toxiny</a>
	    <a href="preparaty.php?action=create">Preparáty Joalis</a>
      <a href="uzivani.php">Dávkování</a>
      <a href="prubeh.php">Detoxikace</a>
        <a href="cenik.php">Ceník</a>
        <a href="novinky.php?action=create">Aktuality</a>
        <a href="kontakt.php">Kontakt</a>
        <a href="sprava.php">Správa uživatelů</a> 
	  </div>                               
	</div>
  </body>

</html>