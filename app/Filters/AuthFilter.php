<?php namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Config\Services;

class AuthFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {

        try {
            $key = Services::getSecretKey();
            $authenticationHeader = $request->getServer('HTTP_AUTHORIZATION');

            if ($authenticationHeader == null) {
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'No se ha enviado ningún token');
            } else {
                $encodedToken = explode(' ', $authenticationHeader);
                $jwt = $encodedToken[1];

                JWT::decode($jwt, new \Firebase\JWT\Key($key, 'HS256'));
            }
        } catch (\Firebase\JWT\ExpiredException $expE) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'El token ya ha expirado');
        } catch (\Exception $e) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Error del servidor en la autenticación del token');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
