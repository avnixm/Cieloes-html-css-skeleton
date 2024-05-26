<?php

// ************* ang task neto is getting, sumitting , updating, delete data- database******************//

declare(strict_types=1);
//************************function sa username****************************/
function get_username(object $pdo, string $username){

        $query = "SELECT username FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;      
}

//*******************************function sa email kung reg ba**************/

function get_email(object $pdo, string $email){

    $query = "SELECT username FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":email", $email);
    $stmt->execute(); 

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;      
}


function set_user(object $pdo, string $username, string $pwd, string $email){

    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
    $stmt = $pdo->prepare($query);

    $option = [
        'cost' => 12
    ];
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedpwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute(); 

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;      
}

?>
