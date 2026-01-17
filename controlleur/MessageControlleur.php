<?php

class MessageControlleur
{
    private $db;
    public function __construct()
    {
        $this->db = new MessageModel();
    }
    public function index()
    {
        session_start();
        if (!isset($_SESSION["pseudo"])) {
            header("location:".URL."InscriptionControlleur");
        }
        Load::template(
            "header",
            [
                "title" => "Great message",
                "css"   => ["bootstrap","icon", "message"],
            ]
        );

        Load::view(
            "message",
            [
                "allUsers" => $this->db->getUsers(),
            ]
        );

        Load::template(
            "footer",
            [
                "script" => ["jquery", "bootstrap", 'icon', 'message'],
            ]
        );
    }

    public function sendNewMessage(){
        $idSender = trim(htmlspecialchars($_POST['idSender']));
        $idReceiver = trim(htmlspecialchars($_POST['idReceiver']));
        $contenu = trim(htmlspecialchars($_POST['contenu']));

        $this->db->sendNewMessage($idSender,$idReceiver,$contenu);

        echo json_encode([
            "success" => "evoie reussi"
        ]);
    }

    public function getConversations()  {
        session_start();
        $idSender = $_SESSION['id_connecte'];
        $idReceiver = trim(htmlspecialchars($_POST['idReceiver']));

       $MessageEntreDeux = $this->db->getConversations($idSender,$idReceiver);
       $totalMessage = count($MessageEntreDeux);

        echo json_encode([
            'success'=> 'get reussi',
            "idSender" => $idSender,
            "MessageEntreDeux" => $MessageEntreDeux,
            "totalMessage" => $totalMessage
            ]); 
    }

   public function getConversationRecente(){
        session_start();
        $idUsers = $_SESSION['id_connecte'];
        $pseudoConnecte = $_SESSION['pseudo'];

       $conversationRecente = $this->db->getConversationRecente($idUsers);

        echo json_encode([
            'success'=> 'get reussi',
            "idUsers" => $idUsers,
            "conversationRecente" => $conversationRecente
            ]);
    }

    public function deconnexion(){
      session_start();
      session_destroy();
      header("location:".URL."InscriptionControlleur");
    }
}
