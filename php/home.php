<html>
<style>

img {
    image-orientation: from-image;
}
</style>
<?php
$properties = (parse_ini_file("properties.ini"));
$servername = $properties['servername'];
$username = $properties['username'];
$password = $properties['password'];
$currentUSer = "deepika";
// Create connection
$conn = new mysqli($servername, $username, $password);

$curUSer = "SELECT * FROM dating.users where username = '$currentUSer';";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query($curUSer);

echo "<div class='row'>";
$currPreference="";
$currentGender="";

if ($result->num_rows > 0) {
	 while($row = $result->fetch_assoc()) {
		 $currPreference = $row["preference"];
		 $currentGender=$row["sex"];
	 }
	
}
$targetGender = $currentGender;
$targetPreference = $currPreference;
if($currPreference != $currentGender){
	$targetGender = $currPreference;
	$targetPreference = $currentGender;
}

	$sql = "SELECT * FROM dating.users where preference = '$targetPreference' and sex = '$targetGender'  ;";

$result = $conn->query($sql);
$rowcount = 0;
$collumnCount =0;
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
		if($collumnCount == 0)
			echo "<div class='column'>";
		$imgname = $row["username"];
		$age = $row['age'];
		$name = $row['firstname'] . "($age)";
		echo "<div><img src='..\userimgs\\$imgname.jpg' ></br>$name</div>";
		$collumnCount = $collumnCount+ 1;
		if($collumnCount ==8){
			$collumnCount =0;
			echo "</div>";
		}
    }
} else {
    echo "0 results";
}
echo "</div>";
die();
function addHeightFilter(){
	
}
function addAthinicityFilter(){
	
}

?>



</html>












