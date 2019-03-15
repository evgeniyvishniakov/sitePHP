<?php 
include_once "connection.php";
include_once "function.php";

if (!empty($_GET['del'])) {
	$delTask = $_GET['del'];
	$query = "DELETE FROM tasks WHERE id = $delTask";
		$result = mysqli_query($link, $query) or die( mysqli_error($link) );
}

if (!empty($_POST['task'])) {
	$task = $_POST['task'];
	
	if (FunctionCheckTask($task)) {

		$query = "INSERT INTO tasks (name) VALUE ('$task')";
		$result = mysqli_query($link, $query) or die( mysqli_error($link) );
		unset($task);
	}else {
		$err .= 'Неверно введы данные';
	}

}
 		


?>

<!DOCTYPE html>
<html>
<head>
<title>Todolist</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    
    <form method="post">
        <input class="text" type="text" name="task" >
        <input class="sub" type="submit" name="ok" value="Enter">
    </form>
    <?php echo $err;?>
    <ul class="todo_list"> 
	<?php 
		$query = "SELECT * FROM tasks "; 
		$result = mysqli_query($link, $query) or die( mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

		foreach ($data as $key => $value) {	 
	?>
		<li> <a href="?del=<?php echo $value['id'];?>"><i class="far fa-trash-alt"></a></i><label><input type="checkbox"><span><?php echo $value['name']; ?></span></label></li>
		
    <?php }?>
    </ul>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="main.js"></script>
</body>
</html>

