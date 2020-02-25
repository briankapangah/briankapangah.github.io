 <?php
session_start();

//connection with the server and selection of database
$conn = mysqli_connect("localhost", "root", "", "bryan") or die(mysqli_error());

if (!$conn)
{
	echo "Failed to connect<br>";
}

//get values passed from form in login.php file
$username =$_POST["users"];
$password = $_POST["passd"];

// query database for user
$s = ("select * from users where username = '$username' && password = '$password' ");
$result = mysqli_query($conn, $s);
$row = mysqli_fetch_array($result);

if ($row['username'] == $username && $row['password'] == $password)
    {
    	echo "Login successful welcome ".$username;
    }
else
    {
	    echo "Failed to login<br> Please register first";
    }

echo "<br>";

/*if($result == TRUE){
	$success = "success";
	$_SESSION['success'] = $success;
	header("location: login.php");
}
/*if($username=='')
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
