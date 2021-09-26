<?php

// Function to generate OTP
function generateNumericOTP() {
	
	// Take a generator string which consist of
	// all numeric digits
	$generator = "1357902468";

	// Iterate for n-times and pick a single character
	// from generator and append it to $result
	
	// Login for generating a random character from generator
	//	 ---generate a random number
	//	 ---take modulus of same with length of generator (say i)
	//	 ---append the character at place (i) from generator to result
    $n=6;
	$result = "";
	for ($i = 1; $i <= $n; $i++) {
		$result .= substr($generator, (rand()%(strlen($generator))), 1);
	}

	// Return result
	return $result;
}

    function dataVerification($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    

	function delete($id){
		$sql = "DELETE FROM admin WHERE ID ='$id'";
        $result=$Conn->query($sql);
	}

?>




<!-- ?php

// 
// function OTP(){

// }

?> -->