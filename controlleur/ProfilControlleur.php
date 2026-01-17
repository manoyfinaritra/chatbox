<?php

class ProfilControlleur
{
    private $db;
    public function __construct()
    {
        $this->db = new ProfilModel();
    }

    public function index()
    {
        session_start();
        if (!isset($_SESSION['pseudo'])) {
            header("location:" . URL . "InscriptionControlleur");
        }

        Load::template(
            "header",
            [
                "title" => "profil",
                "css" => ['bootstrap', 'icon', 'profil']
            ]
        );

        Load::view(
            "profil"
        );

        Load::template(
            "footer",

            [
                "script" => ['jquery', 'bootstrap', 'icon', 'profil']
            ]
        );
    }

    public function modificationProfil()
    {
        $id = trim(htmlspecialchars($_POST['id']));
        $pseudo = trim(htmlspecialchars($_POST['pseudo']));
        $email = trim(htmlspecialchars($_POST['email']));
        $messages = "";

        if (isset($_FILES['image']) && $_FILES['image'] != "") {
            $image_mage = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if ($error === 0) {
                $image_extension = strtolower(pathinfo($image_mage, PATHINFO_EXTENSION));
                $allowed_extension = array("jpg", "jpeg", "png");

                if (in_array($image_extension, $allowed_extension)) {
                    $new_image_name = uniqid($pseudo, true) . "." . $image_extension;
                    $image_upload_path = "public/image/" . $new_image_name;

                    if (move_uploaded_file($tmp_name, $image_upload_path)) {
                        $this->db->modificationProfil($pseudo, $email, $new_image_name, $id);
                        session_start();
                        session_destroy();
                        header("location:" . URL . "InscriptionControlleur");
                    } else {
                        $messages = "erreur lors de la deplacement";
                        header("location:" . URL . "ProfilControlleur&messages=" . $messages);
                    }
                } else {
                    $messages = "n'est pas un tableau";
                    header("location:" . URL . "ProfilControlleur&messages=" . $messages);
                }
            } else {

                // echo "erreur";s

                $this->db->modificationProfil($pseudo, $email, null, $id);
                session_start();
                session_destroy();
                header("location:" . URL . "InscriptionControlleur");
            }
        } else {
            $this->db->modificationProfil($pseudo, $email, null, $id);
            session_start();
            session_destroy();
            header("location:" . URL . "InscriptionControlleur");
        }
    }
}
