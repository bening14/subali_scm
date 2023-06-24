<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('./resources/phpmail/PHPMailer.php');
require('./resources/phpmail/Exception.php');
require('./resources/phpmail/OAuth.php');
require('./resources/phpmail/POP3.php');
require('./resources/phpmail/SMTP.php');

class Auth extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model("Crud", "crud");
    //     $d = $this->crud->get_all('setting_apps')->row_array();
    //     $data['title'] = $d['nama_usaha'] . '| Dashboard';
    // }

    public function index()
    {

        $this->form_validation->set_rules('userid', 'Userid', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login-auth');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $userid = $this->input->post('userid');
        $password = $this->input->post('password');

        //ambil data dari model
        $table = 'user';
        $where = array(
            'userid' => $userid,
        );
        $user = $this->Crud->get_where($table, $where)->row_array();

        if ($user) {
            //cek dulu member aktive atau tidak
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    //jika sukses
                    $data = array(
                        'userid' => $user['userid'],
                        'role_id' => $user['role_id'],
                        'name' => $user['name'],
                        'nik' => $user['nik'],
                        'jabatan' => $user['jabatan'],
                        'phone' => $user['phone'],
                        'photo' => $user['photo'],
                        'is_active' => $user['is_active'],
                    );
                    //buat session
                    $this->session->set_userdata($data);
                    // redirect('dashboard');
                    if ($user['role_id'] == '1') {
                        redirect('xyz');
                    } else {
                        redirect('xyz');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Userid not activated</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Userid not registered</div>');
            redirect('auth');
        }
    }

    public function authreset()
    {
        $this->load->view('auth/reset-auth');
    }

    function cekmail()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $where = array(
            'userid' => $this->input->post('email'),
        );

        $table = 'user';
        $this->Crud->get_where($table, $where);

        if ($this->db->affected_rows() == true) {
            //kirim email
            //buat link dan simpan
            $a = uniqid();
            $b = password_hash($a, PASSWORD_DEFAULT);
            $c = $this->input->post('email');

            $data = array(
                'email' => $c,
                'uniq' => $b,
                'validation' => $today
            );
            $this->Crud->insert('reg_email', $data);


            $host = 'tls://mail.subali.site';
            $username = 'no-reply@subali.site';
            $password = 'M@lang345';
            $secure = 'tls';
            $port = '587';
            $emailfrom = 'no-reply@subali.site';
            $nama_pengirim = 'no-reply@subali.site';


            //KIRIM EMAIL
            $mail = new PHPMailer;

            //Enable SMTP debugging. 
            // $mail->SMTPDebug = 3;

            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = $host; //host mail server
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = $username;   //nama-email smtp          
            $mail->Password = $password;           //password email smtp
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = $secure;
            //Set TCP port to connect to 
            $mail->Port = $port;

            $mail->From = $emailfrom; //email pengirim
            $mail->FromName = $nama_pengirim; //nama pengirim



            $mail->isHTML(true);

            $mail->addAddress($this->input->post('email'), $this->input->post('email')); //email penerima
            $mail->Subject = 'Reset Password PORTAL SCM'; //subject
            $mail->Body    = '<p>Anda telah meminta untuk melakukan reset password terhadap akun Anda yang menggunakan email ini sebagai tautan akun.</p>

			<p>Jika memang benar aktivitas reset password ini atas permintaan Anda, silahkan klik link dibawah ini</p> 
			
			<p><a href="' . base_url('auth/changepass') . '?email=' . $c . '&ref=' . $b . '">' . base_url('auth/changepass') . '?email=' . $c . '&ref='  . $b . '</a></p> 
			
			<p>Namun apabila aktivitas reset ini bukan atas permintaan Anda, silahkan abaikan email ini.</p>
			
			
			<p>Terima Kasih</p>';
            $mail->AltBody = "PHP mailer";
            if (!$mail->send()) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed send email!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Link has been sent. Please check your email</div>');
                redirect('auth');
            }
        } else {
            $result = '500';
            echo json_encode($result);
        }
    }

    public function changepass()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        //ambil get url
        $where = array(
            'email' => $this->input->get('email'),
            'uniq' => $this->input->get('ref'),
            'validation' => $today
        );

        $this->Crud->get_where('reg_email', $where);
        if ($this->db->affected_rows() == true) {
            $data['email'] = $this->input->get('email');
            $this->load->view('auth/changepass-auth', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            You dont allowed to access this page !</div>');
            redirect('auth');
        }
    }

    public function action_change()
    {
        $data = array(
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        );
        $where = array(
            'userid' => $this->input->post('email')
        );
        //tulis ke table via model
        $update = $this->Crud->update('user', $data, $where);



        if ($update > 0) {
            $response = ['status' => 'success', 'message' => '<div class="alert alert-success" role="alert">
            Congratulation, Your Password has been changed</div>'];
        } else
            $response = ['status' => 'error', 'message' => 'Error change password !'];

        echo json_encode($response);
    }

    public function logout()
    {
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('jabatan');
        $this->session->unset_userdata('phone');
        $this->session->unset_userdata('photo');
        $this->session->unset_userdata('is_active');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You has been logout.</div>');
        redirect('auth');
    }
}
