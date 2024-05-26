<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd) {
    if (empty($username) || empty($pwd)){
        return true;
    } else {
        return false;
    }
}

function is_username_wrong(bool|array $result)
 {
    if (!$result){
        return true;
    } else {
        return false;
    }

}

// login_contr.inc.php

function is_password_wrong($pwd, $hashedPwd) {
    if ($hashedPwd === null) {
        return true; // or false, depending on how you want to handle null passwords
    }
    return !password_verify($pwd, $hashedPwd);
}

