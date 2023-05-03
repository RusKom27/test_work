<?php
    function test_email($data) {
        global $error_message;
        global $form_is_valid;
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $error_message["email"] = "Email field is invalid!";
            $form_is_valid = false;
        }
    }

    function test_name($data) {
        global $error_message;
        global $form_is_valid;
        if (!preg_match("/^[a-zA-Z-' ]*$/",$data)) {
            $error_message["name"] = "Name field is invalid!";
            $form_is_valid = false;
        }
    }

    function test_surname($data) {
        global $error_message;
        global $form_is_valid;
        if (!preg_match("/^[a-zA-Z-' ]*$/",$data)) {
            $error_message["surname"] = "Surname field is invalid!";
            $form_is_valid = false;
        }
    }

    function test_field_length($field_name, $data, $min_length, $max_length) {
        global $error_message;
        global $form_is_valid;
        if (strlen($data) < $min_length || strlen($data) > $max_length) {
            $error_message[$field_name] = "Field length must be greater than $min_length or less than $max_length";
            $form_is_valid = false;
        }
    }

    function test_password($password1, $password2) {
        global $error_message;
        global $form_is_valid;
        if ($password1 !== $password2) {
            $error_message["password"] = "Passwords is not equal!";
            $error_message["repeat_password"] = "Passwords is not equal!";
            $form_is_valid = false;
        }
    }


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }