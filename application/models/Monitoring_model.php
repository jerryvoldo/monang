<?php
class Monitoring_model extends CI_Model {

	public function load_berkas_ls()
	{
		$sql = "select * from realisasi where cara_tarik = 'ls' order by epoch_kuitansi desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_berkas_up()
	{
		$sql = "select * from realisasi where cara_tarik = 'up' order by epoch_kuitansi desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_berkas_tup()
	{
		$sql = "select * from realisasi where cara_tarik = 'tup' order by epoch_kuitansi desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_kontrak_ls()
	{
		$sql = "select * from realisasi where cara_tarik = 'ls' and is_kontraktual = 't' order by epoch_kuitansi desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_kontrak_up()
	{
		$sql = "select * from realisasi where cara_tarik = 'up' and is_kontraktual = 't'  order by epoch_kuitansi desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_kontrak_tup()
	{
		$sql = "select * from realisasi where cara_tarik = 'tup' and is_kontraktual = 't'  order by epoch_kuitansi desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_berkas_ls_item($id)
	{
		$sql = "select * from realisasi where cara_tarik = 'ls' and id = ? order by epoch_kuitansi desc";
		return $this->db->query($sql, array($id))->row();
	}

	public function load_berkas_up_item($id)
	{
		$sql = "select * from realisasi where cara_tarik = 'up' and id = ? order by epoch_kuitansi desc";
		return $this->db->query($sql, array($id))->row();
	}

	public function load_berkas_tup_item($id)
	{
		$sql = "select * from realisasi where cara_tarik = 'tup' and id = ? order by epoch_kuitansi desc";
		return $this->db->query($sql, array($id))->row();
	}

	public function simpan_perubahan_ls()
	{
		$data = array(
						'nomor_kuitansi' => $this->input->post('edit_nomor_kuitansi'),
						'epoch_kuitansi' => strtotime($this->input->post('edit_tanggal_kuitansi')),
						'uraian_realisasi' => $this->input->post('edit_uraian_realisasi'),
						'cara_tarik' => $this->input->post('edit_cara_tarik'),
						'kegiatan' => $this->input->post('edit_kegiatan'),
						'kro' => $this->input->post('edit_kro'),
						'ro' => $this->input->post('edit_ro'),
						'komponen' => $this->input->post('edit_komponen'),
						'subkomponen' => $this->input->post('edit_subkomponen'),
						'akun' => $this->input->post('edit_akun'),
						'sumber' => $this->input->post('edit_sumber'),
						'is_kontraktual' => $this->input->post('is_kontraktual'),
						'nomor_spm' => (empty($this->input->post('edit_nomor_spm')) ? 0 : $this->input->post('edit_nomor_spm')),
						'epoch_spm' => (empty($this->input->post('edit_tanggal_spm')) ? 0 : strtotime($this->input->post('edit_tanggal_spm'))),
						'nomor_sp2d' => (empty($this->input->post('edit_nomor_sp2d')) ? 0 : $this->input->post('edit_nomor_sp2d')),
						'epoch_sp2d' => (empty($this->input->post('edit_tanggal_sp2d')) ? 0 : strtotime($this->input->post('edit_tanggal_sp2d'))),
						'jumlah_realisasi_bruto' => $this->input->post('edit_jumlah_realisasi'),
						'penerima' => $this->input->post('edit_penerima'),
						'id' => $this->input->post('edit_id_berkas'),
					);
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		$sql = "update realisasi set nomor_kuitansi = ?, epoch_kuitansi = ?, uraian_realisasi = ?, cara_tarik = ?, kegiatan = ?, kro = ?, ro = ?, komponen = ?, subkomponen = ?, akun = ?, sumber = ?, is_kontraktual = ?, nomor_spm = ?, epoch_spm = ?, nomor_sp2d = ?, epoch_sp2d = ?, jumlah_realisasi_bruto = ?, penerima = ? where id = ?";
		$this->db->query($sql, $data);
	}

	public function simpan_perubahan_up()
	{
		$data = array(
						'nomor_kuitansi' => $this->input->post('edit_nomor_kuitansi_up'),
						'epoch_kuitansi' => strtotime($this->input->post('edit_tanggal_kuitansi_up')),
						'uraian_realisasi' => $this->input->post('edit_uraian_realisasi_up'),
						'cara_tarik' => $this->input->post('edit_cara_tarik_up'),
						'kegiatan' => $this->input->post('edit_kegiatan_up'),
						'kro' => $this->input->post('edit_kro_up'),
						'ro' => $this->input->post('edit_ro_up'),
						'komponen' => $this->input->post('edit_komponen_up'),
						'subkomponen' => $this->input->post('edit_subkomponen_up'),
						'akun' => $this->input->post('edit_akun_up'),
						'sumber' => $this->input->post('edit_sumber_up'),
						'is_kontraktual' => $this->input->post('is_kontraktual_up'),
						'nomor_spm' => (empty($this->input->post('edit_nomor_spm_up')) ? 0 : $this->input->post('edit_nomor_spm_up')),
						'epoch_spm' => (empty($this->input->post('edit_tanggal_spm_up')) ? 0 : strtotime($this->input->post('edit_tanggal_spm_up'))),
						'nomor_sp2d' => (empty($this->input->post('edit_nomor_sp2d_up')) ? 0 : $this->input->post('edit_nomor_sp2d_up')),
						'epoch_sp2d' => (empty($this->input->post('edit_tanggal_sp2d_up')) ? 0 : strtotime($this->input->post('edit_tanggal_sp2d_up'))),
						'jumlah_realisasi_bruto' => $this->input->post('edit_jumlah_realisasi_up'),
						'jumlah_pph' => $this->input->post('edit_jumlah_pph_up'),
						'jumlah_ppn' => $this->input->post('edit_jumlah_ppn_up'),
						'penerima' => $this->input->post('edit_penerima_up'),
						'id' => $this->input->post('edit_id_berkas_up'),
					);
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		$sql = "update realisasi set nomor_kuitansi = ?, epoch_kuitansi = ?, uraian_realisasi = ?, cara_tarik = ?, kegiatan = ?, kro = ?, ro = ?, komponen = ?, subkomponen = ?, akun = ?, sumber = ?, is_kontraktual = ?, nomor_spm = ?, epoch_spm = ?, nomor_sp2d = ?, epoch_sp2d = ?, jumlah_realisasi_bruto = ?, jumlah_pph = ?, jumlah_ppn = ?, penerima = ? where id = ?";
		$this->db->query($sql, $data);
	}

	public function simpan_perubahan_tup()
	{
		$data = array(
						'nomor_kuitansi' => $this->input->post('edit_nomor_kuitansi_tup'),
						'epoch_kuitansi' => strtotime($this->input->post('edit_tanggal_kuitansi_tup')),
						'uraian_realisasi' => $this->input->post('edit_uraian_realisasi_tup'),
						'cara_tarik' => $this->input->post('edit_cara_tarik_tup'),
						'kegiatan' => $this->input->post('edit_kegiatan_tup'),
						'kro' => $this->input->post('edit_kro_tup'),
						'ro' => $this->input->post('edit_ro_tup'),
						'komponen' => $this->input->post('edit_komponen_tup'),
						'subkomponen' => $this->input->post('edit_subkomponen_tup'),
						'akun' => $this->input->post('edit_akun_tup'),
						'sumber' => $this->input->post('edit_sumber_tup'),
						'is_kontraktual' => $this->input->post('is_kontraktual_tup'),
						'nomor_spm' => (empty($this->input->post('edit_nomor_spm_tup')) ? 0 : $this->input->post('edit_nomor_spm_tup')),
						'epoch_spm' => (empty($this->input->post('edit_tanggal_spm_tup')) ? 0 : strtotime($this->input->post('edit_tanggal_spm_tup'))),
						'nomor_sp2d' => (empty($this->input->post('edit_nomor_sp2d_tup')) ? 0 : $this->input->post('edit_nomor_sp2d_tup')),
						'epoch_sp2d' => (empty($this->input->post('edit_tanggal_sp2d_tup')) ? 0 : strtotime($this->input->post('edit_tanggal_sp2d_tup'))),
						'jumlah_realisasi_bruto' => $this->input->post('edit_jumlah_realisasi_tup'),
						'jumlah_pph' => $this->input->post('edit_jumlah_pph_tup'),
						'jumlah_ppn' => $this->input->post('edit_jumlah_ppn_tup'),
						'penerima' => $this->input->post('edit_penerima_tup'),
						'id' => $this->input->post('edit_id_berkas_tup'),
					);
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		$sql = "update realisasi set nomor_kuitansi = ?, epoch_kuitansi = ?, uraian_realisasi = ?, cara_tarik = ?, kegiatan = ?, kro = ?, ro = ?, komponen = ?, subkomponen = ?, akun = ?, sumber = ?, is_kontraktual = ?, nomor_spm = ?, epoch_spm = ?, nomor_sp2d = ?, epoch_sp2d = ?, jumlah_realisasi_bruto = ?, jumlah_pph = ?, jumlah_ppn = ?, penerima = ? where id = ?";
		$this->db->query($sql, $data);
	}
}
