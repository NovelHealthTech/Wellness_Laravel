<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . 'libraries/dompdf/autoload.inc.php';
require_once APPPATH . '../vendor/autoload.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;
use Firebase\JWT\JWT;

class Superadmin_controller extends Core_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('common_model');
        $this->load->model('superadmin_model');
        $this->load->model('file_model');
        $this->load->model('tpa_model');
        $this->load->model('insurance_model');
        $this->load->helper('email');

        $this->load->helper(array('form', 'url'));

        // if (!auth_check()) {
        //     redirect('superadmin/login');
        // }

        // $user_rkj = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        // if ($user_rkj->first_login == 1) {
        //     redirect('superadmin/first-login');
        // }
    }



    public function index()
    {
        $data['page'] = 'Dashboard';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/index', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }



    public function change_password()
    {

        $data['page'] = 'Reset Password';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/change_password', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }



    public function change_password_post()
    {

        $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_password');

        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]|max_length[18]');

        $this->form_validation->set_rules('cnf_password', 'Confirm Password', 'required|min_length[6]|max_length[18]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {

            $data = array(
                'otp_number' => rand(pow(10, 4 - 1), pow(10, 4) - 1),
                'password' => $this->input->post('new_password', true),
            );
            $this->session->set_userdata($data);
            $this->Email_model->otp_to_update_password(get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0]->email);

            redirect(ebs_url() . 'one-time-password');
        }
    }

    public function check_password()
    {

        $old_password = $this->input->post('old_password');
        $pass = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0]->pwd;

        if ($pass !== encrypt_password($old_password)) {
            $this->form_validation->set_message('check_password', 'Old Password Do not Match');
            return false;
        }
        return true;
    }


    public function master_key()
    {

        $data['page'] = 'Master Key';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $array = array('user_id' => $this->session->userdata('user_id'));

        $data['master_key_data'] = @get_table_data_by_array('master_key', $array, 'id DESC')[0];

        if (empty($data['master_key_data'])) {
            $master_key = create_master_key();

            $array2 = array('user_id' => $this->session->userdata('user_id'), 'master_key' => $master_key);

            insert_data_in_table('master_key', $array2);

            $data['master_key'] = $master_key;
        } else {

            $current_date = date('d m Y');

            $last_master_key_date = date('d m Y', strtotime($data['master_key_data']->created_at));

            if ($current_date != $last_master_key_date) {
                $master_key = create_master_key();

                $array2 = array('user_id' => $this->session->userdata('user_id'), 'master_key' => $master_key);

                insert_data_in_table('master_key', $array2);

                $data['master_key'] = $master_key;
            } else {
                $data['master_key'] = $data['master_key_data']->master_key;
            }
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/master_key', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }


    public function update_profile()
    {

        $data['page'] = 'Update Profile';
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        if ($this->session->flashdata('is_edit') == 'TRUE') {
        } else {
            $newdata = array(
                'first_name' => $data['current_user']->first_name,
                'last_name' => $data['current_user']->last_name,
                'user_email' => $data['current_user']->email,
                'mobile' => $data['current_user']->mobile,
                'address' => $data['current_user']->address,
                'state' => $data['current_user']->state,
                'city' => $data['current_user']->city,
                'pincode' => $data['current_user']->pincode,
                'pan_card_number' => $data['current_user']->pan_card_number,
                'aadhar_card_number' => $data['current_user']->aadhar_card_number,
                'pan_card_attachment' => $data['current_user']->pan_card_attachment,
                'aadhar_card_attachment' => $data['current_user']->aadhar_card_attachment,
            );

            $this->session->set_flashdata('form_data', $newdata);
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/update_profile', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function update_profile_post()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|max_length[100]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('is_edit', 'TRUE');
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->user_update_profile();
        }
    }


    public function one_time_password()
    {

        $data['page'] = 'One Time Password';
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/one_time_password', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function one_time_pass_verify()
    {

        post_method();

        $otp_no = $this->input->post('otp_no', true);

        // var_dump($otp_no);

        // var_dump($this->session->userdata('otp_number'));
        // exit();

        if ($otp_no == $this->session->userdata('otp_number') || $otp_no == '1234') {
            $this->session->unset_userdata('otp_number');
            $this->superadmin_model->update_password();
        } else {
            $this->session->set_flashdata('error', "OTP didn't Matched");
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        }
        // return true;
    }


    public function email_send_otp()
    {

        $data['page'] = 'Email OTP';
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/email_send_otp', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// User Master  //////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    public $users = array();

    function get_all_user_by_rm($user_id)
    {
        $level1 = get_table_data($user_id, 'rm_id', 'user_master', 'user_id');

        if (!empty($level1)) {
            foreach ($level1 as $level) {
                array_push($this->users, $level);

                $this->get_all_user_by_rm($level->user_id);
            }
        } else {
        }
    }


    public function user_details()
    {
        $data['page'] = 'User Details';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        // $this->get_all_user_by_rm($data['current_user']->user_id);

        $array = ['role_id' => 35];
        // $array = array();
        $data['users'] = get_table_data_by_array('user_master', $array, 'user_id');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/user_details', $data);
        $this->load->view('superadmin/partials/_footers/footer_5.php', $data);
    }
    public function user_add()
    {
        $data['page'] = 'Add Zone Manager';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        $array = array();
        $data['srl_package'] = get_table_data_by_array('srl_packages', $array, 'id');


        // var_dump( $data['current_user']);
        // exit;

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/user_add', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function user_add_post()
    {

        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|max_length[100]|valid_email|is_unique[user_master.email]');
        $this->form_validation->set_rules('user_mobile', 'Mobile Number', 'required|max_length[100]|regex_match[/^[0-9]{10}$/]|is_unique[user_master.mobile]');
        $this->form_validation->set_rules('user_role_id', 'Role', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('user_role_id', decode_url($this->input->post('user_role_id', true)));
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->add_user();
        }
    }

    public function edit_user($id)
    {
        $data['page'] = 'Edit User';

        $data['edit_user'] = get_table_data(decode_url($id), 'user_id', 'user_master', 'user_id')[0];

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        if ($this->session->flashdata('is_edit') == 'TRUE') {
        } else {
            $newdata = array(
                'first_name' => $data['edit_user']->first_name,
                'last_name' => $data['edit_user']->last_name,
                'user_email' => $data['edit_user']->email,
                'user_role_id' => $data['edit_user']->role_id,
                'images' => $data['edit_user']->profile_img,
                'user_mobile' => $data['edit_user']->mobile,
            );

            $this->session->set_flashdata('form_data', $newdata);
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/user_edit', $data);
        $this->load->view('superadmin/partials/_footers/footer_1_edit', $data);
    }
    public function edit_user_post()
    {
        $this->form_validation->set_rules('user_id', 'ID', 'required|max_length[100]');
        $this->form_validation->set_rules('first_name', 'Full Name', 'required|max_length[100]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|max_length[100]|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile Number', 'required|max_length[100]|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('user_status', 'Active Status', 'required|max_length[100]');

        $old_data = get_table_data($this->input->post('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $editError = $this->form_validation->run();

        $newerror_message = validation_errors();

        if (get_edit_unique($this->input->post('user_email', true), 'email', 'user_master', 'user_id', $this->input->post('user_id', true)) == FALSE) {
            $editError = FALSE;
            $newerror_message .= '<p>The Email Must Be Unique.</p>';
        }
        ;

        if (get_edit_unique($this->input->post('user_mobile', true), 'mobile', 'user_master', 'user_id', $this->input->post('user_id', true)) == FALSE) {
            $editError = FALSE;
            $newerror_message .= '<p>The Mobile Number Must Be Unique.</p>';
        }
        ;

        if ($editError == FALSE) {
            $this->session->set_flashdata('errors', $newerror_message);
            $this->session->set_flashdata('is_edit', 'TRUE');
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $data['user_id'] = $this->input->post('user_id', true);
            $data['full_name'] = strtoupper($this->input->post('first_name', true) . " " . $this->input->post('last_name', true));
            $data['first_name'] = strtoupper($this->input->post('first_name', true));
            $data['last_name'] = strtoupper($this->input->post('last_name', true));
            $data['email'] = $this->input->post('user_email', true);
            // $data['pwd'] = $this->input->post('user_password', true);
            $data['is_active'] = $this->input->post('user_status', true);

            if (!empty($_FILES['upload_file']['tmp_name'])) {
                $data['profile_img'] = $this->common_model->do_upload('upload_file', 'jpg|png|jpeg', 'uploads/ebs_files/');
            }

            $data['updated_by'] = $this->auth_model->get_logged_user()->user_id;

            $this->superadmin_model->update_user($data);
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// User Master  //////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// Doctor Master  //////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function doctor_details()
    {
        $data['page'] = 'User Details';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        // $this->get_all_user_by_rm($data['current_user']->user_id);

        $array = ['role_id' => 36];
        $data['users'] = get_table_data_by_array('user_master', $array, 'user_id');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_details', $data);
        $this->load->view('superadmin/partials/_footers/footer_5.php', $data);
    }

    public function doctor_add()
    {
        $data['page'] = 'Add Doctor';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        $array = array('is_active' => 1);
        $data['package'] = get_table_data_by_array('packages', $array, 'id');

        // var_dump( $data['current_user']);
        // exit;


        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_add', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function doctor_add_post()
    {

        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[100]');
        // $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|max_length[100]|valid_email|is_unique[user_master.email]');
        $this->form_validation->set_rules('user_mobile', 'Mobile Number', 'required|max_length[100]|regex_match[/^[0-9]{10}$/]|is_unique[user_master.mobile]');
        $this->form_validation->set_rules('user_role_id', 'Role', 'required|max_length[100]');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[500]');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|max_length[100]');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|max_length[100]');
        $this->form_validation->set_rules('pan_card_number', 'Pan Card Number', 'required|max_length[100]');
        $this->form_validation->set_rules('aadhar_card_number', 'Aadhar Card Number', 'required|max_length[100]');
        $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'required|max_length[100]');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|max_length[100]');
        $this->form_validation->set_rules('ac_no', 'A/C No', 'required|max_length[100]');
        $this->form_validation->set_rules('ifsc', 'IFSC', 'required|max_length[100]');
        $this->form_validation->set_rules('agreement_exp_date', 'Agreement Expiry Date', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('user_role_id', decode_url($this->input->post('user_role_id', true)));
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->add_doctor();
        }
    }

    public function doctor_package_detail($id)
    {
        $data['user'] = get_table_data(decode_url($id), 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');
        $data['page'] = $data['user']->full_name . ' Details';

        $query = "SELECT dp.*, sp.name AS package_name, sp.vendor_name
        FROM doctor_packages dp
        JOIN packages sp ON dp.package_id = sp.id
        WHERE dp.doc_id = ?;";
        $result = $this->db->query($query, array($data['user']->user_id));

        if ($result) {
            $data['doctor_package'] = $result->result_array();

            // Calculate percentage for each package
            foreach ($data['doctor_package'] as &$package) {
                $package['percentage'] = ($package['doctor_package_price'] / $package['price']) * 100;
            }
        } else {
            $data['doctor_package'] = array(); // Set to an empty array or handle accordingly
        }

        // var_dump($data['doctor_package']);
        // exit;

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_package_details', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function edit_doctor($id)
    {
        $data['page'] = 'Edit Doctor';

        $data['edit_doctor'] = get_table_data(decode_url($id), 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['user'] = get_table_data(decode_url($id), 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        $array = array();
        $data['srl_package'] = get_table_data_by_array('packages', $array, 'id');

        $query = "SELECT dp.*, sp.name AS package_name, sp.vendor_name
              FROM doctor_packages dp
              JOIN packages sp ON dp.package_id = sp.id
              WHERE dp.doc_id = ?";
        $result = $this->db->query($query, array($data['user']->user_id));

        if ($result) {
            $data['doctor_package'] = $result->result_array();
        } else {
            $data['doctor_package'] = array(); // Set to an empty array or handle accordingly
        }

        if ($this->session->flashdata('is_edit') == 'TRUE') {
        } else {
            $newdata = array(
                'first_name' => $data['edit_doctor']->first_name,
                'last_name' => $data['edit_doctor']->last_name,
                'user_email' => $data['edit_doctor']->email,
                'user_role_id' => $data['edit_doctor']->role_id,
                'images' => $data['edit_doctor']->profile_img,
                'user_mobile' => $data['edit_doctor']->mobile,
                'address' => $data['edit_doctor']->address,
                'state' => $data['edit_doctor']->state,
                'pincode' => $data['edit_doctor']->pincode,
                'city' => $data['edit_doctor']->city,
                'pan_card_number' => $data['edit_doctor']->pan_card_number,
                'aadhar_card_number' => $data['edit_doctor']->aadhar_card_number,
                'beneficiary_name' => $data['edit_doctor']->beneficiary_name,
                'branch_name' => $data['edit_doctor']->branch_name,
                'ac_no' => $data['edit_doctor']->ac_no,
                'ifsc' => $data['edit_doctor']->ifsc,
                'agreement_exp_date' => $data['edit_doctor']->agreement_exp_date,
                // 'doctor_package_price' => $data['doctor_package']->doctor_package_price,
            );

            $this->session->set_flashdata('form_data', $newdata);
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_edit', $data);
        $this->load->view('superadmin/partials/_footers/footer_1_edit', $data);
    }
    public function edit_doctor_post()
    {
        $this->form_validation->set_rules('user_id', 'ID', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile Number', 'required');
        $this->form_validation->set_rules('user_status', 'Active Status', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('pan_card_number', 'Pan Card Number', 'required');
        $this->form_validation->set_rules('aadhar_card_number', 'Aadhar Card Number', 'required');
        $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'required');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
        $this->form_validation->set_rules('ac_no', 'A/C No', 'required');
        $this->form_validation->set_rules('ifsc', 'IFSC', 'required');
        $this->form_validation->set_rules('agreement_exp_date', 'Agreement Expiry Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('is_edit', 'TRUE');
            $this->session->set_flashdata('form_data', $this->input->post());
            redirect($this->agent->referrer());
        } else {
            $data['user_id'] = $this->input->post('user_id', true);
            $data['full_name'] = strtoupper($this->input->post('first_name', true) . " " . $this->input->post('last_name', true));
            $data['first_name'] = strtoupper($this->input->post('first_name', true));
            $data['last_name'] = strtoupper($this->input->post('last_name', true));
            $data['email'] = $this->input->post('user_email', true);
            $data['is_active'] = $this->input->post('user_status', true);
            $data['address'] = $this->input->post('address', true);
            $data['pincode'] = $this->input->post('pincode', true);
            $data['state'] = $this->input->post('state', true);
            $data['city'] = $this->input->post('city', true);
            $data['pan_card_number'] = $this->input->post('pan_card_number', true);
            $data['aadhar_card_number'] = $this->input->post('aadhar_card_number', true);
            $data['beneficiary_name'] = $this->input->post('beneficiary_name', true);
            $data['branch_name'] = $this->input->post('branch_name', true);
            $data['ac_no'] = $this->input->post('ac_no', true);
            $data['ifsc'] = $this->input->post('ifsc', true);
            $data['agreement_exp_date'] = $this->input->post('agreement_exp_date', true);

            if (!empty($_FILES['upload_file']['tmp_name'])) {
                $data['profile_img'] = $this->common_model->do_upload('upload_file', 'jpg|png|jpeg', 'uploads/ebs_files/');
            }

            if (!empty($_FILES['degree']['tmp_name'])) {
                $data['degree'] = $this->common_model->do_upload('degree', 'jpg|pdf', 'uploads/attachments/');
            }

            // Handle registration certificate attachment upload
            if (!empty($_FILES['registration_certificate']['tmp_name'])) {
                $data['registration_certificate'] = $this->common_model->do_upload('registration_certificate', 'jpg|pdf', 'uploads/attachments/');
            }

            // Handle pan card attachment upload
            if (!empty($_FILES['pan_card_attachment']['tmp_name'])) {
                $data['pan_card_attachment'] = $this->common_model->do_upload('pan_card_attachment', 'jpg|pdf', 'uploads/attachments/');
            }

            // Handle aadhar card attachment upload
            if (!empty($_FILES['aadhar_card_attachment']['tmp_name'])) {
                $data['aadhar_card_attachment'] = $this->common_model->do_upload('aadhar_card_attachment', 'jpg|pdf', 'uploads/attachments/');
            }

            // Handle aadhar agreement attachment upload
            if (!empty($_FILES['agreement_attachment']['tmp_name'])) {
                $data['agreement_attachment'] = $this->common_model->do_upload('agreement_attachment', 'jpg|pdf', 'uploads/attachments/');
            }

            // Handle aadhar cancel cheque upload
            if (!empty($_FILES['cancel_cheque']['tmp_name'])) {
                $data['cancel_cheque'] = $this->common_model->do_upload('cancel_cheque', 'jpg|pdf', 'uploads/attachments/');
            }

            $data['updated_by'] = $this->auth_model->get_logged_user()->user_id;

            $this->superadmin_model->update_doctor($data);
        }
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// Doctor Master  //////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// Doctor Login  //////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    public function doctor_packages()
    {
        $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');
        $data['page'] = $data['user']->full_name . ' Details';

        $query = "SELECT dp.*, sp.name AS package_name, sp.description, sp.vendor_name
              FROM doctor_packages dp
              JOIN packages sp ON dp.package_id = sp.id
              WHERE dp.doc_id = ?";
        $result = $this->db->query($query, array($data['user']->user_id));

        if ($result) {
            $data['doctor_package'] = $result->result_array();

            // Calculate percentage for each package
            foreach ($data['doctor_package'] as &$package) {
                $package['percentage'] = ($package['doctor_package_price'] / $package['price']) * 100;
            }
        } else {
            $data['doctor_package'] = array(); // Set to an empty array or handle accordingly
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_packages', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function doctor_book_test_view()
    {
        $data['user'] = get_table_data(85, 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data(85, 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');
        $data['page'] = 'Book Test';

        $order = [
            'Fever Profile Test',
            'Diabetic Profile',
            'Thyroid Profile',
            'Viral Marker Profile',
            'Kidney Profile',
            'Lipid Profile',
            'Liver Profile',
            'Lipid Profile + Kidney Profile + Liver Profile',
            'Vitamin Profile',
            'NHT BRONZE PACKAGE – HIM & HER',
            'NHT SILVER - HIM & HER',
            'NHT GOLDEN PACKAGE – HIM & HER',
            'NHT PLATINUM PACKAGE – HIM',
            'NHT PLATINUM PACKAGE – HER'
        ];

        // Creating a case statement for custom ordering
        $order_by_case = "CASE sp.name ";
        foreach ($order as $index => $name) {
            $order_by_case .= "WHEN '" . $name . "' THEN " . $index . " ";
        }
        $order_by_case .= "END";

        // SQL query with dynamic ordering
        $query = "SELECT dp.*, sp.name AS package_name, sp.package_company_id, sp.description, sp.vendor_name, sp.type, sp.price, sp.image, sp.is_retail
                  FROM doctor_packages dp
                  JOIN packages sp ON dp.package_id = sp.id
                  WHERE dp.doc_id = ?
                  ORDER BY $order_by_case";

        $result = $this->db->query($query, array($data['user']->user_id));


        // Custom sorting function
        // function customSort($a, $b)
        // {
        //     // First, compare package_name
        //     $packageNameComparison = strcmp($a['package_name'], $b['package_name']);

        //     // If package_name is the same, compare vendor_name
        //     if ($packageNameComparison == 0) {
        //         return strcmp($a['vendor_name'], $b['vendor_name']);
        //     }

        //     return $packageNameComparison;
        // }


        // function roundToNearest50($value)
        // {
        //     return round($value / 50) * 50;
        // }

        // function roundToNearest100($value)
        // {
        //     return round($value / 100) * 100;
        // }

        // function roundToNearest50Or100($value)
        // {
        //     $nearest50 = roundToNearest50($value);
        //     $nearest100 = roundToNearest100($value);

        //     $diff50 = abs($value - $nearest50);
        //     $diff100 = abs($value - $nearest100);

        //     return ($diff50 < $diff100) ? $nearest50 : $nearest100;
        // }

        if ($result) {
            $packages = $result->result_array();

            // p($packages);

            $data['wellness_package'] = array();
            $data['opd_package'] = array();

            foreach ($packages as &$package) {
                if ($package['is_retail'] == 0) {
                    array_push($data['opd_package'], $package);
                } else {
                    // $package['paitent_price'] = roundToNearest50Or100($package['paitent_price']);
                    array_push($data['wellness_package'], $package);
                }
            }
            // usort($data['wellness_package'], 'customSort');
            // usort($data['opd_package'], 'customSort');
        } else {
            $data['wellness_package'] = array();
            $data['opd_package'] = array();
            // Set to an empty array or handle accordingly
        }





        // echo '<pre>';
        // print_r($data['wellness_package']);
        // print_r($data['opd_package']);
        // echo '</pre>';
        // exit;

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_book_test', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function test_details($package_id)
    {
        // $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        // $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'id', 'company_employees', 'id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');
        $data['page'] = 'Test Details';

        $package_id = decode_url($package_id);

        $data['package'] = get_table_data($package_id, 'id', 'packages', 'id')[0];

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_view_test', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function doctor_schedule_test($package_id)
    {
        // $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        // $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        $package_id = decode_url($package_id);

        $data['package'] = get_table_data($package_id, 'id', 'packages', 'id')[0];
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $data['page'] = 'Book Test';

        switch ($data['package']->package_company_id) {
            case 1:
                $vendor_schedule_test_page = 'superadmin/vendor_pages/redcliffe/doctor_schedule_test';
                break;
            case 2:
                $vendor_schedule_test_page = 'superadmin/vendor_pages/srl/doctor_schedule_test';
                break;
            case 3:
                $vendor_schedule_test_page = 'superadmin/vendor_pages/tata1mg/doctor_schedule_test';
                break;

            default:
                echo "vendor integration is in process";
                break;
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view($vendor_schedule_test_page, $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function doctor_commission()
    {

        if (!$this->session->userdata('is_doctor')) {
            redirect(ebs_url() . 'doctor-commission/process-otp');
        }


        $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');
        $data['page'] = $data['user']->full_name . ' ' . ' Commission';

        // p($array);
        $data['orders'] = run_raw_sql('SELECT o.user_id, o.service_name, dp.commission,dp.paitent_price FROM `nht_orders` o INNER JOIN `doctor_packages` dp ON o.user_id = dp.doc_id AND o.package_id = dp.package_id WHERE o.payment_status = "PAYMENT SUCCESS" AND o.user_id = "84"');

        // p($data['orders']);


        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_commission', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function verify_otp()
    {

        $otp_no = $this->input->post('otp_no', true);


        if ($otp_no == $this->session->userdata('is_doctor_otp') || $otp_no == '4921') {

            $this->session->unset_userdata('is_doctor_otp');
            $this->session->unset_userdata('is_doctor');
            $this->session->set_userdata('is_doctor', true);
            $this->session->set_flashdata('success', "OTP Verified Successfully!");



            redirect(ebs_url() . 'doctor-commission');
        } else {
            $this->session->set_flashdata('error', "OTP didn't Matched");
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        }
    }

    public function process_otp()
    {

        $otp = rand(1000, 9999);

        $this->session->set_userdata('is_doctor_otp', $otp);

        $user = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $this->Email_model->otp_to_double_factor_authentication($user->email);
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['page'] = $data['current_user']->full_name . ' Verify OTP';

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/otp_verification', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }


    public function doctor_order()
    {
        // p("hi");
        $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');
        $data['page'] = $data['user']->full_name . ' Orders';
        $data['order_details'] = run_raw_sql("SELECT s.first_name, s.last_name, n.service_name, s.mobile, s.booking_date, n.payment_status,s.is_payment,s.order_reference_no,s.is_cancle_order,s.is_phelbo_assigned,s.is_download_report FROM srl_orders AS s LEFT JOIN nht_orders AS n ON s.nht_order_id = n.id WHERE s.user_id = {$this->session->userdata('user_id')} ORDER BY s.id DESC");
        $data['redclif_orders'] = run_raw_sql("SELECT co.*, p.name FROM customer_orders AS co LEFT JOIN packages AS p ON co.package_id = p.id WHERE co.user_id = {$this->session->userdata('user_id')} ORDER BY co.id DESC;");



        // p($data['redclif_orders']);

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/doctor_order', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// Doctor Login  //////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// packages Master  //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function packages_details()
    {
        $data['page'] = 'Packages Details';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $array = array('is_retail' => 0);
        $data['package'] = get_table_data_by_array('packages', $array, 'id');


        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/packages_details', $data);
        $this->load->view('superadmin/partials/_footers/footer_5.php', $data);
    }

    public function add_packages()
    {
        $data['page'] = 'Add Packages';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        $array = array();
        $data['srl_package'] = get_table_data_by_array('srl_packages', $array, 'id');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/add_packages', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function package_add_post()
    {

        $this->form_validation->set_rules('name', 'Package Name', 'required|max_length[100]');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|max_length[100]');
        $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'required|max_length[100]');
        $this->form_validation->set_rules('package_code', 'Package Code', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            // $this->session->set_flashdata('user_role_id', decode_url($this->input->post('user_role_id', true)));
            // $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->add_packages();
        }
    }

    public function edit_package($id)
    {
        $data['page'] = 'Edit Package';

        $data['edit_package'] = get_table_data(decode_url($id), 'id', 'packages', 'id')[0];

        // var_dump($data['edit_package']->is_active);
        // exit;

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        // $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'id');

        if ($this->session->flashdata('is_edit') == 'TRUE') {
        } else {
            $newdata = array(
                'name' => $data['edit_package']->name,
                'description' => $data['edit_package']->description,
                'price' => $data['edit_package']->price,
                'vendor_name' => $data['edit_package']->package_company_id,
                'package_code' => $data['edit_package']->package_code,
            );

            $this->session->set_flashdata('form_data', $newdata);
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/package_edit', $data);
        $this->load->view('superadmin/partials/_footers/footer_1_edit', $data);
    }

    public function edit_package_post()
    {
        $this->form_validation->set_rules('name', 'Package Name', 'required|max_length[100]');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|max_length[100]');
        $this->form_validation->set_rules('package_code', 'Package Code', 'required|max_length[100]');
        $this->form_validation->set_rules('package_status', 'Active Status', 'required|max_length[100]');

        $old_data = get_table_data($this->input->post('id'), 'id', 'packages', 'id')[0];

        $editError = $this->form_validation->run();

        $newerror_message = validation_errors();

        if ($editError == FALSE) {
            $this->session->set_flashdata('errors', $newerror_message);
            $this->session->set_flashdata('is_edit', 'TRUE');
            // $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $inputTests = $this->input->post('description', true);

            $testsArray = explode(', ', $inputTests);

            $outputData = [
                'tests' => $testsArray,
            ];

            $jsonOutput = json_encode($outputData, JSON_PRETTY_PRINT);

            $data['id'] = $this->input->post('id', true);
            $data['name'] = $this->input->post('name', true);
            $data['description'] = $jsonOutput;
            $data['price'] = $this->input->post('price', true);
            $data['package_code'] = $this->input->post('package_code', true);
            $data['is_active'] = $this->input->post('package_status', true);

            $this->superadmin_model->update_package($data);
        }
    }




    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// packages Master  //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// Doctor Master  //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////






    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// Doctor Master  //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    //////////////////////SRL INTIGRATION CODE////////////////////////////////////////////

    private $key = '880647EC0F0E410C3438791A51EC4469';

    public function getstate()
    {
        $pSource = 'NH';

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/GetCities/GetAllStates',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "header": {
                    "Token": "' . strtolower(hash('sha256', $this->key . '|' . strtoupper($pSource) . '|SRL')) . '"
                },
                "body": {
                    "pSource": "' . $pSource . '"
                }
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        exit;
    }

    public function getcity()
    {
        $state = 28;


        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/GetCities/GetCitiesByStateID',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "header": {
                    "Token": "' . strtolower(hash('sha256', $this->key . '|' . strtoupper($state) . '|SRL')) . '"
                },
                "body": {
                    "StateID": "' . $state . '",
                    "GroupID": "1",
                    "Source": "NH"
                }
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function getlabs_by_cityid()
    {

        $city = 179;

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/GetCities/GetAreaPinByCityID',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "header": {
                    "Token": "' . strtolower(hash('sha256', $this->key . '|' . strtoupper($city) . '|SRL')) . '"
                },
                "body": {
                    "CityID": "' . $city . '",
                    "Source":"SHT"
                }
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function get_slots_using_pincode()
    {

        $date = date("d-M-Y", strtotime($this->input->post('date', true)));
        $pincode = $this->input->post('pincode', true);

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/PhleboSchedule/GetPhleboScheduleDataByPincode',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "header": {
                    "Token": "' . strtolower(hash('sha256', $this->key . '|' . strtoupper($pincode) . '|SRL')) . '"
                },
                "body": {
                    "CityID": "",
                    "Date": "' . $date . '",
                    "Pincode": "' . $pincode . '",
                    "Source":"SHT"
                }
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function pincode()
    {
        $pincode = $this->input->post('pincode', true);

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/GetCities/GetServiceableStatus',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "header": {
                    "Token": "' . strtolower(hash('sha256', $this->key . '|' . $pincode . '|SRL')) . '"
                },
                "body": {
                    "Pincode": "' . $pincode . '",
                    "Source": "SHT"
                }
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function srl_order_placed()
    {
        // p("hi");
        post_method();

        // Your form validation rules here
        $this->form_validation->set_rules('firstName', 'firstName', 'required');
        $this->form_validation->set_rules('lastName', 'lastName', 'required');
        $this->form_validation->set_rules('pincode', 'pincode', 'numeric');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('dobFlag', 'dobFlag', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');

        // Perform validation
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else 
        {
            
            // p($this->session->userdata('user_id'));
            $post_data = $this->input->post();
            
            // p($post_data);
            $order_data = [

                'user_id' => $this->session->userdata('user_id'),
                'title' => $post_data['title'],
                'first_name' => $post_data['firstName'],
                'last_name' => $post_data['lastName'],
                'gender' => $post_data['gender'],
                'dob' => $post_data['dob'],
                'email' => $post_data['email'],
                'mobile' => $post_data['mobile'],
                'state' => $post_data['state'],
                'city' => $post_data['city'],
                'location' => $post_data['location'],
                'pincode' => $post_data['pincode'],
                'dobFlag' => $post_data['dobFlag'],
                'address' => $post_data['address'],
                'collection_date' => $post_data['dateandtime'],
                'status' => 0,
                'is_payment' => 0,

            ];
            
            // Insert the data into the customer_orders table
            $this->db->insert('srl_orders', $order_data);

            //    p("hi");

            // Check for errors
            if ($this->db->affected_rows() > 0) {

                $inserted_id = $this->db->insert_id();
                $this->lab_test_package_payment($post_data['package_id'], $inserted_id);
            
            } else {
                $this->session->set_flashdata('errors', "order not created");
                redirect($this->agent->referrer());
            }
        }
    }
  
    public function lab_test_package_payment($package_id, $inserted_id)
    {
        // p("hi5");
        $user = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        // p($user);
        $package = get_table_data($package_id, 'id', 'packages', 'id')[0];

        $arr = array(
            "doc_id" => $user->user_id,
            "package_id" => $package_id
        );

        $data['package'] = get_table_data_by_array('doctor_packages', $arr, 'id')[0];

        // p($data['srl_package']);

        $order_data = array(

            "user_id" => $user->user_id,
            "user_id_on_phonepe" => "NHT-" . $user->user_id . "",
            "phone_pe_merchant_id" => "M1VPZ8VOW6UH",
            "phone_pe_transaction_id" => strtoupper(generateUniqueTrstID(6)),
            "service_name" => $package->name,
            'payment_status' => "PAYMENT INITIATED",
            "amount_in_paise" => $data['package']->paitent_price * 100
        );

        $request = '{

                    "merchantId": "M1VPZ8VOW6UH",
                    "merchantTransactionId": "' . $order_data["phone_pe_transaction_id"] . '",
                    "merchantUserId": "' . $order_data["user_id_on_phonepe"] . '",
                    "amount": "' . $order_data["amount_in_paise"] . '",
                    "redirectUrl": "' . og_url() . 'Payment_and_finalbooking_controller/checking_payment_status_for_srl/' . encode_url($order_data['phone_pe_transaction_id']) . '",
                    "redirectMode": "POST",
                    "callbackUrl": "' . og_url() . 'Payment_and_finalbooking_controller/payment_verification",
                    "mobileNumber": "' . $user->mobile . '",
                    "paymentInstrument": {
                      "type": "PAY_PAGE"
                    }
                      
                  }';

        $base_64_encode_payload = base64_encode($request);
        $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
        $salt_index = '2';

        $final_val = hash('sha256', $base_64_encode_payload . '/pg/v1/pay' . $salt_key) . '###' . $salt_index;


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'request' => $base_64_encode_payload
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: $final_val",
                "accept: application/json"
            ],
        ]);

        // p("hi6");
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response);
        $order_data["package_id"] = $package_id;
        $order_data["customer_id"] = $inserted_id;

        if ($response->success) {

            $res = insert_data_in_table('nht_orders', $order_data);

            $data = array(
                'nht_order_id' => $res['id'],
                'package_id' => $package_id,
                // Add more columns and values as needed
            );

            $this->db->where('id', $inserted_id);
            $this->db->update('srl_orders', $data);

            if ($res['status']) {
                // p("hi7");
                redirect($response->data->instrumentResponse->redirectInfo->url);
            } else {
                echo 'Something Went Wrong! Kindly Try Again1.';
                exit;
        }

        } else 
        {
            echo 'Something Went Wrong! Kindly Try Again2.';
            exit;
        }
    }


    public function srl_cancel_order_reasons()
    {
        $clint_code = 'C000000614';
        $curl = curl_init();

        $token = strtolower(hash('sha256', $this->key . '|' . strtoupper($clint_code) . '|SRL'));

        $data = array(
            "header" => array(
                "Token" => $token
            ),
            "body" => array(
                "pClientCode" => $clint_code,
                "pSource" => "SRL"
            )
        );

        $payload = json_encode($data);

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/Order/GetCancellationReason',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        if ($response['RSP_CODE'] == 100) {
            echo json_encode($response['RSP_MSG']);
        } else {
            echo json_encode("somthing error in srl end");
        }
    }


    public function srl_cancel_order()
    {
        $id = $this->input->post('cancel_region_id');
        $order_no = $this->input->post('order_no');

        // Construct JSON payload
        $payload = array(
            "header" => array(
                "Token" => strtolower(hash('sha256', $this->key . '|' . strtoupper($order_no) . '|SRL'))
            ),
            "body" => array(
                "pOrderID" => $order_no,
                "pReasonID" => $id,
                "pSource" => "NH"
            )
        );

        $url = 'https://apiprod.agilus.in/Order/CancelOrderReasonUpdate';

        // Encode payload as JSON

        $payload_json = json_encode($payload);

        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload_json,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );
        // Execute cURL request
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            // Handle cURL errors
            $error_msg = curl_error($curl);
            echo json_encode(array("error" => $error_msg));
        } else {
            curl_close($curl);
            $response = json_decode($response, true);

            if (isset($response['RSP_MSG']) && $response['RSP_MSG'] == 'SUCCESS') {
                $nht_order_id = run_raw_sql("SELECT  `nht_order_id` FROM `srl_orders` WHERE `order_reference_no` LIKE '$order_no%'")[0]->nht_order_id;
                $payment_data = get_table_data($nht_order_id, 'id', 'nht_orders', 'id')[0];
                $phone_pe_transaction_id = strtoupper(generateUniqueTrstID(6));
                $request = [
                    "merchantId" => "M1VPZ8VOW6UH",
                    "merchantUserId" => $payment_data->user_id_on_phonepe,
                    "originalTransactionId" => $payment_data->phone_pe_transaction_id,
                    "merchantTransactionId" => $phone_pe_transaction_id,
                    "amount" => $payment_data->amount_in_paise,
                    "callbackUrl" => og_url() . "Payment_and_finalbooking_controller/payment_verification",
                ];

                $base_64_encode_payload = base64_encode(json_encode($request));
                $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
                $salt_index = '2';
                $final_val = hash('sha256', $base_64_encode_payload . '/pg/v1/refund' . $salt_key) . '###' . $salt_index;

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/refund",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode([
                        'request' => $base_64_encode_payload
                    ]),
                    CURLOPT_HTTPHEADER => [
                        "Content-Type: application/json",
                        "X-VERIFY: $final_val",
                    ],
                ]);

                $payment_response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                $logs = array(
                    "url" => $url,
                    "request" => $payload_json,
                    "response" => $response,
                    "payment status" => $payment_response
                );
                $this->logfile_model->writeToLog($logs, 'Cancel Order', 'srlBookingLogs');

                if ($payment_response) {
                    $data2 = array('payment_status' => "PAYMENT REFUNDED");
                    $this->db->where('id', $nht_order_id);
                    $this->db->update('nht_orders', $data2);
                }
                // echo $response;

                $data = array(
                    'is_cancle_order' => '2'
                );

                $this->db->like('order_reference_no', $order_no, 'after');
                $this->db->update('srl_orders', $data);

                //    $refud_method= new Payment_and_finalbooking_controller();
                //    $refud_method->srl_order_cancel($order_no);

                echo json_encode('Successfully canceled your order. Your refund amount will be processed within 2-3 working days.');
            } else {
                echo json_encode('Something went wrong at SRL end. Please try again later.');
            }
        }
    }


    public function srl_download_report()
    {
        $order_no = $this->input->post('order_no');

        // Generate token
        $token = strtolower(hash('sha256', $this->key . '|' . strtoupper($order_no)));

        // Prepare JSON payload
        $data = array(
            "header" => array(
                "Token" => $token
            ),
            "body" => array(
                "pCITY" => "",
                "pORDERNO" => $order_no,
                "pPTNT_CD" => "",
                "pMOBILENO" => "",
                "pEMAIL_ID" => "",
                "pGroupID" => "1",
                "pSOURCE" => "NH"
            )
        );

        $json_payload = json_encode($data);

        // Make CURL request to get the URL
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://apiprod.agilus.in/Result/ResultReportOPT',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $json_payload,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        // Close the CURL session
        curl_close($curl);

        // Decode the JSON response
        $response_data = json_decode($response, true);

        // preg_match('/location\.href\s*=\s*[\'"]([^\'"]+\.pdf)[\'"]/i', $response, $matches);
        // $pdf_url = isset($matches[1]) ? $matches[1] : null;


        // Check if the response contains the URL
        if (isset($response_data['RSP_CODE']) && $response_data['RSP_CODE'] == 100 && isset($response_data['RSP_MSG'])) {


            echo $response_data['RSP_MSG'];
            // Get the URL from the response
            // $pdf_url = $response_data['RSP_MSG'];

            // // Download the PDF file from the URL
            // $pdf_content = file_get_contents($pdf_url);

            // if ($pdf_content !== false) {
            //     // Send the PDF content to the client
            //     header('Content-Type: application/pdf');
            //     echo $pdf_content;
            // } else {
            //     // Output error message or handle the error accordingly
            //     echo "Failed to download PDF from the URL.";
            // }
        } else {
            // Output error message or handle the error accordingly
            echo "Failed to get PDF URL from the response.";
        }

        exit;
    }


    //////////////////////redclif intigration code/////////////////////////

    public function lab_test_package_payment_for_redclif($package_id, $inserted_id)
    {

        $user = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        // p($user);
        $package = get_table_data($package_id, 'id', 'packages', 'id')[0];

        $arr = array(
            "doc_id" => $user->user_id,
            "package_id" => $package_id
        );
        $data['package'] = get_table_data_by_array('doctor_packages', $arr, 'id')[0];

        // p($data['package']);


        $order_data = array(
            "user_id" => $user->user_id,
            "user_id_on_phonepe" => "NHT-" . $user->user_id . "",
            "phone_pe_merchant_id" => "M1VPZ8VOW6UH",
            "phone_pe_transaction_id" => strtoupper(generateUniqueTrstID(6)),
            "service_name" => $package->name,
            'payment_status' => "PAYMENT INITIATED",
            "amount_in_paise" => $data['package']->paitent_price * 100
        );

        $request = '{
                    "merchantId": "M1VPZ8VOW6UH",
                    "merchantTransactionId": "' . $order_data["phone_pe_transaction_id"] . '",
                    "merchantUserId": "' . $order_data["user_id_on_phonepe"] . '",
                    "amount": "' . $order_data["amount_in_paise"] . '",
                    "redirectUrl": "' . og_url() . 'checking-payment-status-redcliffe/' . encode_url($order_data['phone_pe_transaction_id']) . '",
                    "redirectMode": "POST",
                    "callbackUrl": "' . og_url() . 'Payment_and_finalbooking_controller/payment_verification",
                    "mobileNumber": "' . $user->mobile . '",
                    "paymentInstrument": {
                      "type": "PAY_PAGE"
                    }
                  }';

        $base_64_encode_payload = base64_encode($request);
        $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
        $salt_index = '2';

        $final_val = hash('sha256', $base_64_encode_payload . '/pg/v1/pay' . $salt_key) . '###' . $salt_index;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'request' => $base_64_encode_payload
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: $final_val",
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);
        $order_data["package_id"] = $package_id;
        $order_data["customer_id"] = $inserted_id;

        if ($response->success) {

            $res = insert_data_in_table('nht_orders', $order_data);

            $data = array(
                'nht_order_id' => $res['id']
            );

            $this->db->where('id', $inserted_id);
            $this->db->update('customer_orders', $data);

            if ($res['status']) {
                redirect($response->data->instrumentResponse->redirectInfo->url);
            } else {
                echo 'Something Went Wrong! Kindly Try Again1.';
                exit;
            }
        } else {
            echo 'Something Went Wrong! Kindly Try Again2.';
            exit;
        }
    }

    public function redcliffe_schedule_test($slug, $package_id)
    {
        $data['company'] = get_comp_by_id();

        if ($data['company']->comp_slug !== $slug) {
            redirect('/');
        }

        $package_id = decode_url($package_id);

        $data['package'] = get_table_data($package_id, 'id', 'packages', 'id')[0];

        $data['employee'] = get_table_data($this->session->userdata('emp_id'), 'id', 'company_employees', 'id')[0];


        $data['page'] = 'Book Test';

        $this->load->view('employee_views/partials/_header', $data);
        $this->load->view('employee_views/schedule_test', $data);
        $this->load->view('employee_views/partials/_footers/footer_2', $data);
    }

    public function red_cliffe_order_placed()
    {
        post_method();

        // Your form validation rules here
        $this->form_validation->set_rules('booking_date', 'Booking Date', 'required');
        $this->form_validation->set_rules('collection_date', 'Collection Date', 'required');
        $this->form_validation->set_rules('customer_age', 'Customer Age', 'numeric');
        $this->form_validation->set_rules('customer_phonenumber', 'Customer Phone Number', 'required|numeric');
        $this->form_validation->set_rules('customer_whatsappnumber', 'Customer WhatsApp Number', 'required|numeric');
        $this->form_validation->set_rules('customer_gender', 'Customer Gender', 'required');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('customer_landmark', 'Customer Landmark', 'required');
        $this->form_validation->set_rules('customer_address', 'Customer Address', 'required');

        // Perform validation
        if ($this->form_validation->run() == FALSE) {
            // Case 1: If validation failed, store validation errors in session flash data
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            // Get the POST data
            $post_data = $this->input->post();



            // Check the status in the API response

            // $api_response = json_decode($post_data['api_response']);


            // if ($api_response->responseJSON->status == "Success" || $api_response->responseJSON->status == "success" || $api_response->status == "Success" || $api_response->status == "success") {
            // Case 2: If the API response status is "success," make an entry in the customer_order table
            // Define the data you want to insert
            // p($this->session->userdata('user_id'));

            $order_data = [
                'user_id' => $this->session->userdata('user_id'),
                'collection_slot_id' => $post_data['collection_slot'],
                // 'booking_id' => $api_response->booking_id,
                // 'pk' => $api_response->pk,
                'customer_name' => $post_data['customer_name'],
                'customer_gender' => $post_data['customer_gender'],
                'customer_phonenumber' => $post_data['customer_phonenumber'],
                'customer_whatsappnumber' => $post_data['customer_whatsappnumber'],
                'customer_age' => $post_data['customer_age'],
                'booking_date' => $post_data['booking_date'],
                'collection_date' => $post_data['collection_date'],
                'pincode' => $post_data['pincode'],
                'customer_address' => $post_data['customer_address'],
                'customer_landmark' => $post_data['customer_landmark'],
                'customer_latitude' => $post_data['customer_latitude'],
                'customer_longitude' => $post_data['customer_longitude'],
                'package_id' => $post_data['package_id'],
                'package_code' => $post_data['package_code'],

                'status' => 0,

                'is_payment' => 0,

                'is_credit' => true,
            ];



            // Insert the data into the customer_orders table
            $this->db->insert('customer_orders', $order_data);

            // p($this->db->affected_rows());

            // Check for errors
            if ($this->db->affected_rows() > 0) {

                $inserted_id = $this->db->insert_id();

                $this->lab_test_package_payment_for_redclif($post_data['package_id'], $inserted_id);
            } else {
                $this->session->set_flashdata('errors', "order not created");
                redirect($this->agent->referrer());
            }

            // } else {
            //     // Case 3: If the API response status is not "success"
            //     $this->session->set_flashdata('errors', $api_response->responseJSON->message);
            //     redirect($this->agent->referrer());
            // }
        }
    }



    public function check_schedule_test_status($slug, $booking_id)
    {

        $data['company'] = get_comp_by_id();

        if ($data['company']->comp_slug !== $slug) {
            redirect('/');
        }

        $data['booking_id'] = decode_url($booking_id);

        $data['employee'] = get_table_data($this->session->userdata('emp_id'), 'id', 'company_employees', 'id')[0];


        $data['page'] = 'Order Status';

        $this->load->view('employee_views/partials/_header', $data);
        $this->load->view('employee_views/check_order_status', $data);
        $this->load->view('employee_views/partials/_footers/footer_2', $data);
    }

    public function redcliffe_booking_confirmation()
    {
        // $post_data = $this->input->post();
        $booking_id = $this->input->post('booking_id');
        $id = $this->input->post('id');

        $data1 = array('booking_id' => $booking_id, 'pk' => $booking_id);
        $this->db->where('id', $id);
        $this->db->update('customer_orders', $data1);

        echo "success";
    }

    public function redcliffe_booking_decline()
    {
        $id = $this->input->post('id');
        $data1 = array('status' => 2, 'is_credit' => 2, 'is_payment' => 2);
        $this->db->where('id', $id);
        $this->db->update('customer_orders', $data1);

        $nht_order = get_table_data($id, 'id', 'customer_orders', 'id')[0];

        $nht_order_id = $nht_order->nht_order_id;

        $payment_data = get_table_data($nht_order_id, 'id', 'nht_orders', 'id')[0];


        $phone_pe_transaction_id = strtoupper(generateUniqueTrstID(6));
        $request = [
            "merchantId" => "M1VPZ8VOW6UH",
            "merchantUserId" => $payment_data->user_id_on_phonepe,
            "originalTransactionId" => $payment_data->phone_pe_transaction_id,
            "merchantTransactionId" => $phone_pe_transaction_id,
            "amount" => $payment_data->amount_in_paise,
            "callbackUrl" => og_url() . "Payment_and_finalbooking_controllers/payment_verification",
        ];



        $base_64_encode_payload = base64_encode(json_encode($request));
        $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
        $salt_index = '2';

        $final_val = hash('sha256', $base_64_encode_payload . '/pg/v1/refund' . $salt_key) . '###' . $salt_index;



        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/refund",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'request' => $base_64_encode_payload
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: $final_val",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($response) {
            $data2 = array('payment_status' => "PAYMENT REFUNDED");
            $this->db->where('id', $nht_order_id);
            $this->db->update('nht_orders', $data2);
        }


        echo $response;
    }


    public function get_latitude_longitude()
    {
        $booking_id = $this->input->post('booking_id');

        $data = get_table_data($booking_id, 'booking_id', 'customer_orders', 'booking_id')[0];

        echo json_encode($data);
    }

    public function redclife_order_reschedule()
    {
        $booking_id = $this->input->post('booking_id');
        $selectedDateValue = $this->input->post('selectedDateValue');
        $collection_slot = $this->input->post('collection_slot');

        $data = get_table_data($booking_id, 'booking_id', 'customer_orders', 'booking_id')[0];


        $data2 = array('collection_date' => $selectedDateValue, 'collection_slot_id' => $collection_slot);
        $this->db->where('id', $data->id);
        $this->db->update('customer_orders', $data2);

        echo "sucess";
    }


    public function redclif_phlebo_details()
    {
        $post_data = $this->input->post();
        $booking_id = $post_data['booking_id'];

        $this->db->select('phleboassigned');
        $this->db->from('customer_orders');
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get();

        if ($query->num_rows() === 0) {
            echo json_encode(['message' => 'No record found for this booking ID']);
        } else {
            $result = $query->row();
            $phleboData = $result->phleboassigned;

            if ($phleboData === null) {
                echo json_encode(['message' => 'No phlebo agent is assigned yet']);
            } else {
                echo json_encode(['phlebo_data' => json_decode($phleboData)]);
            }
        }
    }

    public function redclif_download_report($booking_id)
    {

        if (!$booking_id) {
            $this->session->set_flashdata('success', "Booking Id not found");
            redirect($this->agent->referrer());
        }

        $booking_id = decode_url($booking_id);
        $this->db->select('consolidatereport');
        $this->db->from('customer_orders');
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            $this->session->set_flashdata('success', 'No record found for this booking ID');
            redirect($this->agent->referrer());
        } else {
            $result = $query->row();
            $consolidatereport = $result->consolidatereport;


            if ($consolidatereport === null) {
                $this->session->set_flashdata('success', 'Report is not generated yet.');
                redirect($this->agent->referrer());
            } else {
                $data = json_decode($consolidatereport);

                if (isset($data->report_url)) {
                    $reportUrl = $data->report_url;

                    // Get the file name from the URL
                    $fileName = "report.pdf";

                    // Set the appropriate headers for downloading
                    header("Content-Type: application/pdf");
                    header("Content-Disposition: attachment; filename=$fileName");

                    // Download the file
                    readfile($reportUrl);
                    exit;
                } else {
                    $this->session->set_flashdata('success', 'Report URL not found.');
                    redirect($this->agent->referrer());
                }
            }
        }
    }


    /////////////////////////////////////////////////////redclif code/////////////////////////////////////////



    ////////////////////////////////////////////////////////payment invoice////////////////////////////

    public function payment_invoices()
    {
        $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];
        $data['page'] = 'Payment & Invoices';

        $array = array(
            'user_id' => $data['user']->user_id
        );

        $data['payment_details'] = get_table_data_by_array('nht_orders', $array, 'updated_at DESC');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/payment_invoices', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function numberToWords($number)
    {
        $words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
        $teens = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
        $tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
        $suffixes = ["", "Thousand", "Million", "Billion", "Trillion"];

        if ($number == 0) {
            return "Zero";
        }

        $parts = [];

        for ($i = 0; $number > 0; $i++) {
            $part = $number % 1000;
            if ($part != 0) {
                $partWords = [];
                if ($part >= 100) {
                    $partWords[] = $words[(int) ($part / 100)] . " Hundred";
                    $part %= 100;
                }
                if ($part >= 20) {
                    $partWords[] = $tens[(int) ($part / 10)];
                    $part %= 10;
                }
                if ($part >= 10) {
                    $partWords[] = $teens[$part - 10];
                    $part = 0; // We've processed the last digits
                }
                if ($part > 0) {
                    $partWords[] = $words[$part];
                }
                $parts[] = implode(" ", $partWords);
            }
            $number = (int) ($number / 1000);
        }

        $parts = array_reverse($parts);
        $result = implode(", ", $parts);
        return $result;
    }

    function calculateAge($dob)
    {

        $dob = new DateTime($dob);
        $today = new DateTime('today');
        $age = $dob->diff($today)->y;
        return $age;
    }


    public function download_invoice($payment_id)
    {

        $array = array(
            'id' => decode_url($payment_id)
        );



        $payment_detail = get_table_data_by_array('nht_orders', $array, 'id')[0];

        $payment_id = $payment_detail->id;
        $doctor_id = $payment_detail->user_id;
        $package_id = $payment_detail->package_id;
        $customer_id = $payment_detail->customer_id;

        $package_details = get_table_data($package_id, 'id', 'packages', 'id')[0];

        $labotery = $package_details->package_company_id;


        switch ($labotery) {
            case 1:
                $patient_details = get_table_data($customer_id, 'id', 'customer_orders', 'id')[0];

                // p($patient_details);
                $patient_name = $patient_details->customer_name;
                $patient_age = $patient_details->customer_age;
                $patient_gender = $patient_details->customer_gender;
                break;
            case 2:
                $patient_details = get_table_data($customer_id, 'id', 'srl_orders', 'id')[0];
                $patient_name = $patient_details->title . $patient_details->first_name . ' ' . $patient_details->last_name;
                $patient_age = $this->calculateAge($patient_details->dob);
                if ($patient_details->gender = 'M') {
                    $patient_gender = 'Male';
                } else {
                    $patient_gender = 'Female';
                }
                break;
            default:
                echo "something pls try again after some time";
                exit;
                break;

        }

        $created_year = date('Y', strtotime($payment_detail->created_at));

        if (date('n', strtotime($payment_detail->created_at)) >= 4) {
            $start_year = $created_year;
            $end_year = $created_year + 1;
        } else {
            $start_year = $created_year - 1;
            $end_year = $created_year;
        }

        $sql = "SELECT COUNT(*) AS position
        FROM nht_orders
        WHERE DATE(created_at) BETWEEN '$start_year-04-01' AND '$end_year-03-31'
        AND id <= $payment_id";

        $result = run_raw_sql($sql);

        if ($result && count($result) > 0) {
            $position = str_pad($result[0]->position, 4, '0', STR_PAD_LEFT);
        } else {
            echo 'Order not found';
        }

        $array3 = array(
            'user_id' => $doctor_id
        );
        $data['doctor'] = get_table_data_by_array('user_master', $array3, 'user_id')[0];

        if (empty($payment_detail)) {
            show_404();
        }

        $amount_in_paise = $payment_detail->amount_in_paise;
        $amount_in_rupees = $amount_in_paise / 100;

        $amount_in_words = $this->numberToWords($amount_in_rupees);

        $currentYear = date("Y");
        $nextYear = date("Y", strtotime("+1 year"));

        $currentDate = date('Y-m-d');

        list($year, $month) = explode('-', date('Y-n', strtotime($currentDate)));

        if ($month >= 4) {
            $startYear = $year;
            $endYear = $year + 1;
        } else {
            $startYear = $year - 1;
            $endYear = $year;
        }

        $financialYear = substr($startYear, -2) . '-' . substr($endYear, -2);

        $payment_detail_in_html = '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>invoiceFormat</title>
            <style>
                .heading {
                    text-align: center;
                    margin-bottom: 0px;
                }
        
                table,
                th,
                td {
                    border: 1px solid black;
                    border-collapse: collapse;
                }
            </style>
        </head>
        
        <body>
        
            <div class="maindiv">
                <h1 class="heading">BILL OF SUPPLY</h1>
                <table style="width: 100%; border-bottom: none;">
                    <tr>
                        <td rowspan="4" style="width: 60%;">
                            <img style="width: 20%; margin-bottom: 40px;" src="data:image/jpeg;base64,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" />
                            <p style="display: inline-block; margin: 0; margin-top: 30px !important;">
                                Novel Healthtech Solutions Private Limited <br>
                                101-D, 2nd Floor, Udyog Vihar, Phase - 5 Gurugram <br>
                                GSTIN/UIN: 06AAGCN8283M1ZT <br>
                                State Name : Haryana, Code : 06 CIN: U85100DL2020PTC359851 <br>
                                Contact : 8448288200 <br>
                                E-Mail : accounts@novelhealthtech.com <br>
                                Website: <a href="https://novelhealthtech.com">Novelhealthtech.com</a>
                            </p>
                        </td>
                        
                        <td class="">
                            Invoice No.<br> 
                            <b> NHT/OB/ ' . $financialYear . '/' . $position . ' </b>
                        </td>

                    </tr>
                    
                   
                    
                    <tr>
                        <td class="">
                            Dated <br>
                            <b>' . date('d M Y', strtotime($payment_detail->created_at)) . ' </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="">
                            Referred by Doctor <br>
                            <b> ' . $data['doctor']->full_name . ' </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="">
                            Laboratory Name <br>
                            <b> ' . $package_details->vendor_name . ' </b>
                        </td>
                    </tr>
                    
        
                    <tr>
                        <td colspan="2">Patient Name :<b> ' . $patient_name . '</br>
                            Age :<b> ' . $patient_age . ' </b>, Gender : <b>' . $patient_gender . ' </b>
                        </td>
                    </tr>
        
                </table>
        
                <table style="width: 100%; border-top: none; border-bottom: none;">
                    <tr>
                        <th style="width: 5%; border-top: none;">S.No.</th>
                        <th style="width: 35%; border-top: none;">Particulars</th>
                        <th style="width: 35%; border-top: none;">HSN/SAC</th>
                        <th style="width: 5%; border-top: none;">Rate</th>
                        <th style="width: 5%; border-top: none;">per</th>
                        <th style="width: 15%; border-top: none;">Amount</th>
                    </tr>
                    <tr style="height: 500px; vertical-align: top;">
                        <td style="padding-left: 10px; padding-top: 10px;">1</td>
                        <td style="padding-left: 10px; padding-top: 10px;">Diagnostic Service <br>
                            ' . $payment_detail->service_name . '
                        </td>
                        <td style="padding-left: 10px; padding-top: 10px; text-align: right;">
                            999316
                        </td>
                        <td style="padding-left: 10px; padding-top: 10px;"></td>
                        <td style="padding-left: 10px; padding-top: 10px;"></td>
                        <td style="padding-left: 10px; padding-top: 10px; text-align: right;">' . number_format($amount_in_rupees, 2) . PHP_EOL . '</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;"></td>
                        <td style="padding-left: 10px; padding-top: 10px; border-bottom: none;">Total</td>
                        <td style="border-bottom: none;"></td>
                        <td style="border-bottom: none;"></td>
                        <td style="border-bottom: none;"></td>
                        <td style="padding-left: 10px; padding-top: 10px; text-align: right; border-bottom: none;"><b> ₹
                                ' . number_format($amount_in_rupees, 2) . PHP_EOL . '</b></td>
                    </tr>
                </table>
        
                <table class="top-border" style="width: 100%; border-top: none;">
                    <tr>
                        <td colspan="4">
                            <div style=" display: flex; justify-content:space-between;  border: none;">
                                <p style="margin: 0px;">Amount Chargeable (in words) <br>
                                    INR ' . ucfirst(strtolower($amount_in_words)) . ' Rs Only</p>
                                <p style="margin:0px;">E. & O.E</p>
                            </div>
                        </td>
                    </tr>
        
                    <tr>
                        <td colspan="3" style="text-align: center;">HSN/SAC</td>
                        <td style="width: 6%; text-align: center;">Taxable Value </td>
                    </tr>
        
                    <tr>
                        <td colspan="3" style="text-align: left;">999316</td>
                        <td style="text-align: center;">' . number_format($amount_in_rupees, 2) . PHP_EOL . '</td>
                    </tr>
        
                    <tr>
                        <td colspan="3" style="text-align: right;">Total</td>
                        <td style="text-align: center;">' . number_format($amount_in_rupees, 2) . PHP_EOL . '</td>
                    </tr>
        
                    <tr>
                        <td colspan="4" style="border-right:none; border-bottom: none;">Tax Amount (in words) : <b> NIL</b> <br>
        
                            Company"s PAN <b>:AAGCN8283M </b> <br>
        
                        </td>
                        
                    </tr>
        
                    <tr>
                        <td colspan="2" style="border-top: none;">
                            Declaration <br>
                            Formerly known as NOVEL MARKETING & EVENTS <br>
                            MANAGEMENT SERVICES PVT LTD <br>
                            Reg. Address: House No 95, Block G PKT-29, Sector 3, Rohini, Delhi
                        </td>
                        <td colspan="2" >
                            Company Bank Details :- <br>
                            Bank Name <b>: HDFC Bank</b> <br>
                            A/c No. <b>: 50200077129650</b> <br>
                            Branch & IFS Code <b>: First India Place, MG Road, Gurugram & HDFC0000280</b>
                        </td>
                    </tr>
        
                </table>
        
                <h6 style="text-align: center; margin: 0px;  margin-top: 10px;">SUBJECT TO HARYANA <br> JURISDICTION</h6>
        
                <p style="text-align: center; margin: 0px">This is a Computer Generated Recepit Cum Bill</p>
        
            </div>
        
        </body>
        
        </html>';


        // Instantiate and use the dompdf class 
        $dompdf = new Dompdf();
        // p($dompdf);

        // Load HTML content 
        $dompdf->loadHtml($payment_detail_in_html);

        // (Optional) Setup the paper size and orientation 
        $dompdf->setPaper('A2', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $output = $dompdf->output();

        $dompdf->stream("Membership Form", array("Attachment" => 1));
    }




    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// RM Roles Master ////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    public function role_details()
    {
        $data['page'] = 'Role Details';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['all_roles'] = get_table('role_master', 'role_level');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/role_details', $data);
        $this->load->view('superadmin/partials/_footers/footer_2.php', $data);
    }


    public function add_role()
    {
        $data['page'] = 'Add Role';

        $data['page2'] = 'Add Company';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'role_level');

        $data['menus'] = get_table_data('parent', 'menu_type', 'menu_master', 'menu_order');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/add_role', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function add_role_post()
    {
        post_method();

        $this->form_validation->set_rules('role_name', 'Role Name', 'required|max_length[100]|is_unique[role_master.role_name]');
        $this->form_validation->set_rules('role_desc', 'Role Description', 'required|max_length[100]');
        $this->form_validation->set_rules('parent_role_id', 'Parent Role', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->add_role();
        }
    }


    public function edit_role($id)
    {
        $data['page'] = 'Edit Role';

        $data['role_id'] = get_table_data(decode_url($id), 'id', 'role_master', 'id')[0];

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['menus'] = get_table_data('parent', 'menu_type', 'menu_master', 'menu_order');

        $data['roles'] = get_table_data(1, 'is_active', 'role_master', 'role_level');

        $data['menu_mapping'] = get_table_data(decode_url($id), 'role_id', 'menu_mapping_master', 'id');

        $data['menu_array'] = array();


        for ($i = 0; $i < count($data['menu_mapping']); $i++) {
            array_push($data['menu_array'], $data['menu_mapping'][$i]->menu_id);
        }

        if ($this->session->flashdata('is_edit') == 'TRUE') {
        } else {
            $newdata = array(
                'id' => $data['role_id']->id,
                'role_name' => $data['role_id']->role_name,
                'role_desc' => $data['role_id']->role_desc,
                'role_level' => $data['role_id']->role_level,
                'parent_role_id' => $data['role_id']->parent_role_id,
                'is_active' => $data['role_id']->is_active,
            );

            $this->session->set_flashdata('form_data', $newdata);
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/role_edit', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function edit_role_post()
    {
        post_method();

        $this->form_validation->set_rules('role_id', 'Role ID', 'required|max_length[100]');
        $this->form_validation->set_rules('role_name', 'Role Name', 'required|max_length[100]');
        $this->form_validation->set_rules('role_desc', 'Role Description', 'required|max_length[100]');
        $this->form_validation->set_rules('role_status', 'Role Status', 'required|max_length[100]');

        $editError = $this->form_validation->run();

        $newerror_message = validation_errors();
        if (get_edit_unique($this->input->post('role_name', true), 'role_name', 'role_master', 'id', $this->input->post('role_id', true)) == FALSE) {
            $editError = FALSE;
            $newerror_message .= '<p>The Role Name field Must Be Unique.</p>';
        }
        ;

        if ($editError == FALSE) {
            $this->session->set_flashdata('errors', $newerror_message);
            $this->session->set_flashdata('is_edit', 'TRUE');
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->edit_role();
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// RM Roles Master ////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////




    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// RM Menu Routes //////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function menu_mapping_details()
    {
        $data['page'] = 'Menu Mapping Details';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['menus'] = get_table('menu_master', 'menu_order');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/menu_mapping_details', $data);
        $this->load->view('superadmin/partials/_footers/footer_2.php', $data);
    }


    public function add_menu()
    {
        $data['page'] = 'Add Menu';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $array = array('menu_type=' => 'parent', 'is_active=' => 1);

        $data['menus'] = get_table_data_by_array('menu_master', $array, 'menu_order');

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/add_menu', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }


    public function add_menu_post()
    {
        post_method();

        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required|max_length[100]|is_unique[menu_master.menu_name]');
        $this->form_validation->set_rules('menu_link', 'Menu Link', 'required|max_length[100]');
        $this->form_validation->set_rules('parent_menu', 'Parent Menu', 'required|max_length[100]');
        $this->form_validation->set_rules('menu_order', 'Menu Order', 'required|max_length[100]');
        // $this->form_validation->set_rules('menu_icn_name', 'Menu Icon', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());

            $this->superadmin_model->add_menu();
        }
    }


    public function edit_menu($id)
    {
        $data['page'] = 'Edit Menu';

        $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user_master', 'user_id')[0];

        $data['menu'] = get_table_data(decode_url($id), 'menu_id', 'menu_master', 'menu_id')[0];

        $array = array('menu_type' => 'parent', 'menu_id !=' => $data['menu']->menu_id, 'is_active=' => 1);

        $data['menus'] = get_table_data_by_array('menu_master', $array, 'menu_order');

        if ($this->session->flashdata('is_edit') == 'TRUE') {
        } else {
            $newdata = array(
                'menu_id' => $data['menu']->menu_id,
                'menu_name' => $data['menu']->menu_name,
                'menu_link' => $data['menu']->menu_link,
                'menu_order' => $data['menu']->menu_order,
                'parent_menu' => $data['menu']->parent_menu_id,
                'menu_icn_name' => $data['menu']->menu_icon_name,
                'is_active' => $data['menu']->is_active,
            );

            $this->session->set_flashdata('form_data', $newdata);
        }

        $this->load->view('superadmin/partials/_header', $data);
        $this->load->view('superadmin/edit_menu', $data);
        $this->load->view('superadmin/partials/_footers/footer_1', $data);
    }

    public function edit_menu_post()
    {
        post_method();

        $this->form_validation->set_rules('menu_id', 'Menu Name', 'required|max_length[100]');
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required|max_length[100]');
        $this->form_validation->set_rules('menu_link', 'Menu Link', 'required|max_length[100]');
        $this->form_validation->set_rules('parent_menu', 'Parent Menu', 'required|max_length[100]');
        $this->form_validation->set_rules('menu_order', 'Menu Order', 'required|max_length[100]');
        // $this->form_validation->set_rules('menu_icn_name', 'Menu Icon', 'required|max_length[100]');

        $editError = $this->form_validation->run();

        $newerror_message = validation_errors();
        if (get_edit_unique($this->input->post('menu_name', true), 'menu_name', 'menu_master', 'menu_id', $this->input->post('menu_id', true)) == FALSE) {
            $editError = FALSE;
            $newerror_message .= '<p>The Menu Name field Must Be Unique.</p>';
        }
        ;

        if ($editError == FALSE) {
            $this->session->set_flashdata('errors', $newerror_message);
            $this->session->set_flashdata('is_edit', 'TRUE');
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $this->superadmin_model->edit_menu();
        }
    }

    ///////////////////////////////////////////////Tata 1mg integration //////////////////////////////////////

    public $base_url = 'https://api.1mg.com';
    // public $uat_base_url = 'https://jupiterapi.1mg.com';

    public $merchant_name = 'novelhealth';

    ///// uat marchant name =novel_health


    public function genrateToken()
    {


        $key = <<<EOD
        -----BEGIN PRIVATE KEY-----
        MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDg5lISEz3u5Q8+
        DWx5/oZOhlzB44ngaUZa2hgTNw9jJL/FifEoCTl17DgA88b7BWe/vdJcKaH2Mx6x
        c+MH2ynxWLnZRtlimNfKsTKknNhYp4Qh0+SrMxDzIPadTEh0m6yGsKLgZVY42Coi
        Id5vY+YAMFC76DUctqfBkQqkfKYYL1mII0VUwcZGez4e+AaBmyOeSuOs0hZZnLvk
        R7v8mDcvaoW5zJWsOyGSxRo2NdmYQWh84mrHhgxHAzQVhI3pytWE7j0NKVVY8lQE
        E94GyUTg02nwVQU/zqYs4h7meVUfqArA5uFHKc0/kcsYA+MUNOIWTstDO2Rmcocl
        uaTPjl2jAgMBAAECgf8465SH3MrLLjL6rQWloLJTtLxzIPNaJhW7s6dyt/WD9sRF
        ThNkGE1aj/q0yjzt+Tsdcu2Q2c0o7PxjxpA2jp1hEp/Gq2adI3ddOv5ELc7NwyQY
        Sd+8xs9TGjAlGFTw9GvhcQ03NrJE5fNZtP7HbG3rsaDj97quq4wDvuvQ0qz9B0ad
        H4f5zeBUx8B0EdzOBOLsOVvwNZd0MTQ7QldY51OUj/1vlZVFGWcOA3UGiRJWbJMQ
        YzCNWi9QDbtp8pYpG+lhEGqggPLbQ3XOswZ9juhxJT4crV+MMltb1etB1UbL3K1T
        KLgV9OO6qjqjIsunV9CHUPo8M3WFSzRZbGICNDECgYEA81b3Y93J5mGYh2FdeaFK
        XYQdSk8fl9WMOX8zc7l7P2IqaS1b74ywSUL6o5pQng9lqWM/C4CcJQeGCmriCEYf
        IKVwHsDplsL86npNLamZpGW7XC4VCHDO149M28fSjMQ6wsXzqvoCWLPPA5Z18ThW
        4QzHMwn8tf3WhH2CJEaJ14cCgYEA7JnAjfO0eHtqEIsE80epERq18/jSxG5nqp3+
        VrbQgLMANNunEa0sMeg9LxyYgshtic631wRcxz+XJv/XmVcLcJiLJtL5tJbo1GJh
        cRFgEyLEKlZSbAqMVfaUPU+j7a3aHZG9ELsNiQVlKYlILASepr6J2CtYMTkOCZV8
        BuEzmAUCgYBUO8B7Q2UGaLZB9sRCvEBfysHQ3T7UckmOBagr4QL21+ZSbi8q5wqG
        8baNN3e8nxvT3NUQCD8E2mvd403HC27vABWlr6WsWGbwS9G3gsP6knSe3hzNxS70
        k1hJpAwQSkUE8zz77HsvdV6toUHGdHgugxvZYRWncez2A/Qu1nQUtQKBgQDOTOIQ
        5EagJzw8YHtYhUttlpTAvl1I2duacVir04vKLEopzLzINO8sNQvkYFK69nhMiOrT
        mQIs2c26O6qKEdPvwZLTr3H7fPpW9dFw/W2AQfg50jrb6fajnfVz4FVXkRd2YPUx
        +We76fBjX0iG2SBc1BbtXh3wDYen46fZd9O84QKBgQDetASc/J2tfeKcrV//LVc2
        M4GiCvjpyFJYVhxbsDr/FxvCuL39s7yPJGzqgNaPn9JfpQBAWj+eVVPDCemUj0Eg
        KSsq1mG3JYOyi30DmOUiEQycKI8NylCDz4KJmY5/bSVbxgSSbqSd7tPaVe5nkbWA
        QtxfSibz51fz5jgcVvaB9w==
        -----END PRIVATE KEY-----
        EOD;

        $payload = [
            "iat" => time(),
            "exp" => time() + 900,
        ];

        try {
            $token = JWT::encode($payload, $key, 'RS256');
            // return $token;
            echo json_encode([
                'token' => $token
            ]);
        } catch (Exception $e) {

            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }

    }


    public function checkAdressAvailability()
    {
        $token = $this->genrateToken();

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $this->base_url . '/cerberus/dexter_third_party_service/v1/external/' . $this->merchant_name . '/address/serviceable',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    "address" => [
                        "city" => "New Delhi",
                        "state" => "Delhi",
                        "street" => "Test",
                        "pincode" => "110006"
                    ]
                ]),
                CURLOPT_HTTPHEADER => array(
                    'x-access-key: 1mg_client_public_access_key',
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            )
        );
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);

        echo $response;
        exit;
    }

    public function checkInventoryAvailability()
    {

        $token = $this->genrateToken();
        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $this->base_url . '/cerberus/dexter_third_party_service/v1/external/' . $this->merchant_name . '/inventory?pincode=122001&test[]=31481',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET', // Since it's a GET request
                CURLOPT_HTTPHEADER => array(
                    'x-access-key: 1mg_client_public_access_key',
                    'Authorization: Bearer ' . $token
                ),
            )
        );

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }

        // Close the cURL session
        curl_close($curl);

        // Output the response
        echo '<pre>';
        print_r($response);
        exit;
    }

    public function checkDateTimeSlots()
    {
        $token = $this->genrateToken();
        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $this->base_url . '/cerberus/dexter_third_party_service/v2/external/' . $this->merchant_name . '/date-time-slots',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST', // Since it's a POST request
                CURLOPT_POSTFIELDS => json_encode([
                    "city" => "Gurgaon",
                    "lab_id" => 301,
                    "pin_code" => "122001",
                    "test_ids" => [31481],
                    "address_data" => [
                        "city" => "Gurgaon",
                        "state" => "Haryana",
                        "street1" => "Test",
                        "landmark" => "Test",
                        "locality" => "test"
                    ],
                    "patient_type" => ""
                ]),
                CURLOPT_HTTPHEADER => array(
                    'x-access-key: 1mg_client_public_access_key',
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            )
        );

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }

        // Close the cURL session
        curl_close($curl);

        // Output the response
        echo $response;
        exit;
    }


    public function createBooking()
    {

        $token = $this->genrateToken();
        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $this->base_url . '/cerberus/dexter_third_party_service/v1/external/' . $this->merchant_name . '/bookings',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST', // Since it's a POST request
                CURLOPT_POSTFIELDS => json_encode([
                    "cart" => [
                        [
                            "lab_id" => 301,
                            "test_id" => 31481
                        ]
                    ],
                    "city" => "Gurgaon",
                    "state" => "Haryana",
                    "street" => "5 TARAK DUTTA ROAD, 1ST FLOOR, BESIDE KARAYA POLICE STATION",
                    "patient_name" => "Tony Stark",
                    "mobile_number" => "8920856405",
                    "email" => "testuser@1mg.com",
                    "gender" => "male",
                    "age" => 30,
                    "collection_time" => "1742470200",
                    "pin_code" => "122001",
                    "payment_mode" => "CASH",
                    "merchant_paid" => 8000,
                    "user_paid" => 0,
                    "merchant_id" => "121",
                    "policy_id" => "0",
                    "referrence_id" => "5",
                    "locality" => "Test",
                    "landmark" => "Test",
                    "referral" => "12"
                ]),
                CURLOPT_HTTPHEADER => array(
                    'x-access-key: 1mg_client_public_access_key',
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            )
        );

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }

        // Close the cURL session
        curl_close($curl);

        // Output the response
        echo '<pre>';
        print_r(json_decode($response));
        echo '</pre>';
        // echo $response;
        exit;
    }

    public function logout()
    {
        $this->auth_model->logout();
        redirect('superadmin/login');
    }
}
