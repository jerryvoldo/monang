<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
	}

	public function index()
	{
		$this->load->model('pok_model');
		$data['kegiatans'] = $this->pok_model->load_kegiatan();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_master_kegiatan_view', $data);
		$this->load->view('pages/footer_view');
	}


	public function show_kro()
	{
		$this->load->model('pok_model');
		$data['kegiatans'] = $this->pok_model->load_kegiatan();
		$data['kros'] = $this->pok_model->load_kro();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_master_kro_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function json_show_kro()
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_kro());
	}

	public function json_show_kro_item($id)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_kro_item($id));
	}

	


	public function show_ro()
	{
		$this->load->model('pok_model');
		$data['kegiatans'] = $this->pok_model->load_kegiatan();
		$data['kros'] = $this->pok_model->load_kro();
		$data['ros'] = $this->pok_model->load_ro();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_master_ro_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function json_show_ro()
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_ro());
	}

	public function json_show_ro_item($id)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_ro_item($id));
	}

	public function json_show_ro_kode_item($kode)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_ro_kode_item($kode));
	}

	public function show_komponen()
	{
		$this->load->model('pok_model');
		$data['kegiatans'] = $this->pok_model->load_kegiatan();
		$data['kros'] = $this->pok_model->load_kro();
		$data['ros'] = $this->pok_model->load_ro();
		$data['komponens'] = $this->pok_model->load_komponen();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_master_komponen_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function json_show_komponen()
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_komponen());
	}

	public function json_show_komponen_item($id)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_komponen_item($id));
	}

	public function show_subkomponen()
	{
		$this->load->model('pok_model');
		$data['kegiatans'] = $this->pok_model->load_kegiatan();
		$data['kros'] = $this->pok_model->load_kro();
		$data['ros'] = $this->pok_model->load_ro();
		$data['komponens'] = $this->pok_model->load_komponen();
		$data['subkomponens'] = $this->pok_model->load_subkomponen();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_master_subkomponen_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function json_show_subkomponen_item($id)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_subkomponen_item($id));
	}

	public function json_show_subkomponen()
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_subkomponen());
	}

	public function show_akun()
	{
		$this->load->model('pok_model');
		$data['subkomponens'] = $this->pok_model->load_subkomponen();
		$data['akuns'] = $this->pok_model->load_akun();
		$data['bagan_akun_standar'] = $this->pok_model->load_bagan_akun_standar();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_master_akun_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function json_show_akun()
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_akun());
	}

	public function json_show_akun_item($id)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_akun_item($id));
	}

	public function json_show_bas_item($kode)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_bagan_akun_standar_item($kode));
	}

	public function show_akun_2($kegiatan, $kro, $ro, $komponen, $subkomponen)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_akun_2($kegiatan, $kro, $ro, $komponen, $subkomponen));
	}

	public function load_subkomponen_item($id)
	{
		$this->load->model('pok_model');
		echo json_encode($this->pok_model->load_subkomponen_item($id));
	}

	public function simpan_master_kegiatan()
	{
		$kode_kegiatan = $this->input->post('kode_kegiatan');
		$uraian_kegiatan = $this->input->post('uraian_kegiatan');
		$this->load->model('pok_model');
		$this->pok_model->simpan_master_kegiatan($kode_kegiatan, $uraian_kegiatan);
		redirect(base_url('index.php/pok'),'refresh');
	}

	public function simpan_master_kro()
	{
		$this->load->model('pok_model');
		$this->pok_model->simpan_master_kro();
	}

	public function simpan_master_ro()
	{
		$this->load->model('pok_model');
		$this->pok_model->simpan_master_ro();
	}

	public function simpan_master_komponen()
	{
		$this->load->model('pok_model');
		$this->pok_model->simpan_master_komponen();
	}

	public function simpan_master_subkomponen()
	{
		$this->load->model('pok_model');
		$this->pok_model->simpan_master_subkomponen();
	}

	public function simpan_master_akun()
	{
		$this->load->model('pok_model');
		$this->pok_model->simpan_master_akun();
	}

	public function simpan_edit_kro()
	{
		$kegiatan = $this->input->post('edit_kode_kegiatan');
		$kro = $this->input->post('edit_kode_kro');
		$uraian = $this->input->post('edit_uraian_kro');
		$volume = $this->input->post('edit_volume_kro');
		$satuan_volume = $this->input->post('edit_satuan_volume_kro');
		$id = $this->input->post('edit_id_kro');
		$old_kro = $this->input->post('old_kode_kro');
		$this->load->model('pok_model');
		$this->pok_model->simpan_edit_kro($old_kro, $kegiatan, $kro, $uraian, $volume, $satuan_volume, $id);
		redirect(base_url('index.php/pok/show_kro'),'refresh');
	}

	public function simpan_edit_ro()
	{
		$ro = $this->input->post('edit_kode_ro');
		$uraian = $this->input->post('edit_uraian_ro');
		$volume = $this->input->post('edit_volume_ro');
		$satuan_volume = $this->input->post('edit_satuan_volume_ro');
		$id = $this->input->post('edit_id_ro');
		$old_ro = $this->input->post('old_kode_ro');
		$this->load->model('pok_model');
		$this->pok_model->simpan_edit_ro($old_ro, $ro, $uraian, $volume, $satuan_volume, $id);
		redirect(base_url('index.php/pok/show_ro'),'refresh');
	}

	public function simpan_edit_komponen()
	{
		$komponen = $this->input->post('edit_kode_komponen');
		$uraian = $this->input->post('edit_uraian_komponen');
		$id = $this->input->post('edit_id_komponen');
		$old_komponen = $this->input->post('old_kode_komponen');
		$this->load->model('pok_model');
		$this->pok_model->simpan_edit_komponen($old_komponen, $komponen, $uraian, $id);
		redirect(base_url('index.php/pok/show_komponen'),'refresh');
	}

	public function simpan_edit_subkomponen()
	{
		$subkomponen = $this->input->post('edit_kode_subkomponen');
		$uraian = $this->input->post('edit_uraian_subkomponen');
		$id = $this->input->post('edit_id_subkomponen');
		$old_subkomponen = $this->input->post('old_kode_subkomponen');
		$this->load->model('pok_model');
		$this->pok_model->simpan_edit_subkomponen($old_subkomponen, $subkomponen, $uraian, $id);
		redirect(base_url('index.php/pok/show_subkomponen'),'refresh');
	}

	public function simpan_edit_akun()
	{
		$akun = $this->input->post('edit_kode_akun');
		$uraian = $this->input->post('edit_uraian_akun');
		$jumlah = $this->input->post('edit_pagu_akun');
		$sumber = $this->input->post('edit_sumber');
		$id = $this->input->post('edit_id_akun');
		$this->load->model('pok_model');
		$this->pok_model->simpan_edit_akun($akun, $uraian, $jumlah, $sumber, $id);
		redirect(base_url('index.php/pok/show_akun'),'refresh');
	}

}


?>