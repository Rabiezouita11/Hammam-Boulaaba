<?php
	// My modifications to mailer script from:
	// Only process POST reqeusts.
	$name = $_POST['name']; 
	$email = $_POST['email']; 
	$subject = $_POST['sub']; 
	$messagebody = $_POST['message']; 	
	
	// Set the from email address.
	$from = "<example@example.com>";
	
	// Set the recipient email address.
    // FIXME: Update this to your desired email address.
	$to = "muttakin@salahsoftwaresolution.com"; 

	// Build the email content.
	$message = "
				Hi,

				A visitor has been sent a query from Spa.

				Name: $name

				Visitor Email: $email

				Subject: $subject

				Message: $messagebody


				Thanks,

				Spa 

				
				This message was sent to $to.  

				Spa. 176 W street name, Canada, NY 10014.
				"; 


	// send the email 
	if(mail ($to,$subject,$message))
	{
		echo "Success";
	}else{
		echo "No";
	}
?>

