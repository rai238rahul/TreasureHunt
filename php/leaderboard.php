
<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Drill Hunch </title>

      <link rel="stylesheet" href="css/style_leader.css">
  
</head>

<body>

  <h1> <span class="yellow">Drill Hunch </pan></h1>

<table class="container">
	<thead>
		<tr>
			<th><h1>RANK</h1></th>
			<th><h1>ROLL NUMBER</h1></th>
			<th><h1>SCORE</h1></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$sql = "SELECT * FROM LOGIN ORDER BY score DESC LIMIT 3";
	$result = mysqli_query($conn, $sql);
	$i=1;
	while($row = mysqli_fetch_assoc($result))
	{

		echo "<tr><td>".$i."</td><td>".$row['email']."</td><td>{$row['score']}</td></tr>";
		$i+=1;
	}
	?>	
	</tbody>
</table>
  
</body>

</html>