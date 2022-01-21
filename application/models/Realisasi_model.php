<?php
class Realisasi_model extends CI_Model {

        public function load_pok()
        {
                $sql = "SELECT 
                                        pok_2022.kegiatan, 
                                        pok_2022.kro, 
                                        pok_2022.ro, 
                                        pok_2022.komponen, 
                                        pok_2022.subkomponen, 
                                        pok_2022.akun, 
                                        pok_2022.uraian,
                                        pok_2022.sumber, 
                                        pok_2022.jumlah AS pagu, 
                                        pok_2022.level,
                                        CASE 
                                                WHEN realisasi.total_realisasi IS NULL THEN 0
                                                ELSE realisasi.total_realisasi
                                        END total_realisasi,
                                        CASE 
                                                WHEN realisasi.total_realisasi IS NULL THEN pok_2022.jumlah
                                                ELSE (pok_2022.jumlah - realisasi.total_realisasi)
                                        END sisa_pagu,
                                        cara_tarik_ls.total_realisasi AS jumlah_ls,
                                        cara_tarik_up.total_realisasi AS jumlah_up,
                                        cara_tarik_tup.total_realisasi AS jumlah_tup
                                FROM pok_2022
                                LEFT JOIN 
                                        (SELECT kegiatan, kro, ro, komponen, subkomponen, akun, sumber, SUM(jumlah_realisasi_bruto) AS total_realisasi FROM realisasi where nomor_spm IS NOT NULL GROUP BY kegiatan, kro, ro, komponen, subkomponen, akun, sumber) as realisasi
                                ON 
                                        pok_2022.kegiatan = realisasi.kegiatan 
                                        AND pok_2022.kro = realisasi.kro 
                                        AND pok_2022.ro = realisasi.ro 
                                        AND pok_2022.komponen = realisasi.komponen 
                                        AND pok_2022.subkomponen = realisasi.subkomponen
                                        AND pok_2022.akun = realisasi.akun 
                                        AND pok_2022.sumber = realisasi.sumber
                                LEFT JOIN 
                                        (SELECT kegiatan, kro, ro, komponen, subkomponen, akun, sumber, cara_tarik, sum(jumlah_realisasi_bruto) AS total_realisasi FROM realisasi WHERE cara_tarik = 'ls' AND nomor_spm IS NOT NULL GROUP BY kegiatan, kro, ro, komponen, subkomponen, akun, sumber, cara_tarik) AS cara_tarik_ls
                                ON 
                                        pok_2022.kegiatan = cara_tarik_ls.kegiatan 
                                        AND pok_2022.kro = cara_tarik_ls.kro 
                                        AND pok_2022.ro = cara_tarik_ls.ro 
                                        AND pok_2022.komponen = cara_tarik_ls.komponen 
                                        AND pok_2022.subkomponen = cara_tarik_ls.subkomponen
                                        AND pok_2022.akun = cara_tarik_ls.akun 
                                        AND pok_2022.sumber = cara_tarik_ls.sumber

                                LEFT JOIN 
                                        (SELECT kegiatan, kro, ro, komponen, subkomponen, akun, sumber, cara_tarik, sum(jumlah_realisasi_bruto) AS total_realisasi FROM realisasi WHERE cara_tarik = 'up' AND nomor_spm IS NOT NULL GROUP BY kegiatan, kro, ro, komponen, subkomponen, akun, sumber, cara_tarik) AS cara_tarik_up
                                ON 
                                        pok_2022.kegiatan = cara_tarik_up.kegiatan 
                                        AND pok_2022.kro = cara_tarik_up.kro 
                                        AND pok_2022.ro = cara_tarik_up.ro 
                                        AND pok_2022.komponen = cara_tarik_up.komponen 
                                        AND pok_2022.subkomponen = cara_tarik_up.subkomponen
                                        AND pok_2022.akun = cara_tarik_up.akun 
                                        AND pok_2022.sumber = cara_tarik_up.sumber

                                LEFT JOIN 
                                        (SELECT kegiatan, kro, ro, komponen, subkomponen, akun, sumber, cara_tarik, sum(jumlah_realisasi_bruto) AS total_realisasi FROM realisasi WHERE cara_tarik = 'tup' AND nomor_spm IS NOT NULL GROUP BY kegiatan, kro, ro, komponen, subkomponen, akun, sumber, cara_tarik) AS cara_tarik_tup
                                ON 
                                        pok_2022.kegiatan = cara_tarik_tup.kegiatan 
                                        AND pok_2022.kro = cara_tarik_tup.kro 
                                        AND pok_2022.ro = cara_tarik_tup.ro 
                                        AND pok_2022.komponen = cara_tarik_tup.komponen 
                                        AND pok_2022.subkomponen = cara_tarik_tup.subkomponen
                                        AND pok_2022.akun = cara_tarik_tup.akun 
                                        AND pok_2022.sumber = cara_tarik_tup.sumber

                                order by pok_2022.kro asc, pok_2022.ro desc, pok_2022.komponen asc, pok_2022.subkomponen asc, pok_2022.level asc";

        $data_pok = $this->db->query($sql);
        return $data_pok->result_array();
        }

