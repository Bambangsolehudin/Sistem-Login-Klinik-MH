<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('menu_model');
	}
	public function index()
	{


		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		

		// echo 'selamat datang'. $data['user']['name'];	
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer');
	}


	public function edit(){
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('name','Full Name','required|trim');
		
		if ($this->form_validation->run()== false) {
			# code...
			
		// echo 'selamat datang'. $data['user']['name'];	
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/edit',$data);
			$this->load->view('templates/footer');
		}else{
			$name =$this->input->post('name');
			$email =$this->input->post('email');

			//cek jika ada gambar yang akan diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload',$config);
				if ($this->upload->do_upload('image')) {
					$old_image=$data['user']['image'];
					if($old_image != 'default.jpg'){
						unlink(FCPATH . 'assets/img/profile/' . $old_image); //untuk menghapus data
					}



					$new_image = $this->upload->data('file_name');
					$this->db->set('image',$new_image);
				}else{
					echo $this->upload->display_errors();
				}

			}



			$this->db->set('name',$name);
			$this->db->where('email',$email);
			$this->db->update('user');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Your Profille has been update
				</div>');
			redirect('user');

		}
	}



	public function changePassword()
	{


		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		



		$this->form_validation->set_rules('current_password','Current Password','required|trim');
		$this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2','New Password','required|trim|min_length[3]|matches[new_password1]');
		if ($this->form_validation->run()== false) {
		// echo 'selamat datang'. $data['user']['name'];	
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/changepassword',$data);
			$this->load->view('templates/footer');
		}else{
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');

			if(!password_verify($current_password,$data['user']['password'])){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Wrong Current Password!
					</div>');
				redirect('user/changepassword');

			}else{
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
						New Password cannot be same as current password!
						</div>');
					redirect('user/changepassword');
				}else{
				//password ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password',$password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');


					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
						Pasword Changed!

						</div>');

					redirect('user/changepassword');
				}
			}
		}

	}




	























