<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fa extends CI_Controller
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
        $data['menu'] = 'finance';

        $this->load->view('petty', $data);
    }

    public function asset()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        $current_year = explode('-', $today); //2023

        $data['menu'] = 'finance';
        //logic check apakah penyusutan bertambah dan hitung nilai book value
        $getdata = $this->crud->get_all('tbl_asset')->result_array();
        foreach ($getdata as $key => $value) {
            $db_year = explode("-", $value['waktu_perolehan']);
            //harga perolehan
            $id = $value['id'];
            $total_susut = ($value['harga_perolehan'] / $value['usia']) * ($current_year[0] - $db_year[0]);
            //book value
            $book_value = $value['harga_perolehan'] - $total_susut;
            //update
            $this->crud->update('tbl_asset', ['total_penyusutan' => $total_susut, 'book_value' => $book_value], ['id' => $id]);
        }

        $this->load->view('asset', $data);
    }

    public function spt()
    {
        $data['menu'] = 'finance';

        $this->load->view('spt', $data);
    }

    public function pemasukan()
    {
        $data['menu'] = 'finance';

        $this->load->view('pemasukan', $data);
    }

    public function ajax_table_spt()
    {

        $table = 'tbl_spt_masa_ppn'; //nama tabel dari database
        $column_order = array('id', 'periode', 'bukti_penerimaan', 'spt', 'waktu_penyampaian',  'date_created'); //field yang ada di table user
        $column_search = array('id', 'periode', 'bukti_penerimaan', 'spt', 'waktu_penyampaian', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, periode, bukti_penerimaan, spt, waktu_penyampaian,  date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['periode'] = $key->periode;
            $row['data']['bukti_penerimaan'] = $key->bukti_penerimaan;
            $row['data']['spt'] = $key->spt;
            $row['data']['waktu_penyampaian'] = date('d-M-Y', strtotime($key->waktu_penyampaian));
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

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

    public function ajax_table_petty()
    {

        $table = 'tbl_petty_cash'; //nama tabel dari database
        $column_order = array('id', 'subjek', 'amount', 'req_person', 'status_approval', 'reason', 'file_bayar', 'bukti_kwitansi', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'subjek', 'amount', 'req_person', 'status_approval', 'reason', 'file_bayar', 'bukti_kwitansi', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, subjek, amount, req_person, status_approval, reason, file_bayar, bukti_kwitansi, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['subjek'] = $key->subjek;
            $row['data']['amount'] = "Rp " . number_format($key->amount, 2, ',', '.');
            $row['data']['req_person'] = $key->req_person;
            $row['data']['status_approval'] = $key->status_approval;
            $row['data']['reason'] = $key->reason;
            $row['data']['file_bayar'] = $key->file_bayar;
            $row['data']['bukti_kwitansi'] = $key->bukti_kwitansi;
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

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

    public function ajax_table_asset()
    {

        $table = 'tbl_asset'; //nama tabel dari database
        $column_order = array('id', 'kode_asset', 'nama_barang', 'photo', 'kategori', 'harga_perolehan', 'waktu_perolehan', 'usia', 'total_penyusutan', 'book_value', 'lokasi', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_asset', 'nama_barang', 'photo', 'kategori', 'harga_perolehan', 'waktu_perolehan', 'usia', 'total_penyusutan', 'book_value', 'lokasi', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_asset, nama_barang, photo, kategori, harga_perolehan, waktu_perolehan, usia, total_penyusutan, book_value, lokasi, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_asset'] = $key->kode_asset;
            $row['data']['nama_barang'] = $key->nama_barang;
            $row['data']['photo'] = $key->photo;
            $row['data']['kategori'] = $key->kategori;
            $row['data']['harga_perolehan'] = "Rp " . number_format($key->harga_perolehan, 2, ',', '.');
            $row['data']['waktu_perolehan'] = date('d-M-Y', strtotime($key->waktu_perolehan));
            $row['data']['usia'] = $key->usia;
            $row['data']['total_penyusutan'] = "Rp " . number_format($key->total_penyusutan, 2, ',', '.');
            $row['data']['book_value'] = "Rp " . number_format($key->book_value, 2, ',', '.');
            $row['data']['lokasi'] = $key->lokasi;
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

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

    public function delete_data()
    {
        $table = $this->input->post('table');
        if ($this->crud->delete($table, ['id' => $this->input->post('id')])) {
            $response = ['status' => 'success', 'message' => 'Success Delete Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Delete Data!'];

        echo json_encode($response);
    }

    public function update_file_bayar()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/petty_transfer/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 10024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['file_bayar'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function update_file_kwitansi()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/petty_kwitansi/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 10024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['bukti_kwitansi'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function insert_data_petty()
    {

        $table = $this->input->post("table");
        $data = $this->input->post();

        $data['req_person'] = $this->session->userdata('userid');


        unset($data['table']);

        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function reason_aproval()
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

    public function insert_data_asset()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        $b = explode('-', $today); //2023

        $table = $this->input->post("table");
        $usia = $this->input->post("usia");
        $harga = $this->input->post("harga_perolehan");
        $waktu = $this->input->post("waktu_perolehan"); //2022
        $a = explode("-", $waktu);

        $c = $harga / $usia; //nilai pertahun
        $d = $b[0] - $a[0]; //jumlah tahun berjalan
        $penyusutan = $d * $c;
        $bv = $harga - $penyusutan;

        $config['upload_path']          = "assets/image/asset_scm/";
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
        $ass = $this->crud->get_all_limit('tbl_asset')->row_array();
        $t = explode("-", $ass['kode_asset']);

        $k = $t[1] + 1;

        $data['kode_asset'] = 'ASSET-' . $k;

        $data['total_penyusutan'] = $penyusutan;
        $data['book_value'] = $bv;

        $insert = $this->crud->insert($table, $data);

        if ($insert > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function update_file_bukti()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/bukti_elektronik/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 50024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['bukti_penerimaan'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function update_file_spt()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/spt_ppn/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 50024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['spt'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function insert_data_spt()
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

    public function ajax_table_pemasukan()
    {

        $table = 'tbl_pemasukan_lain'; //nama tabel dari database
        $column_order = array('id', 'subjek', 'amount', 'reason', 'pic', 'bukti_transaksi', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'subjek', 'amount', 'reason', 'pic', 'bukti_transaksi', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, subjek, amount, reason, pic,  bukti_transaksi, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['subjek'] = $key->subjek;
            $row['data']['amount'] = "Rp " . number_format($key->amount, 2, ',', '.');
            $row['data']['reason'] = $key->reason;
            $row['data']['pic'] = $key->pic;
            $row['data']['bukti_transaksi'] = $key->bukti_transaksi;
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

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

    public function update_file_pemasukan()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/pemasukan_lain/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 50024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['bukti_transaksi'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function insert_data_pemasukan()
    {

        $table = $this->input->post("table");
        $data = $this->input->post();


        unset($data['table']);
        $data['pic'] = $this->session->userdata('userid');

        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    function reset_data()
    {
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $table = $this->input->post('table');

        if ($jenis == 'bukti') {
            $data = array(
                'bukti_penerimaan' => ''
            );
        } elseif ($jenis == 'spt') {
            $data = array(
                'spt' => ''
            );
        } elseif ($jenis == 'transfer') {
            $data = array(
                'file_bayar' => ''
            );
        } elseif ($jenis == 'kwitansi') {
            $data = array(
                'bukti_kwitansi' => ''
            );
        } elseif ($jenis == 'pemasukan') {
            $data = array(
                'bukti_transaksi' => ''
            );
        }

        $where = array(
            'id' => $id
        );

        // echo $jenis;
        // die;

        $update_data = $this->crud->update($table, $data, $where);

        if ($update_data) {
            $response = ['status' => 'success', 'message' => 'Success Delete Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Delete Data!'];

        echo json_encode($response);
    }
}
