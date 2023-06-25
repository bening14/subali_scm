<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Xyz extends CI_Controller
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

        $this->load->view('dashboard');
    }

    public function ajax_table_chat()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $where = array(
            'substr(date_created,1,10)' => $today
        );

        $table = 'tbl_reminder'; //nama tabel dari database
        $column_order = array('id', 'waktu', 'actual_clock', 'status_reminder'); //field yang ada di table user
        $column_search = array('id', 'waktu', 'actual_clock', 'status_reminder'); //field yang diizin untuk pencarian 
        $select = 'id, waktu, actual_clock, status_reminder';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['waktu'] = $key->waktu;
            $row['data']['actual_clock'] = $key->actual_clock;
            $row['data']['status_reminder'] = $key->status_reminder;

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
}
