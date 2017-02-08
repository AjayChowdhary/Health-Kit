
<!doctype html>
<html>

<head>

<title> REGISTRATIONS OF PATIENTS</title>
<link rel="stylesheet" type="text/css" href="mystyle.css"/>
<style>
.error {color: #FF0000;}
</style>
</head>

<body>


<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $numberErr =$passwordErr =$DOBErr=$addressErr=$licenceErr =$degreeErr=$fieldErr=$placeErr=$officenoErr="";

$name = $email = $gender = $number =$password = $DOB = $address = $licence = $degree = $field = $place = $officeno = "";

echo $c;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";

  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";

  }
  }

  if (empty($_POST["emailid"])) {
    $emailErr = "Email is required";

  }


                             $passwordErr = "PASSWORD is required";
  }

  if (empty($_POST["address"])) {
    $addressErr = "ADDRESS is required";

  }

  if (empty($_POST["gender"])) {

   $genderErr = "Gender is required";
  } else {

    $gender = test_input($_POST["gender"]);
        }

}

function test_input($data) {
  $data = trim($data);

  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<center>
<h1> REGISTRATIONS OF PATIENTS</h1>
<div id="a">

<p><span class="error">* required field.</span></p>
<form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="fname">NAME:</label>
<span class="error">* <?php echo $nameErr;?></span>
<input type="text" id="fname" name="name" value="<?php echo $name;?>">

<label for="no">PHONE NUMBER</label>
<span class="error">* <?php echo $numberErr;?></span>
<input type="text" id="no" name="number" value="<?php echo $number;?>">

<label for="email">email</label>
     <span class="error">* <?php echo $emailErr;?></span>
<input type="text" id="email" name="emailid" value="<?php echo $emailid;?>">

<label for="passw">PASSWORD</label>
<span class="error">* <?php echo $passwordErr;?></span>
<input type="password" id="passw" name="password" value="<?php echo $password;?>">

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
 <span class="error">* <?php echo $addressErr;?></span>
<input type="textarea" id="addres" name="address" value="<?php echo $address; ?>"/>

  <label for="else">ANY MEDICAL CONDITONS</label>
  <span class="error">* <?php echo $addressErr;?></span>
<input type="textarea" id="else" name="medical_conditions" value="<?php echo $medical_conditions; ?>"/>

<input type="submit" value="submit"/>
</form>
</div>
</center>
<?php


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
$sql2="INSERT INTO personuser VALUES ('$_POST[name]','$_POST[emailid]','$_POST[password]')";
$sql = "INSERT INTO patients VALUES ('$_POST[name]', '$_POST[password]', '$_POST[number]', '$_POST[age]', '$_POST[blood]', '$_POST[address]', '$_POST[emailid]', '$_POS$

if ($conn->query($sql) === TRUE && $conn->query($sql2) == TRUE) {
    $c= "New record created successfully";

} else {
    $c= "Error: " . $sql . "<br>" . $conn->error;
$sql2="INSERT INTO personuser VALUES ('$_POST[name]','$_POST[emailid]','$_POST[password]')";
$sql = "INSERT INTO patients VALUES ('$_POST[name]', '$_POST[password]', '$_POST[number]', '$_POST[age]', '$_POST[blood]', '$_POST[address]', '$_POST[emailid]', '$_POS$

if ($conn->query($sql) === TRUE && $conn->query($sql2) == TRUE) {
    $c= "New record created successfully";

} else {
    $c= "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

        die();



//patients (NAME text,PASSWORD text,NUMBER text,AGE text,BLOOD text,ADDRESS text,EMAIL text,DOB text,GENDER text,MEDICAl_CONDITIONS text);


?>

</body>
</html>


