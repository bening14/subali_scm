<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prjt extends CI_Controller
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
        $data['klien'] = $this->crud->get_all('mst_klien')->result_array();
        $data['menu'] = 'project';
        $this->load->view('project', $data);
    }

    public function payment()
    {
        $data['menu'] = 'project';
        $this->load->view('payment', $data);
    }

    public function ajax_table_project()
    {
        $table = 'tbl_project'; //nama tabel dari database
        $column_order = array('id', 'nama_project', 'nama_klien', 'id_klien', 'uraian', 'jumlah_md', 'amount', 'brd_number', 'brd_file', 'quotation_number', 'quotation_file', 'kontrak_kerja_number', 'kontrak_kerja_file', 'bastp_number', 'bastp_file', 'status_project', 'balance', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_project', 'nama_klien', 'id_klien', 'uraian', 'jumlah_md', 'amount', 'brd_number', 'brd_file', 'quotation_number', 'quotation_file', 'kontrak_kerja_number', 'kontrak_kerja_file', 'bastp_number', 'bastp_file', 'status_project', 'balance', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_project, nama_klien, id_klien, uraian, jumlah_md, amount, brd_number, brd_file, quotation_number, quotation_file, kontrak_kerja_number, kontrak_kerja_file, bastp_number, bastp_file, status_project, balance, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama_project'] = $key->nama_project;
            $row['data']['nama_klien'] = $key->nama_klien;
            $row['data']['id_klien'] = $key->id_klien;
            $row['data']['uraian'] = $key->uraian;
            $row['data']['jumlah_md'] = $key->jumlah_md;
            $row['data']['amount'] = "Rp " . number_format($key->amount, 2, ',', '.');
            $row['data']['brd_number'] = $key->brd_number;
            $row['data']['brd_file'] = $key->brd_file;
            $row['data']['quotation_number'] = $key->quotation_number;
            $row['data']['quotation_file'] = $key->quotation_file;
            $row['data']['kontrak_kerja_number'] = $key->kontrak_kerja_number;
            $row['data']['kontrak_kerja_file'] = $key->kontrak_kerja_file;
            $row['data']['bastp_number'] = $key->bastp_number;
            $row['data']['bastp_file'] = $key->bastp_file;
            $row['data']['status_project'] = $key->status_project;
            $row['data']['balance'] = "Rp " . number_format($key->balance, 2, ',', '.');
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

    public function insert_data_project()
    {

        $table = $this->input->post("table");
        $olah_klien = $this->input->post("olah_klien");
        $data = $this->input->post();

        $klien = explode('-', $olah_klien);
        $data['id_klien'] = $klien[0];
        $data['nama_klien'] = $klien[1];
        $data['status_project'] = 'LEADS';
        $data['balance'] = $data['amount'];


        unset($data['table']);
        unset($data['olah_klien']);

        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function update_file()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $kategori_upload = $this->input->post("kategori_upload");
        $dokumen = $this->input->post("dokumen");

        if ($kategori_upload == 'brd') {
            $config['upload_path']          = "assets/pdf/brd/";
        } elseif ($kategori_upload == 'quotation') {
            $config['upload_path']          = "assets/pdf/quotation/";
        } elseif ($kategori_upload == 'kontrak') {
            $config['upload_path']          = "assets/pdf/kontrak_kerja/";
        } elseif ($kategori_upload == 'bastp') {
            $config['upload_path']          = "assets/pdf/bastp/";
        } elseif ($kategori_upload == 'ppn') {
            $config['upload_path']          = "assets/pdf/billing_ppn/";
        }

        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 10024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        unset($data['kategori']);
        unset($data['dokumen']);
        unset($data['kategori_upload']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            if ($kategori_upload == 'brd') {
                $data['brd_file'] = $data_upload['file_name'];
                $data['brd_number'] = $dokumen;
            } else if ($kategori_upload == 'quotation') {
                $data['quotation_file'] = $data_upload['file_name'];
                $data['quotation_number'] = $dokumen;
            } else if ($kategori_upload == 'kontrak') {
                $data['kontrak_kerja_file'] = $data_upload['file_name'];
                $data['kontrak_kerja_number'] = $dokumen;
                $data['status_project'] = 'OPEN';
            } else if ($kategori_upload == 'bastp') {
                $data['bastp_file'] = $data_upload['file_name'];
                $data['bastp_number'] = $dokumen;
                $data['status_project'] = 'CLOSED';
            }
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function update_file_faktur()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/faktur_pajak/";
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

            $data['ppn_file'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function update_file_payment()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $id_project = $this->input->post("id_project");

        $config['upload_path']          = "assets/pdf/payment/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 10024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        unset($data['id_project']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            $data['payment_file'] = $data_upload['file_name'];
        }
        $data['payment_status'] = 'CLOSED';

        //update balance di tbl_project
        $a = $this->crud->get_where('tbl_project', ['id' => $id_project])->row_array();
        $b = $this->crud->get_where('tbl_invoice', ['id' => $id])->row_array();
        $c = $a['balance'] - $b['amount'];
        $this->crud->update('tbl_project', ['balance' => $c], ['id' => $id_project]);
        //end update balance di tbl_project

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Edit Data!'];

        echo json_encode($response);
    }

    public function update_file_bayar()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $config['upload_path']          = "assets/pdf/billing_ppn/";
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

            $data['bukti_bayar_pajak'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Edit Data!'];
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

    public function getinvoice()
    {
        $id_project = $this->input->post('id_project');

        $where = array(
            'id_project' => $id_project
        );
        $result = $this->crud->get_where('tbl_invoice', $where)->result_array();

        echo json_encode($result);
    }

    public function ajax_table_payment()
    {
        $id = $this->input->post('id');

        $where = array(
            'id_project' => $id
        );

        $table = 'tbl_invoice'; //nama tabel dari database
        $column_order = array('id', 'id_project', 'nama_project', 'id_klien', 'nama_klien', 'invoice_number', 'amount', 'invoice_file', 'ntpn', 'ppn', 'ppn_file', 'bukti_bayar_pajak', 'faktur_pajak', 'remark', 'payment_status', 'payment_file', 'date_payment', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'id_project', 'nama_project', 'id_klien', 'nama_klien', 'invoice_number', 'amount', 'invoice_file', 'ntpn', 'ppn', 'ppn_file', 'bukti_bayar_pajak', 'faktur_pajak', 'remark', 'payment_status', 'payment_file', 'date_payment', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_project, nama_project, id_klien, nama_klien, invoice_number, amount, invoice_file, ntpn, ppn, ppn_file, bukti_bayar_pajak, faktur_pajak, remark, payment_status, payment_file, date_payment, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['id_project'] = $key->id_project;
            $row['data']['nama_project'] = $key->nama_project;
            $row['data']['id_klien'] = $key->id_klien;
            $row['data']['nama_klien'] = $key->nama_klien;
            $row['data']['invoice_number'] = $key->invoice_number;
            $row['data']['amount'] = "Rp " . number_format($key->amount, 2, ',', '.');
            $row['data']['invoice_file'] = $key->invoice_file;
            $row['data']['ntpn'] = $key->ntpn;
            $row['data']['ppn'] = "Rp " . number_format($key->ppn, 2, ',', '.');
            $row['data']['ppn_file'] = $key->ppn_file;
            $row['data']['bukti_bayar_pajak'] = $key->bukti_bayar_pajak;
            $row['data']['faktur_pajak'] = $key->faktur_pajak;
            $row['data']['remark'] = $key->remark;
            $row['data']['payment_status'] = $key->payment_status;
            $row['data']['payment_file'] = $key->payment_file;
            $row['data']['date_payment'] = $key->date_payment;
            $row['data']['date_created'] = $key->date_created;

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

    public function getproject()
    {
        $id = $this->input->post('id');

        $where = array(
            'id' => $id
        );
        $result = $this->crud->get_where('tbl_project', $where)->row_array();

        echo json_encode($result);
    }

    public function insert_data_invoice()
    {
        $table = $this->input->post("table");
        $amount = $this->input->post("amount");

        $config['upload_path']          = "assets/pdf/invoice/";
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 10024;
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

            $data['invoice_file'] = $data_upload['file_name'];
        }
        $data['ppn'] = 0.11 * $amount;

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

        if ($jenis == 'brd') {
            $data = array(
                'brd_number' => '',
                'brd_file' => ''
            );
        } elseif ($jenis == 'quotation') {
            $data = array(
                'quotation_number' => '',
                'quotation_file' => ''
            );
        } elseif ($jenis == 'kontrak') {
            $data = array(
                'kontrak_kerja_number' => '',
                'kontrak_kerja_file' => ''
            );
        } elseif ($jenis == 'bastp') {
            $data = array(
                'bastp_number' => '',
                'bastp_file' => ''
            );
        }

        $where = array(
            'id' => $id
        );

        // echo $jenis;
        // die;

        $update_data = $this->crud->update('tbl_project', $data, $where);

        if ($update_data) {
            $response = ['status' => 'success', 'message' => 'Success Delete Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Delete Data!'];

        echo json_encode($response);
    }
}
