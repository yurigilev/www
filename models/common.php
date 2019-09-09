<?php
class Common {

    public static function login($user,$pass) 
    {
        $db=Db::Connect();
        $sql="select * from users where login='$user' and pass='$pass'";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $count=$result->rowCount();

        if ($count>0) {
            $row=$result->fetch();
            return array ($row['id'],$row['name']);
        } else return false;
    }
    
    public static function add($user,$email,$task) 
    {
        $db=Db::Connect();
        $sql="INSERT INTO tasks (name, email, text) VALUES ('$user','$email','$task');";
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }


    public static function del($id) {
        $db=Db::Connect();
        $sql="DELETE FROM tasks WHERE id='$id'";
        return $db->exec($sql);
    }

    public static function edit($id,$text,$status) 
    {
        $db=Db::Connect();
        $sql="UPDATE tasks set text='$text'";
        if (isset($status)) {
            $sql.=", status='$status'";
        }
        $sql.=" WHERE id='$id'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return true;
    }


    public static function get($id) 
    {
        $db=Db::Connect();    

        $sql="SELECT * FROM tasks WHERE id='$id'";
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result = $db->query($sql);        
        return true;
    }


    public static function getList($page,$sort) 
    {
        $begin=($page-1)*3;
        $db=Db::Connect();  
        $sql="SELECT * FROM tasks ORDER BY $sort LIMIT $begin,3";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $ara=array();

        while ($row=$result->fetch()) {
            array_push($ara, $row);
        }
        return $ara;
    }

    public static function pagination() {
        $db=Db::Connect();  
        $sql="SELECT * FROM tasks";
        $result = $db->query($sql);
        $count=$result->rowCount();
        $pg=floor($count/3);
        if (($count % 3) > 0) {
            $pg++;
        } 
        return $pg;
    }
}


?>