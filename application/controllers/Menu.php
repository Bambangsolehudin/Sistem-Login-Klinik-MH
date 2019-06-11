<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('menu_model');
	}


// 

	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		
		$data['menu'] = $this->db->get('user_menu')->result_array();
		// echo 'selamat datang'. $data['user']['name'];
		$this->form_validation->set_rules('menus','Menu','required'); //mengatur eror agar tidak kosong	
		if ($this->form_validation->run() == false) 
		{
			
			
			//
			if ($this->input->post('keyword')) {
				$data['menu'] =  $this->menu_model->searchDataMenu();
			}
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/index',$data);
			$this->load->view('templates/footer');

		}else{
			$this->db->insert('user_menu',['menu'=>$this->input->post('menus')]); //tambah menu pada ci
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Menu Added!
				</div>');
			redirect('menu');
		}
	}
	


	public function deleteMenu($id)
	{	
		
		$this->menu_model->deleteDataMenu($id);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Deleted!
			</div>');
		redirect('menu');
	}

	




	public function submenu()
	{
		
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();

		$this->load->model('menu_model','menu'); //khusus buat folder model


		$data['submenu'] = $this->menu->getsubmenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();
		if ($this->input->post('keyword')) {
			$data['submenu'] =  $this->menu_model->searchDataSubMenu();
		}

		$this->form_validation->set_rules('title','Title','required'); 
		$this->form_validation->set_rules('menu_id','Menu ID','required'); 
		$this->form_validation->set_rules('url','Url','required'); 
		$this->form_validation->set_rules('icon','Icon','required'); 
		
		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/submenu',$data);
			$this->load->view('templates/footer');
		}else{
			$data =
			[
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url'=> $this->input->post('url'),
				'icon'=> $this->input->post('icon'),
				'is_active'=> $this->input->post('is_active')
			];

			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				New Submenu Added!
				</div>');
			redirect('menu/submenu');
		}



	}






	public function deleteSubMenu($id)
	{	
		$this->load->model('menu_model');
		$this->menu_model->deleteDataSubMenu($id);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Deleted!
			</div>');
		redirect('menu/submenu');
	}




	


// 


	public function edit12($id){
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user',['email'=> 
			$this->session->userdata('email')])->row_array();
		
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['edit'] = $this->menu_model->getMenuById($id);


		$this->form_validation->set_rules('menu','Menu','required'); 

		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/edit',$data);
			$this->load->view('templates/footer');
		}else{
			$data=[

				"menu" => $this->input->post('menu')
			];

			
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('user_menu',$data);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Data Updated!
				</div>');
			redirect('menu');
		}

	}



	function editSubMenu($id)
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$this->load->model('menu_model','menu');
		$data['submenu'] = $this->menu->getsubmenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['edit'] = $this->menu_model->getSubMenuById($id);

		$this->form_validation->set_rules('title','Menu','required'); 
		$this->form_validation->set_rules('menu_id','Menu','required'); 
		$this->form_validation->set_rules('url','Menu','required'); 
		$this->form_validation->set_rules('icon','Menu','required'); 
		
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/editSubMenu',$data);
			
		}else{
			

			$this->menu_model->editDataSubMenu();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Data Updated!
				</div>');
			redirect('menu/submenu');

		}
	}
}
