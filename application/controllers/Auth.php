<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');


	}

	public function index()
	{	
		if($this->session->userdata('email')){
			redirect('user');
		}
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');//untuk rules 
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() == false){

			$data['title'] = 'login Page';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}else{
			$this->_login();
		}
	}



	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		

		$user = $this->db->get_where('user',['email'=>$email])->row_array(); //ambil email select from db where email
		//jika usernya  ada




		if ($user) {
			//jika usernya aktif
			if($user['is_active'] == 1){
				//cek password
				if (password_verify($password, $user['password'])) {
					$data=[
						'email' =>$user['email'],
						'role_id' =>$user['role_id']
					];
					
					$this->session->set_userdata($data);
					if ($user['role_id']==1) {
						redirect('admin');
						
					}else{
						redirect('user');
					}

				}else{
					
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
						Wrong Pasword!</div>');
					redirect('auth');
				}

			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					this email has not been activated!
					</div>');
				redirect('auth');
			}

		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Email is not Registred!
				</div>');
			redirect('auth');

		}

	}

	public function registration()
	{ 

		if($this->session->userdata('email')){
			redirect('user');
		}
		$this->form_validation->set_rules('name','Name','required|trim'); //required harus diisi , trim = menghilangkan spasi agar tidak masuk kedatabase

		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'this email has already registed'
		]); //unique : untuk cek tabel user ada apa ngga
		$this->form_validation->set_rules('password1','Password','required|trim|min_Length[3]|matches[password2]',[
			'matches' =>'Password dont match!!',
			'min_Length' =>'Pasword too short'
		]);
		$this->form_validation->set_rules('password2','Password','required|trim|min_Length[3]|matches[password1]');
		
		if($this->form_validation->run() == false){
			$data['title'] = 'WPU User Registration';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		}else{
			$email = $this->input->post('email',true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name',true)),
				'email' => htmlspecialchars($email),
				'image' =>'default.jpg',
				'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' =>0,
				'date_created' => time()
			];
			

			//ambil token bilangan byte random encode untk terjemahkan
			$token =base64_encode(random_bytes(32));
			$user_token = [
				'email' =>$email,
				'token' =>$token,
				'date_created' => time() //waktu saat ini ada pada library php
			];

			$this->db->insert('user',$data);
			$this->db->insert('user_token',$user_token);
			
			$this->_sendemail($token, 'verify'); //verify untuk verifikasi





			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Congratulation! your account has been created. Please activated your account!
				</div>');
			redirect('auth');

		}
	}

	private function _sendemail($token,$type){
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'webrekamedis@gmail.com',
			'smtp_pass' => 'Bamsol62',
			'smtp_port' =>465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email',$config);
		$this->email->initialize($config);

		$this->email->from('webrekamedis@gmail.com', 'web rekam medis');
		$this->email->to($this->input->post('email'));

		if ($type='verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : <a href = "'.base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token =' . urlencode($token) .'"> Activate </a>');
		}

		

		if ($this->email->send()) {
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}



	}




	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

	$user = $this->db->get_where('user', ['email' => $email]) ->row_array(); //ambil sebaris

	if ($user) {
		$user_token = $this->db->get_where('user
			token' , ['token => $token'])->row_array();
		//cek apakah da tidaknya di database
		if ($user_token) {
			if (time()-$user_token['date_created'] > (60*60*24)) {
			$this->db->set('is_active' , 1); //untuk megbah
			$this->db->where('email' , $email);
			$this->db->update('user'); //ditabel user

			$this->db->delete('user_token',['email' => $email]);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				'. $email . ' has been actived!
				Please Login.
				</div>');
			redirect('auth');
		}else{

			$this->db->delete('user',['email' => $email]);
			$this->db->delete('user_token',['email' => $email]);




			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Account Activation failed! Token expired.
				</div>');
			redirect('auth');
		}
		
	}else{
		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			Account Activation failed! Wrong Token
			</div>');
		redirect('auth');
	}
}else{
	$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
		Account Activation failed! Wrong email
		</div>');
			redirect('auth'); //kalo user usil activated
		}


	}


	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			you have been logout!
			</div>');
		redirect('auth');
	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}




}

//