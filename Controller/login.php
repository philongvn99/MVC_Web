<?php
    include('../Model/user.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = test_input($username);
        $password = test_input($password);

        $userModel = new UserModel();
        $user = $userModel->authenticateUser($username, $password);
        if($user) {
            session_start();
            $_SESSION['userId'] = $user['UserID'];
            $_SESSION['usertname'] = $user['UserName'];
            $_SESSION['password'] = $user['PassWord'];
            $_SESSION['status'] = $user['Status'];
            $_SESSION['avatarpath'] = $user['AvatarPath'];
            
            echo json_encode(array('success' => TRUE, 'avatarpath' => $user['AvatarPath']));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>