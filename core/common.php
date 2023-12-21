<?php

    require_once("dbmanager.php");

    $dbManager = new DbManager();

    function checkAccess($clientType, $currentPage) {
        $sessionClientType = $_SESSION['account_type'];
        if(!isset($sessionClientType) || $clientType != $sessionClientType) {
            logout("2");
            return false;
        }
        return true;
    }

    function escape($string){
        return htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
    }

    function logout($error) {
        $_SESSION['account_type'] = "";
        $_SESSION['account_type'] = "";
        $_SESSION['user_name'] = "";
        $_SESSION['user_id'] = "";
        if(isset($error)){
            header("Location: signin.php?error=".$error);
        } else {
            header("Location: signin.php");
        }
    }

    function setUserSession($user) {
        $_SESSION['account_type'] = $user['accountType'];
        echo($user['accountType']);
        $_SESSION['user_name'] = $user['lastName'] . " " . $user['firstName'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
    }
?>