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












    public function cek_reminder()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $kategori = $this->input->post('kategori');

        $where = array(
            'substr(date_created,1,10)' => $today,
            'klasifikasi' => $kategori,
            'actual_clock' => '0000-00-00 00:00:00'
        );

        $this->crud->get_where('tbl_reminder', $where);

        if ($this->db->affected_rows() == true) {
            $response = 200;
        } else {
            $response = 400;
        }

        echo json_encode($response);
    }

    public function punch()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H:i');
        $today = date('Y-m-d');
        $datetime = date('Y-m-d H:i:s');

        if (strtotime($time) >= date(strtotime('8:00')) and strtotime($time) < date(strtotime('8:59'))) {
            $kategori = 'A';
        } elseif (strtotime($time) >= date(strtotime('9:00')) and strtotime($time) < date(strtotime('9:59'))) {
            $kategori = 'B';
        } elseif (strtotime($time) >= date(strtotime('10:00')) and strtotime($time) < date(strtotime('10:59'))) {
            $kategori = 'C';
        } elseif (strtotime($time) >= date(strtotime('11:00')) and strtotime($time) < date(strtotime('11:59'))) {
            $kategori = 'D';
        } elseif (strtotime($time) >= date(strtotime('12:00')) and strtotime($time) < date(strtotime('12:59'))) {
            $kategori = 'E';
        } elseif (strtotime($time) >= date(strtotime('13:00')) and strtotime($time) < date(strtotime('13:59'))) {
            $kategori = 'F';
        } elseif (strtotime($time) >= date(strtotime('14:00')) and strtotime($time) < date(strtotime('14:59'))) {
            $kategori = 'G';
        } elseif (strtotime($time) >= date(strtotime('15:00')) and strtotime($time) <= date(strtotime('16:00'))) {
            $kategori = 'H';
        }

        $update = $this->crud->update('tbl_reminder', ['status_reminder' => 'CLOSED', 'actual_clock' => $datetime, 'user_punch' => $this->session->userdata("userid")], ['klasifikasi' => $kategori, 'substr(date_created,1,10)' => $today]);
        if ($update > 0) {
            $result = 200;
        } else {
            $result = 400;
        }
        echo json_encode($result);
    }

    public function customer()
    {
        $data['menu'] = 'customer';
        $this->load->view('customer', $data);
    }

    public function ajax_table_customer()
    {
        $table = 'mst_klien';
        $column_order = array('id', 'nama_klien', 'kategori', 'alamat', 'contact', 'hp_contact', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_klien', 'kategori', 'alamat', 'contact', 'hp_contact', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_klien, kategori, alamat, contact, hp_contact, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama_klien'] = $key->nama_klien;
            $row['data']['kategori'] = $key->kategori;
            $row['data']['alamat'] = $key->alamat;
            $row['data']['contact'] = $key->contact;
            $row['data']['hp_contact'] = $key->hp_contact;
            $row['data']['date_created'] = date('d-M-Y', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }





    public function getcustomer()
    {
        $id = $this->input->post('id');

        $where = array(
            'id' => $id
        );
        $result = $this->crud->get_where('mst_klien', $where)->row_array();

        echo json_encode($result);
    }

    public function getproject()
    {
        $id = $this->input->post('id');

        $where = array(
            'id_klien' => $id
        );
        $result = $this->crud->get_where('tbl_project', $where)->result_array();

        echo json_encode($result);
    }

    public function update_data_customer()
    {
        $table = $this->input->post("table");
        $data = $this->input->post();

        $where = array(
            'id' => $data['id']
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
}