        public function dana_rm()
        {
                if(!empty($this->load_pok()))
                {
                        $array_of_rm = array_filter($this->load_pok(), function($rm) {
                                                return $rm['sumber'] == 'rm' && $rm['level'] == '6';
                        });
                        $array_of_rm_pagu = array_filter(array_column($array_of_rm, 'pagu'));
                        $sum_of_rm_pagu = array_sum($array_of_rm_pagu);

                        $array_of_rm_sisa = array_filter(array_column($array_of_rm, 'sisa'));
                        $sum_of_rm_sisa = array_sum($array_of_rm_sisa);
                        return array('total_pagu_rm' => $sum_of_rm_pagu, 'sisa_pagu_rm' =>$sum_of_rm_sisa);
                }
                else
                {
                        return array('total_pagu_rm' => 0, 'sisa_pagu_rm' => 0);
                }
        }

        public function dana_pnp()
        {
                if(!empty($this->load_pok()))
                {
                        $array_of_pnp = array_filter($this->load_pok(), function($pnp) {
                        return $pnp['sumber'] == 'pnp' && $pnp['level'] == '6';
                        });
                        $array_of_pnp_pagu = array_filter(array_column($array_of_pnp, 'pagu'));
                        $sum_of_pnp_pagu = array_sum($array_of_pnp_pagu);

                        $array_of_pnp_sisa = array_filter(array_column($array_of_pnp, 'sisa'));
                        $sum_of_pnp_sisa = array_sum($array_of_pnp_sisa);

                        return array('total_pagu_pnp' => $sum_of_pnp_pagu, 'sisa_pagu_pnp' =>$sum_of_pnp_sisa);
                }
                else
                {
                        return array('total_pagu_pnp' => 0, 'sisa_pagu_pnp' => 0);
                }
                
        }

        public function load_realisasi_sas()
        {
                $sql = 'select * from realisasi_sas where epoch_realisasi_sas = (select max(epoch_realisasi_sas) from realisasi_sas)';
                if(empty($this->db->query($sql)->result_array()))
                {
                        return array(array('jumlah_rm_realisasi_sas' => 0, 'jumlah_pnp_realisasi_sas' => 0));
                }
                else
                {
                        return $this->db->query($sql)->result_array();
                }
        }

        public function sisa_dana_after_sas()
        {
                $sisa_rm = $this->dana_rm()['total_pagu_rm'] - $this->load_realisasi_sas()[0]['jumlah_rm_realisasi_sas'];
                $sisa_pnp = $this->dana_pnp()['total_pagu_pnp'] - $this->load_realisasi_sas()[0]['jumlah_pnp_realisasi_sas'];
                return array('rm' => $sisa_rm, 'pnp' => $sisa_pnp);
        }

        public function load_pagu_pulih()
        {
                $sql = 'select * from pagu_pulih';
                return $this->db->query($sql)->result_array();
        }

        public function sisa_dana_after_pagu_pulih()
        {
                $total_pagu_pulih_rm = 0;
                $total_pagu_pulih_pnp = 0;
                foreach($this->load_pagu_pulih() as $pagu_pulih)
                 {
                        if($pagu_pulih['sumber'] == 'rm')
                        {
                                $total_pagu_pulih_rm = $total_pagu_pulih_rm + $pagu_pulih['jumlah_pagu_pulih'];
                        }
                        if($pagu_pulih['sumber'] == 'pnp')
                        {
                                $total_pagu_pulih_pnp = $total_pagu_pulih_pnp + $pagu_pulih['jumlah_pagu_pulih'];
                        }

                 }
                $sisa_dana_rm_after_sas_pagu_pulih = $this->sisa_dana_after_sas()['rm'] + $total_pagu_pulih_rm;
                $sisa_dana_pnp_after_sas_pagu_pulih = $this->sisa_dana_after_sas()['pnp'] + $total_pagu_pulih_pnp;
                return array('rm' =>  $sisa_dana_rm_after_sas_pagu_pulih, 'pnp' =>$sisa_dana_pnp_after_sas_pagu_pulih, 'total_pagu_pulih_rm' => $total_pagu_pulih_rm, 'total_pagu_pulih_pnp' => $total_pagu_pulih_pnp);
        }

