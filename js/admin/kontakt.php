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
      	if(isset($_POST['submit'])) {
          if($_POST['pata'] != ""){
              $q = "UPDATE pata SET pata = '".mysql_real_escape_string($_POST['pata'])."' ";	      
              $result = mysql_query($q);
              if(!$result) {
                      die(mysql_error());
              }
          }else{
              echo "Nevyplnil jste všechny údaje";
          }
          if($_POST['zapis'] != ""){
             $q = "UPDATE cont SET zapis = '".mysql_real_escape_string($_POST['zapis'])."' ";	      
             $result = mysql_query($q);
             if(!$result) {
               die(mysql_error());
             }
          }else{
              echo "Nevyplnil jste všechny údaje";
          }
      	}
        $que = "SELECT * FROM pata";      
   
        $res = mysql_query($que);
        if(!$res) {
         die(mysql_error());
        }
        $pata = mysql_fetch_object($res);
        
        $q = "SELECT * FROM cont";
        $r = mysql_query($q);
        if(!$r) {
         die(mysql_error());
        }
        $cont = mysql_fetch_object($r);
              
        $q9 = "SELECT * FROM ordered JOIN users ON users.id_user = ordered.user_id ORDER BY year ASC, week ASC, day ASC, time ASC";
        $r9 = mysql_query($q9);
        if(!$r9) {
         die(mysql_error());
        }
        
        $q6 = "SELECT * FROM checked JOIN users ON users.id_user = checked.user_id";
        $r6 = mysql_query($q6);
        if(!$r6) {
         die(mysql_error());
        }
        
        if((isset($_GET['action'])) && ($_GET['action'] == "deleteOrder")) {     
              
              
              $qm = "SELECT * FROM ordered JOIN users ON users.id_user = ordered.user_id WHERE id_other = ".mysql_real_escape_string($_GET['id']);
              $rm = mysql_query($qm);
              $rm1 = mysql_fetch_object($rm);
              
              if(mysql_num_rows($rm) > 0 && !$row2){
                $weekM = $rm2->week;
                $yearM = $rm2->year;
                $dayM = $rm2->day;
                
                 if($rm2->time == 1){$timeM = "07:00";}
                 else if($rm1->time == 2){$timeM = "08:00";}
                 else if($rm1->time == 3){$timeM = "09:00";}
                 else if($rm1->time == 4){$timeM = "10:00";}
                 else if($rm1->time == 5){$timeM = "11:00";}
                 else if($rm1->time == 6){$timeM = "12:00";}
                 else if($rm1->time == 7){$timeM = "13:00";}
                 else if($rm1->time == 8){$timeM = "14:00";}
                 else if($rm1->time == 9){$timeM = "15:00";}
                 else if($rm1->time == 10){$timeM = "16:00";}
                 else if($rm1->time == 11){$timeM = "17:00";}
                 else if($rm1->time == 12){$timeM = "18:00";}
                 else if($rm1->time == 13){$timeM = "19:00";}
                 else if($rm1->time == 14){$timeM = "20:00";}
                 else if($rm1->time == 15){$timeM = "21:00";}
                $headers = 'Content-type: text/plain; charset=utf-8' . "\r\n";
                mail("".$rm1->email."","Vaše objednávka byla zrušena","Velmi se Vám omlouvám, ale Vaše objednávka na ".date('d.m.Y', strtotime($yearM."W".$weekM.$dayM))." ".$timeM." byla z technických důvodů zrušena. \r\n Vyberte si, prosím, v rezervačním systému jiný volný termín a nebo mě přímo kontaktujte \r\n na tel. 728 982 083 / Po-Pá , 8.00-9.00 hod./ , abych Vám pomohla situaci vyřešit. \r\n Děkuji za pochopení. \r\n
                Mgr. Jarmila Vokáčová \r\n
                Almedic – studio alternativní medicíny","From: Almedic\r\n".$headers);
              }
              
              $qm3 = "SELECT * FROM checked JOIN users ON users.id_user = checked.user_id WHERE id_other = ".mysql_real_escape_string($_GET['id'])."";
              $rm3 = mysql_query($qm3);
              $rm2 = mysql_fetch_object($rm3);
              
              if(mysql_num_rows($rm3) > 0 && !$row2){
                $weekM = $rm2->week;
                $yearM = $rm2->year;
                $dayM = $rm2->day;
                
                 if($rm2->time == 1){$timeM = "07:00";}
                 else if($rm2->time == 2){$timeM = "08:00";}
                 else if($rm2->time == 3){$timeM = "09:00";}
                 else if($rm2->time == 4){$timeM = "10:00";}
                 else if($rm2->time == 5){$timeM = "11:00";}
                 else if($rm2->time == 6){$timeM = "12:00";}
                 else if($rm2->time == 7){$timeM = "13:00";}
                 else if($rm2->time == 8){$timeM = "14:00";}
                 else if($rm2->time == 9){$timeM = "15:00";}
                 else if($rm2->time == 10){$timeM = "16:00";}
                 else if($rm2->time == 11){$timeM = "17:00";}
                 else if($rm2->time == 12){$timeM = "18:00";}
                 else if($rm2->time == 13){$timeM = "19:00";}
                 else if($rm2->time == 14){$timeM = "20:00";}
                 else if($rm2->time == 15){$timeM = "21:00";}
                 $headers = 'Content-type: text/plain; charset=utf-8' . "\r\n";
                mail("".$rm2->email."","Vaše objednávka byla zrušena","Velmi se Vám omlouvám, ale Vaše objednávka na ".date('d.m.Y', strtotime($yearM."W".$weekM.$dayM))." ".$timeM." byla z technických důvodů zrušena. \r\n Vyberte si, prosím, v rezervačním systému jiný volný termín a nebo mě přímo kontaktujte \r\n na tel. 728 982 083 / Po-Pá , 8.00-9.00 hod./ , abych Vám pomohla situaci vyřešit. \r\n Děkuji za pochopení. \r\n
                Mgr. Jarmila Vokáčová \r\n
                Almedic – studio alternativní medicíny","From: Almedic\r\n".$headers);
              }
              
              $query = "DELETE FROM checked WHERE id_other = ".mysql_real_escape_string($_GET['id'])."";
              $res = mysql_query($query);
              if(!$res) {
                  die(mysql_error());
              }
              
              $q3 = "DELETE FROM ordered WHERE id_other = ".mysql_real_escape_string($_GET['id'])."";
              $r3 = mysql_query($q3);
              if(!$r3) {
                  die(mysql_error());
              }
              header('Location: kontakt.php');
        }
        if((isset($_GET['action'])) && ($_GET['action'] == "openOrder")) {     
              $q60 = "SELECT * FROM checked WHERE id_other =".$_GET['id']."";
              $r60 = mysql_query($q60);
              if(!$r60) {
               die(mysql_error());
              }
              $row3 = mysql_fetch_object($r60);
              
              $q7 = "SELECT * FROM ordered WHERE week = ".$row3->week." AND time=".$row3->time." AND day=".$row3->day." AND year=".$row3->year." ";
              $r7 = mysql_query($q7);
              if(!$r7) {
               die(mysql_error());
              }
              $row2 = mysql_fetch_object($r7);
              
              $qm = "SELECT * FROM ordered JOIN users ON users.id_user = ordered.user_id WHERE id_other = ".mysql_real_escape_string($_GET['id'])."";
              $rm = mysql_query($qm);
              $rm1 = mysql_fetch_object($rm);
              
              $qm3 = "SELECT * FROM checked JOIN users ON users.id_user = checked.user_id WHERE id_other = ".mysql_real_escape_string($_GET['id'])."";
              $rm3 = mysql_query($qm3);
              $rm2 = mysql_fetch_object($rm3);
              
              if(mysql_num_rows($rm3) > 0 && !$row2){
                $weekM = $rm2->week;
                $yearM = $rm2->year;
                $dayM = $rm2->day;
                
                 if($rm2->time == 1){$timeM = "07:00";}
                 else if($rm2->time == 2){$timeM = "08:00";}
                 else if($rm2->time == 3){$timeM = "09:00";}
                 else if($rm2->time == 4){$timeM = "10:00";}
                 else if($rm2->time == 5){$timeM = "11:00";}
                 else if($rm2->time == 6){$timeM = "12:00";}
                 else if($rm2->time == 7){$timeM = "13:00";}
                 else if($rm2->time == 8){$timeM = "14:00";}
                 else if($rm2->time == 9){$timeM = "15:00";}
                 else if($rm2->time == 10){$timeM = "16:00";}
                 else if($rm2->time == 11){$timeM = "17:00";}
                 else if($rm2->time == 12){$timeM = "18:00";}
                 else if($rm2->time == 13){$timeM = "19:00";}
                 else if($rm2->time == 14){$timeM = "20:00";}
                 else if($rm2->time == 15){$timeM = "21:00";}
                 $headers = 'Content-type: text/plain; charset=utf-8' . "\r\n";
                mail("".$rm2->email."","Vaše objednávka byla potvrzena","Vaše objednávka na ".date('d.m.Y', strtotime($yearM."W".$weekM.$dayM))." ".$timeM." byla potvrzena a je závazná.\r\n
V případě, že se z vážných důvodů nebudete moci dostavit, zrušte, prosím, \r\n
svoji objednávku včas, aby mohl být termín poskytnut jiným zájemcům. \r\n  
Děkuji a těším se na Vaši návštěvu.  \r\n

Mgr. Jarmila Vokáčová \r\n
Almedic  studio alternativní medicíny","From: Almedic\r\n".$headers);
              }
              
              if(!$row2){
                $q = "INSERT INTO ordered (user_id,week,day,time,year) VALUES ('".$row3->user_id."','".$row3->week."','".$row3->day."','".$row3->time."','".$row3->year."')";
                $r = mysql_query($q);
                if(!$r) {
                    die(mysql_error());
                }
                $qdel = "DELETE FROM checked JOIN users ON users.id_user = checked.user_id WHERE name=".$row2->user_id." week = ".$row3->week." AND time=".$row3->time." AND day=".$row3->day." AND year=".$row3->year." ";
                $rdel= mysql_query($qdel);
                
                $query = "DELETE FROM checked WHERE id_other = ".mysql_real_escape_string($_GET['id']);
                $res = mysql_query($query);
                if(!$res) {
                    die(mysql_error());
                }

                header('Location: kontakt.php');
              }else{
                $errorTer = "Chyba - Termín obsazen";
              }
            
        }
        
  if(isset($_GET['week'])){
    $week = $_GET['week'];
    if(isset($_GET['year'])){
      $year = $_GET['year'];
    }  	
  }else{
    $week2 = StrFtime("%W") + 1;
    $week = "0".$week2;
    if(!isset($year)){
      $year = "20".StrFtime("%y");
    } 
    header('Location: kontakt.php?week='.$week.'&year='.$year.'');    
  }
  
  if(($week < StrFtime("%W") + 1) && ($year >= "20".StrFtime("%y"))){
      $week2 = StrFtime("%W") + 1;
      $week = "0".$week2;
      $year = "20".StrFtime("%y");
      header('Location: kontakt.php?week='.$week.'&year='.$year.'');
  }
  
  if(isset($_GET['week']) && isset($_GET['day']) && isset($_GET['time']) && isset($_GET['year']) && isset($_GET['name'])){
      $q = "INSERT INTO checked (name,week,day,time,year) VALUES ('".mysql_real_escape_string($_SESSION['username'])."','".mysql_real_escape_string($_GET['week'])."','".mysql_real_escape_string($_GET['day'])."','".mysql_real_escape_string($_GET['time'])."','".mysql_real_escape_string($_GET['year'])."')";     
    	$r = mysql_query($q);
    	if(!$r) {
    	 die(mysql_error());
    	} 
  }
  function vrat($day,$time){
    $qs = "SELECT * FROM ordered WHERE week=".$_GET['week']." AND year=".$_GET['year']." AND day=$day AND time=$time";
    $rs = mysql_query($qs);
    //$r56 = mysql_fetch_object($rs);
    //$day = $r56->day;
    //$time = $56->time;
    if (mysql_num_rows($rs) > 0) return true;
    else return false;
  }
  function vrat2($day,$time){
    $qs = "SELECT * FROM checked WHERE week=".$_GET['week']." AND year=".$_GET['year']." AND day=$day AND time=$time";
    $rs = mysql_query($qs);
    //$r56 = mysql_fetch_object($rs);
    //$day = $r56->day;
    //$time = $56->time;
    if (mysql_num_rows($rs) > 0) return true;
    else return false;
  }
  
  function getPreviousUrl($week, $year) {
    $week--;
    if($week < 10 && $week > 0) {
      $week = '0'.$week;
    }
    if($week == 0) {
      $year--;
      $previousWeekNumber = date('W', strtotime('31 December '.$year));
      if($previousWeekNumber == '01') {
        $previousWeekNumber = '52';
      }
    } else {
      $previousWeekNumber = gmdate('W',strtotime($year."W".$week."2"));
    }
    return 'week='.$previousWeekNumber.'&amp;year='.$year;
  }
  
  function getNextUrl($week, $year) {
    $week++;
    if($week < 10) {
      $week = '0'.$week;
    }
    $nextWeekNumber = gmdate('W',strtotime($year."W".$week."2"));
    if($nextWeekNumber == '01') {
    $year++;
    }
    return 'week='.$nextWeekNumber.'&amp;year='.$year;
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
    <link rel="stylesheet" type="text/css" href="css/table.css" media="all" />
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
      <h1>Uprav obsah strany Kontakt</h1>
      <form id="logOut" action="#" method="post">
            <div>
                <input type="submit" name="logout" value="Odhlásit" style="border:0;background:0;float:right;margin-right:20px;" />
            </div>
      </form>
      <a href="index.php" class="zpet">Zpět do menu</a> 
      <form class="form" action="#" enctype="multipart/form-data" method="post"> 
  	   <div id="label">
           <label for="sidlo" class="labelCon">Uprav kontakt: </label>
       </div>
        <div id="text"> 
          <textarea name="zapis" ><?php echo $cont->zapis; ?></textarea>
          <label  style="width:100%;" for="kont">Uprav kontakt: </label>
          <textarea style="clear:both;" name="pata" ><?php echo $pata->pata; ?></textarea>        	
     	    <input class="submit" type="submit" name="submit" value="Upravit" />
     	  </div>
      </form>
    </div>
    <div id="table">
    <table style="float:left;clear:both;">
       <tr>
         <td><a style="background-image:url('img/leftB.png'); padding-left: 15px; width:90px; height:26px; line-height:27px;" href="kontakt.php?<?php echo getPreviousUrl($week, $year) //if($_GET['week'] <= strftime("%U")){echo '';}else{echo 'href="reservace.php?week='.($_GET['week'] - 1).'&amp;year='.$year.'"';} ?>">Předchozí</a></td>
         <td style="float:left;margin-left:43px;"><?php if(isset($_GET['week'])){echo $_GET['week'].".týden (".date('d.m.Y', strtotime($year."W".$week.'1'))." - ".date('d.m.Y', strtotime($year."W".$week.'7')).")";}?></td>
         <td><a style="background-image:url('img/rightB.png'); padding-left: 30px; width:75px; height:26px; line-height:27px;" href="kontakt.php?<?php echo getNextUrl($week,$year) //echo 'href="reservace.php?week='.((isset($_GET['week']) ? $_GET['week'] : 0) + 1).'&amp;year='.$_GET['year'].'"';?>">Další</a></td>
       </tr>
    </table>
    <table id="date" style="float:left;clear:both;">
          <tbody style="float:left;margin-top:15px;">
            <tr>
              <td></td>
              <td>7h</td>
              <td>8h</td>
              <td>9h</td>
              <td>10h</td>
              <td>11h</td>
              <td>12h</td>
              <td>13h</td>
              <td>14h</td>
              <td>15h</td>
              <td>16h</td>
              <td>17h</td>
              <td>18h</td>
              <td>19h</td>
              <td>20h</td>
              <td>21h</td>
            </tr>
            <?php 
            echo "<tr>
                  <td>Pondělí</td>";
            for($i = 1;$i <= 15;$i++){
                if(vrat(1,$i)){
                  echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
                  
                }else if(vrat2(1,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                  echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                }
            }
            echo "</tr>";
            ?>
            
            <?php 
            echo "<tr>
                  <td>Úterý</td>";
            for($i = 1;$i <= 15;$i++){
                             
                if(vrat(2,$i)){
                  echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
                }else if(vrat2(2,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                  echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                }
            }                
            echo "</tr>";
            ?>
            
            <?php 
            echo "<tr>
                  <td>Středa</td>";
            for($i = 1;$i <= 15;$i++){    
                if(vrat(3,$i)){
                  echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
                }else if(vrat2(3,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                  echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                }
                 
            }
            echo "</tr>";
            ?> 
            
            <?php 
            echo "<tr>
                  <td>Čtvrtek</td>";
            for($i = 1;$i <= 15;$i++){     
                if(vrat(4,$i)){
                  echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
                }else if(vrat2(4,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                  echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                }
                 
            }
            echo "</tr>";
            ?>
            
            <?php 
            echo "<tr>
                  <td>Pátek</td>";
            for($i = 1;$i <= 15;$i++){     
                if(vrat(5,$i)){
                  echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
              }else if(vrat2(5,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                  echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                }
               
            }
            echo "</tr>";
            ?>
            
            <?php 
            echo "<tr>
                  <td>Sobota</td>";
            for($i = 1;$i <= 15;$i++){   
               
                if(vrat(6,$i)){
                  echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
                }else if(vrat2(6,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                }
              
            }
            echo "</tr>";
            ?>
            
            <?php 
            echo "<tr>
                  <td>Neděle</td>";
            for($i = 1;$i <= 15;$i++){   
               
                if(vrat(7,$i)){
                 echo "<td><a style=\"cursor:default;\" class=\"close\"></a></td>";
                }else if(vrat2(7,$i)){
                  echo "<td><a style=\"background-color:#888888;cursor:default;\" class=\"open\"></a></td>";
                }else{
                echo "<td><a style=\"cursor:default;\" class=\"open\"></a></td>";
                } 
                
            }
            echo "</tr>";
            ?>
          </tbody>
      </table> 
    </div>   
    <div id="contProd">
    <?php if(isset($errorTer)){echo $errorTer;} ?>
		<table>
        <tbody>
    		  
          <tr class="item">
            	<td><p><span><u>Čeká na vyřízení</u>&nbsp;</span></p></td>
        	</tr>
          <tr class="item">
            	<td><p><span>Jméno&nbsp;</span></p></td>
              <td><p>Týden&nbsp;</p></td>
              <td><p>Den&nbsp;</p></td>
              <td><p>Čas&nbsp;</p></td>
            	<td><p>Rok</p></td>
        	</tr>     
        <?php
          if($row->name != "admin"){ 
           while($row = mysql_fetch_object($r6)){
                 echo "<tr class=\"item\">
  	                   <td><p><span>".$row->name."&nbsp;</span></p></td>
                       <td><p><span>".$row->week."&nbsp;</span></p></td>
                       <td><p><span>";
                       if($row->day == 1){echo "Pondělí";}
                       else if($row->day == 2){echo "Úterý";}
                       else if($row->day == 3){echo "Středa";}
                       else if($row->day == 4){echo "Čtvrtek";}
                       else if($row->day == 5){echo "Pátek";}
                       else if($row->day == 6){echo "Sobota";}
                       else if($row->day == 7){echo "Neděle";}
                 echo "&nbsp;</span></p></td>
                       <td><p><span>";
                       if($row->time == 1){echo "07:00";}
                       else if($row->time == 2){echo "08:00";}
                       else if($row->time == 3){echo "09:00";}
                       else if($row->time == 4){echo "10:00";}
                       else if($row->time == 5){echo "11:00";}
                       else if($row->time == 6){echo "12:00";}
                       else if($row->time == 7){echo "13:00";}
                       else if($row->time == 8){echo "14:00";}
                       else if($row->time == 9){echo "15:00";}
                       else if($row->time == 10){echo "16:00";}
                       else if($row->time == 11){echo "17:00";}
                       else if($row->time == 12){echo "18:00";}
                       else if($row->time == 13){echo "19:00";}
                       else if($row->time == 14){echo "20:00";}
                       else if($row->time == 15){echo "21:00";}
                 echo "&nbsp;</span></p></td>
                       <td><p><span>".$row->year."&nbsp;</span></p></td>
                       <td><a style=\"background-image:url('../img/open.png')\" href=\"kontakt.php?action=openOrder&amp;id=$row->id_other\"></a></td>
                       <td><a href=\"kontakt.php?action=deleteOrder&amp;id=$row->id_other\"></a></td>
                       </tr>";
              }
          }
        ?>
        <tr class="item">
            <td><p><span><u>Vyřízené</u>&nbsp;</span></p></td>
        </tr>
        <tr class="item">
            	<td><p><span>Jméno&nbsp;</span></p></td>
              <td><p>Týden&nbsp;</p></td>
              <td><p>Den&nbsp;</p></td>
              <td><p>Čas&nbsp;</p></td>
            	<td><p>Rok</p></td>
        	</tr>
        <?php
          
         while($row = mysql_fetch_object($r9)){
               echo "<tr class=\"item\">
	                   <td><p><span>".$row->name."&nbsp;</span></p></td>
                     <td><p><span>".$row->week."&nbsp;</span></p></td>
                     <td><p><span>";
                     if($row->day == 1){echo "Pondělí";}
                     else if($row->day == 2){echo "Úterý";}
                     else if($row->day == 3){echo "Středa";}
                     else if($row->day == 4){echo "Čtvrtek";}
                     else if($row->day == 5){echo "Pátek";}
                     else if($row->day == 6){echo "Sobota";}
                     else if($row->day == 7){echo "Neděle";}
               echo "&nbsp;</span></p></td>
                     <td><p><span>";
                     if($row->time == 1){echo "07:00";}
                     else if($row->time == 2){echo "08:00";}
                     else if($row->time == 3){echo "09:00";}
                     else if($row->time == 4){echo "10:00";}
                     else if($row->time == 5){echo "11:00";}
                     else if($row->time == 6){echo "12:00";}
                     else if($row->time == 7){echo "13:00";}
                     else if($row->time == 8){echo "14:00";}
                     else if($row->time == 9){echo "15:00";}
                     else if($row->time == 10){echo "16:00";}
                     else if($row->time == 11){echo "17:00";}
                     else if($row->time == 12){echo "18:00";}
                     else if($row->time == 13){echo "19:00";}
                     else if($row->time == 14){echo "20:00";}
                     else if($row->time == 15){echo "21:00";}
               echo "&nbsp;</span></p></td>
                     <td><p><span>".$row->year."&nbsp;</span></p></td>       
                     <td><a href=\"kontakt.php?action=deleteOrder&amp;id=$row->id_other\"></a></td>
                     </tr>";
            }
        ?>
	    </tbody>
	 </table>
	</div>
  
  </body>

</html>