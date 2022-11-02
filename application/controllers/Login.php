<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{   

    public function index()
    {
        $this->load->view('login/index.php');
    }

    public function response($status, $code, $msg = "Message is null.", $data = [])
    {
        http_response_code($code);
        return ['status' => $status, 'code' => $code, 'msg' => $msg, 'data' => $data];
    }

    public function aksi()
    {
        //Validasi form harus diisi start
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() != false){
            // menangkap data username dan password dari halaman login
            $username = $this->input->post('username');
            $password = $this->input->post('password');

                $where = array(
                    'pengguna_username' => $username,
                    'pengguna_password' => md5($password),
                    'pengguna_status'   => 1
                );
            $this->load->model('m_data');
            // cek kesesuaian login pada table pengguna
            $cek = $this->m_data->cek_login('pengguna',$where)->num_rows();
            // json($cek);
         // cek jika login benar
            if($cek > 0) {
        // ambil data pengguna yang melakukan login
                $data = $this->m_data->cek_login('pengguna',$where)->row();
        // buat session untuk pengguna yang berhasil login
                $data_session = array(
                    'id'            => $data->id,
                    'username'      => $data->pengguna_username,
                    'level'         => $data->pengguna_level,
                    'status'        => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                // alihkan halaman ke halaman dashboard pengguna
                 redirect(base_url().'dashboard');
                }else{
                    redirect(base_url().'login?alert=gagal');
                  }
            }else{
                 $this->load->view('v_login');
             }
        }

        public function login()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->database();
            $query = $this->db->query("SELECT id, password, name, username, email FROM registrasi WHERE username = ? LIMIT 1",[$username]);
            // json($query->row());

            if($query->num_rows() > 0) {
                $data = $query->row();
                // $password = $data->password;

                $verify = password_verify($password, $data->password);
                // json($verify);

                if($verify) {
                    $session = [
                        'id'        => $data->id,
                        'name'      => $data->name,
                        'username'  => $data->username,
                        'email'     => $data->email,
                        'is_admin'  => True
                    ];

                    $this->session->set_userdata($session);
                      // redirect(base_url().'dashboard');
                    json($this->response(True, 200, "Success"));
                } else {
                    json($this->response(False, 500, "Password or Username In Correct"));
                }
            }else {
                json($this->response(False, 400, 'Anda Belum Login'));
            }
        }

        public function v_registrasi()
        {
            $this->load->view('registrasi/index.php');
        }

        public function registrasi()
        {
            $name = $this->input->post('nama');
            $email = $this->input->post('email');
            $telpon = $this->input->post('telpon');
            $username = $this->input->post('username');
            $level = $this->input->post('level');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $data = [
                'name'      => $name,
                'email'     => $email,
                'telpon'    => $telpon,
                'username'  => $username,
                'password'  => $password,
                'level'     => $level

            ];

            $this->load->database();
            $save = $this->db->insert('registrasi', $data);
            if ($save) {
                json($this->response(True, 200, "Success"));
            } else {
                json($this->response(False, 500, "Internal Server Error"));
            }
        }
    
}
