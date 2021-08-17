<?php
	require "dbconfig/config.php";
?>

<?php
	if(isset($_GET["name"])){
	$name = $_GET["name"];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>blog</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
		<script src="script.js"></script>

	</head>
	<body>
		<?php include("navbar.php"); ?>

		<div class = "container">
			<div class = "row">
				<div class = "col-3" id="pname">
					<h2>Memories</h2>
					
					<?php
						$name = "";
						if(isset($_POST["delete"])){
							$name = $_GET["name"];

							$query = "DELETE FROM players WHERE PlayerName = '$name'";
							$query_run = mysqli_query($con, $query);
							if($query_run){
								echo "<script> alert('Player deleted'); 
								location.href = 'index.php';
								</script>";
							}

						}
					?>
					<?php
						$query = "SELECT PlayerName FROM players";
						$result = mysqli_query($con, $query);
						while($row = mysqli_fetch_array($result)){
							$name = $row['PlayerName'];
							echo "<h4><a href='index.php?name=$name'> $name<br></a>
							</h4>";
						}
					?>
				</div>
				<div class = "col-5" id="mselect">
					<?php
						if(isset($_GET["name"])){
						$name = $_GET["name"];
						$query = "SELECT Description FROM players WHERE PlayerName = '$name' ";
						$query_run = mysqli_query($con, $query);
						$row = mysqli_fetch_array($query_run);
						$desc = $row['Description'];

						echo 
						"<h2>   $name</h2>
						<p>$desc<br></p>";
						}else{
							echo "<h3>Choose a memory!</h3>";
						}
					?>
				</div>
				<div class = "col-3" id="picpic">
				
		
				<?php
						if(isset($_GET["name"])){
						$name = $_GET["name"];
						$query = "SELECT Image FROM players WHERE PlayerName = '$name'";
						$query_run = mysqli_query($con, $query);
						$row = mysqli_fetch_array($query_run);

						echo '
						<form method= "post" action ="index.php?name='.$name.'" >
						<div class="btns">
						<input type="button" value="Hide Memory Pic" id="hidebtn">
						<p><p>
						<input type="submit" name="delete" value="Delete Memory">
						</div>
						<img id="hide" src="data:image/jpeg;base64,'.base64_encode($row['Image'] ).'" height="200" />
						<p><p>
						<button id="bounceButton" onclick="bounceMemory()">Say Hurray!!!</button>
						
						</form>';
						}
					?>
				</div>
			</div>
		</div>
	
	</body>
</html>

