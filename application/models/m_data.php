<?php

class M_data extends CI_Model
{

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function tableKategori()
    {
        $this->load->database();
        $query = $this->db->query("SELECT id, kategori_name as name, kategori_slug as slug FROM kategori where is_deleted IS NULL ORDER BY created_at DESC");
        if($query->num_rows() > 0) {
            $no = 0;
            $result = ['data'=>[]];
            foreach($query->result() as $row => $value) {
                $no++;
                $id = $value->id;
                $result['data'][$row] = [
                    $no,
                    $value->name,
                    $value->slug,
                    '<button id="delete" style= "border-radius: 15px;" class="btn btn-flat btn-danger" data-id="'.$id.'">Hapus</button> <button id="edit" style= "border-radius: 15px;" class="btn btn-flat btn-warning" data-id="'.$id.'">Edit</button>'
                ];
            }

            json($result);
        }

        json(null);
        
    }

    public function view(){
        return $this->db->get('kategori')->result();
    }

    public function tableArtikel()
    {
        $this->load->database();
        $query = $this->db->query("SELECT   a.id, 
                                            a.artikel_slug,
                                            a.artikel_tanggal as tanggal,
                                            a.created_by,
                                            k.kategori_name as name,
                                            a.artikel_sampul as sampul,
                                            a.artikel_status as status

                                            FROM artikel a  
                                            INNER JOIN kategori k ON a.artikel_kategori = k.id

                                            WHERE  
                                            a.is_deleted IS NULL AND  
                                            k.is_deleted IS NULL");
       if($query->num_rows() > 0) {
        $no = 0;
        $result = ['data'=>[]];
        foreach($query->result() as $row => $value) {
            $no++;
            $gambar = "<img loading='lazy' class='img-fluid' width='100' height='100' draggable='false' src=assets/img/".$value->sampul.">";
            $result['data'][$row] = [
                $no,
                $value->tanggal,
                "http://localhost/website_ci/".$value->artikel_slug,
                $value->created_by,
                $value->name,
                $gambar,
                $value->status,
                '<button id="update" style="border-radius: 20px;" data-id="'.$value->id.'" class="btn btn-primary"> Update </button>'.'<button id="delete" style="border-radius: 20px;" data-id="'.$value->id.'" class="btn btn-danger"> Delete </button>'.'<button id="detail" style="border-radius: 20px;" data-id="'.$value->id.'" class="btn btn-flat btn-warning"> Detail </button>'
            ];
        }
        json($result);
       }
       json(null);
    }


    public function tablePages()
    {
        $this->load->database();
        $query = $this->db->query("SELECT id, halaman_judul,halaman_slug FROM halaman WHERE is_deleted IS NULL");
        if($query->num_rows() > 0) {
            $no = 0;
            $result = ['data'=>[]];
            foreach($query->result() as $row => $value) {
                $no++;
                $result['data'][$row] = [
                    $no,
                    $value->halaman_judul,
                    "http://localhost/website_ci/page/".$value->halaman_slug,
                    '<button id="update" style="border-radius: 20px;" data-id="'.$value->id.'" class="btn btn-primary"> Update </button>'.'<button id="delete" style="border-radius: 20px;" data-id="'.$value->id.'" class="btn btn-danger"> Delete </button>'.'<button id="detail" style="border-radius: 20px;" data-id="'.$value->id.'" class="btn btn-flat btn-warning"> Detail </button>'
                ];
            }

            json($result);
        }

        json(null);
    }
}
