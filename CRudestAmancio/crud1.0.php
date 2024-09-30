<?php

include("crud3.0.php");

//add

if(isset($_POST['reg-submit']))
{
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email']; 
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];
    $address = $_POST['address'];

    //if user and email already exist
    $query = "insert into campuscrushx (first_name,last_name,email,gender,birthdate,address) VALUES (:first, :last, :email, :gender, :birth, :address)";
    $query_run = $con->prepare($query);

    $data = [
        ':first' => $first,
        ':last' => $last,
        ':email' => $email,
        ':gender' => $gender,
        ':birth' => $birth,
        ':address' => $address,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: crud2.0.php');
        die;
    }
        $_SESSION['message'] = "Not Inserted";
        header('Location: crud2.0.php');
        die;
    }

    if (isset($_POST['delete-submit'])) {
        $id = $_POST['id']; // Ensure you have the ID to delete
    
        // Prepare the delete query
        $query = "DELETE FROM campuscrushx WHERE id = :id";
        $query_run = $con->prepare($query);
    
        $data = [
            ':id' => $id,
        ];
    
        $query_execute = $query_run->execute($data);
    
        if ($query_execute) {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: crud2.0.php');
            die;
        } else {
            $_SESSION['message'] = "Deletion Failed";
            header('Location: crud2.0.php');
            die;
        }
    }


    //edit

    if (isset($_POST['update-submit'])) {
    $id = $_POST['id'];
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email']; 
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];
    $address = $_POST['address'];

    // Prepare the update query
    $query = "UPDATE campuscrushx SET first_name = :first, last_name = :last, email = :email, gender = :gender, birthdate = :birth, address = :address WHERE id = :id";
    $query_run = $con->prepare($query);

    $data = [
        ':first' => $first,
        ':last' => $last,
        ':email' => $email,
        ':gender' => $gender,
        ':birth' => $birth,
        ':address' => $address,
        ':id' => $id,
    ];
    
    $query_execute = $query_run->execute($data);

    if ($query_execute) {
        $_SESSION['message'] = "Updated Successfully";
        header('Location: crud2.0.php');
        die;
    } else {
        $_SESSION['message'] = "Update Failed";
        header('Location: crud2.0.php');
        die;
    }
}