<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('userid')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Please Login!</div>');
            redirect('auth');
        }
        $this->load->model("Crud", "crud");
    }

    public function index()
    {
        $data['menu'] = 'hr';

        $this->load->view('karyawan', $data);
    }

    public function karyawan()
    {
        $data['menu'] = 'hr';
        $data['karyawan'] = $this->crud->get_where('user', ['id' => $this->uri->segment("3")])->row_array();

        $this->load->view('karyawan_detil', $data);
    }

    public function absensi()
    {
        $data['menu'] = 'hr';
        $data['tanggal'] = $this->konversi->hariIndo(date('l, d-F-Y'));

        $this->load->view('absensi', $data);
    }

    public function ajax_table_karyawan()
    {
        $where = array(
            'jabatan !=' => 'DIREKSI'
        );

        $table = 'user'; //nama tabel dari database
        $column_order = array('id', 'name', 'nik', 'jabatan', 'userid', 'alamat', 'photo', 'phone'); //field yang ada di table user
        $column_search = array('id', 'name', 'nik', 'jabatan', 'userid', 'alamat', 'photo', 'phone'); //field yang diizin untuk pencarian 
        $select = 'id, name, nik, jabatan, alamat, userid, photo, phone';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['name'] = $key->name;
            $row['data']['nik'] = $key->nik;
            $row['data']['jabatan'] = $key->jabatan;
            $row['data']['userid'] = $key->userid;
            $row['data']['alamat'] = $key->alamat;
            $row['data']['photo'] = $key->photo;
            $row['data']['phone'] = $key->phone;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function update_setting_gambar()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/image/karyawan/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 5024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['photo'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!', 'photo' => $data_upload['file_name']];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function delete_data()
    {
        $table = $this->input->post('table');
        if ($this->crud->delete($table, ['id' => $this->input->post('id')])) {
            $response = ['status' => 'success', 'message' => 'Success Delete Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Delete Data!'];

        echo json_encode($response);
    }

    public function update_data_karyawan()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $data = $this->input->post();

        $where = array(
            'id' => $id
        );

        unset($data['table']);
        unset($data['id']);


        $update = $this->crud->update($table, $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function insert_data_karyawan()
    {
        $table = $this->input->post("table");

        $config['upload_path']          = "assets/image/karyawan/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 5024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['photo'] = $data_upload['file_name'];
        }

        $data['role_id'] = '5';
        $data['is_active'] = '1';
        $data['password'] = password_hash('12345', PASSWORD_DEFAULT);

        $insert = $this->crud->insert($table, $data);

        if ($insert > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }
}
