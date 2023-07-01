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

    //ABSENSI RULE

    public function getClock()
    {
        $where = array(
            'nik' => $this->input->post('nik'),
            'attendance_date' => $this->input->post('attendance_date'),
        );

        $result = $this->Crud->get_where('time_attendance', $where)->row_array();
        if ($this->db->affected_rows() == true) {
            echo json_encode($result);
        } else {
            $result = '500';
            echo json_encode($result);
        }
    }

    public function addIn()
    {
        // $id_attendance = $this->newIdAttendance();
        $current_time = date('Y-m-d H:i:s');
        $cr = explode(' ', $current_time);

        //set zona waktu
        $where = array(
            'default_zone' => 1
        );
        $zona = $this->Crud->get_where('indonesia_timezone', $where)->row_array();
        //end set zona

        $temp = [];

        //cek dulu apakah sudah pernah absen dihari yang sama
        $where = array(
            'attendance_date' => $this->input->post('attendance_date'),
            'nik' => $this->input->post('nik'),
        );

        $this->Crud->get_where('time_attendance', $where);
        if ($this->db->affected_rows() == true) {
            $d['result'] = 400;

            $temp[] = $d;
            echo json_encode($temp);
            //end cek 

        } else {


            $nik = $this->input->post('nik');
            $data = array(
                // 'id_attendance' => $id_attendance,
                'nik' => $this->input->post('nik'),
                'attendance_date' => $this->input->post('attendance_date'),
                'clock_in' => $current_time,
                'status_clock' => '1',
                'clock_in_latitude' => $this->input->post('clock_in_latitude'),
                'clock_in_longitude' => $this->input->post('clock_in_longitude')
            );
            $this->Crud->insert_clock_w_camera('time_attendance', $data);
            $id = '';
            $id = $this->input->post("img");
            if ($this->db->affected_rows() == true) {

                define('UPLOAD_DIR', 'assets/images/clock_in/');
                $data = explode(',', $this->input->post("img"));
                $image = base64_decode($data[1]);
                $file = UPLOAD_DIR . md5($id) . '.png';
                $success = file_put_contents($file, $image);
                // echo $id;
                // die();
                if ($success) {
                    $dt_image = array(
                        'image_in' => md5($id) . ".png"
                    );
                    $b = array(
                        'attendance_date' => $this->input->post('attendance_date'),
                        'nik' => $this->input->post('nik'),
                    );
                    $this->Crud->update('time_attendance', $dt_image, $b);
                    // $this->db->where(['image' => md5($id) . ".png"]);
                    // $this->db->update('time_attendance', [
                    //     "nik" => $nik
                    // ]);
                    // $this->db->update_where('time_attendance', ['image' => md5($id) . ".png"], [
                    //     "nik" => $nik
                    // ]);
                    // $this->res->json200("success");
                    $d['result'] = 200;
                    $d['clock'] = $cr[1];
                    $temp[] = $d;
                    echo json_encode($temp);
                } else {
                    // $this->res->json(500, "file corrupted!");
                    $d['result'] = 501;
                    $temp[] = $d;
                    echo json_encode($temp);
                }
            } else {
                $d['result'] = 500;
                $temp[] = $d;
                echo json_encode($temp);
            }


            // echo json_encode($temp);

        }
    }

    public function addOut()
    {
        $current_time = date('Y-m-d H:i:s');
        $cr = explode(' ', $current_time);

        $temp = [];

        //cek dulu apakah sudah selesai absen dihari yang sama
        $where = array(
            'attendance_date' => $this->input->post('attendance_date'),
            'nik' => $this->input->post('nik'),
            'status_clock' => '0',
        );
        $this->Crud->get_where('time_attendance', $where);

        if ($this->db->affected_rows() == true) {
            $d['result'] = 400;

            $temp[] = $d;
            echo json_encode($temp);
            //end cek 

        } else {

            //hitung early_leaving berapa lama
            //ambil data dari shift
            $shift_id = '';
            $this->db->select('shift_id');
            $this->db->from('user');
            $this->db->where('id', $this->session->userdata('id'));
            $data_user_to_get_shift = $this->db->get()->result();
            if (count($data_user_to_get_shift) > 0) {
                foreach ($data_user_to_get_shift as $dut) {
                    $shift_id = $dut->shift_id;
                }
            }
            $time_db = '00:00:00';
            $jika = array(
                'id' => $shift_id
            );
            $r = $this->Crud->get_where('office_shift', $jika)->row_array();
            $r_r = $this->Crud->get_where('office_shift', $jika)->result();
            //tentukan ini hari apa
            // echo count($r_r);
            // die();
            if (count($r_r) > 0) {
                //tentukan ini hari apa
                if (date('l') == 'Monday') {
                    if ($r['senin_out'] != '00:00:00' && $r['senin_out'] != null  && $r['senin_out'] != '') {
                        $time_db = $r['senin_out'];
                    }
                } else if (date('l') == 'Tuesday') {
                    if ($r['selasa_out'] != '00:00:00' && $r['selasa_out'] != null  && $r['selasa_out'] != '') {
                        $time_db = $r['selasa_out'];
                    }
                } else if (date('l') == 'Wednesday') {
                    if ($r['rabu_out'] != '00:00:00' && $r['rabu_out'] != null  && $r['rabu_out'] != '') {
                        $time_db = $r['rabu_out'];
                    }
                } else if (date('l') == 'Thursday') {
                    if ($r['kamis_out'] != '00:00:00' && $r['kamis_out'] != null  && $r['kamis_out'] != '') {
                        $time_db = $r['kamis_out'];
                    }
                } else if (date('l') == 'Friday') {
                    if ($r['jumat_out'] != '00:00:00' && $r['jumat_out'] != null  && $r['jumat_out'] != '') {
                        $time_db = $r['jumat_out'];
                    }
                } else if (date('l') == 'Saturday') {
                    if ($r['sabtu_out'] != '00:00:00' && $r['sabtu_out'] != null  && $r['sabtu_out'] != '') {
                        $time_db = $r['sabtu_out'];
                    }
                } else if (date('l') == 'Sunday') {
                    if ($r['minggu_out'] != '00:00:00' && $r['minggu_out'] != null  && $r['minggu_out'] != '') {
                        $time_db = $r['minggu_out'];
                    }
                }
                //check libur atau tidak
                if ($time_db == '00:00:00') {
                    $d['result'] = 503;

                    $temp[] = $d;
                    echo json_encode($temp);
                } else {
                    //selesai tentukan hari
                    $early = '00:00:00';
                    $overtime = '00:00:00';
                    $find_diff_end = '00:00:00';

                    $datetime1 = new DateTime($current_time);

                    $datetime2 = new DateTime(date('Y-m-d') . ' ' .  $time_db);

                    $difference = $datetime1->diff($datetime2);
                    $se = $difference->s; //45
                    $mi = $difference->i; //23
                    $ho   = $difference->h; //8
                    $da   = $difference->d; //21
                    $mo  = $difference->m; //4
                    $ye   = $difference->y;

                    $find_diff_end = $ho . ':' . $mi . ':' . $se;

                    if (date('Y-m-d') . ' ' .  $time_db > $current_time) {

                        $early = $find_diff_end;
                    }
                    if ($current_time > date('Y-m-d') . ' ' .  $time_db) {
                        $overtime = $find_diff_end;
                    }

                    // echo $current_time;
                    // echo '<br>';
                    // echo date('Y-m-d') . ' ' .  $time_db;
                    // echo '<br>';
                    // echo $early;
                    // echo '<br>';
                    // echo $overtime;
                    // die();
                    //ambil waktu actual
                    // $i = explode(' ', $current_time);
                    // $time_act = strtotime($i[1]);
                    // //hitung selisih dalam detik
                    // $selisih = $time_db - $time_act;

                    // if ($selisih > 0) {
                    //     $early = gmdate("H:i:s", $selisih);
                    // } else {
                    //     $early = '00:00:00';
                    // }
                    //selesai hitung early

                    //hitung overtime (kelebihan waktu setelah jam pulang)
                    // $ov = $time_act - $time_db;
                    // if ($ov > 0) {
                    //     $overtime = gmdate("H:i:s", $ov);
                    // } else {
                    //     $overtime = '00:00:00';
                    // }
                    //selesai hitung overtime

                    //hitung time work
                    $jk = array(
                        'nik' => $this->session->userdata('nik'),
                        'status_clock' => '1'
                    );
                    // $yu = $this->Crud->get_where('time_attendance', $jk)->row_array();
                    // if ($this->db->affected_rows() == true) {
                    //     $h = explode(' ', $yu['clock_in']);
                    //     $total_work =  strtotime($current_time) - strtotime($h[1]);
                    // } else {
                    //     $total_work = '00:00:00';
                    // }

                    $yu = $this->Crud->get_where('time_attendance', $jk)->row_array();
                    if ($this->db->affected_rows() == true) {
                        $h = explode(' ', $yu['clock_in']);
                        // $total_work =  strtotime($current_time) - strtotime($h[1]);
                        // $total_work =  strtotime($current_time) - strtotime($yu['clock_in']);

                        $datetime1 = new DateTime($current_time);

                        $datetime2 = new DateTime($yu['clock_in']);

                        $difference = $datetime1->diff($datetime2);
                        $se = $difference->s; //45
                        $mi = $difference->i; //23
                        $ho   = $difference->h; //8
                        $da   = $difference->d; //21
                        $mo  = $difference->m; //4
                        $ye   = $difference->y;

                        $total_work = $ho . ':' . $mi . ':' . $se;
                    } else {
                        $total_work = '00:00:00';
                    }
                    //selesai hitung total work

                    $b = array(
                        'attendance_date' => $this->input->post('attendance_date'),
                        'nik' => $this->input->post('nik'),
                    );
                    $data = array(
                        'nik' => $this->input->post('nik'),
                        'attendance_date' => $this->input->post('attendance_date'),
                        'clock_out' => $current_time,
                        'status_clock' => '0',
                        'clock_out_latitude' => $this->input->post('clock_out_latitude'),
                        'clock_out_longitude' => $this->input->post('clock_out_longitude'),
                        'early_leaving' => $early,
                        'overtime' => $overtime,
                        'total_work' => $total_work
                    );
                    $this->Crud->update_clock_w_camera('time_attendance', $data, $b);
                    $id = '';
                    $id = $this->input->post("img");
                    if ($this->db->affected_rows() == true) {
                        define('UPLOAD_DIR', 'assets/bsb/images/clock_out/');
                        $data = explode(',', $this->input->post("img"));
                        $image = base64_decode($data[1]);
                        $file = UPLOAD_DIR . md5($id) . '.png';
                        $success = file_put_contents($file, $image);
                        // echo $id;
                        // die();
                        if ($success) {
                            $dt_image = array(
                                'image_out' => md5($id) . ".png"
                            );
                            $b = array(
                                'attendance_date' => $this->input->post('attendance_date'),
                                'nik' => $this->input->post('nik'),
                            );
                            $this->Crud->update('time_attendance', $dt_image, $b);

                            $d['result'] = 200;
                            $d['clock'] = $cr[1];
                            $d['zona'] = $yu['zona'];

                            $temp[] = $d;
                        } else {
                            $d['result'] = 501;
                            $temp[] = $d;
                        }
                    } else {
                        $d['result'] = 500;
                        $temp[] = $d;
                    }
                    echo json_encode($temp);
                }
            } else {
                $d['result'] = 502;

                $temp[] = $d;
                echo json_encode($temp);
            }
        }
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
