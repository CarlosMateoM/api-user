<?php

namespace validation;

use data\UserArray;

require_once './data/userArray.php';

class Validate
{


    public static function initialize()
    {
        
    }

    private static function validate($requestData, UserArray $data)
    {
        $errors = [];

        if (!isset($requestData['identificacion'])) {
            $errors['identificacion'] = 'El campo \'identificacion\' es requerido.';
        } elseif (!is_numeric($requestData['identificacion']) || intval($requestData['identificacion']) <= 0) {
            $errors['identificacion'] = 'El campo \'identificacion\' debe ser un número mayor que cero.';
        } elseif (strlen($requestData['identificacion']) < 5 || strlen($requestData['identificacion']) > 15) {
            $errors['identificacion'] = 'El campo \'identificacion\' debe tener entre 5 y 15 caracteres.';
        } elseif ($data->isIdentificationExists($requestData['identificacion'])) {
            $errors['identificacion'] = 'La identificación ya existe en la base de datos.';
        }

        if (!isset($requestData['nombres'])) {
            $errors['nombres'] = 'El campo \'nombres\' es requerido.';
        } elseif (!is_string($requestData['nombres']) || strlen($requestData['nombres']) < 5 || strlen($requestData['nombres']) > 30) {
            $errors['nombres'] = 'El campo \'nombres\' debe ser una cadena de 5 a 30 caracteres.';
        }

        if (!isset($requestData['apellidos'])) {
            $errors['apellidos'] = 'El campo \'apellidos\' es requerido.';
        } elseif (!is_string($requestData['apellidos']) || strlen($requestData['apellidos']) < 5 || strlen($requestData['apellidos']) > 30) {
            $errors['apellidos'] = 'El campo \'apellidos\' debe ser una cadena de 5 a 30 caracteres.';
        }

        if (!isset($requestData['fecha_nacimiento'])) {
            $errors['fecha_nacimiento'] = 'El campo \'fecha_nacimiento\' es requerido.';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $requestData['fecha_nacimiento'])) {
            $errors['fecha_nacimiento'] = 'El campo \'fecha_nacimiento\' debe tener el formato AAAA-MM-DD.';
        }

        if (!isset($requestData['email'])) {
            $errors['email'] = 'El campo \'email\' es requerido.';
        } elseif (!filter_var($requestData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El campo \'email\' no es un correo electrónico válido.';
        } elseif (strlen($requestData['email']) > 100) {
            $errors['email'] = 'El campo \'email\' no debe tener más de 100 caracteres.';
        }

        if (!isset($requestData['hora_registro'])) {
            $errors['hora_registro'] = 'El campo \'hora_registro\' es requerido.';
        } elseif (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $requestData['hora_registro'])) {
            $errors['hora_registro'] = 'El campo \'hora_registro\' debe tener el formato HH:MM:SS.';
        }

        if (!isset($requestData['tiempo_accion'])) {
            $errors['tiempo_accion'] = 'El campo \'tiempo_accion\' es requerido.';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $requestData['tiempo_accion'])) {
            $errors['tiempo_accion'] = 'El campo \'tiempo_accion\' debe tener el formato AAAA-MM-DD HH:MM:SS.';
        }

        if (!isset($requestData['sexo'])) {
            $errors['sexo'] = 'El campo \'sexo\' es requerido.';
        } elseif (!in_array(strtoupper($requestData['sexo']), ['MASCULINO', 'FEMENINO'])) {
            $errors['sexo'] = 'El campo \'sexo\' debe ser \'MASCULINO\' o \'FEMENINO\'.';
        }

        if (!isset($requestData['observaciones'])) {
            $errors['observaciones'] = 'El campo \'observaciones\' es requerido.';
        } elseif (strlen($requestData['observaciones']) > 300) {
            $errors['observaciones'] = 'El campo \'observaciones\' no debe tener más de 300 caracteres.';
        }

        return $errors;
    }

    public static function validateRequest($requestData, UserArray $data)
    {
        self::initialize();

        $errors = self::validate($requestData, $data);

        if (!empty($errors)) {
            return [
                'code' => 301,
                'message' => 'Existen errores en los campos del registro',
                'data' => $errors,
                'status' => 'USER_INSERT_ERROR'
            ];
        }

        return ['code' => 200];
    }
}
