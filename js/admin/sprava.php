<?php 
	session_start();
	if(isset($_POST['logout'])){
		unset($_SESSION['username']);
		header("Location: index.php");	
	}
	if(!isset($_SESSION['username'])) {
		header("Location: index.php");
	}
      $connect = mysql_connect("wm24.wedos.net", "a29689_koreni", "fERkAV9S");
	    if(!$connect) {
	        die(mysql_error());
	    }
	    $db = mysql_select_db("d29689_koreni", $connect);
	    if(!$db) {
	        die(mysql_error());
	    }              
      
      $q6 = "SELECT * FROM users";
      $r6 = mysql_query($q6);
      if(!$r6) {
       die(mysql_error());
      }
        
        if((isset($_GET['action'])) && ($_GET['action'] == "delete")) {
          $q3 = "DELETE FROM checked WHERE user_id = ".mysql_real_escape_string($_GET['id']);
          $r3 = mysql_query($q3);
          if(!$r3) {
              die(mysql_error());
          }
          $q2 = "DELETE FROM ordered WHERE user_id = ".mysql_real_escape_string($_GET['id']);
          $r2 = mysql_query($q2);
          if(!$r2) {
              die(mysql_error());
          }     
          $query = "DELETE FROM users WHERE id_user = ".mysql_real_escape_string($_GET['id']);
          $res = mysql_query($query);
          if(!$res) {
              die(mysql_error());
          }
          
          header('Location: sprava.php');
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
    <script type="text/javascript" src="../js/tinymce_3.5.7/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
	<script type="text/javascript" >
		tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
                
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",      
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
		});
	</script>
    
    <title>Administrační systém</title>
  </head>

  <body>
    <div id="main">
      <h1>Správa uživatelů</h1>
      <form id="logOut" action="#" method="post">
          <div>
              <input type="submit" name="logout" value="Odhlásit" style="border:0;background:0;float:right;margin-right:20px;" />
          </div>
      </form>
      <a href="index.php" class="zpet">Zpět do menu</a> 
      
    </div>
    <div id="contProd" style="position:absolute;left:20px;top:175px;">
        <?php if(isset($errorTer)){echo $errorTer;} ?>
    		<table>
            <tbody>
              <tr class="item">
                	<td style="padding-right:10px;"><p><span>Uživatelské jméno&nbsp;</span></p></td>
                  <td style="padding-right:10px;"><p>Celé jméno&nbsp;</p></td>
                  <td style="padding-right:10px;"><p>Email&nbsp;</p></td>
                  <td style="padding-right:10px;"><p>Telefon&nbsp;</p></td>
                  <td style="padding-right:10px;"><p>Datum narození&nbsp;</p></td>
                  <td style="padding-right:10px;"><p>Bydliště&nbsp;</p></td>
              </tr>     
            <?php 
             while($row = mysql_fetch_object($r6)){
                   echo "<tr class=\"item\">
    	                   <td style=\"padding-right:10px;\"><p><span>".$row->name."&nbsp;</span></p></td>
                         <td style=\"padding-right:10px;\"><p>".$row->fullname."&nbsp;</p></td>
                         <td style=\"padding-right:10px;\"><p>".$row->email."&nbsp;</p></td>
                         <td style=\"padding-right:10px;\"><p>".$row->gsm."&nbsp;</p></td>
                         <td style=\"padding-right:10px;\"><p>".$row->born."&nbsp;</p></td>
                         <td style=\"padding-right:10px;\"><p>".$row->home."&nbsp;</p></td>
                         <td><a href=\"sprava.php?action=delete&amp;id=$row->id_user\"></a></td>
                         </tr>";
                }
            ?>
    	    </tbody>
    	 </table>
	   </div>
  </body>

</html>