        public function load_kontrak()
        {
                $jumlah_kontrak_rm = 0;
                $jumlah_kontrak_pnp = 0;
                $sql = 'select * from realisasi where is_kontraktual = true and is_kontrak_outstanding = true';
                $data_kontrak = $this->db->query($sql)->result_array();
                if(!empty($data_kontrak))
                {
                        foreach($data_kontrak as $kontrak)
                         {
                                if($kontrak['sumber'] == 'rm')
                                {
                                        $jumlah_kontrak_rm = $jumlah_kontrak_rm + $kontrak['jumlah_realisasi_bruto'];
                                }

                                if($kontrak['sumber'] == 'pnp')
                                {
                                        $jumlah_kontrak_pnp= $jumlah_kontrak_pnp + $kontrak['jumlah_realisasi_bruto'];
                                }
                         }
                         return array('rm' => $jumlah_kontrak_rm, 'pnp' => $jumlah_kontrak_pnp);
                }
                else
                {       
                         return array('rm' => 0, 'pnp' => 0);
                }
                
        }

        // public function load_pengajuan_tup()
        // {
        //         $data_all_tup_rm = 0;
        //         $data_all_tup_pnp = 0;
        //         $sql = 'SELECT SUM(jumlah_pengajuan_tup) AS total_pengajuan_tup, sumber  FROM pengajuan_tup GROUP BY sumber';
        //         $data_all_tup = $this->db->query($sql)->result_array();
        //         if(!empty($data_all_tup))
        //          {
        //                 if($data_all_tup[0]['sumber'] == 'rm') {$data_all_tup_rm = $data_all_tup[0]['total_pengajuan_tup'];}
        //                 if($data_all_tup[0]['sumber'] == 'pnp') {$data_all_tup_pnp = $data_all_tup[0]['total_pengajuan_tup'];}
        //          }
        //         return array('rm' => $data_all_tup_rm, 'pnp' => $data_all_tup_pnp);
        // }

        public function load_pengajuan_tup()
        {
                $data_all_tup_rm = 0;
                $data_all_tup_pnp = 0;
                $sql = "SELECT SUM(jumlah_realisasi_bruto) AS total_realisasi_tup, sumber  FROM realisasi where cara_tarik = 'tup' GROUP BY sumber";
                $data_all_tup = $this->db->query($sql)->result_array();
                if(!empty($data_all_tup))
                 {
                        if($data_all_tup[0]['sumber'] == 'rm') {$data_all_tup_rm = $data_all_tup[0]['total_realisasi_tup'];}
                        if($data_all_tup[0]['sumber'] == 'pnp') {$data_all_tup_pnp = $data_all_tup[0]['total_realisasi_tup'];}
                 }
                return array('rm' => $data_all_tup_rm, 'pnp' => $data_all_tup_pnp);
        }



        // public function load_pengajuan_up()
        // {
        //         $sql = 'select * from pengajuan_up_baru';
        //         $data_all_up = $this->db->query($sql)->result_array();
        //         if(empty($data_all_up))
        //         {
        //                 return array('rm' =>  0, 'pnp' => 0);
        //         }
        //         else
        //         {
        //                 return array('rm' =>  $data_all_up[0]['deposit_rm'], 'pnp' => $data_all_up[0]['deposit_pnp']);
        //         }
                
        // }

