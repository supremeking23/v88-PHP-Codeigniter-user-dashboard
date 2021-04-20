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

	/**
	 * TODO: Loads the users/index view
	 * TODO: set session:active_link to home, the purpose of this session is for the link to be set to active whenver the user goes to index page
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
	public function index(){
		$this->session->set_userdata("active_link","home");
		$this->load->view('users/index');
	}

	/**
	 * TODO: destroys the session and redirects to signin page/method
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
	public function logoff(){
		$this->session->sess_destroy();
		redirect(base_url()."signin");
	}

	/**
	 * TODO: if the is_logged_in session is true and user level session is equal to admin(user_level:9) redirect to admin method
	 * TODO: other wise redirect to dashboard method (for normal users) 
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
    public function signin(){
		if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 9){
			redirect(base_url()."admin");
		}else if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 1){
			redirect(base_url()."dashboard");
		}else{
			$this->load->view('users/signin');
		}
		


	}

	/**
	 * TODO: Handles the signin in process
	 * TODO: uses form validation library to validate form fields
	 * TODO: if the form field pass the validation process, email and password field will be clean using XSS clean of codeigniter
	 * TODO: if user credentials were incorrect it will redirect back to signin view page with error message(incorrect email if no email found/wrong email, wrong password for incorrect password)
	 * TODO: if user credentials were correct, create a session user_data for is_logged_in, user_id, user_level,active_link
	 * TODO: redirect will be base on the user_level of user
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
	public function signin_process(){
		$config = array(
			array(
				'field' => 'email',
				'label' => 'Email',
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
					'active_link' => "",
					
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

	/**
	 * TODO: will load the register view
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
    public function register(){
		$this->load->view('users/register');

		
	}

	/**
	* TODO: Handles the registraion process
	* TODO: uses form validation library to validate form fields
	* TODO: if the form field pass the validation process, all fields in the registration form will be clean using XSS clean of codeigniter
	* TODO: after the user information has been added to the database it will redirect back to the registration view with a success message
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
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

	/**
	 * TODO: set active_link session to dashboard, will use this for setting the link to be active once the user is on the admin page
	 * TODO: redirect user and load all users if the the is_logged_in session is true and user_level is equals to 9, otherwise redirect to sign in
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
    public function admin(){
		$this->session->set_userdata("active_link","dashboard");
		if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 9){
			$data['current_user'] = $this->user->get_user_by_id($this->session->userdata("user_id"));
			$data['users'] = $this->user->get_all_users();
			$this->load->view('users/admin',$data);
		}else{
			redirect(base_url()."signin");
		}
		
	}

	/**
	 * TODO: will load the view new, contains a form for adding new user
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
    public function new(){
		$this->load->view('users/new');
	}


	/**
	* TODO: Handles the adding of new user process
	* TODO: uses form validation library to validate form fields
	* TODO: if the form field pass the validation process, all fields in the add bew user form will be clean using XSS clean of codeigniter
	* TODO: after the user information has been added to the database it will redirect back to the add new user view with a success message
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */
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

	/**
	* TODO: Handles the updating of user information process
	* TODO: uses form validation library to validate form fields
	* TODO: if the form field pass the validation process, all fields in the edit user info form will be clean using XSS clean of codeigniter
	* TODO: after the user information has been updated to the database it will redirect back to the edit view with a success message
	* @param: none
	* * Author: Ivan Christian Jay Funcion
	*/

	// public function edit_profile_process(){
	// 	var_dump($this->input->post());

	// 	if($this->input->post("user-level")){
	// 		echo $this->input->post("user-level");
	// 	}else{
	// 		echo "walang user level";
	// 	}
	// }

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

				if($this->input->post("user-level")){
					$user_details = array(
						"email" => $this->input->post("email",TRUE),
						"first_name" => $this->input->post("first_name",TRUE),
						"last_name" => $this->input->post("last_name",TRUE),
						"user_level" => $this->input->post("user-level",TRUE),
						"id" =>  $this->input->post("user-id",TRUE),
					);
				}else{
					$user_details = array(
						"email" => $this->input->post("email",TRUE),
						"first_name" => $this->input->post("first_name",TRUE),
						"last_name" => $this->input->post("last_name",TRUE),
						"id" =>  $this->input->post("user-id",TRUE),
					);
				}
				
				var_dump($user_details);
				$edit_user = $this->user->edit_user_info($user_details);
				if($edit_user === TRUE) {
				
					$this->session->set_flashdata('edit-user-info-success', '<div class="alert alert-success">User information has been updated successfully</div>');
					if($this->session->userdata("user_id") == $this->input->post("user-id",TRUE)){
						redirect(base_url()."edit");
					}else{
						redirect(base_url()."edit/".$this->input->post("user-id",TRUE));
					}
					
				}
				
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
					"id" => $this->input->post("user-id",TRUE),
				);
				var_dump($user_details);
				$edit_user = $this->user->edit_user_password($user_details);
				if($edit_user === TRUE) {
				
					$this->session->set_flashdata('edit-user-password-success', '<div class="alert alert-success">User password has been updated successfully</div>');
					if($this->session->userdata("user_id") == $this->input->post("user-id",TRUE)){
						redirect(base_url()."edit");
					}else{
						redirect(base_url()."edit/".$this->input->post("user-id",TRUE));
					}
				}
			}
		}else if($this->input->post("process-type",TRUE) =="edit-description"){
			var_dump($this->input->post());
			$user_details = array(
				"description" => $this->input->post("description",TRUE) ,
				"id" => $this->input->post("user-id",TRUE),
			);
			$edit_user = $this->user->edit_user_description($user_details);
			var_dump($this->input->post());
			if($edit_user === TRUE) {
				
				$this->session->set_flashdata('edit-user-description-success', '<div class="alert alert-success">User description has been updated successfully</div>');
				
				if($this->session->userdata("user_id") == $this->input->post("user-id",TRUE)){
					redirect(base_url()."edit");
				}else{
					redirect(base_url()."edit/".$this->input->post("user-id",TRUE));
				}
			}

		}


	}


	/**
	 * TODO: set active_link session to dashboard, will use this for setting the link to be active once the user is on the dashboard page
	 * TODO: redirect user and load all users if the the is_logged_in session is true and user_level is equals to 1, otherwise redirect to sign in
	 * @param: none
	 * * Author: Ivan Christian Jay Funcion
	 */

    public function dashboard(){
		$this->session->set_userdata("active_link","dashboard");
		if($this->session->userdata('is_logged_in') === TRUE AND $this->session->userdata("user_level") == 1){
			$data['users'] = $this->user->get_all_users();
			
			$this->load->view('users/dashboard',$data);
		}else{
			
			redirect(base_url()."signin");
		}
		
	}

	
	/**
	 * TODO: set active_link session to show, will use this for setting the link to be active once the user is on the show page
	 * TODO: redirect user and load all users if the the is_logged_in session is true and user_level is equals to 1, otherwise redirect to sign in
	 * @param show($id,$message_id)
	 * TODO:  the first parameter will load all the message based for a specific user equals to the first paramter($id), second paramter is to load all replies based on a specific message(message id).
	 * TODO: if message_id is null it will only load all the message for that user, otherwise it will have another view to load all replies on the message
	 * * Author: Ivan Christian Jay Funcion
	 */
    public function show($id,$message_id = NULL){
		$this->session->set_userdata("active_link","show");
		$data['current_user'] = $this->user->get_user_by_id($this->session->userdata("user_id"));
		$data['user'] = $this->user->get_user_by_id($id);
		$data['messages'] = $this->message->get_all_messages_by_receipient_id($id);
		// $data['reply_count'] = $this->reply->get_reply_count_by_message_id($message_id);
		// 
		if($message_id === NULL){
			
			$this->load->view('users/show',$data);
		}else{
			$message_details = array(
				"message_id" => $message_id,
				"to_user_id" => $id,
			);
			$data['message'] = $this->message->get_message_by_receipient_id_and_message_id($message_details);
			$data['replies'] = $this->reply->get_all_replies_by_receipient_id_and_message_id($message_details);
			$this->load->view('users/reply',$data);
		}
		
	}

	/**
	* TODO: Handles the deletion of user
	
	* TODO: if success it will redirect to the admin method and display a message saying the the user has been deleted
	* @param: none
	* * Author: Ivan Christian Jay Funcion
	*/
	public function delete_user(){
		$delete_user = $this->user->delete_user_by_id($this->input->post("user-id"),TRUE);
		if($delete_user === TRUE){
			$this->session->set_flashdata('delete-user-success', '<div class="alert alert-success">User has been deleted successfully</div>');
					redirect(base_url()."admin");
		}

	}

	/**
	* TODO: set the active_link to profile
	* TODO: if the parameter is null then the user that we are going to edit is the user who is currently login, otherwise the user data must be from a get requst
	* @param edit(id)
	* * Author: Ivan Christian Jay Funcion
	*/
    public function edit($id = NULL){
		
		$data['current_user'] = $this->user->get_user_by_id($this->session->userdata("user_id"));
		if(!(is_null($id))){
			$data['user_info'] = $this->user->get_user_by_id($id);
		}else{
			$this->session->set_userdata("active_link","profile");
			$data['user_info'] = $this->user->get_user_by_id($this->session->userdata("user_id"));
		}
		
		$this->load->view('users/edit',$data);
	}
}
