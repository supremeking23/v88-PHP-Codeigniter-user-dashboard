<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

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
	public function post_message_process(){
		// $this->load->view('users/index');
        $message_to = $this->input->post("message_to",TRUE);
        $config = array(
			array(
				'field' => 'post_message',
				'label' => 'Message',
				'rules' => 'trim|required'
			),
		
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('error-type', 'Post a message');
            redirect(base_url()."show/".$message_to);
            die();
        }else{
            $message_details = array(
                "from_user_id" => $this->input->post("message_from",TRUE),
                "to_user_id" => $message_to,
                "message" => $this->input->post("post_message",TRUE),
            );

            $post_message = $this->message->add_message($message_details);
            if($post_message){
                $this->session->set_flashdata('post-message-success', '<div class="alert alert-success">Message has been post successfully</div>');
                redirect(base_url()."show/".$message_to);
            }
        }
	}

}