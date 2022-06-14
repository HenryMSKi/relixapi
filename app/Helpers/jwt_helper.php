<?php

function getJWTFromRequest($authenticationHeader): string
{
    if (is_null($authenticationHeader)) { //JWT is absent
        throw new Exception('Missing or invalid JWT in request');
    }
    //JWT is sent from client in the format Bearer XXXXXXXXX
    return explode(' ',
        $authenticationHeader
    )[1];
}

function dataJWTFromRequest(string $encodedToken)
{
    $key = \Config\Services::getSecretKey();
    $decodedToken = \Firebase\JWT\JWT::decode($encodedToken, new \Firebase\JWT\Key($key, 'HS256'));
    return $decodedToken;
}

function getSignedJWTForUser($user)
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;

    $payload = [
        'user' => $user,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration
    ];

    $jwt = \Firebase\JWT\JWT::encode($payload, \Config\Services::getSecretKey(), 'HS256');
    return $jwt;
}
