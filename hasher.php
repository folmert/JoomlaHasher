<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Joomla Hasher</title>
	<style>
		body {
			text-align:center;
			font-family:Verdana;

		}

		input {
			display:block;
			margin:20px auto;
			width:200px;
			padding:5px 10px;
		}

		input[type=submit] {
			width:auto;
			padding:10px 40px;
		}
	</style>
</head>
<body>

	<h1>Joomla Hasher [Portable]</h1>


	<form action="#" method="POST">	

		<input type='text' class='username' name='username' placeholder='username' required autofocus onfocus="this.value = this.value;"
		<?php if(count($_POST)>0) { echo "value=".$_POST['username']; } ?> 
		>

		<input type="text" name='plain' class='plain' placeholder='password' required
		<?php if(count($_POST)>0) { echo "value=".$_POST['plain']; } ?> 
		>

		<input type='submit' class='hash' value='change password' >

	</form>


	<?php

	if(count($_POST)>0) {

		define( '_JEXEC', 1 );
		define('JPATH_BASE', "." );
		define( 'DS', DIRECTORY_SEPARATOR );


		if(file_exists( __DIR__.DS.'configuration.php' )
			&& file_exists( JPATH_BASE .DS.'includes'.DS.'defines.php' )
			&& file_exists( JPATH_BASE .DS.'includes'.DS.'framework.php' )) 
		{

			require_once ( __DIR__.DS.'configuration.php' );
			require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
			require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );


			$mainframe =& JFactory::getApplication('site');
			$mainframe->initialise();   
			ini_set('default_charset', 'utf-8');


			error_reporting(E_ALL ^ E_NOTICE);

			$password=$_POST['plain'];

			jimport('joomla.user.helper');
			$userPassHashed = JUserHelper::hashPassword($password);

			$username = $_POST['username'];

			$host = JFactory::getConfig()["host"];
			$user = JFactory::getConfig()["user"];
			$dbPass = JFactory::getConfig()["password"];
			$dbName = JFactory::getConfig()["db"];
			$dbPrefix = JFactory::getConfig()["dbprefix"];

			$mysqli = new mysqli($host, $user, $dbPass, $dbName);

			if ($mysqli) {
				echo '<br><br>Joomla directory recognized. Connection OK.';
			}
			else {
				die('<br><br>Connection error: ' . mysql_error());
			}

			$sql = "SELECT username FROM ".$dbPrefix."users WHERE username='".$username."';";



			if($mysqli->query($sql)->num_rows==0) {
				echo "<br><br>Couldn't find anyone registered under username: $username";
			}
			else {
				$sql = "UPDATE ".$dbPrefix."users SET password='".$userPassHashed."' WHERE username='".$username."';";

				echo "<br><br>SQL query: <pre>".$sql."</pre>";


				if ($mysqli->query($sql)) {
					echo "<br><br>SQL OK. Password changed.";
					return true;
				}
				else {
					echo "<br><br>SQL error: ".$mysqli->error;
					echo "<br>Password not changed.";
					return false;
				}


				$mysqli->close();
			}


		}
		else {
			echo "This is not a Joomla directory! hasher.php must be run directly from main Joomla directory.";
		}




	}

	?>



</body>
</html>