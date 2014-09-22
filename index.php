<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Joomla Hasher</title>
	<link rel="stylesheet" href="main.css">

	<script src='app.js'></script>
</head>
<body>

<h1>Joomla Hasher [Online]</h1>

	<form action="hash.php" method="POST">	

		<input type="text" placeholder='password' name='input' class='input' autofocus required>

		<input type='submit' class='btn' value='hash!'>

	</form>

	<input type='text' placeholder='hashed password' class='output' readonly>

<p>
	Still too lazy? Download <a href="hasher.php" download="hasher.php">hasher.php</a> and run SQL directly from main Joomla directory.
</p>


</body>
</html>