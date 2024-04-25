<?php
// Permitir solicitudes desde cualquier origen
header('Access-Control-Allow-Origin: *');
// Permitir los métodos GET, POST, PUT, DELETE, OPTIONS
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
// Permitir los encabezados Content-Type y Authorization
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('content-type: application/json; charset-utf-8');
require 'productsModel.php';

$productsModel= new productsModel();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        $respuesta = $productsModel->getProducts();
        echo json_encode($respuesta);
    break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (!isset($_POST->name) || is_null($_POST->name) || empty(trim($_POST->name))){
            $respuesta = ['Error', 'El nombre del producto no puede estar vacio..'];
        }
        else if (!isset($_POST->description) || is_null($_POST->description) || empty(trim($_POST->description))){
            $respuesta = ['Error', 'La descripcion del producto no puede estar vacio..'];
        }
        else if (!isset($_POST->price) || is_null($_POST->price) || empty(trim($_POST->price))){
            $respuesta = ['Error', 'El precio del producto no puede estar vacio..'];
        }
        else{
            $respuesta = $productsModel->saveProducts($_POST->name, $_POST->description, $_POST->price);

        }
        echo json_encode($respuesta);

        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        if (!isset($_PUT->id) || is_null($_PUT->id) || empty(trim($_PUT->id))){
            $respuesta = ['Error', 'El ID del producto no puede ser nulo..'];
        }
        else if (!isset($_PUT->name) || is_null($_PUT->name) || empty(trim($_PUT->name))){
            $respuesta = ['Error', 'El nombre del producto no puede estar vacio..'];
        }
        else  if (!isset($_PUT->description) || is_null($_PUT->description) || empty(trim($_PUT->description))){
            $respuesta = ['Error', 'La descripcion del producto no puede estar vacio..'];
        }
        else  if (!isset($_PUT->price) || is_null($_PUT->price) || empty(trim($_PUT->price))){
            $respuesta = ['Error', 'El precio del producto no puede estar vacio..'];
        }else{
            $respuesta = $productsModel->updateProducts($_PUT->id, $_PUT->name, $_PUT->description, $_PUT->price);

        }
        echo json_encode($respuesta);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input', true));
        if (!isset($_DELETE->id) || is_null($_DELETE->id) || empty(trim($_DELETE->id))){
            $respuesta = ['Error', 'El ID del producto no puede ser nulo..'];
        }else{
            $respuesta = $productsModel->deleteProducts($_DELETE->id);
        }
        echo json_encode($respuesta);
    break;
}

?>