        public function load_pengajuan_up()
        {
                $data_all_up_rm = 0;
                $data_all_up_pnp = 0;
                $sql = "SELECT SUM(jumlah_realisasi_bruto) AS total_realisasi_up, sumber  FROM realisasi where cara_tarik = 'up' AND nomor_spm IS NOT NULL GROUP BY sumber";
                $data_all_up = $this->db->query($sql)->result_array();
                if(!empty($data_all_up))
                 {
                        if($data_all_up[0]['sumber'] == 'rm') {$data_all_tup_rm = $data_all_up[0]['total_realisasi_up'];}
                        if($data_all_up[0]['sumber'] == 'pnp') {$data_all_tup_pnp = $data_all_up[0]['total_realisasi_up'];}
                 }
                 else
                 {
                        $data_all_up_rm = 0;
                        $data_all_up_pnp = 0;
                 }
                return array('rm' => $data_all_up_rm, 'pnp' => $data_all_up_pnp);
        }

        public function load_sisa_dana_before_ls_up()
        {
                $sisa_dana_rm_after_sas_pagu_pulih_outstanding_tup_up = $this->sisa_dana_after_pagu_pulih()['rm'] - $this->load_kontrak()['rm'] - $this->load_pengajuan_tup()['rm'] - $this->load_pengajuan_up()['rm'];
                 $sisa_dana_pnp_after_sas_pagu_pulih_outstanding_tup_up = $this->sisa_dana_after_pagu_pulih()['pnp'] - $this->load_kontrak()['pnp'] - $this->load_pengajuan_tup()['pnp'] - $this->load_pengajuan_up()['pnp'];
                 return array('rm' => $sisa_dana_rm_after_sas_pagu_pulih_outstanding_tup_up, 'pnp' => $sisa_dana_pnp_after_sas_pagu_pulih_outstanding_tup_up);
        }

        public function load_realisasi()
        {
                // query tabel realisasi termasuk kontrak yang sudah tidak outstanding
                $jumlah_realisasi_ls_up_rm = 0;
                $jumlah_realisasi_ls_up_pnp = 0;
                $sql = "SELECT sumber, SUM(jumlah_realisasi_bruto) AS total_realisasi FROM realisasi WHERE (cara_tarik = 'ls' OR cara_tarik = 'up') AND nomor_spm IS NOT NULL  AND is_kontrak_outstanding = false GROUP BY sumber";
                $data_all_realisasi = $this->db->query($sql)->result_array();
                foreach($data_all_realisasi as $data_realisasi)
                 {
                        if($data_realisasi['sumber'] == 'rm')
                        {
                                $jumlah_realisasi_ls_up_rm = $jumlah_realisasi_ls_up_rm + $data_realisasi['total_realisasi'];
                        }

                        if($data_realisasi['sumber'] == 'pnp')
                        {
                                $jumlah_realisasi_ls_up_pnp = $jumlah_realisasi_ls_up_pnp + $data_realisasi['total_realisasi'];
                        }
                 }
                return array('rm' => $jumlah_realisasi_ls_up_rm, 'pnp' =>$jumlah_realisasi_ls_up_pnp);
        }

        public function load_sisa_dana_akhir()
        {
                $sisa_dana_akhir_rm = $this->load_sisa_dana_before_ls_up()['rm'] - $this->load_realisasi()['rm'];
                $sisa_dana_akhir_pnp = $this->load_sisa_dana_before_ls_up()['pnp'] - $this->load_realisasi()['pnp'];
                return array('rm' => $sisa_dana_akhir_rm, 'pnp' => $sisa_dana_akhir_pnp);
        }

        public function load_akun()
        {
                $sql = 'select * from pok_2022 where level = 6 order by kro asc, ro desc, komponen asc, subkomponen asc, level asc';
                return $this->db->query($sql)->result_array();
        }

        public function load_akun_realisasi($id)
        {
                $sql = "select * from pok_2022 where id=? and level=6";
                return json_encode($this->db->query($sql, array($id))->result_array());
        }

        public function load_item_realisasi($id, $cara_tarik)
        {
                $sql = "select * from realisasi where id = ? and cara_tarik = ?";
                return $this->db->query($sql, array($id, $cara_tarik))->result_array();
        }

        public function load_all_realisasi_ls()
        {
                $sql = "select * from realisasi where cara_tarik = 'ls'";
                return $this->db->query($sql)->result_array();
        }

        public function load_all_realisasi_up()
        {
                $sql = "select * from realisasi where cara_tarik = 'up'";
                return $this->db->query($sql)->result_array();
        }

        public function load_all_realisasi_tup()
        {
                $sql = "select * from realisasi where cara_tarik = 'tup'";
                return $this->db->query($sql)->result_array();
        }

