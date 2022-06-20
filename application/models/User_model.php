<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
	public function countPermintaanMasuk($divisi)
	{

		$query = $this->db->query(
			"SELECT COUNT(id_minta) as masuk
							   FROM tb_minta
							   WHERE divisi_kode_tuj = '$divisi' AND status_minta = 1
							   "
		);
		if ($query->num_rows() > 0) {
			return $query->row()->masuk;
		} else {
			return 0;
		}
	}

	public function countDitolak($divisi)
	{

		$query = $this->db->query(
			"SELECT COUNT(id_minta) as ditolak
                               FROM tb_minta
                               WHERE divisi_kode_asal = '$divisi' AND status_minta = 2"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->ditolak;
		} else {
			return 0;
		}
	}
	public function countDiterima($divisi)
	{

		$query = $this->db->query(
			"SELECT COUNT(id_minta) as diterima
                               FROM tb_minta
                               WHERE divisi_kode_asal = '$divisi' AND status_minta = 0"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->diterima;
		} else {
			return 0;
		}
	}

	public function countPending($divisi)
	{
		$query = $this->db->query(
			"SELECT COUNT(id_minta) as pending
                               FROM tb_minta
                               WHERE divisi_kode_asal = '$divisi' AND status_minta = 1"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->pending;
		} else {
			return 0;
		}
	}

	public function countTotal($divisi)
	{
		$query = $this->db->query(
			"SELECT COUNT(id_minta) as total
                               FROM tb_minta
                               WHERE divisi_kode_asal = '$divisi'"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->total;
		} else {
			return 0;
		}
	}

	public function JanuariCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',01) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function FebruariCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',02) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function MaretCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',03) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}


	public function AprilCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',04) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function MeiCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',05) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function JuniCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',06) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function JuliCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',07) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function AgustusCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',08) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function SeptemberCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',09) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function OktoberCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',10) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function NovemberCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',11) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function DesemberCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',12) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	public function NoCount()
	{
		$divisi = $this->session->userdata('divisi_kode');
		$query = $this->db->query(
			"SELECT CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta)) AS tahun_bulan, COUNT(*) AS januari
                FROM tb_minta
                WHERE CONCAT(YEAR(tgl_minta),'/',MONTH(tgl_minta))=CONCAT(YEAR(NOW()),'/',11) AND divisi_kode_asal = '$divisi'
                GROUP BY YEAR(tgl_minta),MONTH(tgl_minta);"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->januari;
		} else {
			return 0;
		}
	}

	function getKodeMinta()
	{
		$this->db->select('RIGHT(kode_minta,4) as kode', FALSE);
		$this->db->order_by('id_minta', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tb_minta');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = date('Ymd') . $kodemax;
		return $kodejadi;
	}

	public function getPermintaan($divisi)
	{
		$query = "SELECT *
                  FROM tb_minta JOIN mst_user
				  ON tb_minta.sess_id = mst_user.id_user
				  JOIN mst_divisi
				  ON mst_divisi.kode_divisi = tb_minta.divisi_kode_tuj
				  JOIN mst_kategori
				  ON mst_kategori.kode_kategori = tb_minta.kategori_kode
				  JOIN mst_cabang
				  ON tb_minta.idcabang = mst_cabang.idcabang
				  JOIN mst_satuan
				  ON mst_satuan.kode_satuan = tb_minta.satuan_kode
				  WHERE tb_minta.divisi_kode_asal = '$divisi' AND status_minta = 1
				  ";
		return $this->db->query($query)->result_array();
	}

	public function getAllPermintaan($divisi)
	{
		$query = "SELECT *
                  FROM tb_minta JOIN mst_user
				  ON tb_minta.sess_id = mst_user.id_user
				  JOIN mst_divisi
				  ON mst_divisi.kode_divisi = tb_minta.divisi_kode_tuj
				  JOIN mst_kategori
				  ON mst_kategori.kode_kategori = tb_minta.kategori_kode
				  JOIN mst_cabang
				  ON tb_minta.idcabang = mst_cabang.idcabang
				  JOIN mst_satuan
				  ON mst_satuan.kode_satuan = tb_minta.satuan_kode
				  WHERE tb_minta.divisi_kode_asal = '$divisi' AND status_minta = 2 OR status_minta = 0
				  ";
		return $this->db->query($query)->result_array();
	}

	public function getNamaDivisi($divisi)
	{
		$query = "SELECT nama_divisi
                  FROM mst_divisi
				  WHERE kode_divisi = '$divisi'				
				  ";
		return $this->db->query($query)->row_array();
	}
	public function getNamaCabang($cabang)
	{
		$query = "SELECT idcabang,namacabang
                  FROM mst_cabang
				  WHERE idcabang = '$cabang'				
				  ";
		return $this->db->query($query)->row_array();
	}

	public function getAllPermintaanMasuk($divisi)
	{
		$query = "SELECT *
                  FROM tb_minta JOIN mst_user
				  ON tb_minta.sess_id = mst_user.id_user
				  JOIN mst_divisi
				  ON mst_divisi.kode_divisi = tb_minta.divisi_kode_asal
				  JOIN mst_kategori
				  ON mst_kategori.kode_kategori = tb_minta.kategori_kode
				  JOIN mst_cabang
				  ON tb_minta.idcabang = mst_cabang.idcabang
				  JOIN mst_satuan
				  ON mst_satuan.kode_satuan = tb_minta.satuan_kode
				  WHERE tb_minta.divisi_kode_tuj = '$divisi' AND status_minta = 1
				  ";
		return $this->db->query($query)->result_array();
	}
}
