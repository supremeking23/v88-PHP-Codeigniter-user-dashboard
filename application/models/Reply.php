<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Manila');
class Reply extends CI_Model {
    

    function mysqli_real_escape_string($val){

        $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
        return $escape_string;
    }





    function get_all_replies_by_receipient_id_and_message_id($message){
        $query = "SELECT users.first_name, users.last_name, users.id,replies.user_id,replies.reply,replies.created_at FROM users INNER JOIN replies ON users.id = replies.user_id WHERE replies.message_id = ?  ORDER BY replies.created_at DESC";
        
        return $this->db->query($query,array($message["message_id"]))->result_array();
    }

    function get_reply_count_by_message_id($message_id){
        $query = "SELECT COUNT(replies.id) as reply_count  FROM messages INNER JOIN replies ON messages.id = replies.message_id GROUP BY replies.message_id HAVING replies.message_id = ?";
        $values = array($message_id); 
        return $this->db->query($query,$values)->row_array();
    }

    function get_all_replies(){
        return $this->db->query("SELECT * FROM replies")->result_array();
    }



    function add_reply($message){
        $query = "INSERT INTO replies(message_id,user_id,reply,created_at) VALUES (?,?,?,?)";
        $values = array($this->mysqli_real_escape_string($message['message_id']),$this->mysqli_real_escape_string($message['user_id']),$this->mysqli_real_escape_string($message['reply']),date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }



}

?>