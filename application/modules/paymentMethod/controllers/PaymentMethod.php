<?php
/**
 * PaymentMethod Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation    25-July-2018
 * @DateOfDeprecated
 * @ShortDescription
 * @LongDescription   This class implement the payment method CRUD and chekout functionality
 */
class PaymentMethod extends MX_Controller
{
    public function __construct()
    {
        $this->load->helper(array('url','encryption','form'));
        $this->load->library('session');
        $this->load->model('PaymentMethod_Model');
        $this->load->library('cart');
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function displays all available payment method with edit,delete and view link
     */
    public function index()
    {
        $table_name = "payment_method";
        $array = array('payment_method_id','payment_method_name');
        $where_array = array('is_deleted'=>1);
        $data['payment_method_info'] = $this->PaymentMethod_Model->select($array, $table_name, $where_array);
        $data['title']="Payment Method List";
        $this->load->view('header', $data);
        $this->load->view('PaymentMethodList', $data);
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Display form for updating data if id availble otherwise form for data insertion is displayed
     * @LongDescription
     * @param string $payment_method_id [encrypted payment method id ]
     */
    public function AddOrUpdatePaymentMethod($payment_method_id = '')
    {
        $data['payment_method_id'] = $payment_method_id;
        $data['payment_method_info'] = [];
        if ($payment_method_id != '') {
            $data['title']="Update Payment Method Details";
            $array = array('payment_method_id','payment_method_name');
            $table_name = "payment_method";
            $where_array = array('payment_method_id' => aes256decrypt($payment_method_id));
            $data['payment_method_info'] = $this->PaymentMethod_Model->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add Payment Method Details';
        }
        if ($this->validatePaymentMethodData($payment_method_id) == false) {
            $this->load->view('header', $data);
            $this->load->view('AddOrUpdatePaymentMethod', $data);
            $this->load->view('footer');
        } else {
            $payment_method_name = $this->input->post('payment_method_name');
            if (isset($payment_method_id)&& $payment_method_id!='') {
                $table_name = 'payment_method';
                $update_array = ['payment_method_name' => $payment_method_name];
                $where_array=['payment_method_id' => aes256decrypt($payment_method_id)];
                if ($this->PaymentMethod_Model->update($table_name, $update_array, $where_array)) {
                    redirect('paymentMethod/');
                }
            } else {
                $table_name = 'payment_method';
                $insert_array = ['payment_method_name' => $payment_method_name];
                if ($this->PaymentMethod_Model->insert($table_name, $insert_array)) {
                    redirect('paymentMethod/');
                }
            }
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the payment method form
     * @LongDescription
     * @param  string $payment_method_id [ Encrypted Payment Method Id]
     * @return [boolean]       [true or false]
     */
    public function validatePaymentMethodData($payment_method_id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('payment_method_name', 'Payment Method Name', 'required');
        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the checkout data
     * @LongDescription
     * @return [boolean]       [true or false]
     */

    public function validateCheckOutData()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('city', 'city', 'trim|required');
        $this->form_validation->set_rules('state', 'state', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('zip_code', 'zip code', 'trim|required');
        $this->form_validation->set_rules('mobile_number', 'phone number', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('payment_method_name', 'payment_method_name', 'trim|required|is_natural_no_zero', ['is_natural_no_zero' => 'Please Select Payment Method']);
        if (!isset($this->session->user_id)) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'required|matches[password]');
        }
        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Delete the payment method data
     * @LongDescription
     * @param  string $payment_method_id [ Encrypted Payment Method Id]
     */

    public function DeletePaymentMethodData($payment_method_id)
    {
        $table_name = "payment_method";
        $where_array = array('payment_method_id' => aes256decrypt($payment_method_id) );
        $this->PaymentMethod_Model->delete($table_name, $where_array);
        redirect('paymentMethod/');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Show the payment method data
     * @LongDescription
     * @param  string $payment_method_id [ Encrypted Payment Method Id]
     */
    public function ShowPaymentMethodData($payment_method_id = '')
    {
        $array = array('payment_method_id','payment_method_name');
        $table_name = "payment_method";
        $where_array = array('payment_method_id' => aes256decrypt($payment_method_id) );
        $data['payment_method_info'] = $this->PaymentMethod_Model->select($array, $table_name, $where_array);
        $this->load->view('header', $data);
        $this->load->view('viewSinglePaymentMethodInfo', $data);
        $this->load->view('footer');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Display the checkout form
     * @LongDescription
     */
    public function CheckOut()
    {
        $this->load->library('cart');
        $product_details = json_encode($this->cart->contents());
        $user_id = $this->session->user_id;
        $user_email = $this->session->user_email;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $this->load->helper('form');
        $data['user_id'] = $user_id;
        $data['user_info'] = [];
        if ($user_id != '') {
            $array = array('user_id','user_firstname','user_lastname','user_email','user_mobile','user_country','user_city','user_zipcode','user_state','user_address');
            $table_name = "users";
            $where_array = array('user_id' => aes256decrypt($user_id));
            $data['user_info'] = $this->PaymentMethod_Model->select($array, $table_name, $where_array);
        }
        if ($this->validateCheckOutData()==false) {
            $payment_methods= $this->PaymentMethod_Model->select(['payment_method_id','payment_method_name'], 'payment_method');
            foreach ($payment_methods as $row) {
                $paymentmethods[$row['payment_method_id']] = $row['payment_method_name'];
                # code...
            }
            $data['payment_methods'] = $paymentmethods;
            $this->load->view('header');
            $this->load->view('CheckOut', $data);
        } else {
            $firstname = $this->input->post('first_name');
            $lastname = $this->input->post('last_name');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $mobile_number = $this->input->post('mobile_number');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $zip_Code = $this->input->post('zip_code');
            if ($user_id == '') {
                $password = $this->input->post('password');
            }
            $payment_method = $this->input->post('payment_method_name');
            if ($user_id=='') {
                $table_name = "users";
                $password = $this->input->post('password');
                $insert_array = [ 'user_firstname' => $firstname,'user_lastname'=>$lastname, 'user_email' => $email,'user_password' => sha1($password),'user_mobile' => $mobile_number ,'ip_address'=>$ip_address,'user_country'=>$country,'user_state' => $state,'user_city' => $city,'user_address'=>$address];
                $this->PaymentMethod_Model->insert($table_name, $insert_array);
                $user_id =  $this->db->insert_id();
                $insert_array = [ 'user_id' => $user_id,'payment_method_id'=>$payment_method,'product_details'=>$product_details];
                $this->PaymentMethod_Model->insert('order', $insert_array);
                $this->load->view('header');
                echo "<div class='alert alert-success'>Your Order Has Been Placed</div>";
            } else {
                $table_name = "users";
                $update_array = ['user_firstname' => $firstname,'user_lastname'=>$lastname, 'user_email'=>$email,'user_mobile' => $mobile_number,'ip_address'=>$ip_address,'user_country'=>$country,'user_state' => $state,'user_city' => $city,'user_address'=>$address];
                $where_array = array('user_id' => aes256decrypt($user_id));
                $user_id = aes256decrypt($user_id);
                $this->PaymentMethod_Model->update($table_name, $update_array, $where_array);
                $insert_array = [ 'user_id' => $user_id,'payment_method_id'=>$payment_method,'product_details'=>$product_details];
                $this->PaymentMethod_Model->insert('order', $insert_array);
                $this->load->view('header');
                echo "<div class='alert alert-success'>Your Order Has Been Placed</div>";
            }
        }
    }
}
