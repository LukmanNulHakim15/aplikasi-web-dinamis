<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_admin') != "telah_login") {
			redirect(base_url('Login'));
		}
	}

	public function index()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages');
		$this->load->view('dashboard/v_footer');
	}

	public function response($status, $code, $msg = "Message is null.", $data = [])
    {
        http_response_code($code);
        return ['status' => $status, 'code' => $code, 'msg' => $msg, 'data' => $data];
    }


	public function savePages()
	{
		$judul = $this->input->post('judul_halaman');
		$konten = $this->input->post('konten_halaman');

		$data = [
			'halaman_judul' => $judul,
			'halaman_konten'=> $konten,
			'halaman_slug'	=> strtolower(url_title($judul)),
			'created_by'	=> session('name')
		];

		$this->load->database();
		$save = $this->db->insert('halaman', $data);
		if($save) {
			json($this->response(True, 200, "success"));
		} else {
			json($this->response(False, 500, "gagal simpan"));
		}

	}

	public function getTablePages()
	{
		$this->load->model('m_data');
		$this->m_data->tablePages();
	}

	public function pagesId()
	{
		$id = $this->input->post('id');
		$this->load->database();
		$query = $this->db->query("SELECT * FROM halaman WHERE is_deleted IS NULL AND id=?",[$id]);
		if($query->num_rows() > 0) {
			json($this->response(True, 200, 'success', $query->row()));
		} else {
			json($this->response(False, 500, 'internal server error'));
		}
	}

	public function updatePages()
	{
		$id = $this->input->post('id');
		$judul = $this->input->post('judul_halaman');
		$konten = $this->input->post('konten_halaman');

		$data = [
			'halaman_judul' => $judul,
			'halaman_konten'=> $konten,
			'halaman_slug'	=> strtolower(url_title($judul)),
			'updated_by'	=> session('name'),
			'updated_at'	=> date('Y-m-d H-m-s')
		];

		$this->load->database();
		$update = $this->db->where('id', $id)->update('halaman', $data);
		if($data) {
			json($this->response(True, 200, 'success'));
		} else {
			json($this->response(False, 500, 'internal server error'));
		}
	}

	public function deletePages()
	{
		$id = $this->input->post('id');
		$data = [
			'is_deleted'	=> 1,
			'deleted_by'	=> session('name'),
			'deleted_at'	=> date('Y-m-d H-m-s')		
		];
		$this->load->database();
		$delete = $this->db->where('id', $id)->update('halaman', $data);
		if($delete) {
			json($this->response(True, 200, 'success'));
		} else {
			json($this->response(False, 500, 'gagal delete'));
		}
	}
}



?>