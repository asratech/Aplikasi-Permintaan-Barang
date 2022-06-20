<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		is_logged_in();
		is_admin();
		$this->load->helper('rupiah');
		$this->load->helper('tglindo');
		$this->load->model('Admin_model', 'admin');
		$this->load->helper('date');
	}

	public function index()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Beranda';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['user_perbulan'] = $this->admin->countUserPerbulan();
			$data['count_user'] = $this->admin->countJmlUser();
			$data['user_aktif'] = $this->admin->countUserAktif();
			$data['user_tak_aktif'] = $this->admin->countUserTakAktif();
			$data['list_user'] = $this->db->get('mst_user')->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/index', $data);
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
						unlink(FCPATH . 'assets/dist/img/profile/' . $old_image);
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
			$this->db->set('nama', $nama);
			$this->db->set('email', $email);
			$this->db->set('hp', $hp);
			$this->db->where('id_user', $id_user);
			$this->db->update('mst_user');
			$this->session->set_flashdata('message', 'Update data');
			redirect('admin/index');
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
			$data['user_perbulan'] = $this->admin->countUserPerbulan();
			$data['count_user'] = $this->admin->countJmlUser();
			$data['user_aktif'] = $this->admin->countUserAktif();
			$data['user_tak_aktif'] = $this->admin->countUserTakAktif();
			$data['list_user'] = $this->db->get('mst_user')->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/index', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if ($current_password == $new_password) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
				redirect('admin/index');
			} else {
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('mst_user');
				$this->session->set_flashdata('message', 'Ubah password');
				redirect('admin/index');
			}
		}
	}

	public function man_user()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[mst_user.username]', array(
			'is_unique' => 'Username sudah ada'
		));
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
			'matches' => 'Password tidak sama',
			'min_length' => 'password min 3 karakter'
		));
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Management User';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_user'] = $this->admin->getAllUser();
			$data['divisi'] = $this->db->get_where('mst_divisi', ['divisi_aktif' => 1])->result_array();
			$data['cabang'] = $this->db->get_where('mst_cabang', ['status' => 1])->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/man_user', $data);
			$this->load->view('templates/footer');
		} else {
			$data = array(
				'nama' => $this->input->post('nama', true),
				'divisi_kode' => $this->input->post('divisi_kode', true),
				'idcabang' => $this->input->post('idcabang', true),
				'email' => $this->input->post('email', true),
				'hp' => $this->input->post('hp', true),
				'level' => $this->input->post('level', true),
				'username' => $this->input->post('username', true),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'date_created' => date('Y/m/d'),
				'image' => 'default.jpg',
				'is_active' => 1
			);
			$this->db->insert('mst_user', $data);
			$this->session->set_flashdata('message', 'Tambah user');
			redirect('admin/man_user');
		}
	}

	public function edit_user()
	{
		echo json_encode($this->admin->getUserEdit($_POST['id_user']));
	}

	public function proses_edit_user()
	{
		$id_user = $this->input->post('id_user');
		$nama = $this->input->post('nama');
		$divisi_kode = $this->input->post('divisi_kode');
		$idcabang = $this->input->post('idcabang');
		$email = $this->input->post('email');
		$hp = $this->input->post('hp');
		$level = $this->input->post('level');
		$is_active = $this->input->post('is_active');

		$this->db->set('nama', $nama);
		$this->db->set('divisi_kode', $divisi_kode);
		$this->db->set('idcabang', $idcabang);
		$this->db->set('email', $email);
		$this->db->set('hp', $hp);
		$this->db->set('level', $level);
		$this->db->set('is_active', $is_active);

		$this->db->where('id_user', $id_user);
		$this->db->update('mst_user');
		$this->session->set_flashdata('message', 'Update data');
		redirect('admin/man_user');
	}

	public function del_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->delete('mst_user');
		$this->session->set_flashdata('message', 'Hapus user');
		redirect('admin/man_user');
	}

	public function mst_divisi()
	{
		$this->form_validation->set_rules('kode_divisi', 'kode_divisi', 'required|trim|is_unique[mst_divisi.kode_divisi]', array(
			'is_unique' => 'Kode Divisi sudah ada'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Master Divisi';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_divisi'] = $this->db->get('mst_divisi')->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/master/mst_divisi', $data);
			$this->load->view('templates/footer');
		} else {
			$data = array(
				'kode_divisi' => $this->input->post('kode_divisi', true),
				'nama_divisi' => $this->input->post('nama_divisi', true),
				'divisi_aktif' => 1
			);
			$this->db->insert('mst_divisi', $data);
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('admin/mst_divisi');
		}
	}

	public function get_divisi()
	{
		$id_divisi = $this->input->post('id_divisi');
		echo json_encode($this->db->get_where('mst_divisi', ['id_divisi' => $id_divisi])->row_array());
	}

	public function edit_divisi()
	{
		$id_divisi = $this->input->post('id_divisi');
		$nama_divisi = $this->input->post('nama_divisi');
		$divisi_aktif = $this->input->post('divisi_aktif');

		$this->db->set('nama_divisi', $nama_divisi);
		$this->db->set('divisi_aktif', $divisi_aktif);

		$this->db->where('id_divisi', $id_divisi);
		$this->db->update('mst_divisi');
		$this->session->set_flashdata('message', 'Simpan Perubahan');
		redirect('admin/mst_divisi');
	}
