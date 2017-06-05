<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>
<link href="Style6.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="FormValidation.js"></script>
<script type="text/javascript">
function validate(form) {
var firstname = form.FirstName.value;
var lastname = form.LastName.value;
var email = form.Email.value;
var errors = [];

if (!reName.test(firstname)) {
errors[errors.length] = "Please enter a valid first name.";
}

if (!reName.test(lastname)) {
errors[errors.length] = "Please enter a valid last name."; 
}

if (!reEmail.test(email)) {
errors[errors.length] = "Please enter a valid email address."; 
}
	
if (errors.length > 0) {
		reportErrors(errors);
		return false;
		}
	return true;
}
	
function reportErrors(errors){
	var msg = "There were some problems...\n";
	for (var i = 0; i<errors.length; i++) {
		var numError = i + 1;
		msg += "\n" + numError + ". " + errors[i];
	}
	alert(msg);
}
</script>
	</head>
<body>
<header>
<?php include 'Header.php';
?>
</header>
<h1 id='title'>Connect With Sandy's Pet Shop</h1>
<div id='wrapper'>
   <div id="contact">
     <img src="turtles.jpg" alt="turles" class="center">
         <p>We would love to hear from you!  Feel free to reach out and let us know if there is anything we can do for you and your pet.</p>
	<div id="form-messages"></div>
       <form id="wrap2" method="post" action="email.php" onsubmit="return validate(this);">
         <table>
	       <tr>
  	         <td>First Name:</td> 
			 <td><input type="text" name="FirstName" id="FirstName" size="20" maxlength="30"></td>
		   </tr>
  	       
  	       <tr>
  	         <td>Last Name:</td> 
  	         <td><input type="text" name="LastName" id="LastName" size="20" maxlength="30"></td>
		   </tr> 
 	         
 	       <tr>  	    				    			
  	         <td>Email Address:</td> 
  	         <td><input type="text" name="Email" id="Email" size="25" maxlength="35"></td>
		   </tr>
 	         
 	       <tr>  
  	         <td>Message:</td>
  	         <td><textarea name="Message" id="Message" cols="30" rows="3" 
  	         onblur="checkTextArea(this.value,100);"></textarea></td>
  	       </tr>
 	         
 	       <tr>
			   <td><input type="submit" value="Submit Request"></td>
	       </tr>
	       </table>
	    </form>
      </div>
   </div>
   <script src="jquery-2.1.0.min.js"></script>
   <script src="ajax.js"></script>
<footer>
	<?php include 'Footer.php';
?>
</footer>
	</body>
</html>