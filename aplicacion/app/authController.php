<?php 

include_once "app.php";
include_once "connectionController.php";

if(isset($_POST['action']))
{
	if(isset($_POST['token']) && $_POST['token']) == $_POST['token']))
	{
		$authController = new AuthController();

		switch ($_POST['action']) {
			case 'value':
				# code...
				break;
			
			default:
				# code...
				break;
		}

	}
	else
	{
		$_SESSION['error'] = 'verifique los datos envíados';

		header("Location:". $_SERVER['HTTP_REFERER'] );
	}


	$authController = new AuthController();

	switch ($_POST['action'])
	{
		case 'register':

			$name = strip_tags($_POST['name']);
			$email = strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);

			$authController->register($name,$email,$password);

		break;

		case 'login':

			$name = strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);

			$authController->register($email,$password);

		break;
		
		default:
			
		break;
	}
}


class AuthController
{
	public function register($name,$email,$password)
	{
		$conn = connect();
		
		if ($conn->connect_error) {

			if ($name!="" && $email!="" && $password!="")
			{
				$originalPassword=$password;
				$password = md5($password.'a0lh7as5f');


				$query = "insert into users (name,email,password) values(?,?,?)";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('sss',$name,$email,$password);

				if ($prepared_query->execute())
				{
					$this->acces($email,$originalPassword);

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

	public function access($email,$password)
	{
		$conn = connect();
		
		if ($conn->connect_error) {

			if ($name!="" && $email!="" && $password!="")
			{
				$originalPassword=$password;
				$password = md5($password.'a0lh7as5f');

				$query = "select * from users where email = ? and password = ?";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('ss',$name,$email,$password);

				if ($prepared_query->execute())
				{
					$results = $prepared_query->get_result();
					$user = $results->fetch_all(MYSQLI_ASSOC);

					if (count($user)>0)
					{
						$user = array_pop($user);

						$_SESSION['id']=$user['id']);
						$_SESSION['name']=$user['name']);
						$_SESSION['email']=$user['email']);

						header("Location:".BASE_PATH."categories");

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

	public function logout()
	{

	}

}



?>