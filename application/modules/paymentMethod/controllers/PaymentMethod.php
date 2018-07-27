<?php
class PaymentMethod extends MX_Controller
{
	public function __construct()
    {
        $this->load->helper(array('url','encryption','form'));
        $this->load->library('session');
        $this->load->model('PaymentMethod_Model');
    }
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $table_name = "payment_method";
        $array = array('payment_method_id','payment_method_name');
        $where_array = array('is_deleted'=>1);
        $data['payment_method_info'] = $this->PaymentMethod_Model->select($array, $table_name,$where_array);
        $data['title']="Payment Method List";
        $this->load->view('header', $data);
        $this->load->view('PaymentMethodList', $data);
    }
    /**
     * [AddOrUpdatePaymentMethod description]
     * @param string $payment_method_id [description]
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
    * @ShortDescription   Validate the category form
    * @LongDescription
    * @param  string $user_id [User Encrypted Id]
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
     public function validateCheckOutData()
    {
$this->load->library('form_validation');
    $this->form_validation->set_rules('country', 'country', 'trim|required');
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
    $this->form_validation->set_rules('address', 'address', 'trim|required');
    $this->form_validation->set_rules('city', 'city', 'trim|required');
    $this->form_validation->set_rules('state', 'state', 'trim|required');
     $this->form_validation->set_rules('zip_code', 'zip code', 'trim|required');
    $this->form_validation->set_rules('phone_number', 'phone number', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    
    //$this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');

            if ($this->form_validation->run() == false) 
            {

                $this->load->view('header');
                $this->load->view('CheckOut');
            } 
            else 
            {
                return true;
            }
        } 
        
    

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
     * @ShortDescription   Show product from the database of the product id specified
     * @LongDescription
     * @param string $product_id
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


    public function CheckOut()
    {
                $this->load->view('header');
        $this->load->view('CheckOut');
    }
}
?>