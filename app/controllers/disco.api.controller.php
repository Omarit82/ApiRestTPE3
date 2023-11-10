<?php

require_once 'app/controllers/api.controller.php';
require_once "app/models/discos.model.php";

class DiscosApiController extends ApiController{
    protected $model;

    function __construct(){
        parent::__construct();
        $this->model = new discosModel();
    }

    function getDiscos($params = []){
        if(empty($params)){
            //FILTRO ODENA ASCENDENTE
            $ordenar = $_GET['ordenar'];
            if (isset($ordenar)&&($ordenar='true')){
               
                $discos = $this->model->getDiscos();
                
                //ORDENO ARREGLO  (se me rompe aca :C)
                $length = (count($discos));
                for ($i = 0; $i < $length; $i + 1){
                    for($j = 0; $j < $length - 1; $j + 1){
                        if($discos[$j] > $discos[$j + 1]){      //LO QUE TENGO QUE COMPARAR ES ALGUNO DE LOS CAMPOS
                            $temporal = $discos[$j];            //DE LOS OBJETOS($nombre, $precio, $autor, o $genero)
                            $discos[$j] = $discos[$j + 1];      //PERO NO SE COMO
                            $discos[$j + 1] = $temporal;
                        }
                    }
                }
                
                
                //Y LUEGO SE LO ENVIO A LA VISTA(YA ORDENADO)
                $this->view->respose($discos, 200);
            }else{//SI NO HAY PARAMETRO SORT PARA ORDENAR EN LA URL PASO EL ARREGLO DE DISCOS NOMAL(ODENADO POR ID)
                $discos = $this->model->getDiscos();
                $this->view->response($discos, 200);
            }
        }
        //no anda D:
    }

    function getDisco($params = [":ID"]){
        $disco = $this->model->getDisco($params[":ID"]);
        if(!empty($disco)){
            $this->view->response($disco, 200);
        }else{
            $this->view->response(['No existe el disco con el id:' . $params[':ID']], 404);
        }
    }

    function deleteDisco($params = [":ID"]){
        $disco_id = $params[":ID"];
        $disco = $this->model->getDisco($disco_id);

        if($disco){
            $this->model->deleteDisco($disco_id);
            $this->view->response(["Disco " . $disco_id . " eliminado con exito."], 200);
        } else{
            $this->view->response(['No existe el disco con el id:' . $disco_id], 404);
        }
    }

    function createDisco(){
        $body = $this->getData();

        $nombre = $body->nombre;
        $autor = $body->autor;
        $genero = $body->genero;
        $precio = $body->precio;

        $id = $this->model->insertDisco($nombre,$autor,$genero,$precio);

        $this->view->response(["Agregado nuevo disco con id =" . $id], 201);
        
    }

    function update($params = []) {
        $id = $params[':ID'];
        $disco = $this->model->getDisco($id);

        if($disco){
            $body = $this->getData();
            $nombre = $body->nombre;
            $autor = $body->autor;
            $genero = $body->genero;
            $precio = $body->precio;

            $this->model->updateDisco($id,$nombre,$autor,$genero,$precio);

            $this->view->response(["Modificado el disco con id: ".$id], 200);
        }else{
            $this->view->response(["No existe el disco con id: ".$id], 400);
        }
    }

}