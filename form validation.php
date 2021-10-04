    <!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
  
<?php
/* define variables and set to empty values */
$nameErr = $emailError = $mobileError=$radioError=$dropDownError = $dateError ="";
$name = $email = $mobile=$date=$radio=$dropDown =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  else {

    $name = test_input($_POST["name"]);
    /* check if name only contains letters and whitespace */
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
    // has two words
    $hasSpace = 0;
    for($x=0;$x < strlen($name)-1;$x++){
    
      if($name[$x] == ' '){
        $hasSpace =0;
        break;
      }else{
        $hasSpace = 1 ;
      }
    }
    
    
    if($hasSpace ==1){
      $nameErr = "Only one word";
    }
    
  }
  // if (empty($_POST["name"])) {
  //   $mobileError = "Name is required";
  // } else {
  //   $mobile = test_input($_POST["mobile"]);
  //   /* check if name only contains letters and whitespace */
  //   if (!preg_match('/^[0-9]{10}+$/', $mobile)) {
  //     $mobileError = "10 digit Number"; 
  //   }
  // }
  if (empty($_POST["email"])) {
    $emailError = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    /* check if e-mail address is well-formed */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailError = "Invalid email format"; 
    }
  }

  if (empty($_POST["date"])) {
    $dateError = "date is required";
  } else {
    $date = test_input($_POST["date"]);
    
    /* check if e-mail address is well-formed */
    if (!preg_match('/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/', $date)) {
      $dateError = "Invalid date format"; 
    }
  }
  ////radio button check
  if(!isset($_POST['myrdo'])){ 
    $radioError = "No radio buttons were checked."; 
  } 

  if(!empty($_POST['list'])){ 
    $dropDown = test_input($_POST["list"]);
    if($dropDown == 'Select One'){
      $dropDownError = "No dropdown buttons were checked."; 
    } 
  } 


}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <!-- Mobile: <input type="text" name="mobile" value="<?php echo $mobile;?>">
  <span class="error">* <?php echo $mobileError;?></span>
  <br><br> -->
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailError;?></span>
  <br><br>
  Date: <input type="text" name="date" value="<?php echo $date;?>">
  <span class="error">* <?php echo $dateError;?></span>
  <br><br>

  <input type="radio" name="myrdo" value="<?php echo $radio;?>">
  Male  
  <input type="radio" name="myrdo" value="<?php echo $radio;?>">
  Female 
    <input type="radio" name="myrdo" value="<?php echo $radio;?>">
   Other <span class="error"><?php echo $radioError;?>
    <br />
  <h4 style="color:black">Blood Group</h4>
  <select name="list" value="<?php echo $dropDown;?>" >
         <option>Select One</option>
         <option>A+</option>
         <option>B+</option>
         <option>AB+</option>
  </select> <span class="error"><?php echo $dropDownError;?>

  <input type="submit" name="submit" value="Submit">  
</form>
</body>
</html>
    
