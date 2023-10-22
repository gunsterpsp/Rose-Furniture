<?php
@ob_start();
	try {
		$conn = new mysqli('localhost', 'root', '', 'furniture_system');

	} catch (Exception $e) {
		echo "Connection Error! " . $e->getMessage();
	}


	//Set the session timeout for 36000 seconds

$timeout = 36000;

//Set the maxlifetime of the session

@ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session

@ini_set( "session.cookie_lifetime", $timeout );

//Start a new session

@session_start();

//Set the default session name

$s_name = session_name();


//Check the session exists or not

if(isset( $_COOKIE[ $s_name ] )) {


    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );

}

?>