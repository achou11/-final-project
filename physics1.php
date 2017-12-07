<?php
	ob_start();
	session_start();
	require_once '../../dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: ../../index.php");
		exit;
	}


	// select loggedin users detail
	$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);
	$userAdmin = $userRow['userAdmin'];
	
	if($userAdmin == 1){
	
	  header("Location: ../../admin.php");
	  exit;
	}
		
	$leadersQuery = mysqli_query($conn, "SELECT userId, userName, userPoints FROM users WHERE userAdmin NOT IN (SELECT userAdmin FROM users WHERE userAdmin = 1) ORDER BY userPoints DESC LIMIT 10");
	$tempFile = basename(__FILE__, '.php');
	$fileQuery = mysqli_query($conn, "SELECT * FROM files WHERE fileName = '". $tempFile."'");
	$fileRow=mysqli_fetch_array($fileQuery);
	
//	$leadersRow=mysqli_fetch_array($leadersQuery);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<title>Welcome <?php echo $userRow['userName']; ?>!</title>
<link rel="stylesheet" href="../../css/master.css" type="text/css"  />
<script>
  function updateUserScore(value) {
    var request = new XMLHttpRequest();
    var user_id = "<?php echo $userRow['userId']; ?>";
    request.open("POST", "updateScore.php?q="+value+"&id="+user_id);
    console.log("Request sent!");
    request.send();
}


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>

	<nav id="nav">
		<ul id="navigation">
			<li><a href="../../home.php" class="first">Home</a></li>
			<li><a href="#">Skills &raquo;</a>
				<ul>
					<li><a href="#">Math</a>
						<ul>
							<li><a href="../math/math1.php" >math1</a></li>
							<li><a href="../math/math2.php" >math2</a></li>
						</ul>
					</li>
					<li><a href="#">Physics</a>
						<ul>
							<li><a href="physics1.php">physics1</a></li>
							<li><a href="#">Physics#2</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a href="#">Score: <?php echo $userRow['userPoints']?></a>
				<ul>
					<li><a href="#">Stats</a></li>
					<li><a href="#">Leaderboard</a></li>
				</ul>
			</li>
			<li><a href="#" class="last">GUILD: <?php echo $userRow['userGuild'] ?></a></li>
			
			<li style = "float: right"><a href="../../logout.php?logout">Sign Out</a></li>
		</ul>
	</nav>

</body>
<!--
<body>
  <div>
	<ul>
	  <li><a class="active" href="home.php">Home</a></li>
	  <li><a href="guilds.php">Guilds</a></li>
	  <li><a href="quests.php">Quests</a></li>
	  <li><a href="#">Score: <?php echo $userRow['userPoints'] ?></a></li>
	  <li style = "float: right"><a href="logout.php?logout">Sign Out</a></li>
	</ul>
	


  </div>

</body>
-->

<center><iframe src = <?php echo $fileRow['fileName'] ?>.pdf width="80%" height="500">
			<p>Could not find file</p>
		</iframe></center>
<table>
    <th><tr><td>File Name</td><td>File Difficulty</td></tr></th>
    <tr><td><?php echo $fileRow['fileName'] ?></td><td><?php echo $fileRow['fileDifficulty'] ?></td></tr>
</table>




<?php ob_end_flush(); ?>