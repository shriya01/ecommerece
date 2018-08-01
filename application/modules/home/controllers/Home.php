<?php 
/**
 * Home Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation    25-July-2018
 * @DateOfDeprecated
 * @ShortDescription
 * @LongDescription   This class implement the login,registration and all other functionality at user access level
 */
class Home extends MX_Controller
{
    public function __construct()
    {
        $this->load->helper(array('url','encryption','form'));
        $this->load->library(array('session'));
        $this->load->model('Home_Model');
        # code...
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function displays the shop grid
     */
    public function index()
    {
        $data['title'] = "HOME";
        $this->load->view('includes/header', $data);
        $this->load->view('navigation');
        $data['product_info'] = $this->Home_Model->select(['product_id','product_name','product_description','product_price','product_image','product_selling_price'], 'products');
        $this->load->view('shop', $data);
        $this->load->view('footer');
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function implements the registration functionality and insert user to database after successful validation  
     */
    public function register()
    {
        $data['title'] = 'Registration Form';

        if ($this->registerValidate() == false) {
            $this->load->view('includes/header', $data);
            $this->load->view('registerform');
            $this->load->view('footer');
        } else {
            $table_name = "users";
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $mobileNumber = $this->input->post('mobileNumber');
            $gender = $this->input->post('gender');
            $insert_array = [ 'user_firstname' => $firstname,'user_lastname'=>$lastname, 'user_email' => $email,'user_password' => sha1($password),'user_mobile' => $mobileNumber ,'ip_address'=>$ip_address];
            $this->Home_Model->insert($table_name, $insert_array);
            redirect('home/');
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the user registration form
     * @LongDescription    Apply validation rules and return result
     * @return [boolean]   [true or false]
     */
    public function registerValidate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.user_email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Displays the user login form, authenticate it and redirect to login after successful authentication
     * @LongDescription
     */
    public function login()
    {
        $data['title'] = 'User Login Form';
        if ($this->loginValidate() == false) {
            $this->load->view('header', $data);
                        $this->load->view('loginform');
            $this->load->view('footer');
        } else {
            $email = $this->input->post('email');
            $password = sha1($this->input->post('password'));
            //Calling is_valid_user function from Pms_model class by providing email and password fetched from post array
            if ($user_valid=$this->Home_Model->isValidUser($email, $password)) {
                $selectdata = $this->Home_Model->select(['user_id'],'users',['user_email'=>$email]);
                foreach ($selectdata as $key) {
                    $user_id = $selectdata[0]['user_id'];
                    # code...
                }
                //If is_valid_user function returns true saving data to userdata array
                $userdata=array('user_email'=>$email,'password'=>$password,'user_id'=>aes256encrypt($user_id));
                //assigning userdata array to session variable by calling set_userdata method of session class to allow backward compatiblity
                $this->session->set_userdata($userdata);
                //redirecting to home
                redirect('home/index', 'refresh');
            } else {
                // Set message
                $this->session->set_flashdata('loginFailed', 'Email Or Password Is Incorrect');
                redirect('home/login');
            }
        }
    }
    /**
     * @DateOfCreation     16-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the login form
     * @LongDescription
     * @return  [boolean] [true if validation successfully passed or false if validation fails]
     */
    public function loginValidate()
    {
        if (isset($this->session->user_email)) {
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
            if ($this->form_validation->run() == false) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
     * @DateOfCreation     16-July-2018
     * @DateOfDeprecated
     * @ShortDescription   logout user and redirects to login
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home/login');
    }
}
