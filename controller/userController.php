<?php

namespace controller;

use model\User;
use data\UserArray;
use validation\Validate;

require_once './model/user.php';
require_once './data/userArray.php';
require_once './validation/validate.php';


class UserController
{
    private UserArray $userData;

    public function __construct()
    {
        $this->userData = new UserArray();
    }


    public function insert($requestData)
    {

        $response = Validate::validateRequest($requestData, $this->userData);

        if ($response['code'] == 301) {
            return $response;
        }

        $newUser = new User(
        $requestData['identificacion'],
        $requestData['nombres'],
        $requestData['apellidos'],
        $requestData['fecha_nacimiento'],
        $requestData['sexo'],
        $requestData['email'],
        $requestData['hora_registro'],
        $requestData['tiempo_accion'],
        $requestData['observaciones']);

        $this->userData->addUserData($newUser);

        return array(
            'code' => 200,
            'message' => 'Registro satisfactorio',
            'data' => $newUser->getJson(),
            'status' => 'USER_INSERT_OK'
        );
    }

    public function get($id)
    {
        $user = $this->userData->getUserByIdentification($id);

        if ($user) {
            return array(
                'code' => 200,
                'message' => 'Busqueda satisfactoria',
                'data' => $user->getJson(),
                'status' => 'USER_GET_OK'
            );
        } else {
            return array(
                'code' => 404,
                'message' => 'Usuario no existente.',
                'data' => '',
                'status' => 'USER_GET_ERROR'
            );
        }
    }
}
