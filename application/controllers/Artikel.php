<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_admin')!="telah_login") {
			redirect(base_url('Login'));
		}

	}

	public function index()
	{
		$this->load->model('m_data');
		$data['provinsi'] = $this->m_data->view();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel');
		$this->load->view('dashboard/v_footer');
	}

	 public function response($status, $code, $msg = "Message is null.", $data = [])
    {
        http_response_code($code);
        return ['status' => $status, 'code' => $code, 'msg' => $msg, 'data' => $data];
    }

	public function artikel_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_tambah');
		$this->load->view('dashboard/v_footer');
	}

	

	private function GetDataResult($select, string $table, $where = [])
    {
        $this->load->database();
        $sql = $this->db->select($select)->from($table)->where($where)->get();
        if ($sql->num_rows() > 0) {
            json($this->response(true, 200, "Successfully get data $table", $sql->result()));
        }else{
            json($this->response(false, 404, "data $table is null", null));
        }
    }

    public function kategoriDropdown()
    {
    	// $this->GetDataResult('id, kategori_name','kategori');
    	$this->load->database();
    	$query = $this->db->query("SELECT id, kategori_name FROM kategori WHERE is_deleted IS NULL");
    	if ($query->num_rows() > 0) {
            json($this->response(true, 200, "Successfully get data ", $query->result()));
        }else{
            json($this->response(false, 404, "data is null", null));
        }
    }

    public function tableArtikel()
    {
    	$this->load->model('m_data');
    	$this->m_data->tableArtikel();
    }

    public function idArtikel()
    {
    	$id = $this->input->post('id');
    	// json($id);
    	$this->load->database();
    	$query = $this->db->query("SELECT id, artikel_judul,artikel_konten FROM artikel WHERE is_deleted IS NULL AND id =?",[$id]);
    	if($query->num_rows() > 0) {
    		json($this->response(True, 200, 'success', $query->row()));
    	} else {
    		json($this->response(False, 400, 'failed'));
    	}
    }

    public function updateArtikel()
    {
    	$id = $this->input->post('id');
    	$judul = $this->input->post('judul');
    	$konten = $this->input->post('isi');
    	$kategori = $this->input->post('kategori');
    	$status         = $this->input->post('status');
    	
    	$_image = $this->db->get_where('artikel',['id'=> $id])->row();
    	  $config = [
            'upload_path'   => './assets/img/',
            'allowed_types' => "gif|jpg|jpeg|png",
            'encrypt_name'  => false,
            'remove_spaces' => true,
            'detect_mime'     => true,
            'mod_mime_fix'  => true,
            'file_ext_tolower' => true,
            'max_filename_increment' => 1000
        ];

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('sampul')) {
                echo 'gagal update';
        }else {
        	// $this->load->do_upload('sampul');
        	$result = $this->upload->data();
        	$file = $result['file_name'];
        	$size = $result['file_size'];
        	$xt = $result['file_ext'];


        	$data = [
        		'artikel_sampul' 	=> $file,
        		'artikel_tanggal'	=> date('Y-m-d H-m-s'),
        		'artikel_judul'		=> $judul,
        		'artikel_slug'		=> strtolower(url_title($judul)),
        		'artikel_status'	=> $status,
        		'artikel_konten'	=> $konten,
        		'artikel_author'	=> session('id'),
        		'artikel_kategori'	=> $kategori,
        		'artikel_status'	=> $status,
        		'updated_at'		=> date('Y-m-d H-m-s'),
        		'updated_by'		=> session('name'),
        	];

        	$this->load->database();
        	$update = $this->db->where('id', $id)->update('artikel', $data);
        	if($update) {
        		 unlink("assets/img/".$_image->artikel_sampul);
        		 json($this->response(True, 200, 'success'));
        	} else {
        		json($this->response(False, 500, 'Internal server error'));
        	}
        }


    }

    public function deleteArtikel()
    {
    	$id = $this->input->post('id');
    	$image = $this->db->get_where('artikel', ['id'=>$id])->row();
    	$query = $this->db->query("SELECT artikel_sampul FROM artikel WHERE is_deleted IS NULL AND id=?", [$id]);
    	$data = $query->row();
    	$sampul = $data->artikel_sampul;
    	
    	$tampung = [
    		'is_deleted'		=> 1,
    		'deleted_at'		=> date('Y-m-d H-m-s'),
    		'deleted_by'		=> session('name')
    	];

    	$hapus = $this->db->where('id', $id)->update('artikel', $tampung);
    	if($hapus) {
    		json($this->response(True, 200, "success"));
    	} else {
    		json($this->response(False, 500, "gagal delete"));
    	}
    }

    
}


?>