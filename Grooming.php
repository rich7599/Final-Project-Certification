<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Grooming</title>
<link href="Style6.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="FormValidation.js"></script>
<script type="text/javascript" src="lib.js"></script>
<script type="text/javascript">

function validate(form) {
var firstname = form.FirstName.value;
var lastname = form.LastName.value;
var address = form.Address.value;
var city = form.City.value;
var state = form.State.value;
var zip = form.Zip.value;
var phone = form.PhoneNumber.value;
var petname = form.PetName.value;
var errors = [];

if (!reName.test(firstname)) {
errors[errors.length] = "Please enter a valid first name.";
}

if (!reName.test(lastname)) {
errors[errors.length] = "Please enter a valid last name."; 
}
	
if (!checkLength(address)) {
errors[errors.length] = "Please enter a valid street address.";
}

if (!reName.test(city)) {
errors[errors.length] = "Please enter a valid city.";
}
	
if (!reState.test(state)) {
errors[errors.length] = "Please enter a valid state.";
}
	
if (!reZipCode.test(zip)) {
errors[errors.length] = "Please enter a valid zip code.";
}
	
if (!rePhone.test(phone)) {
errors[errors.length] = "Please enter a valid phone number.";
}
	
if ( !checkSelect(form.PetType) ) {
errors[errors.length] = "Please select a valid pet type.";
}
	
if (!reName.test(petname)) {
errors[errors.length] = "Please enter a valid name for your pet.";
}
	
if (errors.length > 0) {
		reportErrors(errors);
		return false;
		}

	return true;
}
	
function checkSelect(select) {
	return (select.selectedIndex > 0);
}

	
function reportErrors(errors){
	var msg = "There were some problems...\n";
	for (var i = 0; i<errors.length; i++) {
		var numError = i + 1;
		msg += "\n" + numError + ". " + errors[i];
	}
	
	alert(msg);
}
	
function selChanged(sel,data,dependentSel) {
		var selection = sel.options[sel.selectedIndex].value;
		var arrOptions = data[selection];
		var opt;
		removeAllChildren(dependentSel);
		for (var i in arrOptions) {
			opt = new Option(arrOptions[i]);
			appendOptionToSelect(dependentSel,opt);
		}
	}
	
	observeEvent(window,"load",function() {
		var petTypes = {
			"Dog" : ["Beagle", "Boxer", "BullDog", "Collie", "Dachshund", "Doberman", "German Shepherd", "Golden Retriever", 
					 "Great Dane", "Labrador Retriever", "Pit Bull", "Poodle", "Shih Tzu", "Terrier", "Other"]
				};
		var type = document.getElementById("type");
		var breed = document.getElementById("breed");
		observeEvent(type,"change",function() {
			selChanged(type,petTypes,breed);
		});
	});
	
</script>

</head>
<body>
<header>
<?php include 'Header.php';
	?>
