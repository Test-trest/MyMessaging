<?php 
	session_start();
	if(isset($_POST['logout'])){
		unset($_SESSION['username']);
		header("Location: http://localhost/korenarka/admin");	
	}
	if(!isset($_SESSION['username'])) {
		header("Location: http://localhost/korenarka");
	}
        $connect = mysql_connect("localhost", "root", null);
		if(!$connect) {
			die(mysql_error());
		}
        $db = mysql_select_db("tac", $connect);
        if(!$db) {
            die(mysql_error());
        }
        if((isset($_GET['action'])) && ($_GET['action'] == "create")) {
            if(($_POST['name'] != "") && ($_POST['url'] != "")){
                $q2 = "INSERT INTO client(name,url) VALUE ('". mysql_real_escape_string($_POST['name'])."','". mysql_real_escape_string($_POST['url'])."')";
                $r2 = mysql_query($q2);
                if(!$r2){
                    die(mysql_error());
                } 
                $clients_id = mysql_insert_id();
                define("UPLOAD_DIR", "../img/clients/$clients_id/" );
                mkdir(UPLOAD_DIR);             
                if(isset($_FILES['logo'])){     
                    $file = $_FILES['logo'];
                    if ($file['error'] == UPLOAD_ERR_OK){
                        
                        $new_file = "1.png";
                        if(file_exists(UPLOAD_DIR.$new_file)){
                            unlink(UPLOAD_DIR.$new_file);
                        }
                        move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$new_file);
                    }
                }
                header("Location: clients.php");
            }else{
                $udajeErr = "Nevyplnil jste nějaké údaje!";
            }
            
        }
        if((isset($_GET['action'])) && ($_GET['action'] == "delete") && (isset($_GET['id']))){
            $query = "DELETE FROM client WHERE id_client = ".mysql_real_escape_string($_GET['id']);
            
            $res = mysql_query($query);
            if(!$res) {
                die(mysql_error());
            }
            $clients_id = $_GET['id'];
            define("DELETE_DIR", "../img/clients/$clients_id/" );
            unlink(DELETE_DIR."1.png");
            header("Location: clients.php");
        }
        $q4 = "SELECT * FROM client";
        $r4 = mysql_query($q4);
        if(!$r4) {
            die(mysql_error());
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
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="all" />
    
    <title>Administrační systém</title>
  </head>

  <body>
    <div id="main">     
	<h1>Přidej logo klienta</h1>
        <form id="logOut" action="#" method="post">
            <div>
                <input type="submit" name="logout" value="Odhlásit" style="border:0;background:0;float:right;margin-right:20px;" />
            </div>
        </form>
        <a href="index.php" class="zpet">Zpět do menu</a> 
        <form class="form" id="form" action="metoda.php?action=create" method="post" enctype="multipart/form-data">
        <div>
	      <div id="label">	  
		      <label for="name" class="lblKlient">Jmeno</label> 
              <label for="url" class="lblKlient">URL</label>
		      <label for="logo" class="lblKlient">Logo</label> 
	      </div>
	      <div id="text">
	        <input type="text" name="name" class="obsah" />
            <input type="text" name="url" class="obsah" />
	        <input type="file" name="logo" class="file obsah" />
                
	        <input type="submit" name="submit" value="Odeslat"/>
	      </div>
	    </div>
	  </form>
            <?php 
                if(isset($udajeErr)){
                    echo "<p class=\"error\">$udajeErr</p>";
                }
            ?>
	</div>
        <div id="contProd">
        	<table>
	            <tbody>
            		<tr class="item">
	                	<td><p>Klient:&nbsp;</p></td>
	                	<td><p><span>Jméno</span></p></td>
	                	<td><p>Odkaz</p></td>
                	</tr>     
	            <?php 
	                while($row2 = mysql_fetch_object($r4)){
	            	echo "<tr class=\"item\">
			                   <td><p>Klient:&nbsp;</p></td>
			                   <td><p><span>$row2->name&nbsp;</span></p></td>
			                   <td><p>$row2->url</p></td>
		                       <td><a href=\"clients.php?action=delete&amp;id=$row2->id_client\"></a></td>
		                    </tr>";
	                }
	            ?>
            </tbody>
		 </table>
        </div>
  </body>

</html>