//REKAM MEDIS





	public function rekam_medis()
	{
		$data['title'] = 'Rekam Medis';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();

		$data['tindakan'] = $this->db->get('data_tindakan')->result_array();
		$data['medis'] = $this->db->get('rekam_medis')->result_array();
		$data['visit'] =  ['ya','tidak'];
		
		if ($this->input->post('keyword')) {
			$data['medis'] =  $this->menu_model->searchDataRM();
		}
		
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/rekam_medis',$data);
		$this->load->view('templates/footer');
	}
	

	public function deleteRM($id)
	{	
		
		$this->db->where('id',$id);
		$this->db->delete('rekam_medis');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Deleted!
			</div>');
		redirect('user/rekam_medis');
	}

	public function editRM($id)
	{
		$data['title'] = 'Rekam Medis';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		
		$data['medis'] = $this->db->get('rekam_medis')->result_array();
		$data['visit'] =  ['ya','tidak'];
		$data['tindakan'] = $this->db->get('data_tindakan')->result_array();
		// echo 'selamat datang'. $data['user']['name'];	
		$data['edit'] = $this->menu_model->getRMById($id);
		
		

		$this->form_validation->set_rules('tgl_periksa','Tanggal Periksa','required'); 
		$this->form_validation->set_rules('id_rm','id_rm','required'); 
		$this->form_validation->set_rules('id_pasien','ID Pasien','required'); 
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('visit','Visit','required');
		$this->form_validation->set_rules('anamnesa','Anamnesa','required');
		$this->form_validation->set_rules('diagnosa','Diagnosa','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		$this->form_validation->set_rules('biaya','Biaya','required');
		
		if ($this->form_validation->run() == false) 
		{
			if ($this->input->post('keyword')) {
				$data['menu'] =  $this->menu_model->searchDataMenu();
			}
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/editRM',$data);
			$this->load->view('templates/footer');

		}else{

			$data =
			[	
				'tgl_periksa' => $this->input->post('tgl_periksa'),
				'id_rm' => $this->input->post('id_rm'),
				'id_pasien' => $this->input->post('id_pasien'),
				'nama' => $this->input->post('nama'),
				'visit'=> $this->input->post('visit'),
				'anamnesa'=> $this->input->post('anamnesa'),
				'diagnosa'=> $this->input->post('diagnosa'),
				'keterangan'=> $this->input->post('keterangan'),
				'biaya'=> $this->input->post('biaya')
			];
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('rekam_medis',$data);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Data Updated!
				</div>');
			redirect('user/rekam_medis');
		}
	}

	function tambahRm1(){
		$data['title'] = 'Tambah RM';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		
		$data['tindakan'] = $this->db->get('data_tindakan')->result_array();
		$data['pasien'] = $this->db->get('data_pasien')->result_array();
		$data['visit'] =  ['ya','tidak'];
		
		if ($this->input->post('keyword')) {
			$data['pasien'] =  $this->menu_model->searchDataPasien();

		}
		
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/tambahRm1',$data);
		$this->load->view('templates/footer');
	}












	public function tambah_RM($id){
		$data['title'] = 'Rekam Medis';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();

		$data['tindakan'] = $this->db->get('data_tindakan')->result_array();
		$data['medis'] = $this->db->get('rekam_medis')->result_array();
		$data['visit'] =  ['ya','tidak'];
		$data['edit'] = $this->menu_model->getPasienById($id);
		// echo 'selamat datang'. $data['user']['name'];	
		$this->form_validation->set_rules('id_pasien','ID Pasien','required'); 
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('visit','Visit','required');
		$this->form_validation->set_rules('anamnesa','Anamnesa','required');
		$this->form_validation->set_rules('diagnosa','Diagnosa','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		$this->form_validation->set_rules('biaya','Biaya','required');
		if ($this->input->post('keyword')) {
			$data['medis'] =  $this->menu_model->searchDataRM();
		}
		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/tambah_RM',$data);
			$this->load->view('templates/footer');

		}else{

			$data =
			[
				'tgl_periksa' => $this->input->post('tgl_periksa'),
				'id_rm' => $this->input->post('id_rm'),
				'id_pasien' => $this->input->post('id_pasien'),
				'nama' => $this->input->post('nama'),
				'visit'=> $this->input->post('visit'),
				'anamnesa'=> $this->input->post('anamnesa'),
				'diagnosa'=> $this->input->post('diagnosa'),
				'keterangan'=> $this->input->post('keterangan'),
				'biaya'=> $this->input->post('biaya')
			];

			$this->db->insert('rekam_medis', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Menu Added!
				</div>');
			redirect('user/rekam_medis');
		}
	}
	

	
	public function detailRM($id)
	{
		$data['title'] = 'Detail RM';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		$data['detail'] = $this->menu_model->getRMById($id);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/detailRM',$data);
		$this->load->view('templates/footer');
	}

	public function cetakRM($id)
	{
		
		
		$data['title'] = 'Detail RM';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		$data['detail'] = $this->menu_model->getRMById($id);
		
		$this->load->view('user/cetakRM',$data);
		
		
		
		

	}































//DATA PASIEN




	public function data_pasien()
	{
		$data['title'] = 'Data Pasien';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		
		$data['pasien'] = $this->db->get('data_pasien')->result_array();
		$data['status'] = ['Menikah','Belum Menikah'];
		$data['status_bayar'] = ['Lunas','Belum Lunas'];
		// echo 'selamat datang'. $data['user']['name'];	
		$this->form_validation->set_rules('id_pasien','ID Pasien','required'); 
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telepon','Telepon','required');
		$this->form_validation->set_rules('status','Status','required');
		$this->form_validation->set_rules('pekerjaan','Pekerjaan','required');
		$this->form_validation->set_rules('status_bayar','Status Bayar','required');
		if ($this->input->post('keyword')) {
			$data['pasien'] =  $this->menu_model->searchDataPasien();
		}
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/data_Pasien',$data);
		$this->load->view('templates/footer');
		
	}










	public function tambahPasien()
	{
		$data['title'] = 'Data Pasien';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		
		$data['pasien'] = $this->db->get('data_pasien')->result_array();
		$data['status'] = ['Menikah','Belum Menikah'];
		$data['status_bayar'] = ['Lunas','Belum Lunas'];
		// echo 'selamat datang'. $data['user']['name'];	
		$this->form_validation->set_rules('id_pasien','ID Pasien','required'); 
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telepon','Telepon','required');
		$this->form_validation->set_rules('status','Status','required');
		$this->form_validation->set_rules('pekerjaan','Pekerjaan','required');
		$this->form_validation->set_rules('status_bayar','Status Bayar','required');
		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/tambahPasien',$data);
			$this->load->view('templates/footer');

		}else{

			$data =
			[
				'id_pasien' => $this->input->post('id_pasien'),
				'nama' => $this->input->post('nama'),
				'tanggal_lahir'=> $this->input->post('tanggal_lahir'),
				'alamat'=> $this->input->post('alamat'),
				'telepon'=> $this->input->post('telepon'),
				'status'=> $this->input->post('status'),
				'pekerjaan'=> $this->input->post('pekerjaan'),
				'status_bayar'=> $this->input->post('status_bayar')
			];

			$this->db->insert('data_pasien', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Menu Added!
				</div>');
			redirect('user/data_pasien');
		}
	}







	public function deletePasien($id)
	{	
		
		$this->db->where('id',$id);
		$this->db->delete('data_pasien');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Deleted!
			</div>');
		redirect('user/data_pasien');
	}
	public function editPasien($id)
	{
		$data['title'] = 'Data Pasien';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		$data['pasien'] = $this->db->get('data_pasien')->result_array();
		$data['edit'] = $this->menu_model->getPasienById($id);
		$data['status'] = ['Menikah','Belum Menikah'];
		$data['status_bayar'] = ['Lunas','Belum Lunas'];
		$this->form_validation->set_rules('id_pasien','ID Pasien','required'); 
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telepon','Telepon','required');
		$this->form_validation->set_rules('status','Status','required');
		$this->form_validation->set_rules('pekerjaan','Pekerjaan','required');
		if ($this->input->post('keyword')) {
			$data['pasien'] =  $this->menu_model->searchDataPasien();
		}
		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/editPasien',$data);
			$this->load->view('templates/footer');

		}else{

			$data =
			[
				'id_pasien' => $this->input->post('id_pasien'),
				'nama' => $this->input->post('nama'),
				'tanggal_lahir'=> $this->input->post('tanggal_lahir'),
				'alamat'=> $this->input->post('alamat'),
				'telepon'=> $this->input->post('telepon'),
				'status'=> $this->input->post('status'),
				'pekerjaan'=> $this->input->post('pekerjaan')
			];
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('data_pasien', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Menu Added!
				</div>');
			redirect('user/data_pasien');
		}
	}
	function detailPasien($id)
	{
		$data['title'] = 'Detail Pasien';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		$data['pasien'] = $this->db->get('data_pasien')->result_array();
		$data['detail'] = $this->menu_model->getPasienById($id);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/detailPasien',$data);
		$this->load->view('templates/footer');
	}


































//data Tindakan


	public function data_tindakan()
	{
		$data['title'] = 'Data Tindakan';
		$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['tindakan'] = $this->db->get('data_tindakan')->result_array();
		
		$this->form_validation->set_rules('nama_tindakan','Nama Tindakan','required');
		$this->form_validation->set_rules('biaya','Biaya','required');
		if ($this->input->post('keyword')) {
			$data['tindakan'] =  $this->menu_model->searchDataTindakan();
		}
		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/data_tindakan',$data);
			$this->load->view('templates/footer');

		}else{

			$data =
			[
				'nama_tindakan' => $this->input->post('nama_tindakan'),
				'biaya' => $this->input->post('biaya'),
				
			];

			$this->db->insert('data_tindakan', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Data Added!
				</div>');
			redirect('user/data_tindakan');
		}
	}

	public function deleteTindakan($id)
	{	
		
		$this->db->where('id',$id);
		$this->db->delete('data_tindakan');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Deleted!
			</div>');
		redirect('user/data_tindakan');
	}


	public function edit_tindakan($id)
	{
		$data['title'] = 'Edit Tindakan';
		$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['tindakan'] = $this->db->get('data_tindakan')->result_array();
		$data['edit'] = $this->menu_model->getTindakanById($id);
		
		$this->form_validation->set_rules('nama_tindakan','Nama Tindakan','required');
		$this->form_validation->set_rules('biaya','Biaya','required');
		if ($this->input->post('keyword')) {
			$data['tindakan'] =  $this->menu_model->searchDataTindakan();
		}
		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/edit_tindakan',$data);
			$this->load->view('templates/footer');

		}else{

			$data =
			[
				'nama_tindakan' => $this->input->post('nama_tindakan'),
				'biaya' => $this->input->post('biaya'),
				
			];

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('data_tindakan', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Data Updated!
				</div>');
			redirect('user/data_tindakan');
		}
	}














}


