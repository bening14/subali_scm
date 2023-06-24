<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller
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

        $d = $this->crud->get_all('setting_apps')->row_array();

        $data['title'] = $d['nama_usaha'] . ' | Dashboard';
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];

        $this->load->view('dashboard', $data);
    }

    public function user()
    {
        // if ($this->session->userdata('role_id') != '1') {;
        //     redirect('dashboard/pekerjaan');
        // }

        $d = $this->crud->get_all('setting_apps')->row_array();
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];

        $data['title'] = $d['nama_usaha'] . ' | User Manajemen';
        $data['favicon'] = $d['favicon'];

        $this->load->view('user', $data);
    }

    public function ajax_table_karyawan()
    {
        $table = 'user'; //nama tabel dari database
        $column_order = array('id', 'name', 'userid', 'is_active', 'role_id', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'name', 'userid', 'is_active', 'role_id', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, name, userid, is_active, role_id, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['name'] = $key->name;
            $row['data']['userid'] = $key->userid;
            $row['data']['is_active'] = $key->is_active;
            if ($key->role_id == 1) {
                $row['data']['role_id'] = 'Owner';
            } else {
                $row['data']['role_id'] = 'Petugas';
            }
            $row['data']['date_created'] = $key->date_created;

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

    public function insert_data_user()
    {

        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['is_active'] = '1';

        //cek dulu apakah userID sudah ada ?
        $userid = $data['userid'];
        $where = array(
            'userid' => $userid
        );
        $a = $this->crud->get_where('user', $where)->num_rows();

        if ($a > 0) {
            $response = ['status' => 'error', 'message' => 'UserID sudah terpakai!'];
            echo json_encode($response);
            die;
        }


        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

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

    public function close_order()
    {


        $table = $this->input->post('table');

        if ($this->crud->update($table, ['status_pekerjaan' => 'closed'], ['id' => $this->input->post('id')])) {
            $response = ['status' => 'success', 'message' => 'Success Update Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Update Data!'];


        echo json_encode($response);
    }

    public function customer()
    {
        $d = $this->crud->get_all('setting_apps')->row_array();
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];

        $data['title'] = $d['nama_usaha'] . ' | Customer';
        $data['favicon'] = $d['favicon'];

        $this->load->view('customer', $data);
    }

    public function ajax_table_customer()
    {
        $table = 'customer'; //nama tabel dari database
        $column_order = array('id', 'nama', 'alamat', 'handphone', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama', 'alamat', 'handphone', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama, alamat, handphone, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama'] = $key->nama;
            $row['data']['alamat'] = $key->alamat;
            $row['data']['handphone'] = $key->handphone;
            $row['data']['date_created'] = $key->date_created;

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

    public function insert_data_customer()
    {

        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function harga()
    {
        if ($this->session->userdata('role_id') != '1') {;
            redirect('dashboard/pekerjaan');
        }

        $d = $this->crud->get_all('setting_apps')->row_array();
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];

        $data['title'] = $d['nama_usaha'] . ' | Harga Pekerjaan';
        $data['favicon'] = $d['favicon'];

        $this->load->view('harga', $data);
    }

    public function ajax_table_harga()
    {
        $table = 'harga'; //nama tabel dari database
        $column_order = array('id', 'pekerjaan', 'harga', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'pekerjaan', 'harga', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, pekerjaan, harga, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['pekerjaan'] = $key->pekerjaan;
            $row['data']['harga'] = "Rp " . number_format($key->harga, 2, ',', '.');
            $row['data']['date_created'] = $key->date_created;

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

    public function insert_data_harga()
    {

        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function pekerjaan()
    {
        $data['customer'] = $this->crud->get_all('customer')->result_array();
        $data['pekerjaan'] = $this->crud->get_all('harga')->result();

        $d = $this->crud->get_all('setting_apps')->row_array();
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];

        $data['title'] = $d['nama_usaha'] . ' | Transaksi';
        $data['favicon'] = $d['favicon'];

        $this->load->view('pekerjaan', $data);
    }

    public function ajax_table_pekerjaan()
    {
        $table = 'pekerjaan'; //nama tabel dari database
        $column_order = array('id', 'customer', 'alamat', 'handphone', 'pekerjaan', 'nomor_kendaraan', 'harga', 'tgl_masuk', 'status_pekerjaan', 'status_bayar', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'customer', 'alamat', 'handphone', 'pekerjaan', 'nomor_kendaraan', 'harga', 'tgl_masuk', 'status_pekerjaan', 'status_bayar', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, customer, alamat, handphone, pekerjaan, nomor_kendaraan, harga, tgl_masuk, status_pekerjaan, status_bayar,  date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['customer'] = $key->customer;
            $row['data']['alamat'] = $key->alamat;
            $row['data']['handphone'] = $key->handphone;
            $row['data']['pekerjaan'] = $key->pekerjaan;
            $row['data']['nomor_kendaraan'] = $key->nomor_kendaraan;
            $row['data']['harga'] = "Rp " . number_format($key->harga, 2, ',', '.');
            $row['data']['tgl_masuk'] = date('d-M-Y', strtotime($key->tgl_masuk));
            $row['data']['status_pekerjaan'] = $key->status_pekerjaan;
            $row['data']['status_bayar'] = $key->status_bayar;
            $row['data']['date_created'] = $key->date_created;

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

    public function insert_data_pekerjaan()
    {

        $table = $this->input->post("table");
        $data = $this->input->post();

        $a = $this->input->post("customer");
        $b = $this->input->post("pekerjaan");
        unset($data['table']);
        unset($data['customer']);
        unset($data['pekerjaan']);

        $customer = explode('-', $a);
        $pekerjaan = explode('-', $b);

        $data['customer'] = $customer[1];
        $data['pekerjaan'] = $pekerjaan[1];



        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function insert_data_kwitansi()
    {

        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $data = $this->input->post();


        unset($data['table']);
        unset($data['id']);



        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            //update tbl_pekerjaan, ubah status bayar menjadi closed
            $this->crud->update('pekerjaan', ['status_bayar' => 'CLOSED'], ['id' => $id]);
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function print_qr()
    {
        $id = $this->input->get('id');
        $uniqid = uniqid();
        $this->load->library('ciqrcode');

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/default/assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/default/assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/default/assets/images/qr/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $uniqid . '.png'; //buat name dari qr code acak

        $a = $this->crud->get_where('pekerjaan', ['id' => $id])->row_array();

        $params['data'] = $a['id']; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 3;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data['qr_image'] = $image_name;
        $data['nomor'] = $a['id'];
        $data['pekerjaan'] = $a['pekerjaan'];
        $data['nomor_kendaraan'] = $a['nomor_kendaraan'];

        //get info aplikasi dari tbl setting_apps
        $b = $this->crud->get_all('setting_apps')->row_array();

        $data['nama_usaha'] = $b['nama_usaha'];
        $data['logo'] = $b['favicon'];
        $data['alamat'] = $b['alamat'];
        $data['hp_usaha'] = $b['handphone'];
        $data['slogan'] = $b['slogan'];
        $data['title'] = $b['nama_usaha'] . ' | QR Tags';

        $this->load->view('print_qr', $data);
    }

    public function print_kwitansi()
    {
        $id = $this->input->get('id');


        $a = $this->crud->get_where('kwitansi', ['id_pekerjaan' => $id])->row_array();

        $data['nomor'] = $a['id'];
        $data['customer'] = $a['customer'];
        $data['alamat'] = $a['alamat'];
        $data['handphone'] = $a['handphone'];
        $data['amount'] = $a['amount'];
        $data['tgl_masuk'] = $a['tgl_masuk'];
        $data['tgl_keluar_actual'] = $a['tgl_keluar_actual'];
        $data['bayar'] = $a['bayar'];
        $data['kembali'] = $a['kembali'];
        $data['pekerjaan'] = $a['pekerjaan'];
        $data['jumlah'] = $a['jumlah'];
        $data['harga'] = $a['harga'];

        //get info aplikasi dari tbl setting_apps
        $b = $this->crud->get_all('setting_apps')->row_array();

        $data['nama_usaha'] = $b['nama_usaha'];
        $data['logo'] = $b['favicon'];
        $data['alamat'] = $b['alamat'];
        $data['hp_usaha'] = $b['handphone'];
        $data['slogan'] = $b['slogan'];
        $data['title'] = $b['nama_usaha'] . ' | Kwitansi';

        $this->load->view('print_kwitansi', $data);
    }

    public function getcustomer()
    {
        $id = $this->input->post('id'); //2-Arthur Julio Risa
        $a = explode("-", $id);

        $where = array(
            'id' => $a[0]
        );
        $result = $this->crud->get_where('customer', $where)->row_array();

        echo json_encode($result);
    }

    public function getstrukcustomer()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');

        $where = array(
            'id' => $id
        );
        $result = $this->crud->get_where($table, $where)->row_array();

        echo json_encode($result);
    }

    public function getharga()
    {
        $id = $this->input->post('id');
        $a = explode("-", $id);

        $where = array(
            'id' => $a[0]
        );
        $result = $this->crud->get_where('harga', $where)->row_array();

        echo json_encode($result);
    }

    public function aplikasi()
    {
        if ($this->session->userdata('role_id') != '1') {;
            redirect('dashboard/pekerjaan');
        }

        $d = $this->crud->get_all('setting_apps')->row_array();

        $data['title'] = $d['nama_usaha'] . ' | Setting Aplikasi';
        $data['nama_usaha'] = $d['nama_usaha'];
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];
        $data['slogan'] = $d['slogan'];
        $data['gambar_depan'] = $d['gambar_depan'];
        $data['gambar_latar'] = $d['gambar_latar'];
        $data['alamat'] = $d['alamat'];
        $data['handphone'] = $d['handphone'];

        $this->load->view('aplikasi', $data);
    }

    public function update_setting_gambar()
    {
        $table = $this->input->post("table");

        $config['upload_path']          = "assets/default/assets/images/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 1024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            if ($data['jenis'] == 'logo_dark') {
                $data['logo_dark'] = $data_upload['file_name'];
            } else if ($data['jenis'] == 'latar') {
                $data['gambar_latar'] = $data_upload['file_name'];
            } else if ($data['jenis'] == 'logo_light') {
                $data['logo_light'] = $data_upload['file_name'];
            } else if ($data['jenis'] == 'favicon') {
                $data['favicon'] = $data_upload['file_name'];
            } else {
                $data['gambar_depan'] = $data_upload['file_name'];
            }
            unset($data['jenis']);
        }

        $update = $this->crud->update($table, $data, ['id' => '1']);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!', 'gambar' => $data_upload['file_name']];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function insert_setting_detil()
    {

        $table = $this->input->post("table");
        $data = $this->input->post();

        unset($data['table']);


        $update_data = $this->crud->update($table, $data, ['id' => '1']);


        if ($update_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Data!'];

        echo json_encode($response);
    }

    public function laporan()
    {
        if ($this->session->userdata('role_id') != '1') {;
            redirect('dashboard/pekerjaan');
        }

        $d = $this->crud->get_all('setting_apps')->row_array();
        $data['logo_dark'] = $d['logo_dark'];
        $data['logo_light'] = $d['logo_light'];
        $data['favicon'] = $d['favicon'];

        $data['title'] = $d['nama_usaha'] . ' | Laporan Transaksi';
        $data['favicon'] = $d['favicon'];

        $this->load->view('laporan', $data);
    }

    public function generatedata()
    {
        $numrow = 10;
        $no = 1;
        $awal = $_GET['tanggal_awal'];
        $akhir = $_GET['tanggal_akhir'];

        $where = array(
            'tgl_masuk >=' => $awal,
            'tgl_masuk <=' => $akhir
        );


        $data = $this->crud->get_where_between('pekerjaan', 'tgl_masuk', $awal, $akhir)->result();
        // echo $this->db->last_query();
        // die;
        $d = $this->crud->get_all('setting_apps')->row_array();

        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(30);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(20);
        $excel->getColumnDimension('F')->setWidth(20);
        $excel->getColumnDimension('G')->setWidth(10);
        $excel->getColumnDimension('H')->setWidth(20);

        $excel->getRowDimension('9')->setRowHeight(15);

        $excel->getStyle('A1')->getFont()->setBold(true);
        $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A9:H9')->getFont()->setBold(true);

        $excel->getStyle('A2:A3')->getFont()->setSize(9);
        $excel->getStyle('A9:H9')->getFont()->setSize(10);
        $excel->getStyle('A7')->getFont()->setSize(9);
        $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A9:H9')->applyFromArray($styleArray);

        $excel->setCellValue('A1', strtoupper($d['nama_usaha']));
        $excel->setCellValue('A2', strtoupper($d['alamat']));
        $excel->setCellValue('A3', "HP " . $d['handphone']);
        $excel->setCellValue('A5', "LAPORAN TRANSAKSI PEKERJAAN");
        $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($awal)) . " sd " . date('d-M-Y', strtotime($akhir)));
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "CUSTOMER");
        $excel->setCellValue('C9', "ALAMAT");
        $excel->setCellValue('D9', "HANDPHONE");
        $excel->setCellValue('E9', "JENIS KENDARAAN");
        $excel->setCellValue('F9', "NOPOL");
        $excel->setCellValue('G9', "TOTAL");
        $excel->setCellValue('H9', "TANGGAL CUCI");

        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->customer);
            $excel->setCellValue('C' . $numrow, $key->alamat);
            $excel->setCellValue('D' . $numrow, $key->handphone);
            $excel->setCellValue('E' . $numrow, $key->pekerjaan);
            $excel->setCellValue('F' . $numrow, $key->nomor_kendaraan);
            $excel->setCellValue('G' . $numrow, $key->amount);
            $excel->setCellValue('H' . $numrow, $key->tgl_masuk);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':H' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':H' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = 'laporan_carwash.xlsx';

        //format excel baru
        // $writer = new Xlsx($spreadsheet);
        // $writer->save($file_name);

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function getcustomerqty()
    {
        $result = $this->crud->count_all('customer');

        echo json_encode($result);
    }

    public function getamount()
    {
        $result = $this->crud->sum('pekerjaan', 'amount')->row_array();

        echo json_encode($result);
    }

    public function getorder()
    {
        $result = $this->crud->count_all('pekerjaan');

        echo json_encode($result);
    }

    public function ajax_jenis_pekerjaan_chart()
    {
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");

        $this->db->select("pekerjaan, SUM(jumlah) jumlah");
        $this->db->from("pekerjaan");
        if (!empty($bulan)) $this->db->where("MONTH(tgl_masuk)", $bulan);
        if (!empty($tahun)) $this->db->where("YEAR(tgl_masuk)", $tahun);
        $this->db->group_by("pekerjaan");
        $data = $this->db->get()->result();

        echo json_encode($data);
    }

    public function ajax_pendapatan_chart()
    {
        $tahun = $this->input->post("tahun");

        $this->db->select("MONTH(tgl_masuk) bulan, SUM(amount) jumlah");
        $this->db->from("pekerjaan");
        if (!empty($tahun)) $this->db->where("YEAR(tgl_masuk)", $tahun);
        else $this->db->where("YEAR(tgl_masuk)", date("Y"));
        $this->db->group_by("MONTH(tgl_masuk)");
        $this->db->order_by("tgl_masuk DESC");
        $data_pekerjaan = $this->db->get()->result_array();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlah = 0;
            foreach ($data_pekerjaan as $key => $value) {
                if ($value['bulan'] == $i) $jumlah = $value['jumlah'];
            }

            $data[] = [
                "bulan" => $i,
                "jumlah" => $jumlah
            ];
        }

        echo json_encode($data);
    }

    public function get_last_month()
    {
        $data = $this->db->distinct()
            ->select("MONTH(tgl_masuk) bulan_masuk, YEAR(tgl_masuk) tahun_masuk")
            ->from("pekerjaan")
            ->order_by("tgl_masuk DESC")
            ->get()
            ->result();
        echo json_encode($data);
    }

    public function get_last_year()
    {
        $data = $this->db->distinct()
            ->select("YEAR(tgl_masuk) tahun")
            ->from("pekerjaan")
            ->order_by("YEAR(tgl_masuk) DESC")
            ->get()
            ->result();
        echo json_encode($data);
    }
}
