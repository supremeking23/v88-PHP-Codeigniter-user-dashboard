<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
	public function index(){
		$this->load->view('users/index');
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect(base_url()."signin");
	}

    public function signin(){
		if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 9){
			redirect(base_url()."admin");
		}else if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 9){
			redirect(base_url()."dashboard");
		}else{
			$this->load->view('users/signin');
		}
		


	}

	public function signin_process(){
		$config = array(
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|required|valid_email'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			),
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('error-type', 'Sigin Error');
            redirect(base_url()."signin");
            die();

        }

		$user = $this->user->get_user_by_email($this->input->post("email",TRUE)); //XSS clean
		if(!$user){
            $this->session->set_flashdata('errors', '<li>Incorrect Email</li>');
			$this->session->set_flashdata('error-type', 'Incorrect Credential');
			redirect(base_url()."signin");
            die();
		}else{
			$encrypted_password = md5($this->input->post("password",TRUE). '' . $user["salt"]);
			if($user["password"] == $encrypted_password){
				$user = array(
					'user_id' => $user['id'],
					// 'student_email' => $student['email'],
					// 'student_firstname' => $student['first_name'],
					// 'student_lastname' => $student['last_name'],
					// 'student_fullname' => $student['first_name'].' '.$student['last_name'],
					'is_logged_in' => true,
					'user_level' => $user['user_level'],
				 );
				 $this->session->set_userdata($user);
				 echo $this->session->userdata("user_level");
				 if($this->session->userdata("user_level") == 9){
					redirect(base_url()."admin");
				 }else if($this->session->userdata("user_level") == 1){
					redirect(base_url()."dashboard");
				 }
				 die();
				//  redirect(base_url()."profile");
			}else{
				$this->session->set_flashdata('errors', '<li>Incorrect Password</li>');
				$this->session->set_flashdata('error-type', 'Incorrect Credential');
				redirect(base_url()."signin");
				die();
			}
		}
	}

    public function register(){
		$this->load->view('users/register');

		
	}

	public function register_process(){
		$config = array(
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|required|valid_email'
			),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[8]'
			),
			array(
				'field' => 'confirm_password',
				'label' => 'Password Confirm',
				'rules' => 'trim|required|matches[password]|min_length[8]'
			),
		);

		$this->form_validation->set_rules($config);

		
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('error-type', 'Registration Error');
            redirect(base_url()."register");
			die();
		}else{
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($this->input->post("password",TRUE) . '' . $salt);

			$user_details = array(
				"email" => $this->input->post("email",TRUE),
				"first_name" => $this->input->post("first_name",TRUE),
				"last_name" => $this->input->post("last_name",TRUE),
				"password" => $encrypted_password,
				"salt" => $salt
			);

			$add_user = $this->user->add_user($user_details);
			if($add_user === TRUE) {
				// echo "Course is added!";
				$this->session->set_flashdata('add-user-success', '<div class="alert alert-success">User information has been added successfully</div>');
				redirect(base_url()."register");
			}
		}
		
	}

    public function admin(){
		if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 9){
			$data['users'] = $this->user->get_all_users();
			$this->load->view('users/admin',$data);
		}else{
			redirect(base_url()."signin");
		}
		
	}

    public function new(){
		$this->load->view('users/new');
	}

	public function add_new_process(){

		$config = array(
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|required|valid_email'
			),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[8]'
			),
			array(
				'field' => 'confirm_password',
				'label' => 'Password Confirm',
				'rules' => 'trim|required|matches[password]|min_length[8]'
			),
		);

		$this->form_validation->set_rules($config);

		
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('error-type', 'Add new user error');
            redirect(base_url()."new");
			die();
		}else{
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($this->input->post("password",TRUE) . '' . $salt);

			$user_details = array(
				"email" => $this->input->post("email",TRUE),
				"first_name" => $this->input->post("first_name",TRUE),
				"last_name" => $this->input->post("last_name",TRUE),
				"password" => $encrypted_password,
				"salt" => $salt
			);

			$add_user = $this->user->add_user($user_details);
			if($add_user === TRUE) {
				// echo "Course is added!";
				$this->session->set_flashdata('add-user-success', '<div class="alert alert-success">User information has been added successfully</div>');
				redirect(base_url()."new");
			}
		}
		
	}

	public function edit_profile_process(){
		if($this->input->post("process-type",TRUE) == "edit-info"){

			$config = array(
				array(
					'field' => 'email',
					'label' => 'email',
					'rules' => 'trim|required|valid_email'
				),
				array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'trim|required'
				),
				
			);
	
			$this->form_validation->set_rules($config);
	
			
			if($this->form_validation->run() === FALSE){
				$errors = validation_errors('<li>', '</li>');
				$this->session->set_flashdata('errors', $errors);
				$this->session->set_flashdata('error-type', 'Edit information error');
				redirect(base_url()."edit");
				die();
			}else{
				$user_details = array(
					"email" => $this->input->post("email",TRUE),
					"first_name" => $this->input->post("first_name",TRUE),
					"last_name" => $this->input->post("last_name",TRUE),
					"id" => $this->session->userdata("user_id"),
				);
				var_dump($user_details);
				$edit_user = $this->user->edit_user_info($user_details);
				if($edit_user === TRUE) {
				
					$this->session->set_flashdata('edit-user-info-success', '<div class="alert alert-success">User information has been updated successfully</div>');
					redirect(base_url()."edit");
					
				}
				// var_dump($this->input->post());
			}


		}else if($this->input->post("process-type",TRUE) =="edit-password"){
			$config = array(
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[8]'
				),
				array(
					'field' => 'confirm_password',
					'label' => 'Password Confirm',
					'rules' => 'trim|required|matches[password]|min_length[8]'
				),
				
			);
	
			$this->form_validation->set_rules($config);

			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($this->input->post("password",TRUE) . '' . $salt);
	
			
			if($this->form_validation->run() === FALSE){
				$errors = validation_errors('<li>', '</li>');
				$this->session->set_flashdata('errors', $errors);
				$this->session->set_flashdata('error-type', 'Edit password error');
				redirect(base_url()."edit");
				die();
			}else{
				$user_details = array(
					"password" => $encrypted_password,
					"salt" => $salt,
					"id" => $this->session->userdata("user_id"),
				);
				var_dump($user_details);
				$edit_user = $this->user->edit_user_password($user_details);
				if($edit_user === TRUE) {
				
					$this->session->set_flashdata('edit-user-password-success', '<div class="alert alert-success">User password has been updated successfully</div>');
					redirect(base_url()."edit");
				}
			}
		}else if($this->input->post("process-type",TRUE) =="edit-description"){
			var_dump($this->input->post());
			$user_details = array(
				"description" => $this->input->post("description",TRUE) ,
				"id" => $this->session->userdata("user_id"),
			);
			$edit_user = $this->user->edit_user_description($user_details);
			// var_dump($this->input->post())
			if($edit_user === TRUE) {
				
				$this->session->set_flashdata('edit-user-description-success', '<div class="alert alert-success">User description has been updated successfully</div>');
				redirect(base_url()."edit");
			}

		}


	}


    public function dashboard(){
		if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 1){
			$data['users'] = $this->user->get_all_users();
			$this->load->view('users/dashboard',$data);
		}else{
			redirect(base_url()."signin");
		}
		
	}

    public function show($id){
		$data['user'] = $this->user->get_user_by_id($id);
		$this->load->view('users/show',$data);
	}

    public function edit(){
		$data['user_info'] = $this->user->get_user_by_id($this->session->userdata("user_id"));
		$this->load->view('users/edit',$data);
	}
}
