<?php

namespace data;

use model\User;

require_once './model/user.php';

class UserArray
{

    private $data;

    public function __construct()
    {
        $this->loadDataFromFile(); 
    }

    
    private function loadDataFromFile()
    {
        $jsonContents = file_get_contents('./data/data.json'); 
        $this->data = json_decode($jsonContents, true); 
    }

    private function saveDataToFile()
    {
        $jsonContents = json_encode($this->data, JSON_PRETTY_PRINT); 
        file_put_contents('./data/data.json', $jsonContents); 
    }

    public function addUserData(User $user) {
        $this->data[] = [
            'identificacion' => $user->getIdentification(),
            'nombres' => $user->getFirstName(),
            'apellidos' => $user->getLastName(),
            'fecha_nacimiento' => $user->getDateOfBirth(),
            'sexo' => $user->getGender(),
            'email' => $user->getEmail(),
            'hora_registro' => $user->getRegistrationTime(),
            'tiempo_accion' => $user->getActionTime(),
            'observaciones' => $user->getObservations(),
        ];

        $this->saveDataToFile();
    }

    public function isIdentificationExists($identification) {
        $identification = intval($identification);

        foreach ($this->data as $userData) {
            if ($userData['identificacion'] === $identification) {
                return true; 
            }
        }
        return false; 
    }


    public function getUserByIdentification($identification) {

        $identification = intval($identification);


        foreach ($this->data as $userData) {
            if ($userData['identificacion'] === $identification) {
                return new User(
                    $userData['identificacion'],
                    $userData['nombres'],
                    $userData['apellidos'],
                    $userData['fecha_nacimiento'],
                    $userData['sexo'],
                    $userData['email'],
                    $userData['hora_registro'],
                    $userData['tiempo_accion'],
                    $userData['observaciones'],
                );
            }
        }
    
        return null; 
    }
    
    
}
