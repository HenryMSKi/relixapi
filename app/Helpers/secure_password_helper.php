<?php

    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function dehashPassword($password){
        return ;
    }

    function verifyPassword($plainText, $passwordDB){
        return password_verify($plainText, $passwordDB);
    }

    function generateRandomString()
    {
        $tamaño = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $passwordRamdon = '';
        for ($i = 0; $i < $tamaño; $i++) {
            $passwordRamdon .= $characters[rand(0, $charactersLength - 1)];
        }
        return $passwordRamdon;
    }