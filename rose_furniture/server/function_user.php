<?php

include '../database/connection.php';


if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $group = $_POST['group'];
    
        $insert = "INSERT INTO tbl_users 
        (first_name, last_name, address, contact_no, username, password, email, group_code)
        VALUES ('$firstname', '$lastname', '$address', '$contact_no', '$username', '$password', '$email', '$group')";
        mysqli_query($conn, $insert);

}


if(isset($_POST['getUser'])){
    $getId = $_POST['getId'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = $getId ");

    $data = mysqli_fetch_assoc($sql);

echo json_encode($data);
}

if(isset($_POST['updateUser'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $group = $_POST['group'];
    $id = $_POST['id'];

    $update = "UPDATE tbl_users SET first_name = '$firstname', 
    last_name = '$lastname', username = '$username', address = '$address', contact_no = '$contact_no', password = '$password', 
    email = '$email', group_code = '$group' WHERE user_id = '$id' ";
    mysqli_query($conn, $update);
}

if(isset($_POST['active'])){
    $id = $_POST['getId'];

    $update = "UPDATE tbl_users SET status = '0'  WHERE user_id = '$id' ";
    mysqli_query($conn, $update);

}

if(isset($_POST['lock'])){
    $id = $_POST['getId'];

    $update = "UPDATE tbl_users SET status = '1'  WHERE user_id = '$id' ";
    mysqli_query($conn, $update);
}

if(isset($_POST['updatePassword'])){

    $user_id = $_POST['user_id'];
    $new_password = $_POST['new_password'];

    $update = "UPDATE tbl_users SET password = '$new_password'  WHERE user_id = '$user_id' ";
    mysqli_query($conn, $update);


}


if(isset($_POST['updateInfo'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $user_id = $_POST['user_id'];

    $update = "UPDATE tbl_users SET first_name = '$first_name', 
    last_name = '$last_name', address = '$address', contact_no = '$contact_no', 
    email = '$email' WHERE user_id = '$user_id' ";
    mysqli_query($conn, $update);
}


?>