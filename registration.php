
<?php
$nameErr = $passwordErr = $emailErr = $numberErr = $addressErr = $birthErr ="";
$users = $password = $email = $number = $address = $birth ="";

	  /*$name     = $_POST["name"];
	  $password = $_POST["password"];
	  $email    = $_POST["email"];
	  $website  = $_POST["website"];
	  $comment  = $_POST["comment"];
	  $gender   = $_POST["gender"];*/
	  function test_input($data)
	  {
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	  }

	  if($_SERVER["REQUEST_METHOD"] == "POST")
	  {
	    if(empty($_POST["users"]))
	    {
	      $nameErr = "";
	    }
	    else
	    {
	      $users = test_input($_POST["users"]);
	      if(!preg_match("/^[a-zA-Z,-.]*$/",$users))
	      {
	        $nameErr = "only letters are allowed";
	      }
	    }

	    if(empty($_POST["password"]))
	    {
	      $passwordErr = "password is required";
	    }
	    else
	    {
	      $password = test_input($_POST["password"]);
	    }

	    if(empty($_POST["email"]))
	    {
	      $emailErr = "";
	    }
	    else
	    {
	      $email = test_input($_POST["email"]);

	      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	      {
	        $emailErr = "invalid email format";
	      }
	    }

	    if(empty($_POST["number"]))
	    {
	      $numberErr = "";
	    }
	    else
	    {
	      $number = test_input($_POST["number"]);
	    }
// i had to put this part in comments coz it interfered with
// the name part:
			/*if(empty($_POST["address"]))
		 {
			 $nameErr = "";
		 }
		 else
		 {
			 $address = test_input($_POST["address"]);
			 if (!preg_match("/^[a-zA-Z,-.]*$/",$address))
			 {
				 $addressErr = "only letters and white space allowed";
			 }
		 }*/

	    if(empty($_POST["birth"]))
	    {
	      $birth = "birth day is required";
	    }
	    else
	    {
	      $birth = test_input($_POST["birth"]);
	    }
	  }
?>
<html>
<head>
	<title> REGISTRATION</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<style>.error{color:#FF0000;}</style>
</head>
<body>
<div id="reg">
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
		method="POST">
		<fieldset>
			<legend>Registration Form</legend>
			<p>
			<label >Username</label><br>
			<input type="text" id="user" name="users" size="35%"
			 value="<?php echo $users;?>" required/>
		</p>
		<span class ="error"><?php echo $nameErr;?></span>
		<p >
			<label >Password</label><br>
			<input type="password" name="passd" size="35%"
			 required maxlength="16" />
		</p>
		<p >
			<label >Email</label><br>
			<input type="email" id="pass" name="email" size="35%"
			value="<?php echo $email;?>" required />
		</p>
		<span class = "error"><?php echo $emailErr;?></span>
		<p >
			<label >Phone Number</label><br>
			<input type="Phone" name="number" size="35%"
			 placeholder= "+263 000 000 000"
			 pattern="\(?\d{4}\)?[-.\s]?\d{3}[-.\s]?\d{3}[-.\s]?"/>
		</p>
		<span class = "error"><?php echo $numberErr;?></span>
		<p >
			<label >Physical Address</label><br>
			<input type="text" name="address" size="35%" />
		</p>
		<span class ="error"><?php echo $addressErr;?></span>
		<p id="dob">
			<label >Date of Birth</label><br>
			<input type="Date" name="birth" size="35%" placeholder="mm-dd-year"
			required/>
		</p>

		<p>
			<input type="submit" id="buttons" value="Register" align="center" />
		</p>
		</fieldset>
		<?php
session_start();

//connection with the server and selection of database
$conn = mysqli_connect("localhost", "root", "", "bryan") or die(mysqli_error());

    if (!$conn) {
	echo "Failed to connect<br>";
}

//get values passed from form in register.php file
$username =$_POST["users"];
$password = $_POST["passd"];
$email = $_POST["email"];
$phone_number = $_POST["number"];
$physical_address = $_POST["address"];
$date_of_birth = $_POST["birth"];

// query database for user
$s = (" select * from users where username = '$username'"); //"&& password = '$password'  ");
$result = mysqli_query($conn, $s);
$row = mysqli_fetch_array($result);

//$num = mysqli_num_rows($row);

if (!$row == $username)
{
	$reg = "insert into users(username,password,email,phone_number,physical_address,date_of_birth)
  values('$username','$password','$email','$phone_number','$physical_address','$date_of_birth')";

 	    (mysqli_query($conn, $reg));
 	    echo "Registration Succesfull <br> Thank you $username for joining us ";

}else {
	    echo "username already taken<br>";
	    exit();
      }

/*$username_error = "";
	if(empty($_POST["users"]))
	{
		$username_error = "username required";
	} else {
		$username = test_input($_POST['users']);
		if (!preg_match("/^[a-zA-Z]*$/", $username)) {
			$username_error = "only letters and white space allowed";
		}
	}

function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if($username=='')
{
	echo "<script>alert('Please enter name')</script>";
	exit();
}
if($password=='')
{
	echo "<script>alert('Please enter password')</script>";
	exit();
}

*/
 ?>

	</form>
</div>
</body>
</html>
