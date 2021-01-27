<?php
namespace App\Shared\Utility;

use Exception;

class SecurityPassword
{
    public static function encryptPassword($password): String {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash): Bool {
        return password_verify($password, $hash);
    }

    public static function generatePassword(int $length): string {

        $permitted_chars = WebConstants::PASSWORD_CHARS;

        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < $length; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;

    }
}