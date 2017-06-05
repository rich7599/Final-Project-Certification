   <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $FirstName = strip_tags(trim($_POST["FirstName"]));
		$FirstName = str_replace(array("\r","\n"),array(" "," "),$FirstName);
		$LastName = strip_tags(trim($_POST["LastName"]));
		$LastName = str_replace(array("\r","\n"),array(" "," "),$LastName);
        $Email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
        $Message = trim($_POST["Message"]);
        
        if ( empty($FirstName) OR empty($LastName) OR empty($Message) OR !filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        $recipient = "root@localhost.com";
		$subject = "New contact from $FirstName $LastName";
		$email_content = "FirstName: $FirstName\n";
		$email_content = "LastName: $LastName\n";
        $email_content = "Email: $Email\n\n";
        $email_content = "Message:\n$Message\n";
        $email_headers = "From: $FirstName $LastName <$Email>";
        
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "Thank's for contacting Sandy's Pet Shop!  Your message has been sent.";
        } else {
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
?>



