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
        if((isset($_GET['action'])) && ($_GET['action'] == "chBig")) {
            unlink("../img/bigImg/bigImgJoalis.png");
            copy("../img/1.png","../img/bigImg/bigImgJoalis.png");
            $q2 = "UPDATE prep SET big = '1.png'";
            $r2 = mysql_query($q2);
            if(!$r2) {
                    die(mysql_error());
            }
        }
        if((isset($_GET['action'])) && ($_GET['action'] == "hide")) {
           $q3 = "UPDATE prep SET big = ' '";	      
           $r3 = mysql_query($q3);
           if(!$r3) {
             die(mysql_error());
           }
        }
        
	      if((isset($_GET['action'])) && ($_GET['action'] == "create")) {       
            if($_POST['zapis'] != "" ){    
                $q = "INSERT INTO prep (img,cena,zapis) VALUES('".mysql_real_escape_string($_FILES['newImg']['name'][0])."','".nl2br(mysql_real_escape_string($_POST['cena']))."','".nl2br(mysql_real_escape_string($_POST['zapis']))."')";	      
                $result = mysql_query($q);
                if(!$result) {
                        die(mysql_error());
                }            
            }
              if(isset($_FILES['bigImg'])){
                foreach ($_FILES['bigImg']['error'] as $key => $error) {
                    if($_FILES['bigImg'] != ""){
                      $q3 = "UPDATE prep SET big = '".$_FILES['bigImg']['name'][$key]."'";	      
                      $r3 = mysql_query($q3);
                      if(!$r3) {
                              die(mysql_error());
                      }
                    }
                    if ($error == UPLOAD_ERR_OK) {
                        move_uploaded_file(
                          $_FILES['bigImg']['tmp_name'][$key], 
                          "../img/bigImg/bigImgJoalis.png"  
                        ) or die("Problems with upload");
                    }
                 } 
             }  
              if(isset($_FILES['newImg'])){
                foreach ($_FILES['newImg']['error'] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        move_uploaded_file(
                          $_FILES['newImg']['tmp_name'][$key], 
                          "../img/joalis/".$_FILES['newImg']['name'][$key]
                        ) or die("Problems with upload");
                    }
                 }
              }      
          
                      
	   }
      if((isset($_GET['action'])) && ($_GET['action'] == "edit")){
          $q5 = "SELECT * FROM prep WHERE id_zapis =".$_GET['id']."";
          $r5 = mysql_query($q5);
          if(!$r5) {
              die(mysql_error());
          }
          $up = mysql_fetch_object($r5);
          
          
          
          if(isset($_FILES['newImg'])){
            foreach ($_FILES['newImg']['error'] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    move_uploaded_file(
                      $_FILES['newImg']['tmp_name'][$key], 
                      "../img/joalis/".$_FILES['newImg']['name'][$key]
                    ) or die("Problems with upload");
                }
             }
          }
          if($_POST['zapis'] != ""){
            $query = "UPDATE prep SET img='".mysql_real_escape_string($_FILES['newImg']['name'][0])."', zapis='".nl2br(mysql_real_escape_string($_POST['zapis']))."',cena='".nl2br(mysql_real_escape_string($_POST['cena']))."' WHERE id_zapis = '".$_GET['id']."'";
            $res = mysql_query($query);
            if(!$res) {
                die(mysql_error());
            }
            header('Location: http://tac-tac-web.eu/almedic/admin/preparaty.php');
          }
      }
     
      if((isset($_GET['action'])) && ($_GET['action'] == "deleteimg")) {
            $img_id = $_GET['id'];
            $qDel = "SELECT img FROM prep WHERE id_zapis =".$img_id."";
            $r3 = mysql_query($qDel);
            if(!$r3) {
                die(mysql_error());
            }
            $un = mysql_fetch_object($r3);
            if($un){
              unlink("../img/joalis/".$un->img."");
            
              $query = "DELETE FROM prep WHERE id_zapis = ".mysql_real_escape_string($_GET['id']);
              $res = mysql_query($query);
              if(!$res) {
                  die(mysql_error());
              }
            }        

       }
        $q3 = "SELECT * FROM prep";     
      	$rIm = mysql_query($q3);
      	if(!$rIm) {
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
    
    <script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
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
      <h1>Uprav obsah stránky Preparáty Joalis</h1>
      <form id="logOut" action="#" method="post">
            <div>
                <input type="submit" name="logout" value="Odhlásit" style="border:0;background:0;float:right;margin-right:20px;" />
            </div>
      </form>   
      <form class="form" action="" enctype="multipart/form-data" method="post">
        <a href="index.php" class="zpet">Zpět do menu</a>     
      <!-- POUZE TEXT  -->
      <div id="hlavni" style="clear:both;margin-top:15px;">
        
         <div id="label">
            <label for="sidlo" class="labelCon">Úprava textu: </label>
         </div> 
	       <div id="text"> 
             <textarea name="zapis" style="width:550px;height:450px;" ><?php if(($up->zapis) != ""){echo $up->zapis;} ?></textarea>
             <div style="clear:both;height:20px;width:100%;margin-bottom:20px;"><p>Dodatečné údaje:</p></div>
             <div style="clear:both;height:20px;width:100%;"></div>
             <textarea name="cena" style="width: 100px; height: 100px;clear:both;margin-top:10px;" ><?php if(($up->cena) != ""){echo $up->cena;} ?></textarea>
             <input id="check" class="check" data-type="onlytext" type="checkbox" name="big" />
             <label for="check" style="clear:none;margin-left:10px;font-size:13px;">Nahrát hlavní obrázek</label>
             <input class="bigImg" type="file" name="bigImg[]" />
             <div id="imgD" style="clear:both;">
   	           <div class="newImg" style="clear:both;float:left;margin-top:5px;">
                  <input style="clear:both;float:left;margin-top:5px;" class="newImg" type="file" name="newImg[]"/>
              </div>
             </div>
   	         <input class="submit" type="submit" name="submit" value="Uložit" />
   	      </div>
          <?php if($_GET['action'] != "create"){echo "<a class=\"newBut\" href=\"preparaty.php?action=create\" style=\"margin-left:170px;color:#000;\">Přepnout do režimu vložit</a>";} ?>
       	   <a class="newBut" href="preparaty.php?action=chBig" style="margin-left:170px;color:#000;">Navrácení hlavního obrázku</a>
           <a class="newBut" href="preparaty.php?action=hide" style="margin-left:170px;color:#000;">Vypnout hlavní obrázek</a>
    </div>    
     
    </form>
    
    
  </div> 
  <div id="contProd">
		<table>
	        <tbody>
	    		<tr class="item">
	            	<td style="width:350px"><p><span>Zapis&nbsp;</span></p></td>
                <td style="width:350px"><p><span>Komentář&nbsp;</span></p></td>
	            	<td><p><span>Obrázek&nbsp;</span></p></td>
	        	</tr>     
	        <?php 
          
	         while($row2 = mysql_fetch_object($rIm)){
                 echo "<tr class=\"item\">
		                   <td><p style=\"clear:both;\"><span>$row2->zapis&nbsp;</span></p></td>
                       <td><p style=\"clear:both;\"><span>$row2->cena&nbsp;</span></p></td>
		                   <td><img style=\"width:70px;height:70px;\" src=\"../img/joalis/$row2->img\" /></td>
                       <td>
                          <a href=\"preparaty.php?action=edit&amp;id=$row2->id_zapis\" style=\"background-image:url('http://tac-tac-web.eu/almedic/img/edit.png')\"></a>
                          <a href=\"preparaty.php?action=deleteimg&amp;id=$row2->id_zapis\"></a>                     
                       </td>
                       </tr>";
                    
              }

	        ?>
	    </tbody>
	 </table>
	</div>
  <script type="text/javascript">    
   $(".check").change(function(){
    if($(this).attr("checked")){
	     $("#text .bigImg").css("display","block");
      
	  }else{
	    $("#text .bigImg").css("display","none");
      
	  }
	});     		
            
  </script>
  </body>

</html>