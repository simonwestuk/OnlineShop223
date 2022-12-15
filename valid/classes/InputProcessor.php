<?php

class InputProcessor {

    public static function process_email(string $email) : array {

        if (empty($email)) {
            return self::return_input(false, "Email field is empty.");
        }

        $value = htmlspecialchars($email);
        $value = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($value === false ) {
            return self::return_input(false, "$email is not valid a valid email address.");
        }

        return self::return_input(true, $value);

    }

    public static function process_password(string $password, string $passwordv = null) : array {

        if (empty($password)) {
            return self::return_input(false, "Password field is empty.");
        }

        if (!empty($passwordv)) {
            if ($password != $passwordv) {
                return self::return_input(false, "Passwords do not match.");
            }
        }

        $value = htmlspecialchars($password);
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        if (preg_match($regex, $password) === false ) {
            return self::return_input(false, "Password must have a minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character.");
        }

        return self::return_input(true, $value);

    }

    public static function process_string(string $text, $length = 0) : array {

        if (empty($text)) {
            return self::return_input(false, "Field is empty.");
        }
        
        if ($length > 0) {
            if (strlen($text) > $length) {
                return self::return_input(false, "Text must be less than $length characters.");
            }
        }

        $regex = '/^[a-zA-Z]+([_ -]?[a-zA-Z])*$/';

        if (preg_match($regex, $text) === false ) {
            return self::return_input(false, "Text must be A - z characters only.");
        }

        $value = htmlspecialchars($text);
        return self::return_input(true, $value);

    }

    public static function process_file(array $file) : array {

        if (empty($file)) {
            return self::return_input(false, "File is empty.");
        }

        return self::return_input(true, $file['name']);

    }

    private static function return_input(bool $valid, string $value) : array {

        return [
            'valid' => $valid, 
            'value' =>  $valid ? $value : '', 
            'error' =>  $valid ? '' : $value,
        ];

    }

}


?>