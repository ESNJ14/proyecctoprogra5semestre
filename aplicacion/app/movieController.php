<?php

if (!isset($_SESSION)) {
	session_start();
}

include "connectionController.php";

if (isset($_POST['action'])) {
	
	
	switch ($_POST['action']) {
		case 'store':
			
			$title = strip_tags($_POST['title']);
			$description = strip_tags($_POST['description']);
			$minutes = strip_tags($_POST['minutes']);
			$clasification = strip_tags($_POST['clasification']);
			$category_id = strip_tags($_POST['category_id']);

			$movieController->store($title, $description, $minutes, $clasification, $category_id);

		break; 		
	}

}

class MovieController
{

	public function get()
	{
		
	}

	public function store($title,$description,$minutes, $clasification, $category_id)
	{
		$conn = connect();
		if ($conn->connect_error==false) {

			if ($title !="" && $description!="" && $minutes!="" && $clasification!="" && $category_id!="") {
				
				$target_patch = "../assets/img/movies";
				$new_file_name = $target_patch.basename($_FILES['cover']['name']);
				
				if (move_uploaded_file($_FILES['cover']['tmp_name'], $new_file_name)) {
					
					$query = "inser into movies(title,description,minutes,cover,clasification)values(?,?,?,?,?,?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('sisi')

					if($prepared_query->execute())
					{

					$_SESSION['success'] = "el registro se ha guardado correctamente,category_id";

					header("Location:". $_SERVER['HTTP_REFERER'] );
					}else{

					$_SESSION['error'] = 'verifique los datos envíados';

					header("Location:". $_SERVER['HTTP_REFERER'] );
				}

				}else{

					$_SESSION['error'] = 'verifique los datos envíados';

					header("Location:". $_SERVER['HTTP_REFERER'] );
				}

			}else{

				$_SESSION['error'] = 'verifique la información del formulario';

				header("Location:". $_SERVER['HTTP_REFERER'] );
			}

		}else{

			$_SESSION['error'] = 'verifique la conexión a la base de datos';

			header("Location:". $_SERVER['HTTP_REFERER'] );
		}
	}
}

?>