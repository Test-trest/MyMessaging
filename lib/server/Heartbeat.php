<?php
	if(isset($_POST['Username']))
	{
		$Username = $_POST['Username'];
	}
    if($LoggedIn && ($Username != null))
    {  
    	mysql_connect('localhost','root', null) or
                die('Cannot connect to database');
                
                mysql_select_db('messaging') or 
                die('Cannot select to database');
                
        $selectID = mysql_query("SELECT `Id` FROM `ActiveUsers` WHERE `Username` = '{$Username}' LIMIT 1");
        
        if($userID = mysql_fetch_assoc($selectID))
        {
        	$h = "UPDATE `ActiveUsers` SET `LastPulse` = NOW() WHERE `Id` = {$userId}";
        	if(mysql_query($h));
        	{
        	
        	}
        	else
        	{
        		
        	}
        }
        else
        {
        	$p = "INSERT INTO `ActiveUsers` (`Username`,`LastPulse`,`FirstPulse`) VALUES ('{$Username}',NOW(),NOW())";
        	if(mysql_query($p));
        	{
        	
        	}
        	else
        	{
        		
        	}
        }
        
       $z = "DELETE FROM `ActiveUsers` WHERE `LastPulse` < (NOW() - INTERVAL 2 MINUTE)";
       if(mysql_query($z));
        	{
        	
        	}
        	else
        	{
        		
        	}    
    }

	//$o = "SELECT `Username`, UNIX_TIMESTAMP(`FirstPulse`) AS `FirstPulse` FROM `ActiveUsers` ORDER BY `FirstPulse` ASC";
      




		
<?>