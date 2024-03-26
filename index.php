<?php

use controller\UserController;

require_once './controller/userController.php';

header('Content-Type: application/json');

$userController = new userController();




    $method = $_SERVER['REQUEST_METHOD'];

    if (isset($_GET['controller']) && isset($_GET['action'])) {

        $controller = $_GET['controller'];

        if ($controller === 'user') {

            $action = $_GET['action'];

            switch ($method) {
                case 'GET':

                    if ($action === 'get') {
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            echo json_encode($userController->get($id));
                        } else {
                            echo json_encode(['estado' => 'error', 'mensaje' => 'El parámetro "id" es requerido para la acción "get".']);
                        }
                    } else {
                        echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida.']);
                    }

                    break;
                case 'POST':

                    if ($action === 'insert') {

                        $requestData = json_decode(file_get_contents('php://input'), true);

                        echo json_encode($userController->insert($requestData));
                    } else {
                        echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida.']);
                    }
                    break;
                default:
                    echo json_encode(['estado' => 'error', 'mensaje' => 'Método no válido.']);
                    break;
            }
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Controlador no válido.']);
        }
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Los parámetros "controller" y "action" son requeridos en la URL.']);
    }