</header>
<h1 id='title'>Sandy's Pet Grooming</h1>
  <div id='wrapper'>
  	<div id='groombody'>
   	 <img src="DogAndCat.jpg" alt="dog and cat" class='center'>
  	  <p>We have the right people, products, and attention to detail to ensure your pet will look and feel its finest.</p>
 	     <div id='space'>
  	     <h2>Basic Dog Grooming Package From $29-$99.  Package includes:</h2>
  			<ul>
  				<li>Bath</li>
  				<li>Haircut</li>
  				<li>Nail trim</li>
  				<li>Ear clenaing</li>
  				<li>Cleaning of anal gland</li>
  			</ul>
		</div>	
		
		<div id='space'>
			<h2>Dog Grooming Plus Package From $40-$129.  Package includes:</h2>
  				<ul>
  					<li>Bath</li>
  					<li>Haircut</li>
  					<li>Nail trim</li>
  					<li>Ear clenaing</li>
  					<li>Cleaning of anal gland</li>
  					<li>Aromatherapy</li>
  					<li>Foot pad shaving</li>
  					<li>20-minute brushing</li>
   				</ul>
  	     </div>
  	    
  	    <div id='space'>
  	    	<h2>Basic Cat Grooming Package From $49-$79.  Package includes:</h2>
  	    	<ul>
  				<li>Bath</li>
  				<li>Haircut</li>
  				<li>Nail trim</li>
  				<li>Ear clenaing</li>
  			</ul>
  	    </div>
	    
  	    <div id='space'>
			<h2>Pretty Kitty Grooming Plus Package From $63-$140.  Package includes:</h2>
  				<ul>
  					<li>Bath</li>
  					<li>Haircut</li>
  					<li>Nail trim</li>
  					<li>Ear clenaing</li>
  					<li>Sanitary Trim</li>
  					<li>Aromatherapy</li>
  					<li>Bow</li>
  					<li>20-minute brushing</li>
   				</ul>
		</div>
	  </div>
	
    <?php
	 
	if (array_key_exists('Submitted',$_POST))		
	{
		$firstName = $_POST['FirstName'];
		$lastName = $_POST['LastName'];
		$address = $_POST['Address'];
		$city = $_POST['City'];
		$state = $_POST['State'];
		$zip = $_POST['Zip'];
		$phoneNumber = $_POST['PhoneNumber'];
		$email = $_POST['Email'];
		$petType = $_POST['PetType'];
		$breed = isset($_POST['Breed']) ? $_POST['Breed'] : '';		
		$petName = $_POST['PetName'];
		$neuteredOrSpayed = isset($_POST['NeuteredOrSpayed']);
		$petBirthday = $_POST['PetBirthday'];
		 
		
		@$db = new mysqli('localhost','root','pwdpwd','pet_shop');
	      if (mysqli_connect_errno())
			{
		echo 'Cannot connect to database: ' . mysqli_connect_error();
			}
	  
		
		$query = "INSERT INTO grooming (FirstName, LastName, Address, City, State, Zip, PhoneNumber, Email, PetType, Breed, PetName, NeuteredOrSpayed, PetBirthday)
		VALUES ('$firstName', '$lastName', '$address', '$city', '$state', '$zip', '$phoneNumber', '$email', '$petType', '$breed', '$petName', '$neuteredOrSpayed', '$petBirthday')";
		
		
		if (mysqli_query($db,$query)) 
			{
		echo 'Thank you!  We have received your grooming request and will contact you shortly for an appointment time.';
			}
	 	else
			{	
		echo 'Something went wrong.  Your request did not process.  Please try again.' . mysqli_error($db);;
			}
	 }
		?>
	
	   <form id='wrap1' method="post" enctype="multipart/form-data" onSubmit="return validate(this);">	
		       <input type="hidden" name="Submitted" value="true">
	    	    <h2>Schedule Your Pet's Next Grooming Appointment</h2> 
 	    	    <table>
  	    			<tr>
  	    			  <td>First Name (Required)</td> 
					  <td><input type="text" name="FirstName" size="20" maxlength="30"></td>
  	    			</tr>
  	    			<tr>
					  <td>Last Name (Required)</td> 
 	    			  <td><input type="text" name="LastName" size="20" maxlength="30"></td>
					</tr>
	    			<tr>
 	    			  <td>Address (Required)</td> 
 	    			  <td><input type="text" name="Address" size="30" maxlength="40"></td>		
					</tr>	
 	    			<tr>
  	    			  <td>City (Required)</td> 
  	    			  <td><input type="text" name="City" size="20" maxlength="30"></td>
  	    			</tr>	
  	    			<tr>
  	    			  <td>State (Required)</td> 
  	    			  <td><input type="text" name="State" size="2" maxlength="2"></td>
  	    			</tr>
  	    			<tr>
  	    			  <td>Zip Code (Required)</td> 
  	    			  <td><input type="text" name="Zip" size="10" maxlength="12"></td>
  	    			</tr>	
  	    			<tr>
  	    			  <td>Phone Number (Required)</td> 
  	    			  <td><input type="tel" name="PhoneNumber" size="13" maxlength="14"></td> 
  	    			</tr>
  	    			<tr>
  	    			  <td>Email (Optional)</td> 
  	    			  <td><input type="email" name="Email" size="25" maxlength="35"></td>
  	    			</tr>
  	    			<tr>
  	    			  <td>Type of Pet (Required)</td> 
  	    			  <td><select id="type" name="PetType">
  	    			      <option value="0">-Please Select-</option>
						  <option value="Dog">Dog</option>
						  <option value="Cat">Cat</option>
						  </select>
						  <label>Dog Breed</label>
						  <select id="breed" name="Breed"></select></td>
					</tr>
  	    			<tr>
  	    			  <td>Pet's Name (Required)</td> 
  	    			  <td><input type="text" name="PetName" size="20" maxlength="30"></td>
  	    			</tr>
  	    			<tr>
						<td>Spayed/Neutered (Optional)</td>
						<td><input type="checkbox" name="NeuteredOrSpayed" value="1"></td>
					</tr>
  	    			<tr>
  	    			  <td>Pet's Date of Birth (Optional)</td> 
  	    			  <td><input type="date" name="PetBirthday" size="10"></td>
  	    			</tr>
  	    			<tr>
  	    			  <td><input type="submit" name="formSubmit" value="Submit Appointment"></td>
			 		</tr>
			   </table>
			</form>
	      </div>
	   <footer>
	<?php include 'Footer.php';
	?>
       </footer>
	</body>
</html>
 