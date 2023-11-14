<?php

require_once 'app/controllers/api.controller.php';
require_once "app/models/discos.model.php";

class DiscosApiController extends ApiController{
    protected $model;

    function __construct(){
        parent::__construct();
        $this->model = new discosModel();
    }

    function getDiscos($params = null){
        $parametros = [];

        if (isset($_GET['sort'])){
            $parametros['sort'] = $_GET['sort'];
        }

        if (isset($_GET['order'])){
            $parametros['order'] = $_GET['order'];
        }
        
        $discos = $this->model->getDiscos($parametros);
        $this->view->response($discos, 200);
    }    
    function getOfertas($params = null){
        $parametros = [];

        if (isset($_GET['sort'])){
            $parametros['sort'] = $_GET['sort'];
        }

        if (isset($_GET['order'])){
            $parametros['order'] = $_GET['order'];
        }
        
        $discos = $this->model->getOfertas($parametros);
        $this->view->response($discos, 200);
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
            $oferta = $body->oferta;

            $this->model->updateDisco($id,$nombre,$autor,$genero,$precio,$oferta);

            $this->view->response(["Modificado el disco con id: ".$id], 200);
        }else{
            $this->view->response(["No existe el disco con id: ".$id], 400);
        }
    }

}