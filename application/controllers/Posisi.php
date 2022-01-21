<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posisi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
	}

	public function index()
	{
		$this->load->model('posisi_model');
		$data['realisasi_sas'] = $this->posisi_model->load_realisasi_sas();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_posisi_realisasi_sas', $data);
		$this->load->view('pages/footer_view');	
	}

	public function pulih()
	{
		$this->load->model('posisi_model');
		$data['pagu_pulih'] = $this->posisi_model->load_pagu_pulih();
		$data['load_akun_pok'] = $this->posisi_model->load_akun_pok();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_posisi_pagu_pulih', $data);
		$this->load->view('pages/footer_view');	
	}

	public function tup()
	{
		$this->load->model('posisi_model');
		$data['load_akun_pok'] = $this->posisi_model->load_akun_pok();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_posisi_pengajuan_tup', $data);
		$this->load->view('pages/footer_view');	
	}

	public function up()
	{
		$this->load->model('posisi_model');
		$data['load_pengajuan_up'] = $this->posisi_model->load_pengajuan_up();
		$this->load->view('pages/header_view');
		$this->load->view('pages/input_posisi_pengajuan_up', $data);
		$this->load->view('pages/footer_view');	
	}

	public function json_show_pengajuan_up()
	{
		$this->load->model('posisi_model');
		echo json_encode($this->posisi_model->load_pengajuan_up());
	}

	public function json_show_akun_pok_item($id)
	{
		$this->load->model('posisi_model');
		echo json_encode($this->posisi_model->load_akun_pok_item($id));
	}

	public function json_show_pengajuan_tup($id_akun)
	{
		$this->load->model('posisi_model');
		echo json_encode($this->posisi_model->load_pengajuan_tup($id_akun));
	}

	public function simpan_realisasi_sas()
	{
		$this->load->model('posisi_model');
		$this->posisi_model->simpan_realisasi_sas();
	}

	public function simpan_pagu_pulih()
	{
		$this->load->model('posisi_model');
		$this->posisi_model->simpan_pagu_pulih();
	}

	public function simpan_pengajuan_tup()
	{
		$data = json_decode(file_get_contents('php://input'));
		$this->load->model('posisi_model');
		$this->posisi_model->simpan_pengajuan_tup($data->tup_kode_kegiatan, $data->tup_kode_kro, $data->tup_kode_ro, $data->tup_kode_komponen, $data->tup_kode_subkomponen, $data->tup_kode_akun, $data->tup_uraian, $data->tup_sumber, $data->jumlah_pengajuan_tup, $data->urutan_tup, $data->poksi, time());
	}

	public function simpan_pengajuan_up()
	{
		$data = json_decode(file_get_contents('php://input'));
		$this->load->model('posisi_model');
		$this->posisi_model->simpan_pengajuan_up($data->jumlah_pengajuan_up_rm, $data->jumlah_pengajuan_up_pnp, $data->tanggal_deposit);
	}




}
?>