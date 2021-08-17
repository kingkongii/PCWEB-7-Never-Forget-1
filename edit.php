<?php
	require "dbconfig/config.php";
?>

<?php
	if(isset($_GET["name"])){
	$name = $_GET["name"];
	$query = "SELECT * FROM players WHERE PlayerName = '$name' ";
	$query_run = mysqli_query($con, $query);
	$row = mysqli_fetch_array($query_run);

	$playername = $row["PlayerName"];
	$playerdesc = $row["Description"];

	}else{

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
		<style>
			
		</style>
	</head>
	<body>
		<?php include("navbar.php"); ?>
		<?php
			$player = $desc = $oldplayer = "";
			if(isset($_POST["upload"])){
				$oldplayer = $_GET["name"];
				$player = $_POST["player"];
				$desc = $_POST["description"];
				$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

				$query = "UPDATE players SET PlayerName = '$player', Description = '$desc', Image = '$file' WHERE PlayerName = '$oldplayer'";
				$query_run = mysqli_query($con, $query);

				if($query_run){
					echo "<script> alert('Memory updated');
					location.href = 'edit.php';
					</script>";
				}
			}
		?>

		<div class = "container">
			<div class = "row">
				<div class = "col-3" id="pname">
					<h2>Memories</h2>
					<br>
					<?php
						$query = "SELECT PlayerName FROM players";
						$result = mysqli_query($con, $query);
						while($row = mysqli_fetch_array($result)){
							$name = $row['PlayerName'];
							echo "<h4><a href='edit.php?name=$name'>  $name <br> </a></h4>";
						}
					?>
				</div>
				<div class = "col-9">
					<?php
					if(isset($_GET["name"])){
						$name = $_GET["name"];
						echo '<form method = "post" enctype="multipart/form-data" action = "';
						echo htmlspecialchars("edit.php?name=$name");
						echo '">';
						echo '
						<h2>Memory</h2>
						<input class="player" name="player" value="'.$playername.'"">
						<h2>Description</h2>
						<textarea class="desc" name="description">'.$playerdesc.'</textarea>
						<input type="file" name="image" required>
						<input type="submit" value="Submit" name="upload">
						</form>';
					}
					else{
						echo '<h2>Choose a memory to edit!</h2>';
					}
					?>
					
				</div>
			</div>
		</div>

	</body>
</html>