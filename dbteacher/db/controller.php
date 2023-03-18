<?php
class Controller{
    private $db;

    function __construct($con){
        $this->db=$con;
    }

    function getdepartment(){
        try{
            $sql = "SELECT * FROM department";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function getmember(){
        try{
            $sql = "SELECT * FROM member a INNER JOIN department b ON a.department_id = b.department_id ORDER By a.emp_id";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }  
    }
    
    function insert($name,$sname,$email,$department_id){
        try{
            $sql="INSERT INTO member(name,sname,email,department_id) VALUES (:name,:sname,:email,:department_id)";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":name",$name);
            $stmt->bindParam(":sname",$sname);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":department_id",$department_id);   
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
    function delete($id){
        try{
            $sql="DELETE FROM member WHERE emp_id=:id ";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    function getmemberDetail($id){
        try{
            $sql="SELECT * FROM member a 
            INNER JOIN department b
            ON a.department_id = b.department_id WHERE emp_id =:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    function update($fname,$sname,$email,$department_id,$emp_id){
        try{
            $sql="UPDATE member 
            SET name=:name, sname=:sname, email=:email, department_id=:department_id 
            WHERE emp_id = :emp_id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":name",$fname);
            $stmt->bindParam(":sname",$sname);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":department_id",$department_id);
            $stmt->bindParam(":emp_id",$emp_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

?>