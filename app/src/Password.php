<?php

class Password
{


    /* Cryptographing the Password. */
    public function make($password)
    {

        $options = [
            'cost' => 12,
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }


    /* Verifing the Password. */
    public static function verify($password, $hash)
    {

        return password_verify($password, $hash);
    }
}
