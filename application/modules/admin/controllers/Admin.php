<?php 
/**
 * Admin Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation    25-July-2018
 * @DateOfDeprecated
 * @ShortDescription
 * @LongDescription   This class manages user at admin access level
 */
class Admin extends MX_Controller
{
    public function __construct()
    {
        $this->load->helper(array('url','encryption'));
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->model('Admin_Model');
    }
    function success()
    {
        echo "mail sent";
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function checks the login credentials and after successful authentication redirects to admin home page
     * @LongDescription
     */
    public function index()
    {
        //check if admin email session is set or not
        if (isset($this->session->admin_email)) {
            redirect('admin/home', 'refresh');
        } else {
            //Loading The form helper
            $this->load->helper('form');
            // Initializes the form_validation library class
            $this->load->library('form_validation');
            //Setting Rules for input fields by calling set_rules method of form_validation library class
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Page';
                //Loading login Form with error messages if data is not properly validated
                $this->load->view('header', $data);
                $this->load->view('loginform');
            //  $this->load->view('footer');
            } else {
                //Fetching values from post arrays if data is properly validated
                $email=$this->input->post('email');
                $password=sha1($this->input->post('password'));
                //Calling is_valid_user function from Pms_model class by providing email and password fetched from post array
                if ($user_valid=$this->Admin_Model->isValidUser($email, $password)) {
                    //If is_valid_user function returns true saving data to userdata array
                    $userdata=array('admin_email'=>$email,'password'=>$password);
                    //assigning userdata array to session variable by calling set_userdata method of session class to allow backward compatiblity
                    $this->session->set_userdata($userdata);
                    //redirecting to home
                    redirect('admin/home', 'refresh');
                } else {
                    // Set message
                    $this->session->set_flashdata('loginFailed', 'Email Or Password Is Incorrect');
                    redirect('admin');
                }
            }
        }
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Displays The Admin Dashboard
     * @LongDescription
     */
    public function home()
    {
        //check if admin email session is set or not
        if (isset($this->session->admin_email)) {
            $data['title'] = 'Admin Dashboard';
            $this->load->view('header', $data);
            $this->load->view('navigation');
        } else {
            redirect('admin');
        }
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function destroys the current session and redirects to login page
     * @LongDescription
     */
    public function logout()
    {
        //destroy the session
        $this->session->sess_destroy();
        redirect('admin/');
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   executes the forgot password script
     * @LongDescription
     */
    public function forgotPassword()
    {
         if (isset($this->session->admin_email)) {    
            redirect('admin/home');
        } else {
           
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 5; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $password = implode($pass); //turn the array into a string

$this->load->library('email');
$this->email->set_newline("\r\n");
$this->email->from('jain.shriya@fxbytes.com', 'sender shriya');
$this->email->to('jain.shriya@fxbytes.com');
$this->email->cc('jain.shriya@fxbytes.com');
$this->email->bcc('jain.shriya@fxbytes.com');

$this->email->subject('Email Test');
$this->email->message('Hi Its Your New password '." :-    ".$password."  ."."You can update it anytime according to your convience thank you");

  if($this->email->send())
     {
      redirect('/admin');
     }

   }
    }
  
}
