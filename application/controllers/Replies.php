<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replies extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function post_reply_process(){
		// $this->load->view('users/index');
        
        $message_to = $this->input->post("message_to",TRUE);
        $message_id = $this->input->post("message_id",TRUE);
        $config = array(
			array(
				'field' => 'post_reply',
				'label' => 'Reply',
				'rules' => 'trim|required'
			),
		
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('error-type', 'Post a message');
            redirect(base_url()."show/".$message_to."/".$message_id);
            die();
        }else{
            $reply_details = array(
                "user_id" => $this->input->post("reply_from",TRUE),
                "message_id" => $message_id,
                "reply" => $this->input->post("post_reply",TRUE),
            );

            $post_reply = $this->reply->add_reply($reply_details);
            if($post_reply){
                $this->session->set_flashdata('post-reply-success', '<div class="alert alert-success">Reply has been post successfully</div>');
                redirect(base_url()."show/".$message_to."/".$message_id);
            }
           
        }
	}

}