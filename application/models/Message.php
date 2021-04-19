<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Manila');
class Message extends CI_Model {
    

    function mysqli_real_escape_string($val){

        $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
        return $escape_string;
    }

    function get_all_messages(){
        return $this->db->query("SELECT * FROM messages")->result_array();
    }

    function get_all_messages_by_receipient_id($id){
        $query = "SELECT users.id,messages.id as message_id,users.first_name, users.last_name, users.id,messages.to_user_id,messages.message,messages.created_at FROM users INNER JOIN messages ON users.id = messages.from_user_id WHERE messages.to_user_id = ? ORDER BY messages.created_at DESC";
        
        return $this->db->query($query, array($id))->result_array();
    }

    function get_message_by_receipient_id_and_message_id($message){
        $query = "SELECT messages.id as message_id,users.first_name, users.last_name, users.id,messages.to_user_id,messages.message,messages.created_at FROM users INNER JOIN messages ON users.id = messages.from_user_id WHERE messages.to_user_id = ? AND messages.id = ? ORDER BY messages.created_at DESC";
        
        return $this->db->query($query, array($message["to_user_id"],$message["message_id"]))->row_array();
    }



    function get_message_by_id($id){
        return $this->db->query("SELECT * FROM messages where id = ?", array($id))->row_array();
    }


    function add_message($message){
        $query = "INSERT INTO messages(from_user_id,to_user_id,message,created_at) VALUES (?,?,?,?)";
        $values = array($this->mysqli_real_escape_string($message['from_user_id']),$this->mysqli_real_escape_string($message['to_user_id']),$this->mysqli_real_escape_string($message['message']),date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }



}

?>