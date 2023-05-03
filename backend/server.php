<?php
    include "validations.php";
    header('Access-Control-Allow-Origin: http://localhost:3000');

    $error_message = [
        "name" => "",
        "surname" => "",
        "email" => "",
        "password" => "",
        "repeat_password" => "",
    ];

    $form_is_valid = true;

    $users = [
        ["id" => 0,
        "name" => "user0 name",
        "email" => "user0@gmail.com",
        "password" => "user0 password"],
        ["id" => 1,
        "name" => "user1 name",
        "email" => "user1@gmail.com",
        "password" => "user1 password"]
    ];

    $name = $surname = $email = $password = $repeat_password = "";

    if ($_POST) {
        $name = test_input($_POST["name"]);
        test_field_length("name", $name, 1, 16);
        test_name($name);

        $surname = test_input($_POST["surname"]);
        test_field_length("surname", $surname, 1, 32);
        test_surname($surname);

        $email = test_input($_POST["email"]);
        test_field_length("email", $email, 5, 64);
        test_email($email);

        foreach ($users as $user) {
            if ($email === $user["email"]) {
                $error_message["email"] = "This email is already registered!";
                $form_is_valid = false;
            }
        }


        $password = test_input($_POST["password"]);
        test_field_length("password", $password, 6, 16);
        $repeat_password = test_input($_POST["repeat_password"]);
        test_field_length("repeat_password", $repeat_password, 6, 16);
        test_password($password, $repeat_password);
    }

    if ($form_is_valid) {
        array_push($users, [
            "id" => count($users),
            "name" => $name." ".$surname,
            "email" => $email,
            "password" => $password,
        ]);
    }

    echo json_encode([
        "is_valid" => $form_is_valid ? 'true' : 'false',
        "errors" => json_encode($error_message)
    ]);
    wh_log(
        "is_valid: ".($form_is_valid ? 'true' : 'false').
        " errors: ".json_encode($error_message)
    );

    function wh_log($log_msg)
    {
        $log_filename = "log";
        if (!file_exists($log_filename))
        {
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
        file_put_contents($log_file_data, "[".date('H:i:s')."] ".$log_msg . "\n", FILE_APPEND);
    }

?>