        public function simpan_realisasi()
        {
                // get POST request 

                // tentukan jenis pph
                switch ( $this->input->post('select_pph')) {

                        case 'no_pajak':
                                $jenis_pph = 'no_pajak';
                                break;

                        case '0':
                                $jenis_pph = 'PPh 21 0%';
                                break;
                        
                        case '0.05':
                                $jenis_pph = 'PPh 21 5% (PNS Gol III)';
                                break;

                        case '0.15':
                                $jenis_pph = 'PPh 21 15% (PNS Gol IV)';
                                break;

                        case '0.025':
                                $jenis_pph = 'PPh 21 5% x 50% (non pegawai, NPWP)';
                                break;

                        case '0.03':
                                $jenis_pph = 'PPh 21 5% x 50% x 120% (non pegawai, non NPWP)';
                                break;

                        case '0.015':
                                $jenis_pph = 'PPh 22 1,5%';
                                break;

                        case '0.02':
                                $jenis_pph = 'PPh 23 2% (sewa, imbalan, jasa teknik)';
                                break;

                        case '0.15':
                                $jenis_pph = 'PPh 23 15% (dividen, bunga, royalti)';
                                break;
                }

                $data = array(
                                $this->input->post('nomor_kuitansi'),
                                strtotime($this->input->post('tanggal_kuitansi')),
                                $this->input->post('uraian_realisasi'),
                                 $this->input->post('cara_tarik'),
                                0,
                                $this->input->post('kegiatan_realisasi'),
                                $this->input->post('kro_realisasi'),
                                $this->input->post('ro_realisasi'),
                                $this->input->post('komponen_realisasi'),
                                $this->input->post('subkomponen_realisasi'),
                                $this->input->post('akun_realisasi'),
                                time(),
                                '198411172015021002',
                                $this->input->post('sumber_realisasi'),
                                $this->input->post('kontraktual'),
                                $this->input->post('poksi'),
                                $this->input->post('jumlah_realisasi_bruto'),
                                $this->input->post('penerima'),   

                                // pajak-pajak
                                $this->input->post('nilai_ppn'),
                                $this->input->post('nilai_pph'),
                                $jenis_pph, 
                        );

                $sql = "insert into realisasi (nomor_kuitansi, epoch_kuitansi, uraian_realisasi, cara_tarik, urutan_cara_tarik, kegiatan, kro, ro, komponen, subkomponen, akun, epoch_realisasi, user_entri, sumber, is_kontraktual, poksi, jumlah_realisasi_bruto, penerima, jumlah_ppn, jumlah_pph, jenis_pph) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->db->query($sql, $data);

        }


        public function load_data_posisi_anggaran_tup($kro, $ro, $komponen, $subkomponen, $akun, $sumber)
        {
                $sql =  "SELECT pengajuan_tup.kro, pengajuan_tup.ro, pengajuan_tup.komponen, pengajuan_tup.subkomponen, pengajuan_tup.akun, 
                                pengajuan_tup.uraian, pengajuan_tup.sumber, SUM(pengajuan_tup.jumlah_pengajuan_tup) AS jumlah_aju_tup, pengajuan_tup.poksi, realisasi_tup.jumlah_realisasi_tup
                                FROM pengajuan_tup

                                LEFT JOIN 
                                (
                                        SELECT kro, ro, komponen, subkomponen, akun, sumber, SUM(jumlah_realisasi_bruto) AS jumlah_realisasi_tup, poksi
                                        FROM realisasi
                                        WHERE cara_tarik = 'tup'
                                        GROUP BY kro, ro, komponen, subkomponen, akun, sumber, poksi
                                ) AS realisasi_tup

                                ON
                                pengajuan_tup.kro = realisasi_tup.kro
                                AND pengajuan_tup.ro = realisasi_tup.ro
                                AND pengajuan_tup.komponen = realisasi_tup.komponen
                                AND pengajuan_tup.subkomponen = realisasi_tup.subkomponen
                                AND pengajuan_tup.akun = realisasi_tup.akun
                                AND pengajuan_tup.sumber = realisasi_tup.sumber
                                AND pengajuan_tup.poksi = realisasi_tup.poksi

                                WHERE 
                                pengajuan_tup.kro = ?
                                AND pengajuan_tup.ro = ?
                                AND pengajuan_tup.komponen = ?
                                AND pengajuan_tup.subkomponen = ?
                                AND pengajuan_tup.akun = ?
                                AND pengajuan_tup.sumber = ?

                                GROUP BY pengajuan_tup.kro, pengajuan_tup.ro, pengajuan_tup.komponen, pengajuan_tup.subkomponen, pengajuan_tup.akun, 
                                pengajuan_tup.uraian, pengajuan_tup.sumber,  pengajuan_tup.poksi,  realisasi_tup.jumlah_realisasi_tup";
                return json_encode($this->db->query($sql, array($kro, $ro, $komponen, $subkomponen, $akun, $sumber))->result_array());
        }


