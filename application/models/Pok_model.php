<?php

class Pok_model extends CI_Model {

	public function load_kegiatan()
	{
		$sql = "select * from pok_2022 where level = 1";
		return $this->db->query($sql)->result_array();
	}

	public function load_kro()
	{
		$sql = "select * from pok_2022 where level = 2";
		return $this->db->query($sql)->result_array();
	}

	public function load_kro_item($id)
	{
		$sql = "select * from pok_2022 where level = 2 and id = ?";
		return $this->db->query($sql, array($id))->row();
	}

	


	public function load_ro()
	{
		$sql = "select * from pok_2022 where level = 3";
		return $this->db->query($sql)->result_array();
	}

	public function load_ro_item($id)
	{
		$sql = "select * from pok_2022 where level = 3 and id = ?";
		return $this->db->query($sql, array($id))->row();
	}

	public function load_ro_kode_item($kode)
	{
		$sql = "select * from pok_2022 where level = 3 and ro = ?";
		return $this->db->query($sql, array($kode))->row();
	}

	public function load_komponen()
	{
		$sql = "select * from pok_2022 where level = 4";
		return $this->db->query($sql)->result_array();
	}

	public function load_komponen_item($id)
	{
		$sql = "select * from pok_2022 where level = 4 and id = ?";
		return $this->db->query($sql, array($id))->row();
	}

	public function load_subkomponen()
	{
		$sql = "select * from pok_2022 where level = 5";
		return $this->db->query($sql)->result_array();
	}

	public function load_subkomponen_item($id)
	{
		$sql = "select * from pok_2022 where level = 5 and id = ?";
		return $this->db->query($sql, array($id))->row();
	}

	public function load_akun()
	{
		$sql = "select * from pok_2022 where level = 6";
		return $this->db->query($sql)->result_array();
	}

	public function load_akun_item($id)
	{
		$sql = "select * from pok_2022 where level = 6 and id = ?";
		return $this->db->query($sql, array($id))->row();
	}

	public function load_akun_2($kegiatan, $kro, $ro, $komponen, $subkomponen)
	{
		$sql = "select * from pok_2022 where kegiatan = ? and kro = ? and ro = ? and komponen = ? and subkomponen = ? and level = 6";
		return $this->db->query($sql, array('kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro, 'komponen' => $komponen, 'subkomponen' => $subkomponen))->result_array();
	}

	public function load_bagan_akun_standar()
	{
		$sql = "select * from bagan_akun_standar order by kode asc";
		return $this->db->query($sql)->result_array();
	}

	public function load_bagan_akun_standar_item($kode)
	{
		$sql = "select * from bagan_akun_standar where kode = ? order by kode asc";
		return $this->db->query($sql, array($kode))->row();
	}

	public function simpan_master_kegiatan($kode_kegiatan, $uraian_kegiatan)
	{
		$sql = "insert into pok_2022 (kegiatan, kro, ro, komponen, subkomponen, akun, detail, uraian, volume, satuan_volume, level) values (?,'-', '-','-','-','-','-',?,0,'-',1)";
		$this->db->query($sql, array($kode_kegiatan, $uraian_kegiatan));
	}

	public function simpan_master_kro()
	{
		$data = json_decode(file_get_contents('php://input'));
		// print_r($data);
		$sql = "insert into pok_2022 (kegiatan, kro, ro, komponen, subkomponen, akun, detail, uraian, volume, satuan_volume, level) values (?,?, '-','-','-','-','-',?,?,?,2)";
		if($this->db->query($sql, array($data->kode_kegiatan, $data->kode_kro, $data->uraian_kro, $data->volume_kro, $data->satuan_volume_kro)))
		{
			echo json_encode(array('success' => true, 'desc' => "Data berhasil disimpan!" ));
		}
		else
		{
			echo json_encode(array('success' => false, 'desc' => "Data gagal disimpan!" ));
		}
		
	}

	public function simpan_master_ro()
	{
		$data = json_decode(file_get_contents('php://input'));
		// print_r($data);
		$sql = "insert into pok_2022 (kegiatan, kro, ro, komponen, subkomponen, akun, detail, uraian, volume, satuan_volume, level) values (?,?,?,'-','-','-','-',?,?,?,3)";
		if($this->db->query($sql, array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->uraian_ro, $data->volume_ro, $data->satuan_volume_ro)))
		{
			echo json_encode(array('success' => true, 'desc' => "Data RO berhasil disimpan!" ));
		}
		else
		{
			echo json_encode(array('success' => false, 'desc' => "Data RO gagal disimpan!" ));
		}
		
	}

	public function simpan_master_komponen()
	{
		$data = json_decode(file_get_contents('php://input'));
		// print_r(array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->kode_komponen, $data->uraian_komponen));
		$sql = "insert into pok_2022 (kegiatan, kro, ro, komponen, subkomponen, akun, detail, uraian, volume, satuan_volume, level) values (?,?,?,?,'-','-','-',?,0,'-',4)";
		if($this->db->query($sql, array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->kode_komponen, $data->uraian_komponen)))
		{
			echo json_encode(array('success' => true, 'desc' => "Data Komponen berhasil disimpan!" ));
		}
		else
		{
			echo json_encode(array('success' => false, 'desc' => "Data Komponen gagal disimpan!" ));
		}
		
	}

