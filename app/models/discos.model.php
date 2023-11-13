<?php

require_once 'app/models/model.php';


class discosModel extends Model{

    public function getDiscos($parametros){
        $sql = 'SELECT * FROM discos';

        if (isset($parametros['order'])){
           
            $sql .= ' ORDER BY '.$parametros['order'];

            if (isset($parametros['sort'])){

                $sql .= ' '.$parametros['sort'];

            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $discos = $query->fetchAll(PDO::FETCH_OBJ);
        return $discos;
    }
    public function getDisco($id){
        $query = $this->db->prepare('SELECT * FROM discos WHERE id = ?');
        $query->execute([$id]);
        $disco = $query->fetch(PDO::FETCH_OBJ);
        return $disco;
    }

    public function insertDisco($nombre,$autor,$genero,$precio){
        $query = $this->db->prepare('INSERT INTO discos(nombre,autor,genero,precio) VALUES (?,?,?,?)');
        $query->execute([$nombre,$autor,$genero,$precio]);
        
        return $this->db->lastInsertId();
    }

    public function deleteDisco($id){
        
        $query = $this->db->prepare('DELETE FROM discos WHERE id = ?');
        $query->execute([$id]);

    }

    public function updateDisco($id, $nombre, $autor, $genero, $precio){
        $query = $this->db->prepare('UPDATE discos SET nombre = ?, autor = ?, genero = ?, precio = ? WHERE id = ?');
        $query->execute([$nombre,$autor,$genero,$precio,$id]);
    }
}