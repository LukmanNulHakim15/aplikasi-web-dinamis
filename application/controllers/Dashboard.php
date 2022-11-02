<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //cek session yang login
        //jika session status tidak sama dengan session telah_login berarti pengguna belum login
        //makan halaman akan dialihkan kembali ke halaman login
            if($this->session->userdata('is_admin')!="telah_login"){
                    redirect(base_url('Login'));
            }
    }

    public function index()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_index');
        $this->load->view('dashboard/v_footer');
    }

    public function response($status, $code, $msg = "Message is null.", $data = [])
    {
        http_response_code($code);
        return ['status' => $status, 'code' => $code, 'msg' => $msg, 'data' => $data];
    }

    #function logout start
    public function logout()
    {
        $this->session->sess_destroy();
        //berguna untuk menghapus semua session yang telah dibuat pada saat pengguna login.
       redirect(base_url('Login'));

       //Login itu controller
        //fungsi ini untuk meredirect kembali ke halaman login 
    }
    #function logout finish

    #function ganti password start
    public function ganti_password()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_ganti_password');
        $this->load->view('dashboard/v_footer');
    }

    // public function ganti_password_aksi()
    // {
    //     //Falidasi form pergantian password
    //     $this->form_validation->set_rules('password_lama','Password Lama','required');
    //     $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[8]');
    //     $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password Baru','required|matches[password_baru]');

    //     #cek validasi
    //     if($this->form_validation->run()  != false) {

    //          #Menangkap data dari form
    //         $password_lama = $this->input->post('password_lama');
    //         $password_baru = $this->input->post('password_baru');
    //         $konfirmaasi_password = $this->input->post('konfirmasi_password');

    //         #Cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
    //             $where = array(
    //                 'id'                    => $this->session->userdata('id');
    //                 'pengguna_password'     => md5($password_lama);
    //             );

    //         }
            
    // }

    public function konfirmasiPassword()
    {
        $passLama = $this->input->post('password_lama');
        $passBaru = password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT);
        $konfirPass = $this->input->post('konfirmasi_password');
        $username = session('username');
       
        // json($konfirPass);
        $this->load->database();
        $query = $this->db->query("SELECT id, password FROM registrasi WHERE username = ?",[$username]);
        if($query->num_rows() > 0) {
            $data = $query->row();
           
            $verify = password_verify($passLama, $data->password);
            if($verify) {
                $tampung = [
                    'password' => $passBaru
                ];

                $update = $this->db->where('username', $username)->update('registrasi', $tampung);
                if($update) {
                    json($this->response(True, 200, "success update password"));
                } else {
                    json($this->response(False, 400, "Gagal update"));
                }
            } else {
                json($this->response(False, 500, "password lama anda tidak cocok"));
            }
           
        } 

    }

    public function kategori()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori');
        $this->load->view('dashboard/v_footer');
    }
    
    #function ganti password finish

    public function kategoriTable()
    {
        $this->load->model('m_data');
        $this->m_data->tableKategori();

    }

    public function saveKategori()
    {
        $kategori = $this->input->post('name');
        // json($kategori);
        // $pattern = "/[a-zA-Z0-9_]+/";
        // $cocok = preg_match_all($pattern, $kategori);
        // if(!$cocok) {
        //     json($this->response(True, 402, "Tidak sesuai pettern"));
        // }
        $kategori_slug = strtolower(url_title($this->input->post('name')));
        $created_by = session('name');

        $data = [
            'kategori_name' => $kategori,
            'kategori_slug' => $kategori_slug,
            'created_by'    => $created_by
        ];

        $this->load->database();
        $save = $this->db->insert('kategori', $data);
        if($save) {
            json($this->response(True, 200, "Success menyimpan data"));
        } else {
            json($this->response(False, 401, "Gagal simpan data"));
        }
    }

    public function kategoriId()
    {
        $id = $this->input->post('id');
        if(!$id) {
            http_response_code(400);
            return false;
        }
        $this->load->database();
        $query = $this->db->query("SELECT * FROM kategori WHERE is_deleted IS NULL AND id = ?",[$id]);
        if($query->num_rows() > 0) {
            json($this->response(True, 200, "Success", $query->row()));
        } else {
            json($this->response(False, 500, "Internal server error"));
        }
    }

    public function updateKategori()
    {
        $id = $this->input->post('id');
        $kategori_name = $this->input->post('name');
        $updated_at = date('Y-m-d H-m-s');
        $updated_by = session('name');

        $data = [
            'updated_at' => $updated_at,
            'updated_by' => $updated_by,
            'kategori_name' => $kategori_name
        ];

        $update = $this->db->where('id', $id)->update('kategori',$data);
        if($update) {
            json($this->response(True, 200, "success updated"));
        } else {
            json($this->response(False, 500, "gagal update"));
        }
    }

    public function deleteTableKategori()
    {
        $id = $this->input->post('id');
        $this->load->database();
        $query = $this->db->query("SELECT id FROM kategori WHERE is_deleted IS NULL AND id = ?",[$id]);
        if($query->num_rows() > 0) {
            $data = [
                'is_deleted' => 1,
                'deleted_at' => date('Y-m-d'),
                'deleted_by' => session('name'),
            ];

            $delete = $this->db->where('id', $id)->update('kategori', $data);
            if($delete) {
                json($this->response(True, 200, "hapus success"));
            } else {
                json($this->response(False, 500, "Gagal simpan"));
            }
        }
    }

    public function saveArtikel()
    {
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
        
        if ($this->upload->do_upload('sampul')) {

            $results = $this->upload->data();

            $file = $results['file_name'];
            $size = $results['file_size'];
            $ext  = $results['file_ext'];

            $judul          = $this->input->post('judul');
            $konten = $this->input->post('isi');
           
            $kategori       = $this->input->post('kategori');
            $status         = $this->input->post('status');
         

            $fiel = [
                'artikel_sampul' => $file,
                'artikel_tanggal'  => date('Y-m-d H-m-s'),
                'artikel_judul' => $judul,
                'artikel_slug' => strtolower(url_title($judul)),
                'artikel_status' => $status,
                'artikel_konten'   => $konten,
                'artikel_author' => session('id'),
                'artikel_kategori' => $kategori,
                'artikel_status'    => $status,
                'created_by'        => session('name')
            ];

            $save = $this->db->insert('artikel', $fiel);
            if (!$save) {
                json($this->response(false, 500, 'failed'));
            } else {
                json($this->response(true, 200, 'success'));

            }

        }else {
            $error = $this->upload->display_errors();

            if ($error === "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                $msg = 'File terlalu besar';
                $response = ['status' => false, 'code' => 500, 'msg' => $msg, 'id' => $id];
            } elseif ($error === "<p>The filetype you are attempting to upload is not allowed.</p>") {
                $msg = 'Jenis file tidak mendukung';
                $response = ['status' => false, 'code' => 500, 'msg' => $msg, 'id' => $id];
            } else {
                print_r($error); die();
            }
            json($response);
        }
    }

    public function profil()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_update_profile');
        $this->load->view('dashboard/v_footer');
    }

    public function updateProfile()
    {
        $id = session('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        $data = [
            'name'      => $name,
            'email'     => $email
        ];

        $update = $this->db->where('id', $id)->update('registrasi', $data);
        if($update) {
            json($this->response(True, 200, 'success'));
        } else {
            json($this->response(False, 400, 'Gagal update'));
        }
    }

    public function pengaturan()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengaturan');
        $this->load->view('dashboard/v_footer');
    }

    public function savePengaturan()
    {
        $name_web = $this->input->post('name');
        $deskripsi_web = $this->input->post('deskripsi');
        $session = $this->session->userdata('id');
        $linkFb = $this->input->post('linkfb');
        $linkTwt = $this->input->post('linktwt');
        $linkIg = $this->input->post('linkig');
        $linkGh = $this->input->post('linkgit');
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

        if($this->upload->do_upload('logo')) {

            $results = $this->upload->data();

            $file = $results['file_name'];
            $size = $results['file_size'];
            $ext  = $results['file_ext'];


            $data = [
                'nama_webiste'  => $name_web,
                'deskripsi'     => $deskripsi_web,
                'logo'          => $file,
                'link_facebook' => $linkFb,
                'link_twitter'  => $linkTwt,
                'link_instagram'=> $linkIg,
                'link_github'   => $linkGh,
                'updated_at'    => date('Y-m-d H-m-s'),
                'updated_by'    => session('name')

            ];

            $this->load->database();
            $update = $this->db->where('id_registrasi',$session)->update('pengaturan', $data);
            if($update) {
                json($this->response(True, 200, 'success'));
            } else {
                json($this->response(False, 400, 'gagal update'));
            }

        }
    }

    public function getDataPengaturan()
    {
        $id = $this->session->userdata('id');
        
        $this->load->database();
        $query = $this->db->query("SELECT   p.id,p.nama_webiste as name,
                                            p.link_facebook,
                                            p.link_twitter,
                                            p.link_instagram,
                                            p.link_github,
                                            p.deskripsi

                                        FROM pengaturan p

                                        INNER JOIN registrasi r  ON p.id_registrasi = r.id 

                                        WHERE 
                                        p.is_deleted IS NULL AND
                                        r.id = ?",[$id]);
       if($query->num_rows() > 0){
        json($this->response(True, 200, "success", $query->row()));
       } else {
        json($this->response(False, 500, "Internal server error"));
       }
    }

    public function pengguna()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna');
        $this->load->view('dashboard/v_footer');
    }

}
