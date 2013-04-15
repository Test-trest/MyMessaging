<?php
    session_start();
    if(!isset($_SESSION['user_id']) || !isset($_COOKIE["login"])) 
    {
        header('Location: index.php');
    }
    mysql_connect('localhost','root', null);
    mysql_select_db('messaging');
    if(isset($_SESSION['user_id'])) 
    {
         $h = "SELECT * FROM users
                  WHERE id = '".$_SESSION['user_id']."'";
            $result2 = mysql_query($h);
            $user = mysql_fetch_assoc($result2);
    }
    else if (isset($_COOKIE["login"]))
    {
    	 $h = "SELECT * FROM users
                  WHERE id = '".$_COOKIE["login"]."'";
            $result2 = mysql_query($h);
            $user = mysql_fetch_assoc($result2);	
    }
    
    $q = "SELECT * FROM users";
    $result = mysql_query($q);
    
   
?>
<!DOCTYPE HTML>

<html>

<head>
        <title>Your Website</title>
 		<meta name="keywords" content="     " />
  		<meta name="description" content="    " />
  		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  		<link media="screen" href="css/styleService.css" type="text/css" rel="stylesheet"/>
  		<script src="js/jquery-1.7.2.min.js"></script><script src="js/jquery-1.7.2.min.js"></script>

</head>

<body>
        <header>
        		<a href="/"><h1 id="logo">
				My Messaging
				</h1></a>

                
        </header>
    	<nav>
                    <ul>
                            <li><?php echo $user['firstname'];?></li>
                            <li><?php echo $user['lastname'];?></li>
                            <li><a href="odhlaseni.php?action">Odhlásit</a></li>
                        
                    </ul>
        </nav>
        <div id="main">
        	<div id="users">
        		<div id="wrap">
        		<?php require 'printoutUsers.php'?>
        		</div>
        	</div>


        	<div id="chat">
        		<selection id="chatItem">
        			<p class="time">10:44</p>
        			<div class="user">
        			<div>
        			</div>
        			<p><?php echo $user['username'];?></p>
        			</div>
        			<p class="text"">ira Jonathana Iva, ponúkne výraznú a pravdepodobne inovatívnu zmenu prostredia, na ktoré sme z mobilných jablčných zariadení zvyknutí, aj naďalej sa na internete objavujú rôzne videá a obrázky</p>
        		</selection>
        	</div>
        	<div id="textArea">
        		<div class="textArea">
						<input type="text" name="lastName" value="...">	
				</div>
				<div class="formularButton">
						<input class="buttonSend" type="submit" name="send" value="Send">
				</div>
        		
        	</div>
        </div>
          <script src="js.js"></script>
          <script>loadService()</script>		
</body>

</html>