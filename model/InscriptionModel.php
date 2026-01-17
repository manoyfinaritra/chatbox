<?php
class InscriptionModel 
{
    private $db;
    public function __construct(){
        $this->db = new Query();
    }

   public function insert($pseudo,$email,$password,$image){
    $this->db->insert("users")->champ(['pseudo','email','password','image'])->execute([$pseudo,$email,$password,$image]);
   }
   public function verfierPseudo($pseudo,$email){
   return $this->db->select("users")->where("pseudo","=" )->andwhere("or","email","=")->execute([$pseudo,$email]);
   }

   public function verificationConnexion($pseudo){
    return $this->db->select("users")->where("pseudo","=")->execute([$pseudo]);
   }
}