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
          if((isset($_GET['action'])) && ($_GET['action'] == "delete")){
           $q = "DELETE FROM imguses";	      
            $result = mysql_query($q);
            if(!$result) {
                    die(mysql_error());
            }
            
            $files = glob('../img/uses/*');
            if(is_array($files) && count($files) > 0){
              foreach($files as $file){
                if(is_file($file)){
                  unlink($file);
                  $karel =  "je to tam";
                  }
              }
            }
        }
        if((isset($_GET['action'])) && ($_GET['action'] == "chBig")) {
            unlink("../img/bigImg/bigImgUses.png");
            copy("../img/1.png","../img/bigImg/bigImgUses.png");
            $q2 = "UPDATE uses SET big = '1.png'";
            $r2 = mysql_query($q2);
            if(!$r2) {
                    die(mysql_error());
            }
        }
        if((isset($_GET['action'])) && ($_GET['action'] == "hide")) {
           $q3 = "UPDATE uses SET big = ' '";	      
           $r3 = mysql_query($q3);
           if(!$r3) {
             die(mysql_error());
           }
        }
	      if((isset($_GET['action'])) && ($_GET['action'] == "create")) {
                   
          if($_POST['zapis'] != ""){
          
            if(($_POST['zapis']) != "" ){    
                $q = "UPDATE uses SET zapis = '".nl2br(mysql_real_escape_string($_POST['zapis']))."', theme = '".mysql_real_escape_string($_POST['select'])."' ";	      
                $result = mysql_query($q);
                if(!$result) {
                        die(mysql_error());
                }            
            }
           
              if(isset($_FILES['bigImg'])){
                foreach ($_FILES['bigImg']['error'] as $key => $error) {
                    if($_FILES['bigImg'] != ""){
                      $q3 = "UPDATE detox SET big = '".$_FILES['bigImg']['name'][$key]."'";	      
                      $r3 = mysql_query($q3);
                      if(!$r3) {
                              die(mysql_error());
                      }
                    }
                    if ($error == UPLOAD_ERR_OK) {
                        move_uploaded_file(
                          $_FILES['bigImg']['tmp_name'][$key], 
                          "../img/bigImg/bigImgDetox.png"  
                        ) or die("Problems with upload");
                    }
                 } 
             }
              if(isset($_FILES['newImg'])){
                foreach ($_FILES['newImg']['error'] as $key => $error) {
                    if($_FILES['newImg'] != ""){
                      $q = "INSERT INTO imguses (jmenoImg) VALUES('".$_FILES["newImg"]["name"][$key]."')";	      
                      $result = mysql_query($q);
                      if(!$result) {
                              die(mysql_error());
                      }
                    }
                    if ($error == UPLOAD_ERR_OK) {
                        move_uploaded_file(
                          $_FILES['newImg']['tmp_name'][$key], 
                          "../img/uses/".$_FILES['newImg']['name'][$key] 
                        ) or die("Problems with upload");
                    }
                 } 
             }     
          }else{
              echo "Nevyplnil jste všechny údaje";
          }
                      
	   }
     if((isset($_GET['action'])) && ($_GET['action'] == "empty")) {
          $q = "UPDATE imguses SET jmenoImg = 'em.png' WHERE id_img = '".$_GET['id']."'";	      
          $result = mysql_query($q);
          if(!$result) {
                  die(mysql_error());
          }
          copy("../img/em.png","../img/uses/em.png");
          header('Location: uzivani.php');
     }
     if((isset($_GET['action'])) && ($_GET['action'] == "editImg")) {
            if(isset($_FILES['newImg'])){
                foreach ($_FILES['newImg']['error'] as $key => $error) {
                    if($_FILES['newImg'] != ""){
                      $q = "UPDATE imguses SET jmenoImg = '".$_FILES["newImg"]["name"][$key]."' WHERE id_img = '".$_GET['id']."'";	      
                      $result = mysql_query($q);
                      if(!$result) {
                              die(mysql_error());
                      }
                    }
                    if ($error == UPLOAD_ERR_OK) {
                        move_uploaded_file(
                          $_FILES['newImg']['tmp_name'][$key], 
                          "../img/uses/".$_FILES['newImg']['name'][$key] 
                        ) or die("Problems with upload");
                    }
                 } 
             }
             header('Location: uzivani.php');
     }
      if((isset($_GET['action'])) && ($_GET['action'] == "deleteimg")) {
            $img_id = $_GET['id'];
            $qDel = "SELECT jmenoImg FROM imguses WHERE id_img =".$img_id."";
            $r3 = mysql_query($qDel);
            if(!$r3) {
                die(mysql_error());
            }
            $un = mysql_fetch_object($r3);
            if($un != ""){
              unlink("../img/uses/".$un->jmenoImg);
            
              $query = "DELETE FROM imguses WHERE id_img = ".mysql_real_escape_string($_GET['id']);
              $res = mysql_query($query);
              if(!$res) {
                  die(mysql_error());
              }
            }
            

      }
        $q3 = "SELECT * FROM imguses WHERE jmenoImg != '' ";     
      	$rIm = mysql_query($q3);
      	if(!$rIm) {
      	 die(mysql_error());
      	}   
                
        $qZap = "SELECT * FROM uses";
        $rzap = mysql_query($qZap);
        if(!$rzap) {
         die(mysql_error());
        }
        $zap = mysql_fetch_object($rzap);
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
      <h1>Uprav obsah stránky Dávkování</h1>
      <form id="logOut" action="#" method="post">
            <div>
                <input type="submit" name="logout" value="Odhlásit" style="border:0;background:0;float:right;margin-right:20px;" />
            </div>
      </form>   
      <form class="form" action="uzivani.php?action=create" enctype="multipart/form-data" method="post">
        <a href="index.php" class="zpet">Zpět do menu</a>
        <select id="select" name="select">
          <option selected="selected"></option>
          <option value="onlytext">1. pouze text</option>
          <option value="imgDown">2. obrázky pod textem</option>
          <option value="imgSide">3. obrázky vedle textu</option>
          <option value="imgBiger">4. velké obrázky pod textem</option>
        </select>
      
      <!-- POUZE TEXT  -->
      <div id="hlavni" style="clear:both;margin-top:15px;">
        
         <div id="label">
            <label for="sidlo" class="labelCon">Úprava textu: </label>
         </div> 
	       <div id="text"> 
             <textarea name="zapis" style="width:550px;height:450px;" ><?php echo $zap->zapis; ?></textarea>
             <input id="check" class="check" data-type="onlytext" type="checkbox" name="big" />
             <label for="check" style="clear:none;margin-left:10px;font-size:13px;">Nahrát hlavní obrázek</label>
             <input class="bigImg" type="file" name="bigImg[]" />
             <div id="imgD" style="clear:both;">
   	           <a class="newBut" onclick="neImg()">Přidat obrázek</a>
               <div class="newImg" style="clear:both;float:left;margin-top:5px;"></div>
             </div>
   	         <input class="submit" type="submit" name="submit" value="Upravit" />
   	      </div>
       	  <a class="newBut" href="uzivani.php?action=delete" style="margin-left:170px;color:#000;">Odstranit všechny obrázky</a>
       	   <a class="newBut" href="uzivani.php?action=chBig" style="margin-left:170px;color:#000;">Navrácení hlavního obrázku</a>
           <a class="newBut" href="uzivani.php?action=hide" style="margin-left:170px;color:#000;">Vypnout hlavní obrázek</a>
    </div>    
     
    </form>
    
    
  </div> 
  <div id="contProd">
		<table>
	        <tbody>
	    		<tr class="item">
	            	<td><p><span>Jméno&nbsp;</span></p></td>
	            	<td><p>Odkaz</p></td>
	        	</tr>     
	        <?php 
          
	         while($row2 = mysql_fetch_object($rIm)){

                 echo "<tr class=\"item\">
		                   <td><p><span>$row2->jmenoImg&nbsp;</span></p></td>
		                   <td><img style=\"width:70px;height:70px;\" src=\"../img/uses/".$row2->jmenoImg."\" /></td>
	                     <td class=\"edit\"><form action=\"uzivani.php?action=editImg&amp;id=$row2->id_img\" enctype=\"multipart/form-data\" method=\"post\"></form></td>
                        <td><a onclick=\"edit()\" style=\"cursor:pointer;background-image:url('http://tac-tac-web.eu/almedic/img/edit.png')\"></a></td>
                        <td><a href=\"uzivani.php?action=empty&amp;id=$row2->id_img\" style=\"cursor:pointer;background-image:url('../img/noI.jpg')\"></a></td>
                        <td><a href=\"uzivani.php?action=deleteimg&amp;id=$row2->id_img\"></a></td>
                        </tr>";
              }

	        ?>
	    </tbody>
	 </table>
	</div>
  <script type="text/javascript">
   function neImg(){
      $('.newImg').append('<input style="clear:both;float:left;margin-top:5px;" class="newImg" type="file" name="newImg[]" />'); 
   }; 
   function edit(){
      $('.edit').children().append('<input style="float:left;" class="newImg" type="file" name="newImg[]" /><input class="submit" type="submit" name="edit" value="Upravit" />');
   } 
   $(".check").change(function(){
    if($(this).attr("checked")){
	     $("#text .bigImg").css("display","block");
      
	  }else{
	    $("#text .bigImg").css("display","none");
      
	  }
	});     		
   $("select").change(function () {
          var str = $("select option:selected").text();
		  
      if(str != ""){
          $("#hlavni").css("display","block");
      }else{
          $("#hlavni").css("display","none");
      };    
      if(str != "1. pouze text"){
          $("#imgD").css("display","block");
      }else{
          $("#imgD").css("display","none");
      };
               
      }).trigger('change'); 
            
  </script>
  </body>

</html>