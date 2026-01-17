<?php
class Query
{
    private static $host, $dbname, $user, $password;
    private $db, $query, $type_select, $tab1;
    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password);
        } catch (Exception $e) {
            echo "erreur lors de la connexion à la base de données" . $e->getMessage();
            die;
        }
    }
    public static function connect($host, $dbname, $user, $password)
    {
        self::$host = htmlspecialchars(trim($host));
        self::$dbname = htmlspecialchars(trim($dbname));
        self::$user = htmlspecialchars(trim($user));
        self::$password = htmlspecialchars(trim($password));
    }

    public function select($table, $column="*", $distinct=" ") 
    {
        if (is_string($table)) {
            # code...
            $this->tab1 = $table; 
            $this->query = "SELECT ". $distinct .  " " . $column . " FROM " . $table;
            $this->type_select = "select";
        } else {
            echo "<h2>le valeur doit être de type string</h2>";
        }
        return $this;
    }

    public function insert($table)
    {
        if (is_string($table)) {
            # code...
            $this->query = "INSERT INTO " . $table;
        } else {
            echo "<h2>le valeur doit être de type string</h2>";
        }

        return $this;
    }
    public function champ($tab)
    {
        if (is_array($tab)) {
            $champ = "";
            $trous = "";
            for ($i = 0; $i < count($tab); $i++) {
                # code...
                $champ .= "$tab[$i]".",";
                $trous .= "?,";
            }
            $champ = trim($champ, ", ");
            $trous = trim($trous, ", ");
            $this->query .= "($champ) VALUES ($trous)";
        } else {
            echo "<h2>le valeur doit être de type tableau</h2>";
        }
        return $this;
    }

    public function delete($table)
    {
        if (is_string($table)) {
            # code...
            $this->query = "DELETE FROM " . $table;
            $this->type_select = "delete";

        } else {
            echo "<h2>les deux valeurs doivent être de type string</h2>";
        }
        return $this;
    }
    public function edit($table)
    {
        if (is_string($table)) {
            # code...
            $this->query = "SELECT * FROM " . $table;
            $this->type_select = "edit";
        } else {
            echo "<h2>le type de donnée doit être de type string</h2>";
        }
        return $this;
    }

    // SELECT * FROM tab WHERE champ = ?
    // SELECT * FROM client WHERE idC = '4' AND nom = 'Koto'

    // $class->select("client")->where("idC", "=")->andWhere();

    # function where le parametre champ c'est string le parametre condition = "=",">",...
    public function where( $champ = "", $condition = "")
    {
        $this->query .= " WHERE  ". $champ . " " . $condition . " ?";
        return $this;
    }
    public function wheretable($table ,$champ = "", $condition = ""){
        $this->query .= " WHERE  " .$table.".". $champ . " " . $condition . " ? ";
        return $this;
    }
    public function andwheretable($And_Or, $table  ,$champ="", $condition=""){
        $this->query.= " " . $And_Or . " " . $table . "." . $champ . "  " . $condition . " ?" ;
        return $this;
    }

    #function andwhere
    public function andwhere($And_Or, $champ = "", $condition = " ")
    {
        $this->query .= " " . $And_Or . " " . $champ . " " . $condition . " ?";
        return $this;
    }

    public function  wheredoublecondition($table, $champ1 ,$andor,$champ2,$condition){
        $this->query .= " WHERE ( " .$table.".".$champ1. "  " . $condition. " ? ". $andor . "  " .$table.".".$champ2 . "  ". $condition . " ? )";

        return $this;
    }

    public function andwheredoublecondition($andor1, $table, $champ1 ,$andor,$champ2,$condition){
        $this->query .= " " . $andor1 . " ( " .$table.".".$champ1. "  " . $condition. " ? ". $andor . "  " .$table.".".$champ2 . "  ". $condition . " ? )";

        return $this;
    }

    public function limit($nbr){
        $this->query .= " " . "LIMIT " . $nbr ;
        return $this;
    }




    public function join($table2, $table1_col, $table2_col, $type_join = "INNER")
{
    $table1 = $this->tab1; 
    $this->query .= " " . 
                    strtoupper($type_join) . " JOIN " . 
                    $table2 . " ON " . 
                   
                    $table1 . "." . $table1_col . " = " . 
                
                    $table2 . "." . $table2_col;
    
    $this->type_select = "join";
    return $this;
}


    public function orderby($table, $champ,$ascoudesc){
        $this->query .= " " . "ORDER BY ". $table . "." .$champ. "  ". $ascoudesc ;
        return $this;
    }

    public function groupeby($table, $champ){
        $this->query .= " " . " GROUP BY " . $table . "." .$champ ;
        return $this;
    }


    public function update($table, array $tab = [])
    {
        $champ = "";
        $this->query = "UPDATE ";
        for ($i = 0; $i < 1; $i++) {
            for ($j = 0; $j < count($tab); $j++) {
                # code...
                $champ .= $tab[$j] . " = ? ,";
            }
        }
        $champ = trim($champ, ", ");
        $this->query .= $table . " SET " . $champ;
        return $this;
    }

   

    public function execute(array $tab = [])
    {
        if (!empty($tab)) {
            # code...
            if ($this->type_select == "select") {
                $req = $this->db->prepare($this->query);
                $req->execute($tab);
                return $req->fetchAll(PDO::FETCH_ASSOC);
            }
            if ($this->type_select == "delete") {
                $req = $this->db->prepare($this->query);
                $req->execute($tab);
            }
            if ($this->type_select == "edit") {
                $req = $this->db->prepare($this->query);
                $req->execute($tab);
                return $req->fetchAll(PDO::FETCH_ASSOC);
            }
            if ($this->type_select == "join") {
                $req = $this->db->prepare($this->query);
                $req->execute($tab);
                return $req->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $req = $this->db->prepare($this->query);
                $req->execute($tab);
            }

        } else {
            if ($this->type_select == "select") {
                $req = $this->db->prepare($this->query);
                $req->execute();
                return $req->fetchAll(PDO::FETCH_ASSOC);
            }
            if ($this->type_select == "join") {
                $req = $this->db->prepare($this->query);
                $req->execute();
                return $req->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "<h2>le tableau de doit pas être vide</h2>";
            }
        }
        return $this;
    }


    

    public function get_query()
    {
        echo $this->query;
    }

    // Execute a raw SQL query and return results (associative array)
    public function executeRaw($sql, array $params = [])
    {
        try {
            $req = $this->db->prepare($sql);
            $req->execute($params);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erreur executeRaw: " . $e->getMessage();
            return [];
        }
    }
}

Query::connect("localhost", "chat2", "root", "");

$db = new Query();

// $db->select("message","insrciptions.pseudo","dinstinct");
// $db->get_query();
// $db->wheredoublecondition("message","id_expediteur","or","id_destinateur","=")->andwheredoublecondition("and", "message","id_expediteur","or","id_destinateur","=");
// // $val = $class->update("client",["prenom"])->where("id", "=")->execute(["teste",4]);
// $db->get_query();
// $val = $class->delete("client")->where("id", "=")->execute([9]);
// var_dump($val);