// Master Cabang
public function mst_cabang()
	{
		$this->form_validation->set_rules('kodecabang', 'namacabang', 'required|trim|is_unique[mst_cabang.kodecabang]', array(
			'is_unique' => 'Kode Cabang sudah ada'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Master Cabang';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_cabang'] = $this->db->get('mst_cabang')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/master/mst_cabang', $data);
			$this->load->view('templates/footer');
			$dibuat = $this->session->userdata('nama');
		} else {
			$data = array(
				'kodecabang' => $this->input->post('kodecabang', true),
				'namacabang' => $this->input->post('namacabang', true),
				'status' => 1,
				'createby' => $dibuat,
				'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now())
			);
			$this->db->insert('mst_cabang', $data);
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('admin/mst_cabang');
		}
	}
	public function get_cabang()
	{
		$idcabang = $this->input->post('idcabang');
		echo json_encode($this->db->get_where('mst_cabang', ['idcabang' => $idcabang])->row_array());
	}
	public function edit_cabang()
	{
		$idcabang = $this->input->post('idcabang');
		$namacabang = $this->input->post('namacabang');
		$status = $this->input->post('status');

		$this->db->set('namacabang', $namacabang);
		$this->db->set('status', $status);

		$this->db->where('idcabang', $idcabang);
		$this->db->update('mst_cabang');
		$this->session->set_flashdata('message', 'Simpan Perubahan');
		redirect('admin/mst_cabang');
	}

// Akhir Master Cabang
	public function mst_kategori()
	{
		$this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required|trim|is_unique[mst_kategori.kode_kategori]', array(
			'is_unique' => 'Kode kategori sudah ada'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Master Kategori';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_kategori'] = $this->db->get('mst_kategori')->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/master/mst_kategori', $data);
			$this->load->view('templates/footer');
		} else {
			$data = array(
				'kode_kategori' => $this->input->post('kode_kategori', true),
				'nama_kategori' => $this->input->post('nama_kategori', true),
				'kategori_aktif' => 1
			);
			$this->db->insert('mst_kategori', $data);
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('admin/mst_kategori');
		}
	}

	public function get_kategori()
	{
		$id_kategori = $this->input->post('id_kategori');
		echo json_encode($this->db->get_where('mst_kategori', ['id_kategori' => $id_kategori])->row_array());
	}

	public function edit_kategori()
	{
		$id_kategori = $this->input->post('id_kategori');
		$nama_kategori = $this->input->post('nama_kategori');
		$kategori_aktif = $this->input->post('kategori_aktif');

		$this->db->set('nama_kategori', $nama_kategori);
		$this->db->set('kategori_aktif', $kategori_aktif);

		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('mst_kategori');
		$this->session->set_flashdata('message', 'Simpan Perubahan');
		redirect('admin/mst_kategori');
	}

	public function mst_satuan()
	{
		$this->form_validation->set_rules('kode_satuan', 'kode_satuan', 'required|trim|is_unique[mst_satuan.kode_satuan]', array(
			'is_unique' => 'Kode satuan sudah ada'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Master Satuan';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_satuan'] = $this->db->get('mst_satuan')->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/master/mst_satuan', $data);
			$this->load->view('templates/footer');
		} else {
			$data = array(
				'kode_satuan' => $this->input->post('kode_satuan', true),
				'nama_satuan' => $this->input->post('nama_satuan', true),
				'satuan_aktif' => 1
			);
			$this->db->insert('mst_satuan', $data);
			$this->session->set_flashdata('message', 'Simpan Data');
			redirect('admin/mst_satuan');
		}
	}

	public function get_satuan()
	{
		$id_satuan = $this->input->post('id_satuan');
		echo json_encode($this->db->get_where('mst_satuan', ['id_satuan' => $id_satuan])->row_array());
	}

	public function edit_satuan()
	{
		$id_satuan = $this->input->post('id_satuan');
		$nama_satuan = $this->input->post('nama_satuan');
		$satuan_aktif = $this->input->post('satuan_aktif');

		$this->db->set('nama_satuan', $nama_satuan);
		$this->db->set('satuan_aktif', $satuan_aktif);

		$this->db->where('id_satuan', $id_satuan);
		$this->db->update('mst_satuan');
		$this->session->set_flashdata('message', 'Simpan Perubahan');
		redirect('admin/mst_satuan');
	}

	public function view()
	{
		$data['title'] = 'Permintaan Divisi';
		$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['list_permintaan'] = $this->admin->getPermintaan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_admin', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/data/view', $data);
		$this->load->view('templates/footer');
	}
}
