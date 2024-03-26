<?php

namespace model;

class User {

    private $identification;
    private $first_name;
    private $last_name;
    private $date_of_birth;
    private $gender;
    private $email;
    private $registration_time;
    private $action_time;
    private $observations;

    public function __construct(
        $identification,
        $first_name,
        $last_name,
        $date_of_birth,
        $gender,
        $email,
        $registration_time,
        $action_time,
        $observations
    ) {
        $this->identification = $identification;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->date_of_birth = $date_of_birth;
        $this->gender = $gender;
        $this->email = $email;
        $this->registration_time = $registration_time;
        $this->action_time = $action_time;
        $this->observations = $observations;
    }
    

    public function setIdentification($identification) {
        $this->identification = $identification;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function setDateOfBirth($date_of_birth) {
        $this->date_of_birth = $date_of_birth;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRegistrationTime($registration_time) {
        $this->registration_time = $registration_time;
    }

    public function setActionTime($action_time) {
        $this->action_time = $action_time;
    }

    public function setObservations($observations) {
        $this->observations = $observations;
    }

    public function getIdentification() {
        return $this->identification;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getDateOfBirth() {
        return $this->date_of_birth;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRegistrationTime() {
        return $this->registration_time;
    }

    public function getActionTime() {
        return $this->action_time;
    }

    public function getObservations() {
        return $this->observations;
    }

    public function getJson() 
    {
        return array(
            'identificacion' => $this->getIdentification(),
            'nombres' => $this->getFirstName(),
            'apellidos' => $this->getLastName(),
            'fecha_nacimiento' => $this->getDateOfBirth(),
            'sexo' => $this->getGender(),
            'email' => $this->getEmail(),
            'hora_registro' => $this->getRegistrationTime(),
            'tiempo_accion' => $this->getActionTime(),
            'observaciones' => $this->getObservations()
        );
        
    }
    
}
