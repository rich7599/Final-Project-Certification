// JavaScript Document
var reEmail = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
var reName = /^([A-Z][A-Za-z']+ )*[A-Z][A-Za-z']+$/;
var reState = /^[A-Z]{2}$/;
var reZipCode = /^\d{5}(\-\d{4})?$/;
var rePhone = /^\(?([2-9]\d\d)\)?[\-\. ]?([2-9]\d\d)[\-\. ]?(\d{4})$/;
var reType = /^[A-Z]{1}[a-z]{2}$/;

function checkLength(text, min, max){
	min = min || 1;
	max = max || 100;

	if (text.length < min || text.length > max) {
		return false;
	}
	return true;
}

function checkTextArea(text, min, max){
	if (!checkLength(text, 0, max)) {
		var numChars = text.length;
		var chopped = text.substr(0, max);
		var message = 'You typed ' + numChars + ' characters.\n';
		message += 'The limit is 100.';
		message += 'Your entry will be changed to read as:\n\n' + chopped;
		alert(message); 
	}
}


	




