<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->load->model('realisasi_model');
		$data['pok'] = $this->realisasi_model->load_pok(); 
		$data['dana_rm'] = $this->realisasi_model->dana_rm();
		$data['dana_pnp'] = $this->realisasi_model->dana_pnp();
		$data['sisa_dana_after_sas'] = $this->realisasi_model->sisa_dana_after_sas();
		$data['load_realisasi_sas'] = $this->realisasi_model->load_realisasi_sas();
		$data['load_pagu_pulih'] = $this->realisasi_model->load_pagu_pulih();
		$data['sisa_dana_after_pagu_pulih'] = $this->realisasi_model->sisa_dana_after_pagu_pulih();
		$data['load_kontrak'] = $this->realisasi_model->load_kontrak();
		$data['load_pengajuan_tup'] = $this->realisasi_model->load_pengajuan_tup();
		$data['load_pengajuan_up'] = $this->realisasi_model->load_pengajuan_up();
		$data['load_sisa_dana_before_ls_up'] = $this->realisasi_model->load_sisa_dana_before_ls_up();
		$data['load_realisasi'] = $this->realisasi_model->load_realisasi();
		$data['load_sisa_dana_akhir'] = $this->realisasi_model->load_sisa_dana_akhir();
		$this->load->view('pages/header_view');
		$this->load->view('pages/dashboard', $data);
		$this->load->view('pages/footer_view');
	}

	public function inputrealisasils()
	{
		$this->load->model('realisasi_model');
		$data['akuns'] = $this->realisasi_model->load_akun();
		$data['load_all_realisasi_ls'] = $this->realisasi_model->load_all_realisasi_ls();
		$this->load->view('pages/header_view');
		$this->load->view('pages/inputrealisasils_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function inputrealisasiup()
	{
		$this->load->model('realisasi_model');
		$data['akuns'] = $this->realisasi_model->load_akun();
		$data['load_all_realisasi_up'] = $this->realisasi_model->load_all_realisasi_up();
		$this->load->view('pages/header_view');
		$this->load->view('pages/inputrealisasiup_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function inputrealisasitup()
	{
		$this->load->model('realisasi_model');
		$data['akuns'] = $this->realisasi_model->load_akun();
		$data['load_all_realisasi_tup'] = $this->realisasi_model->load_all_realisasi_tup();
		$this->load->view('pages/header_view');
		$this->load->view('pages/inputrealisasitup_view', $data);
		$this->load->view('pages/footer_view');
	}

	public function load_akun_realisasi($id)
	{
		$this->load->model('realisasi_model');
		echo $this->realisasi_model->load_akun_realisasi($id);
	}

	public function simpan_realisasi()
	{
		$this->load->model('realisasi_model');
		$this->realisasi_model->simpan_realisasi();
		if($this->input->post('cara_tarik') == 'ls')
		{
			redirect(base_url('index.php/dashboard/inputrealisasils'),'refresh');
		}
		else if($this->input->post('cara_tarik') == 'up')
		{
			redirect(base_url('index.php/dashboard/inputrealisasiup'),'refresh');
		}
		else
		{
			redirect(base_url('index.php/dashboard/inputrealisasitup'),'refresh');
		}
		
	}

	public function load_data_posisi_tup($kro, $ro, $komponen, $subkomponen, $akun, $sumber)
	{
		$this->load->model('realisasi_model');
		echo $this->realisasi_model->load_data_posisi_anggaran_tup($kro, $ro, $komponen, $subkomponen, $akun, $sumber);
	}

	public function load_data_posisi_up($kro, $ro, $komponen, $subkomponen, $akun, $sumber)
	{
		$this->load->model('realisasi_model');
		echo $this->realisasi_model->load_data_posisi_anggaran_up($kro, $ro, $komponen, $subkomponen, $akun, $sumber);
	}

	public function load_data_posisi_ls($kro, $ro, $komponen, $subkomponen, $akun, $sumber)
	{
		$this->load->model('realisasi_model');
		echo $this->realisasi_model->load_data_posisi_anggaran_ls($kro, $ro, $komponen, $subkomponen, $akun, $sumber);
	}

}
