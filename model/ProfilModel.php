<?php

class ProfilModel {
    private $db;
    public function __construct()
    {
        $this->db = new Query();
    }

    public function modificationProfil($pseudo,$email,$image,$id){
        $this->db->update("users", ["pseudo","email","image"])->where("idUsers","=")->execute([$pseudo,$email,$image, $id]);
    }
}