<?php 
	
	$errors = '';

	$db=mysqli_connect('localhost','root','','todo');
	if (isset($_POST['submit'])) {
		$task = $_POST['task'];
		if(empty($task)){
			$errors = "you must fill in the task";
		}else{
			$sql = "INSERT INTO tasks(task) VALUES ('$task')";
			mysqli_query($db , $sql);
			header('location:index.php');
		}
	}

	//delet the  task

		if (isset($_GET['del_task'])) {
			$id = $_GET['del_task'];
			mysqli_query($db ,"DELETE FROM 	tasks WHERE id=$id");
			header('location:index.php');
		}

	$tasks = mysqli_query($db , "SELECT *  FROM tasks");
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>todo list application with php and mysql</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2>todo list application with php and my sql</h2>
	</div>
	<form method="POST" action="index.php">
		<?php if(isset($errors)){ ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" class="add_btn" name="submit">Add task</button>	
		
	</form>

	<table>
		<thead>
			<tr>
				<th>N</th>
				<th>Task</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($tasks)) {?>
				
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td class="task"><?php echo $row['task']; ?></td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'];?>">x</a>
				</td>
			</tr

			<?php } ?>
			
		</tbody>
	</table>
</body>
</html>