<?php
    session_start();
    if (isset($_COOKIE["login"]))
    {
    	 $_SESSION['user_id'] = $_COOKIE["login"];
    	header('Location:service.php');
    }
    if(isset($_POST['sendLogin']))
    {  
        if(trim($_POST['usernameLogin']) != null && trim($_POST['passwordLogin']) != null)
        {
            mysql_connect('localhost','root', null);

            mysql_select_db('messaging') or die('Could not connect: ' . mysql_error());
            $username = $_POST['usernameLogin'];
            $password = md5($_POST['passwordLogin']);
            $q = "SELECT * FROM users
                  WHERE username = '$username'
                  AND password = '$password';";
            $result = mysql_query($q);
            
            if($user = mysql_fetch_assoc($result))
            {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_firstname'] = $user['firstname'];
                $_SESSION['user_lastname'] = $user['lastname']; 
                
                setcookie('login',$user['id'], time()+86400);
                
                header('Location:service.php');     
            }
            else
            {
                $logError = 'Zadali jste špatné jméno nebo heslo';
            }
        }
        else {
           $logError = 'Špatně vyplněné';
    	}
    }
    else {
           $logError = '';
    }
    
    if(isset($_POST['sendReg']))
    {
        if($_POST['usernameReg'] != null && $_POST['passwordReg'] != null
        && $_POST['usernameReg'] != 'Username' && $_POST['passwordReg'] != 'Password'
        && $_POST['passwordCheckReg'] != null && $_POST['emailReg'] != null
        && $_POST['passwordCheckReg'] != 'Password' && $_POST['emailReg'] != 'E-mail' 
        && $_POST['firstNameReg'] != null && $_POST['lastNameReg'] != null
        && $_POST['firstNameReg'] != 'First name' && $_POST['lastNameReg'] != 'Last name')
        {
            if($_POST['passwordReg'] == $_POST['passwordCheckReg'])
            {
               mysql_connect('localhost','root', null) or
                die('Cannot connect to database');
                
                mysql_select_db('messaging') or 
                die('Cannot select to database');
                
                $q = "INSERT INTO users(username,password,email,firstname,lastname,regdate)
                      VALUES('".mysql_real_escape_string($_POST['usernameReg'])."',
                             '".md5($_POST['passwordReg'])."',
                             '".mysql_real_escape_string($_POST['emailReg'])."',
                             '".mysql_real_escape_string($_POST['firstNameReg'])."',
                             '".mysql_real_escape_string($_POST['lastNameReg'])."',
                             '".date('Y-m-d H:i:s')."');";
                if(mysql_query($q))
                    {
                    $regError = "Jsi uspěšně registrován. Nyní se přihlašte";
                    }
                    else {
                    	$regError = "Registrace neuspěšná. (databáze)";
                    }
            }
        }
        else {
        	$regError = "Registrace neuspěšná, opravte a doplnte udaje.";
        }
    }
    else
    {
    	$regError = "";
    }
  ?>
<!DOCTYPE HTML>

<html>

<head>
        <title>My messaging</title>
 		<meta name="keywords" content="     " />
  		<meta name="description" content="    " />
  		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  		<link media="screen" href="css/styleIndex.css" type="text/css" rel="stylesheet"/>
  		<script src="js/jquery-1.7.2.min.js"></script>
</head>

<body>
        <header>
        		<a href="/"><h1 id="logo">
				My Messaging
				</h1></a>
                
        </header>
    	<nav>
        </nav>
        <div id="mainLog">
        	<div id="login">
        		<h2>Přihlašte se</h2>
        		<section id="formular">
                	<form action="#" method="post">
                		<div class="formularItem">
							<input type="text" name="usernameLogin" onblur="this.value=(this.value=='') ? 'Username' : this.value;" onfocus="this.value=(this.value=='Username') ? '' : this.value;" value="Username">
						</div>
						<div class="formularItem">
							<input type="password" name="passwordLogin" onblur="this.value=(this.value=='') ? 'Password' : this.value;" onfocus="this.value=(this.value=='Password') ? '' : this.value;" value="Password">	
						</div>
						<div class="formularItem">
							<input class="buttonSend" type="submit" name="sendLogin" value="Login">
						</div>
					</form>
					<p> <?php echo $logError ?></p
				</section>
				<a href="#registration"><p id="toRegistration">or Registration</p></a>
			</div>
            <div id="registration">
				<section id="formular">
                	<form action="#" method="post">
                		<div class="formularItem">
							<input type="text" name="usernameReg" value="Username">
						</div>
						<div class="formularItem">
							<input type="password" name="passwordReg" value="Password">	
						</div>
						<div class="formularItem">
							<input type="password" name="passwordCheckReg" value="Password">	
						</div>
						<div class="formularItem">
							<input type="text" name="emailReg" value="E-mail">	
						</div>
						<div class="formularItem">
							<input type="text" name="firstNameReg" value="First name">	
						</div>
						<div class="formularItem">
							<input type="text" name="lastNameReg" value="Last name">	
						</div>
						<div class="formularItem">
							<input class="buttonSend" type="submit" name="sendReg" value="Register">
						</div>
					</form>
					<p> <?php echo $regError ?></p>
				</section>
			</div>
        </div>

        <footer>
                <p>Copyright 2013</p>
        </footer>
        <script src="js.js"></script>
        <script>loadIndex()</script>	
</body>

</html>