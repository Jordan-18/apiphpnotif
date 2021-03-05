<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class notif extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data pesan
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('notif')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('notif')->result();
        }
        $this->response($kontak, 200);
    }


    //Mengirim atau menambah data pesan baru
    function index_post()
    {
        $data = array(
            'id'   => $this->post('id'),
            'nim'   => $this->post('nim'),
            'penerima'   => $this->post('penerima'),
            'pesan'   => $this->post('pesan'),
            'waktu'   => $this->post(''),
            'sudah_terbaca'   => $this->post('sudah_terbaca')
        );
        $insert = $this->db->insert('notif', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data pesan yang telah ada
    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'id'                => $this->put('id'),
            'already_read'       => 1
        );
        $this->db->where('id', $id);
        $update = $this->db->update('notif', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data pesan
    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('notif');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
};
