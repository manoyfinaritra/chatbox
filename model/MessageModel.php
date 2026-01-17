<?php 
class MessageModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Query();
    }

    public function getUsers(){
       return $this->db->select("users")->orderby("users","date_inscription","DESC")->execute();
    }

    public function sendNewMessage($idSender,$idReceiver,$contenu){
        $this->db->insert("messages")->champ(["idSender","idReceiver","contenu"])->execute([$idSender,$idReceiver,$contenu]);
    }

    public function getConversations($A,$B){
        return $this->db->select("messages")->where("idSender", "=")->andwhere("and", "idReceiver", "=")->andwhere("or", "idSender", "=")->andwhere("and", "idReceiver", "=")->execute([$A, $B, $B, $A]);
    }


      public function getConversationRecente($A)
    {
        // Retourne pour l'utilisateur $A la liste des utilisateurs avec qui il a échangé
        // le dernier message entre eux (contenu + id) triée par dernier message décroissant.
        $sql = "SELECT u.idUsers,u.image, u.pseudo, m.contenu  AS last_message, m.idMessage AS last_msg_id, m.idSender, m.idReceiver
                FROM users u
                JOIN (
                    SELECT CASE WHEN idSender = ? THEN idReceiver ELSE idSender END AS other_id,
                           MAX(idMessage) AS last_msg_id
                    FROM messages
                    WHERE idSender = ? OR idReceiver = ?
                    GROUP BY other_id
                ) lm ON u.idUsers = lm.other_id
                JOIN messages m ON m.idMessage = lm.last_msg_id
                ORDER BY lm.last_msg_id DESC";

        return $this->db->executeRaw($sql, [$A, $A, $A]);
    }


}