	public function simpan_master_subkomponen()
	{
		$data = json_decode(file_get_contents('php://input'));
		// print_r(array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->kode_komponen, $data->kode_subkomponen, $data->uraian_subkomponen));
		$sql = "insert into pok_2022 (kegiatan, kro, ro, komponen, subkomponen, akun, detail, uraian, volume, satuan_volume, level) values (?,?,?,?,?,'-','-',?,0,'-',5)";
		if($this->db->query($sql, array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->kode_komponen, $data->kode_subkomponen,$data->uraian_subkomponen)))
		{
			echo json_encode(array('success' => true, 'desc' => "Data SubKomponen berhasil disimpan!" ));
		}
		else
		{
			echo json_encode(array('success' => false, 'desc' => "Data SubKomponen gagal disimpan!" ));
		}
		
	}

	public function simpan_master_akun()
	{
		$data = json_decode(file_get_contents('php://input'));
		// print_r(array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->kode_komponen, $data->kode_subkomponen, $data->uraian_subkomponen));
		$sql = "insert into pok_2022 (kegiatan, kro, ro, komponen, subkomponen, akun, detail, uraian, volume, satuan_volume, jumlah, sumber, level) values (?,?,?,?,?,?,'-',?,0,'-', ?, ?, 6)";
		if($this->db->query($sql, array($data->kode_kegiatan, $data->kode_kro, $data->kode_ro, $data->kode_komponen, $data->kode_subkomponen, $data->kode_akun, $data->uraian_akun, $data->pagu_akun, $data->sumber)))
		{
			echo json_encode(array('success' => true, 'desc' => "Data Akun berhasil disimpan!" ));
		}
		else
		{
			echo json_encode(array('success' => false, 'desc' => "Data Akun gagal disimpan!" ));
		}
		
	}

	public function simpan_edit_kro($old_kro, $kegiatan, $kro, $uraian, $volume, $satuan_volume, $id)
	{
		$sql = "update pok_2022 set kegiatan = ?, kro = ?, uraian = ?, volume = ?, satuan_volume = ? where id = ?";
		if($this->db->query($sql, array($kegiatan, $kro, $uraian, $volume, $satuan_volume, $id)))
		{
			$sql = "update pok_2022 set kro = ? where kro = ?";
			$this->db->query($sql, array($kro, $old_kro));
		}
	}

	public function simpan_edit_ro($old_ro, $ro, $uraian, $volume, $satuan_volume, $id)
	{
		$sql = "update pok_2022 set ro = ?, uraian = ?, volume = ?, satuan_volume = ? where id = ?";
		if($this->db->query($sql, array($ro, $uraian, $volume, $satuan_volume, $id)))
		{
			$sql = "update pok_2022 set ro = ? where ro = ?";
			$this->db->query($sql, array($ro, $old_ro));
		}
	}

	public function simpan_edit_komponen($old_komponen, $komponen, $uraian, $id)
	{
		$sql = "update pok_2022 set komponen = ?, uraian = ? where id = ?";
		if($this->db->query($sql, array($komponen, $uraian, $id)))
		{
			$sql = "update pok_2022 set komponen = ? where komponen = ?";
			$this->db->query($sql, array($komponen, $old_komponen));
		}
	}

	public function simpan_edit_subkomponen($old_subkomponen, $subkomponen, $uraian, $id)
	{
		$sql = "update pok_2022 set subkomponen = ?, uraian = ? where id = ?";
		if($this->db->query($sql, array($subkomponen, $uraian, $id)))
		{
			$sql = "update pok_2022 set subkomponen = ? where subkomponen = ?";
			$this->db->query($sql, array($subkomponen, $old_subkomponen));
		}
	}

	public function simpan_edit_akun($akun, $uraian, $jumlah, $sumber, $id)
	{
		$sql = "update pok_2022 set akun = ?, uraian = ?, jumlah = ?, sumber = ? where id = ?";
		$this->db->query($sql, array($akun, $uraian, $jumlah, $sumber, $id));
	}

}

?>