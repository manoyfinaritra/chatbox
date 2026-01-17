<?php
class Root
{
    public static function executer($url)
    {
        $url = htmlspecialchars(trim($url));
        $url = trim($url, "/");
        $tab = explode("/", $url);
        $class = $tab[0];
        if (is_numeric(strpos($url, "/"))) {
            #raha numeric le valeur de misy class method param
            // var_dump($tab);
            if (count($tab) == 2) {
                $method = $tab[1];
                if (file_exists("controlleur/$class.php")) {

                    if (method_exists($class, $method)) {
                        # code...
                        $reflect = new ReflectionMethod($class, $method);
                        $reflect->invoke(new $class);
                    } else {
                        echo "<h2 style='color:red'>Le method $method.php n'existe pas</h2>";
                    }

                } else {
                    echo "<h2 style='color:red'>Le fichier $class.php n'existe pas</h2>";
                }
            } else {

                #param
                // var_dump($tab);
                $param = [];
                $j = 0;
                for ($i = 2; $i < count($tab); $i++) {
                    $param[$j] = $tab[$i];
                    $j++;
                }
                // var_dump($param);
                $method = $tab[1];
                if (file_exists("controlleur/$class.php")) {

                    if (method_exists($class, $method)) {
                        # code...
                        $reflect = new ReflectionMethod($class, $method);
                        $nombre = $reflect->getNumberOfRequiredParameters();
                        // var_dump($nombre);
                        if (count($param) == $nombre) {
                            # code...
                            $reflect->invokeArgs(new $class, $param);
                        } else {
                            echo "<h2 style='color:red'>Le methode $method necessite $nombre nombre de paramettre</h2>";
                        }

                    } else {
                        echo "<h2 style='color:red'>Le method $method.php n'existe pas</h2>";
                    }

                } else {
                    echo "<h2 style='color:red'>Le fichier $class.php n'existe pas</h2>";
                }

            }
        } else {
            #class fotsiny
            if (file_exists("controlleur/$class.php")) {
                $reflect = new ReflectionMethod($class, "index");
                $reflect->invoke(new $class);
            } else {
                echo "<h2 style='color:red'>Le fichier $class.php n'existe pas</h2>";
            }
        }

    }
}
?>