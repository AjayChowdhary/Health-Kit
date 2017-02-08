<!doctype html>
<html>

<head>

<title> REGISTRATIONS OF DOCTORS</title>
<link rel="stylesheet" type="text/css" href="mystyle.css"/>
<style>
.error {color: #FF0000;}
</style>
</head>

<body>

<center>
<h1> REGISTRATIONS OF DOCTORS</h1>
<div id="a">

<p><span class="error">* required field.</span></p>
<form  method="POST" action= >
<label for="fname">NAME:</label>
<input type="text" id="fname" name="name" value="<?php echo $name;?>">
 <span class="error">* <?php echo $nameErr;?></span>
<label for="no">PHONE NUMBER</label>
<input type="text" id="no" name="number" value="<?php echo $number;?>">
 <span class="error">* <?php echo $numberErr;?></span>
<label for="email">email</label>
<input type="text" id="email" name="emailid" value="<?php echo $emailid;?>">
 <span class="error">* <?php echo $emailErr;?></span>
<label for="passw">PASSWORD</label>
<input type="password" id="passw" name="password" value="<?php echo $password;?>">
 <span class="error">* <?php echo $passwordErr;?></span>
<label for="agee">AGE</label>
<input type="text" id="agee" name="age" value="<?php echo $age;?>"/>
<label for="bloood">BLOOD GROUP:</label>
<select  id="bloood" name="blood" value="<?php echo $blood;?>">
 <option value="A+">A+</option>
 <option value="B+">B+</option>
 <option value="AB+">AB+</option>
 <option value="O+">O+</option>
 <option value="O-">O-</option>
                               
 <option value="AB-">AB-</option>
 <option value="B-">B-</option>
 <option value="A-">A-</option>
 </select>
<br><br>
<label for="dob">DATE OF BIRTH</label>
<input type="text" id="dob" name="DOB" value="<?php echo $DOB;?>">
 <span class="error">* <?php echo $DOBErr;?></span>
<br>
 Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
 <label for="addres">ADDRESS</label>
<input type="textarea" id="addres" name="address" value="<?php echo $address; ?>"/>
  <span class="error">* <?php echo $addressErr;?></span>
 <br/>
 <br/>

 <br/>
<br/>
 <center><label>PROFFESIONALS DETAILS</label></center>
 <br/>
 <br/>
 <br/>
 <label for="licence_no">LICENCE NUMBER</label>
<input type="text" id="licence_no" name="licence" value="<?php echo $licence;?>">
 <span class="error">* <?php echo $licenceErr;?></span>
 <label for="degre">PROFFESIONAL DEGREE</label>
<input type="text" id="degre" name="degree" value="<?php echo $degree;?>">
 <span class="error">* <?php echo $degreeErr;?></span>
 <label for="specialized_field">SPECIALIZED FIELD</label>
<input type="text" id="specialized_field" name="field" value="<?php echo $field;?>">
  <span class="error">* <?php echo $fieldErr;?></span>
 <label for="practicing_place">PRACTICING PLACE</label>
<input type="text" id="practicing_place" name="place" value="<?php echo $place;?>"/>
  <span class="error">* <?php echo $placeErr;?></span>
 <label for="practicing_place_phoneno">OFFICE PHONE NUMBER</label>
<input type="text" id="practicing_place_phoneno" name="officeno" value="<?php echo $officeno;?>"/>
 <span class="error">* <?php echo $officenoErr;?></span>

<input type="submit" value="submit"/>
</form>
</div>
</center>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $numberErr =$passwordErr =$DOBErr=$addressErr=$licenceErr =$degreeErr=$fieldErr=$placeErr=$officenoErr="";

$name = $email = $gender = $number =$password = $DOB = $address = $licence = $degree = $field = $place = $officeno = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  }

  if (empty($_POST["emailid"])) {
    $emailErr = "Email is required";
  }



  if (empty($_POST["gender"])) {


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IOT";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql2="INSERT INTO usersperson VALUES ('$_POST[name]','$_POST[emailid]','$_POST[password]')";
$sql ="INSERT INTO doctor VALUES ('$_POST[name]', '$_POST[password]', '$_POST[number]', '$_POST[age]', '$_POST[blood]', '$_POST[address]', '$_POST[emailid]','$gender',$

if ($conn->query($sql) === TRUE && $conn->query($sql2) == TRUE) {
    echo "New record created successfully";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql2="INSERT INTO usersperson VALUES ('$_POST[name]','$_POST[emailid]','$_POST[password]')";
$sql ="INSERT INTO doctor VALUES ('$_POST[name]', '$_POST[password]', '$_POST[number]', '$_POST[age]', '$_POST[blood]', '$_POST[address]', '$_POST[emailid]','$gender',$

if ($conn->query($sql) === TRUE && $conn->query($sql2) == TRUE) {
    echo "New record created successfully";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

die();

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

</body>
</html>

