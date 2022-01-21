<?php
class Posisi_model extends CI_Model {

	public function load_realisasi_sas()
	{
		$sql = "select * from realisasi_sas order by epoch_realisasi_sas desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_pagu_pulih()
	{
		$sql = "select * from pagu_pulih order by epoch_sas_pagu_pulih desc";
		return $this->db->query($sql)->result_array();
	}

	public function load_akun_pok()
	{
		$sql = 'select * from pok_2022 where level = 6 order by kro asc, ro asc, komponen asc, subkomponen asc';
		return $this->db->query($sql)->result_array();
	}

	public function load_akun_pok_item($id)
	{
		$sql = 'select * from pok_2022 where level = 6 and id = ?';
		return $this->db->query($sql, array($id))->row();
	}

	public function load_pengajuan_tup($id_akun)
	{
		$sql = "SELECT 
				pok_2022.id,
				pok_2022.kegiatan, 
				pok_2022.kro, 
				pok_2022.ro, 
				pok_2022.komponen, 
				pok_2022.subkomponen, 
				pok_2022.akun, 
				pok_2022.uraian, 
				pok_2022.jumlah AS pagu, 
				CASE 
					WHEN realisasi.total_realisasi IS NULL THEN 0
					ELSE realisasi.total_realisasi
				END total_realisasi,
				CASE 
					WHEN realisasi.total_realisasi IS NULL THEN pok_2022.jumlah
					ELSE (pok_2022.jumlah - realisasi.total_realisasi)
				END sisa_pagu, 
				pok_2022.sumber,
				realisasi.cara_tarik,
				pengajuan_tup.total_pengajuan_tup
			FROM pok_2022 
			LEFT JOIN 
				(
					SELECT realisasi.kegiatan, realisasi.kro, realisasi.ro, realisasi.komponen, realisasi.subkomponen, realisasi.akun, realisasi.sumber, realisasi.cara_tarik, SUM(jumlah_realisasi_bruto) AS total_realisasi 
					FROM realisasi 
					WHERE realisasi.nomor_spm IS NOT NULL AND realisasi.cara_tarik = 'tup'
					GROUP BY realisasi.kegiatan, realisasi.kro, realisasi.ro, realisasi.komponen, realisasi.subkomponen, realisasi.akun, realisasi.sumber, realisasi.cara_tarik
				) AS realisasi
			ON 
				pok_2022.kegiatan = realisasi.kegiatan
				AND pok_2022.kro = realisasi.kro
				AND pok_2022.ro = realisasi.ro
				AND pok_2022.komponen = realisasi.komponen
				AND pok_2022.subkomponen = realisasi.subkomponen
				AND pok_2022.akun = realisasi.akun
				AND pok_2022.sumber = realisasi.sumber

			LEFT JOIN 
				(
					SELECT pengajuan_tup.kegiatan, pengajuan_tup.kro, pengajuan_tup.ro, pengajuan_tup.komponen, pengajuan_tup.subkomponen, pengajuan_tup.akun, pengajuan_tup.sumber, SUM(pengajuan_tup.jumlah_pengajuan_tup) AS total_pengajuan_tup
					FROM pengajuan_tup 
					GROUP BY pengajuan_tup.kegiatan, pengajuan_tup.kro, pengajuan_tup.ro, pengajuan_tup.komponen, pengajuan_tup.subkomponen, pengajuan_tup.akun, pengajuan_tup.sumber
				) AS pengajuan_tup
			ON 
				pok_2022.kegiatan = pengajuan_tup.kegiatan
				AND pok_2022.kro = pengajuan_tup.kro
				AND pok_2022.ro = pengajuan_tup.ro
				AND pok_2022.komponen = pengajuan_tup.komponen
				AND pok_2022.subkomponen = pengajuan_tup.subkomponen
				AND pok_2022.akun = pengajuan_tup.akun
				AND pok_2022.sumber = pengajuan_tup.sumber
			WHERE pok_2022.id = ?";
			return $this->db->query($sql, array($id_akun))->row();
	}

	public function load_pengajuan_up()
	{
		$sql = 'select deposit_rm, deposit_pnp, epoch_deposit, (deposit_rm+deposit_pnp) as jumlah_deposit from pengajuan_up_baru order by epoch_deposit desc';
		return $this->db->query($sql)->result_array();
	}

	public function simpan_realisasi_sas()
	{
		$epoch_realisasi_sas = strtotime($this->input->post('tanggal_data_sas'));
		$jumlah_rm_realisasi_sas = $this->input->post('jumlah_realisasi_sas_rm');
		$jumlah_pnp_realisasi_sas = $this->input->post('jumlah_realisasi_sas_pnp');
		$epoch_input_realisasi_sas = time();
		$sql = "insert into realisasi_sas (epoch_realisasi_sas, jumlah_rm_realisasi_sas, jumlah_pnp_realisasi_sas, epoch_input_realisasi_sas) values (?,?,?,?)";
		$this->db->query($sql, array($epoch_realisasi_sas, $jumlah_rm_realisasi_sas, $jumlah_pnp_realisasi_sas, $epoch_input_realisasi_sas));
		redirect(base_url('index.php/posisi'), 'refresh');
	}

	public function simpan_pagu_pulih()
	{
		$jumlah_pagu_pulih = $this->input->post('jumlah_pagu_pulih');
		$id_akun = $this->input->post('id_akun');
		$tanggal_pagu_pulih = strtotime($this->input->post('tanggal_pagu_pulih'));

		$sql = "with data_akun as (select * from pok_2022 where id = ?) 
			insert into pagu_pulih (kegiatan, kro, ro, komponen, subkomponen, akun, uraian, sumber, jumlah_pagu_pulih, epoch_sas_pagu_pulih)
			values ((select data_akun.kegiatan from data_akun), (select data_akun.kro from data_akun), (select data_akun.ro from data_akun), 
			(select data_akun.komponen from data_akun), (select data_akun.subkomponen from data_akun), (select data_akun.akun from data_akun), 
			(select data_akun.uraian from data_akun), (select data_akun.sumber from data_akun), ?, ?)";
		$this->db->query($sql, array($id_akun, $jumlah_pagu_pulih, $tanggal_pagu_pulih));
		redirect(base_url('index.php/posisi/pulih'), 'refresh');
	}

	public function simpan_pengajuan_tup($kegiatan, $kro, $ro, $komponen, $subkomponen, $akun, $uraian, $sumber, $jumlah_pengajuan_tup, $urutan_tup, $poksi, $epoch_pengajuan_tup)
	{
		$sql = "insert into pengajuan_tup (kegiatan, kro, ro, komponen, subkomponen, akun, uraian, sumber, jumlah_pengajuan_tup, urutan_tup, poksi, epoch_pengajuan_tup) values (?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql, array($kegiatan, $kro, $ro, $komponen, $subkomponen, $akun, $uraian, $sumber, $jumlah_pengajuan_tup, $urutan_tup, $poksi, $epoch_pengajuan_tup)))
		{
			echo json_encode(array('success' => true, 'message' => 'Pengajuan TUP berhasil disimpan'));
		}
		else
		{
			echo json_encode(array('success' => false, 'message' => 'Pengajuan TUP gagal disimpan'));
		}
	}

	public function simpan_pengajuan_up($jumlah_pengajuan_up_rm, $jumlah_pengajuan_up_pnp, $tanggal_deposit)
	{
		$sql = "insert into pengajuan_up_baru (deposit_rm, deposit_pnp, epoch_deposit) values (?,?,?)";
		if($this->db->query($sql, array($jumlah_pengajuan_up_rm, $jumlah_pengajuan_up_pnp, $tanggal_deposit)))
		{
			$sql = "insert into pengajuan_up (jumlah_pengajuan_up, sumber, epoch_pengajuan_up) values (?,?,?)";
			$this->db->query($sql, array($jumlah_pengajuan_up_rm, 'rm', $tanggal_deposit));

			$sql = "insert into pengajuan_up (jumlah_pengajuan_up, sumber, epoch_pengajuan_up) values (?,?,?)";
			$this->db->query($sql, array($jumlah_pengajuan_up_pnp, 'pnp', $tanggal_deposit));
		}
	}


}
?>