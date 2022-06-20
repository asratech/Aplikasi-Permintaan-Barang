<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		is_logged_in();
		is_user();
		$this->load->helper('rupiah');
		$this->load->helper('tglindo');
		$this->load->model('user_model', 'user');
		$this->load->helper('date');
	}

	public function index()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Beranda';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['januari'] = $this->user->JanuariCount();
			$data['februari'] = $this->user->FebruariCount();
			$data['maret'] = $this->user->MaretCount();
			$data['april'] = $this->user->AprilCount();
			$data['mei'] = $this->user->MeiCount();
			$data['juni'] = $this->user->JuniCount();
			$data['juli'] = $this->user->JuliCount();
			$data['agustus'] = $this->user->AgustusCount();
			$data['september'] = $this->user->SeptemberCount();
			$data['oktober'] = $this->user->OktoberCount();
			$data['november'] = $this->user->NovemberCount();
			$data['desember'] = $this->user->DesemberCount();
			$divisi = $this->session->userdata('divisi_kode');
			$data['permintaan_masuk'] = $this->user->countPermintaanMasuk($divisi);
			$data['ditolak'] = $this->user->countDitolak($divisi);
			$data['diterima'] = $this->user->countDiterima($divisi);
			$data['pending'] = $this->user->countPending($divisi);
			$data['total'] = $this->user->countTotal($divisi);

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer');
		} else {
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/dist/img/profile';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . './assets/dist/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$id_user = $this->input->post('id_user');
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$hp = $this->input->post('hp');
			$cabang = $this->input->post('cabang');
			$this->db->set('nama', $nama);
			$this->db->set('email', $email);
			$this->db->set('hp', $hp);
			$this->db->where('id_user', $id_user);
			$this->db->update('mst_user');
			$this->session->set_flashdata('message', 'Update data');
			redirect('user/index');
		}
	}

	public function ubah_password()
	{
		$this->form_validation->set_rules('current_password', 'Password Lama', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Konfirm Password Baru', 'required|trim|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Beranda';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if ($current_password == $new_password) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
				redirect('user/index');
			} else {
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('mst_user');
				$this->session->set_flashdata('message', 'Ubah password');
				redirect('user/index');
			}
		}
	}

	public function permintaan()
	{
		$this->form_validation->set_rules('kode_minta', 'kode_minta', 'required|trim|is_unique[tb_minta.kode_minta]', array(
			'is_unique' => 'Kode Permintaan sudah ada'
		));

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = 'Permintaan';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$divisi = $this->session->userdata('divisi_kode');
			$data['nama_divisi'] = $this->user->getNamaDivisi($divisi);
			$data['list_permintaan'] = $this->user->getPermintaan($divisi);
			$data['divisi'] = $this->db->get_where('mst_divisi', ['divisi_aktif' => 1])->result_array();
			$data['cabang'] = $this->db->get_where('mst_cabang', ['status' => 1])->result_array();
			$data['kategori'] = $this->db->get_where('mst_kategori', ['kategori_aktif' => 1])->result_array();
			$data['satuan'] = $this->db->get_where('mst_satuan', ['satuan_aktif' => 1])->result_array();
			$data['komin'] = $this->user->getKodeMinta();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/permintaan', $data);
			$this->load->view('templates/footer');
		} else {
			$sess_id = $this->session->userdata('id_user');
			$dibuatoleh = $this->session->userdata('nama');
			$divisi_asal = $this->session->userdata('divisi_kode');
			$data = array(
				'kode_minta' => $this->input->post('kode_minta', true),
				'kategori_kode' => $this->input->post('kategori_kode', true),
				'divisi_kode_tuj' => $this->input->post('divisi_kode_tuj', true),
				'idcabang' => $this->input->post('idcabang', true),
				'tgl_minta' => $this->input->post('tgl_minta', true),
				'jml_minta' => $this->input->post('jml_minta', true),
				'satuan_kode' => $this->input->post('satuan_kode', true),
				'permintaan' => $this->input->post('permintaan', true),
				'keterangan' => $this->input->post('keterangan', true),
				'sess_id' => $sess_id,
				'divisi_kode_asal' => $divisi_asal,
				'penerima' => '-',
				'alasan_tolak' => '-',
				'status_minta' => 1,
				'createby' => $dibuatoleh,
				'createdate' => mdate('%Y-%m-%d %H:%i:%s', now())
			);
			$this->db->insert('tb_minta', $data);
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('user/permintaan');
		}
	}
	public function get_minta()
	{
		$id_minta = $this->input->post('id_minta');
		echo json_encode($this->db->get_where('tb_minta', ['id_minta' => $id_minta])->row_array());
	}

	public function edit_permintaan()
	{
		$id_minta = $this->input->post('id_minta');
		$kategori_kode = $this->input->post('kategori_kode');
		$divisi_kode_tuj = $this->input->post('divisi_kode_tuj');
		$idcabang = $this->input->post('idcabang');
		$jml_minta = $this->input->post('jml_minta');
		$satuan_kode = $this->input->post('satuan_kode');
		$permintaan = $this->input->post('permintaan');
		$keterangan = $this->input->post('keterangan');
		$dibuatoleh = $this->session->userdata('nama');

		$this->db->set('kategori_kode', $kategori_kode);
		$this->db->set('divisi_kode_tuj', $divisi_kode_tuj);
		$this->db->set('idcabang', $idcabang);
		$this->db->set('jml_minta', $jml_minta);
		$this->db->set('satuan_kode', $satuan_kode);
		$this->db->set('permintaan', $permintaan);
		$this->db->set('keterangan', $keterangan);
		$this->db->set('lastupdate',mdate('%Y-%m-%d %H:%i:%s', now()));
		$this->db->set('updateby',$dibuatoleh);

		$this->db->where('id_minta', $id_minta);
		$this->db->update('tb_minta');
		$this->session->set_flashdata('message', 'Simpan Perubahan');
		redirect('user/permintaan');
	}

	public function del_permintaan($id_minta)
	{
		$this->db->where('id_minta', $id_minta);
		$this->db->delete('tb_minta');
		$this->session->set_flashdata('message', 'Hapus Permintaan');
		redirect('user/permintaan');
	}

	public function list_permintaan()
	{
		$data['title'] = 'List Permintaan';
		$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
		$divisi = $this->session->userdata('divisi_kode');
		$data['nama_divisi'] = $this->user->getNamaDivisi($divisi);
		$data['list_permintaan'] = $this->user->getAllPermintaan($divisi);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_user', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/list_permintaan', $data);
		$this->load->view('templates/footer');
	}

	public function permintaan_masuk()
	{
		$this->form_validation->set_rules('penerima', 'Nama Penerima', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = 'Permintaan Masuk';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$divisi = $this->session->userdata('divisi_kode');
			$data['nama_divisi'] = $this->user->getNamaDivisi($divisi);
			$data['permintaan_masuk'] = $this->user->getAllPermintaanMasuk($divisi);
			$data['satuan'] = $this->db->get_where('mst_satuan', ['satuan_aktif' => 1])->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/permintaan_masuk', $data);
			$this->load->view('templates/footer');
		} else {
			$id_minta = $this->input->post('id_minta', true);
			$penerima = $this->input->post('penerima', true);
			$alasan_tolak = $this->input->post('alasan_tolak', true);
			$approveby = $this->session->userdata('nama');
			$status_minta = $this->input->post('status_minta', true);

			$this->db->set('penerima', $penerima);
			$this->db->set('alasan_tolak', $alasan_tolak);
			$this->db->set('status_minta', $status_minta);
			$this->db->set('approvedate',mdate('%Y-%m-%d %H:%i:%s', now()));
			$this->db->set('approveby',$approveby);

			$this->db->where('id_minta', $id_minta);
			$this->db->update('tb_minta');
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('user/permintaan_masuk');
		}
	}
}
