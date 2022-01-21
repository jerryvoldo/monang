<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
	}

	public function berkas()
	{
		$this->load->model('monitoring_model');
		$data['berkas_ls'] = (empty($this->monitoring_model->load_berkas_ls()) ? [] : $this->monitoring_model->load_berkas_ls());
		$data['berkas_up'] = (empty($this->monitoring_model->load_berkas_up()) ? [] : $this->monitoring_model->load_berkas_up());
		$data['berkas_tup'] = (empty($this->monitoring_model->load_berkas_tup()) ? [] : $this->monitoring_model->load_berkas_tup());
		$this->load->view('pages/header_view');
		$this->load->view('pages/monitoring_berkas_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function kontrak()
	{
		$this->load->model('monitoring_model');
		$data['kontrak_ls'] = (empty($this->monitoring_model->load_kontrak_ls()) ? [] : $this->monitoring_model->load_kontrak_ls());
		$data['kontrak_up'] = (empty($this->monitoring_model->load_kontrak_up()) ? [] : $this->monitoring_model->load_kontrak_up());
		$data['kontrak_tup'] = (empty($this->monitoring_model->load_kontrak_tup()) ? [] : $this->monitoring_model->load_kontrak_tup());
		$this->load->view('pages/header_view');
		$this->load->view('pages/monitoring_kontrak_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function load_berkas_ls($id)
	{
		$this->load->model('monitoring_model');
		$data = $this->monitoring_model->load_berkas_ls_item($id);
		echo json_encode($data);
	}

	public function load_berkas_up($id)
	{
		$this->load->model('monitoring_model');
		$data = $this->monitoring_model->load_berkas_up_item($id);
		echo json_encode($data);
	}

	public function load_berkas_tup($id)
	{
		$this->load->model('monitoring_model');
		$data = $this->monitoring_model->load_berkas_tup_item($id);
		echo json_encode($data);
	}

	public function simpan_perubahan_ls()
	{
		$this->load->model('monitoring_model');
		$this->monitoring_model->simpan_perubahan_ls();
		redirect(base_url('index.php/monitoring/berkas'),'refresh');
	}

	public function simpan_perubahan_up()
	{
		$this->load->model('monitoring_model');
		$this->monitoring_model->simpan_perubahan_up();
		redirect(base_url('index.php/monitoring/berkas'),'refresh');
	}

	public function simpan_perubahan_tup()
	{
		$this->load->model('monitoring_model');
		$this->monitoring_model->simpan_perubahan_tup();
		redirect(base_url('index.php/monitoring/berkas'),'refresh');
	}
}

?>