        public function load_data_posisi_anggaran_up($kro, $ro, $komponen, $subkomponen, $akun, $sumber)
        {
                 $sql =  "SELECT        pengajuan_up.sumber, 
                                        SUM(pengajuan_up.jumlah_pengajuan_up) AS jumlah_aju_up, 
                                        CASE 
                                                WHEN realisasi_up.jumlah_realisasi_up IS NULL THEN 0
                                                ELSE realisasi_up.jumlah_realisasi_up
                                        END jumlah_realisasi_up,

                                        CASE 
                                                WHEN realisasi_up_total.jumlah_realisasi_up_total IS NULL THEN SUM(pengajuan_up.jumlah_pengajuan_up)
                                                ELSE (sum(pengajuan_up.jumlah_pengajuan_up) - realisasi_up_total.jumlah_realisasi_up_total)
                                        END sisa_pengajuan_up
                                FROM pengajuan_up

                                LEFT JOIN 
                                (
                                        SELECT sumber, SUM(jumlah_realisasi_bruto) AS jumlah_realisasi_up
                                        FROM realisasi
                                        WHERE cara_tarik = 'up' AND nomor_spm IS NOT NULL
                                        AND kro = ?
                                        AND ro = ?
                                        AND komponen = ?
                                        AND subkomponen = ?
                                        AND akun = ?
                                        AND sumber = ?
                                        GROUP BY kro, ro, komponen, subkomponen, akun, sumber
                                ) AS realisasi_up
                                ON pengajuan_up.sumber = realisasi_up.sumber

                                LEFT JOIN 
                                (
                                        SELECT sumber, SUM(jumlah_realisasi_bruto) AS jumlah_realisasi_up_total
                                        FROM realisasi
                                        WHERE cara_tarik = 'up' AND nomor_spm IS NOT NULL
                                        GROUP BY sumber
                                ) AS realisasi_up_total

                                ON pengajuan_up.sumber = realisasi_up_total.sumber
                                

                                WHERE pengajuan_up.sumber = ?

                                GROUP BY pengajuan_up.kro, pengajuan_up.ro, pengajuan_up.komponen, pengajuan_up.subkomponen, pengajuan_up.akun, 
                                pengajuan_up.uraian, pengajuan_up.sumber,  pengajuan_up.poksi,  realisasi_up.jumlah_realisasi_up, realisasi_up_total.jumlah_realisasi_up_total";


                $data = $this->db->query($sql, array($kro, $ro, $komponen, $subkomponen, $akun, $sumber, $sumber))->result_array();
                if(!empty($data))
                {
                        return json_encode(
                                        array(
                                                array_map(
                                                                function($x) {return (is_null($x) ? 0 : $x);}, $data[0]
                                                        )
                                        )
                                );
                }
                else 
                {
                        return json_encode(array('sumber' => $sumber, 'jumlah_aju_up' => 0, 'jumlah_realisasi_up' => 0, 'sisa_pengajuan_up' => 0));
                }

                
        }

        public function load_data_posisi_anggaran_ls($kro, $ro, $komponen, $subkomponen, $akun, $sumber)
        {
                $sql = "SELECT kro, ro, komponen, subkomponen, akun, sumber, SUM(jumlah_realisasi_bruto) AS jumlah_realisasi_ls
                                FROM realisasi
                                WHERE 
                                cara_tarik = 'ls' 
                                AND kro = ?
                                AND ro = ?
                                AND komponen = ?
                                AND subkomponen = ?
                                AND akun = ?
                                AND sumber = ?
                                GROUP BY kro, ro, komponen, subkomponen, akun, sumber";
               return json_encode($this->db->query($sql, array($kro, $ro, $komponen, $subkomponen, $akun, $sumber))->result_array());
        }

}
?>