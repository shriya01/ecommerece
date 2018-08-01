<?php 
/**
 * User Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation    25-July-2018
 * @DateOfDeprecated
 * @ShortDescription
 * @LongDescription   This class manages user CRUD at admin access level
 */
class User extends MX_Controller
{
    public function __construct()
    {
        # code...
        $this->load->helper(array('url','encryption'));
        $this->load->model('User_Model');
        $this->load->library('session');
    }
    /**
    * @DateOfCreation     1-July-2018
    * @DateOfDeprecated
    * @ShortDescription   This function displays the list of all availble user whose user type is not admin
    * @LongDescription
    */
    public function index()
    {
       
        $table_name = "users";
        $array = array('user_id','user_firstname','user_lastname','user_gender','user_email','user_mobile');
        $where_array=array('is_deleted'=>1,'user_type_id'=>2);
        $data['user_info'] = $this->User_Model->select($array, $table_name, $where_array);
        $data['title']="User Information";
        $this->load->view('header', $data);
        $this->load->view('userlist', $data);
        $this->load->view('footer');
    }
    /**
    * @DateOfCreation     1-July-2018
    * @DateOfDeprecated
    * @ShortDescription    Delete user information from dataBase
    * @LongDescription
    * @param  string $user_id [User Encrypted Id]
    */
    public function deleteUserData($user_id = '')
    {
        $table_name = "users";
        $where_array = array('user_id' => aes256decrypt($user_id) );
        $this->User_Model->delete($table_name, $where_array);
        redirect('user');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Display form for updating data if id availble other form for data insertion is displayed
     * @LongDescription
     * @param string $user_id [description]
     */
    public function addOrUpdateData($user_id = '')
    {
         $ip_address = $_SERVER['REMOTE_ADDR'];
        $this->load->helper('form');
        $data['user_id'] = $user_id;
        $data['user_info'] = [];
        if ($user_id != '') {
            $data['title']="Update User";
            $array = array('user_id','user_firstname','user_lastname','user_email','user_mobile','user_gender');
            $table_name = "users";
            $where_array = array('user_id' => aes256decrypt($user_id));
            $data['user_info'] = $this->User_Model->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add User';
        }
        if ($this->validateUserData($user_id) == false) {
            $this->load->view('header', $data);
            $this->load->view('addOrUpdateUser', $data);
            $this->load->view('footer');
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $mobileNumber = $this->input->post('mobileNumber');
            $gender = $this->input->post('gender');
            if ($user_id=='') {
                $table_name = "users";
                $password = $this->input->post('password');
                $insert_array = [ 'user_firstname' => $firstname,'user_lastname'=>$lastname, 'user_email' => $email,'user_password' => sha1($password),'user_mobile' => $mobileNumber ,'ip_address'=>$ip_address,'user_gender'=>$gender];
                $this->User_Model->insert($table_name, $insert_array);
                redirect('user/');
            } else {
                $table_name = "users";
                $update_array = ['user_firstname' => $firstname,'user_lastname'=>$lastname, 'user_email'=>$email,'user_mobile' => $mobileNumber,'ip_address'=>$ip_address,'user_gender'=>$gender];
                $where_array = array('user_id' => aes256decrypt($user_id));
                $user_id = aes256decrypt($user_id);
                if ($is_unique_email = $this->User_Model->is_unique_email($email, $user_id)) {
                    $this->User_Model->update($table_name, $update_array, $where_array);
                    redirect('user/');
                } else {
                    $this->session->set_flashdata('error', 'Email Already Exists');
                    redirect('user/addOrUpdateData/'.aes256encrypt($user_id));
                }
            }
        }
    }
     /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the user form
     * @LongDescription
     * @param  string $user_id [User Encrypted Id]
     * @return [boolean]       [true or false]
     */
    public function validateUserData($user_id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    if ($user_id == '') :
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.user_email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        else:
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        endif;
        $this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');
        $this->form_validation->set_rules('gender','Gender','required');
        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Show User data From Database
     * @LongDescription
     * @param  string $user_id [User Encrypted Id]
     */
    public function showUserData($user_id = '')
    {
        $array = array('user_id','user_firstname','user_email','user_mobile');
        $table_name = "users";
        $where_array = array('user_id' => aes256decrypt($user_id) );
        $data['user_info'] = $this->User_Model->select($array, $table_name, $where_array);
        $this->load->view('header', $data);
        $this->load->view('viewUserData', $data);
        $this->load->view('footer');
    }
}
