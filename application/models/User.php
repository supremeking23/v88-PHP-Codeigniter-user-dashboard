<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    function mysqli_real_escape_string($val){

        $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
        return $escape_string;
    }

    function get_all_users(){
        return $this->db->query("SELECT * FROM users")->result_array();
    }

    function get_user_by_id($id){
        return $this->db->query("SELECT * FROM users where id = ?", array($id))->row_array();
    }

    function get_user_by_email($email){
        return $this->db->query("SELECT * FROM users where email = ?", array($email))->row_array();
    }

    function add_user($user){
        $query = "INSERT INTO users(first_name,last_name,email,password,salt,user_level,created_at) VALUES (?,?,?,?,?,?,?)";
        $values = array($this->mysqli_real_escape_string($user['first_name']),$this->mysqli_real_escape_string($user['last_name']),$this->mysqli_real_escape_string($user['email']),$this->mysqli_real_escape_string($user['password']),$this->mysqli_real_escape_string($user['salt']),1,date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

    function edit_user_info($user){
        if(array_key_exists("user_level",$user)){
            $query = "UPDATE users SET email = ? , first_name = ? , last_name = ?, user_level = ? , updated_at = ? WHERE id = ?";
            $values = array($this->mysqli_real_escape_string($user['email']),$this->mysqli_real_escape_string($user['first_name']),$this->mysqli_real_escape_string($user['last_name']),$this->mysqli_real_escape_string($user['user_level']),date("Y-m-d, H:i:s"),$this->mysqli_real_escape_string($user['id']));
        }else{
            $query = "UPDATE users SET email = ? , first_name = ? , last_name = ? , updated_at = ? WHERE id = ?";
            $values = array($this->mysqli_real_escape_string($user['email']),$this->mysqli_real_escape_string($user['first_name']),$this->mysqli_real_escape_string($user['last_name']),date("Y-m-d, H:i:s"),$this->mysqli_real_escape_string($user['id']));
        }
       
        return $this->db->query($query,$values);
    }

    function edit_user_password($user){
        $query = "UPDATE users SET password = ?, salt = ?, updated_at = ? WHERE id = ?";
        $values = array($this->mysqli_real_escape_string($user['password']),$this->mysqli_real_escape_string($user['salt']),date("Y-m-d, H:i:s"),$this->mysqli_real_escape_string($user['id']));
        return $this->db->query($query,$values);
    }

    function edit_user_description($user){
        $query = "UPDATE users SET description = ?, updated_at = ? WHERE id = ?";
        $values = array($this->mysqli_real_escape_string($user['description']),date("Y-m-d, H:i:s"),$this->mysqli_real_escape_string($user['id']));
        return $this->db->query($query,$values);
    }

    function delete_user_by_id($id){
        return $this->db->query("DELETE FROM users where id = ?", array($id));
    }

    // function get_all_students(){
    //     return $this->db->query("SELECT * FROM students")->result_array();
    // }
    // function get_student_by_id($student_id){
    //     return $this->db->query("SELECT * FROM students WHERE id = ?", array($student_id))->row_array();
    // }

    // function  get_student_by_email($email){
    //     return $this->db->query("SELECT * FROM students WHERE email = ?", array($this->MysqliRealeScapeString($email)))->row_array();
    // }

    // function add_student($student){
    //     $query = "INSERT INTO students (first_name,last_name,email,password,salt, created_at) VALUES (?,?,?,?,?,?)";
    //     $values = array($this->MysqliRealeScapeString($student['first_name']),$this->MysqliRealeScapeString($student['last_name']),$this->MysqliRealeScapeString($student['email']),$student['password'],$student['salt'], date("Y-m-d, H:i:s")); 
    //     return $this->db->query($query, $values);
    // }

}

?>