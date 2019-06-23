<?php  
 
defined('BASEPATH') or exit('No direct script access allowed');

class menu_model extends CI_model
{
	public function getsubmenu()
	{
		$query = "SELECT `user_sub_menu`.*,`user_menu`.`menu` FROM `user_sub_menu` JOIN `user_menu`
			ON 
			`user_sub_menu`.`menu_id` = `user_menu`.`id`";
		return $this->db->query($query)->result_array();
	}

	public function deleteDataMenu($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user_menu');
	
		
	}


	public function deleteDataSubMenu($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user_sub_menu');
	
		
	}

	
	public function getMenuById($id)
	{
		return $this->db->get_where('user_menu', ['id' => $id ])->row_array();
	}


	public function editDataMenu(){
		$data=[

			"menu" => $this->input->post('menu')
		];

		
		$this->db->where('id',$this->input->post('id'));
		 $this->db->update('user_menu',$data);



	}

	public function searchDataMenu(){
		$keyword= $this->input->post('keyword');
		//query builder
		$this->db->like('menu' , $keyword);
		return $this->db->get('user_menu')->result_array();

	}





	public function getSubMenuById($id){
		return $this->db->get_where('user_sub_menu', ['id' => $id ])->row_array();
	}

	public function editDataSubMenu()
	{
		$data =
		[
			"title" => $this->input->post('title'),
			"menu_id" => $this->input->post('menu_id'),
			"url"=> $this->input->post('url'),
			"icon"=> $this->input->post('icon'),
			"is_active"=> $this->input->post('is_active')
		];

		
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('user_sub_menu',$data);



	}

	public function searchDataSubMenu(){
		$keyword= $this->input->post('keyword');
		//query builder
		$this->db->like('title' , $keyword);
		$this->db->or_like('menu_id' , $keyword);
		$this->db->or_like('url' , $keyword);
		$this->db->or_like('icon' , $keyword);
		
		
		return $this->db->get('user_sub_menu')->result_array();

	}






	//Rekam Medis

	public function getRMById($id)
	{
		return $this->db->get_where('rekam_medis', ['id' => $id ])->row_array();
	}
	public function getDtById($id)
	{
		return $this->db->get_where('data_tindakan', ['id' => $id ])->row_array();
	}




	public function searchDataRM(){
		$keyword= $this->input->post('keyword');
		//query builder
		$this->db->like('tgl_periksa' , $keyword);
		$this->db->or_like('id_rm' , $keyword);
		$this->db->or_like('id_pasien' , $keyword);
		$this->db->or_like('nama' , $keyword);
		$this->db->or_like('visit' , $keyword);
		$this->db->or_like('anamnesa' , $keyword);
		$this->db->or_like('diagnosa' , $keyword);
		$this->db->or_like('keterangan' , $keyword);

		$this->db->or_like('biaya' , $keyword);

		
		
		return $this->db->get('rekam_medis')->result_array();

	}


	public function getPasienById($id){
		return $this->db->get_where('data_pasien', ['id' => $id ])->row_array();
	}

	public function searchDataPasien(){
		$keyword= $this->input->post('keyword');
		//query builder
		$this->db->like('id' , $keyword);
		$this->db->or_like('nama' , $keyword);
		$this->db->or_like('tanggal_lahir' , $keyword);
		$this->db->or_like('alamat' , $keyword);
		$this->db->or_like('telepon' , $keyword);
		$this->db->or_like('status' , $keyword);
		$this->db->or_like('pekerjaan' , $keyword);

		
		
		return $this->db->get('data_pasien')->result_array();
	}







public function searchDataTindakan(){
		$keyword= $this->input->post('keyword');
		$this->db->like('nama_tindakan' , $keyword);
		$this->db->or_like('biaya' , $keyword);
		
		
		
		return $this->db->get('data_tindakan')->result_array();

	}








public function getTindakanById($id)
	{
		return $this->db->get_where('data_tindakan', ['id' => $id ])->row_array();
	}




public function get_sum()
{
	$sql = "SELECT SUM(biaya) as biaya from rekam_medis";
	$result = $this->db->query($sql);
	return $result->row()->biaya;
}

public function get_count()
{
	$sql = "SELECT COUNT(biaya) as biaya from rekam_medis";
	$result = $this->db->query($sql);
	return $result->row()->biaya;
}

public function get_countDP()
{
	$sql = "SELECT COUNT(nama) as nama from data_pasien";
	$result = $this->db->query($sql);
	return $result->row()->nama;
}

public function get_sum1()
{
	$sql = "SELECT SUM(biaya_tambahan) as biaya_tambahan from rekam_medis";
	$result = $this->db->query($sql);
	return $result->row()->biaya_tambahan;
}



}//