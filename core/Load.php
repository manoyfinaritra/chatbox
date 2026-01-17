<?php
class Load
{
    public static function view($vue, $data = [])
    {
        
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                # code...
                $$key = $value;
            }
        }
        if (file_exists("view/$vue.php")) {
            require_once "./view/$vue.php";
        }
    }

    public static function template($vue, $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                # code...
                $$key = $value;
            }
        }

        if (file_exists("view/template/$vue.php")) {
            require_once "./view/template/$vue.php";
        }
    }
    public static function css($css){
        for ($i=0; $i <count($css) ; $i++) { 
            # code...
            echo "<link rel='stylesheet' href='".URL."public/css/$css[$i].css'>";

        }
    }

    public static function script($script){
        for ($i= 0; $i <count($script) ; $i++) {
 
            // echo '<script src="' . URL . 'public/js/' . $script[$i] . '.js"></script>'."\n";
          echo '<script src="http://localhost/chat2/public/js/' . $script[$i] . '.js"></script>';
           
        }
    }
}

