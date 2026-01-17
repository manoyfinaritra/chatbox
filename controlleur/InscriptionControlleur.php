<?php
class InscriptionControlleur
{

    private $db;

    public function __construct()
    {
        $this->db = new InscriptionModel();
    }
    public function index()
    {
        //header
        Load::template(
            "header",
            [
                "title" => "Page d'inscription",
                "css"   => ["bootstrap", "icon", "inscription2"],
            ]
        );
        $message = "";
        $type    = "";

        // Priorité aux flash messages de session (fiable après redirection)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            $type    = isset($_SESSION['flash_type']) ? $_SESSION['flash_type'] : '';
            unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        }

        // Support rétrocompatible via GET
        if (isset($_GET['message'])) {
            $message .= $_GET['message'];
        }
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }

        // Passer le message et son type (success|error) à la vue
        Load::view("inscription", ["message" => $message, "type" => $type]);
        //footer
        Load::template(
            "footer",
            [
                "script" => ["jquery", "bootstrap", "icon", "inscription"],
            ]
        );
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pseudo        = htmlspecialchars($_POST["pseudo"]);
            $email         = htmlspecialchars($_POST["email"]);
            $password      = htmlspecialchars($_POST["password"]);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if (isset($_FILES["image"]["name"]) && ! empty($_FILES["image"]["name"])) {
                $image_name = $_FILES["image"]["name"];
                $tmp_name   = $_FILES["image"]["tmp_name"];
                $error      = $_FILES["image"]["error"];
                $message    = "";

                if ($error === 0) {
                    $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                    $allowed_extension = ["jpg", "jpeg", "png"];

                    if (in_array($image_extension, $allowed_extension)) {

                        $new_name_image     = uniqid($pseudo, true) . "." . $image_extension;
                        $image_uploads_path = "public/image/" . $new_name_image;

                        $count = $this->db->verfierPseudo($pseudo, $email);

                        if (count($count) > 0) {
                            $message      = "L'utilisateur existe deja";
                            $message_type = "error";
                        } else {
                            if (move_uploaded_file($tmp_name, $image_uploads_path)) {

                                $this->db->insert($pseudo, $email, $password_hash, $new_name_image);
                                $message      = "Creation de compte reussi";
                                $message_type = "success";
                            } else {
                                $message      = "erreur lors le deplacement de l'image";
                                $message_type = "error";
                            }
                        }
                    } else {
                        $message      = "format de l'image non reconnu";
                        $message_type = "error";
                    }
                } else {
                    $message      = "erreur lors de la telechargement de l'image";
                    $message_type = "error";
                }

                // Utiliser session flash pour transmettre le message après redirection
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['flash_message'] = $message;
                $_SESSION['flash_type']    = (isset($message_type) && $message_type === 'success') ? 'success' : 'error';

                header("location:" . URL . "InscriptionControlleur");
            } else {
                $this->db->insert($pseudo, $email, $password_hash, null);
                $message = "Creation de compte reussi";
                $message_type = "success";

                // Utiliser session flash pour transmettre le message après redirection
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['flash_message'] = $message;
                $_SESSION['flash_type']    = (isset($message_type) && $message_type === 'success') ? 'success' : 'error';

                header("location:" . URL . "InscriptionControlleur");
            }
        }
    }

    public function verificationConnexion()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pseudo = trim(htmlspecialchars($_POST['pseudo']));
            $motdepasse = trim(htmlspecialchars($_POST['password']));
            $user = $this->db->verificationConnexion($pseudo);
            $message = "";
            var_dump($user);
            if ($user && password_verify($motdepasse, $user[0]["password"])) {
                session_start();
                $_SESSION['id_connecte'] = $user[0]['idUsers'];
                $_SESSION['pseudo'] = $user[0]['pseudo'];
                $_SESSION['image'] = $user[0]['image'];
                $_SESSION['email'] = $user[0]['email'];

                header('location:' . URL . 'MessageControlleur');
            } else {
                $message = "Identifiants et mot de passe incorect";
                header('location:' . URL . 'InscriptionControlleur&message=' . $message);
            }
        }
    }
}
