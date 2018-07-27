<?php
class Product extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
  $this->load->model('ProductModel');
  $this->load->library(array('form_validation','session'));
	}
	/**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function insert all products
     * @LongDescription
     */

public function index()
    {
       
        $table_name = "products";
        $array = array('product_id','product_name','product_description','product_price','product_discount','prodect_selling_price');
        $where_array=array('is_deleted'=>1);
        $data['product_info'] = $this->ProductModel->select($array, $table_name, $where_array);
        $data['title']="product Information";
        $this->load->view('header', $data);
        $this->load->view('productlist', $data);
        $this->load->view('footer');
    }

public function addOrUpdateProduct($product_id = '')
    {
         $ip_address = $_SERVER['REMOTE_ADDR'];
        $this->load->helper('form');
        $data['product_id'] = $product_id;
        $data['product_info'] = [];
        if ($product_id != '') {
            $data['title']="Update Product";
            $array = array('product_id','product_name','product_description','product_price','product_discount','prodect_selling_price');
            $table_name = "products";
            $where_array = array('product_id' => aes256decrypt($product_id));
            $data['product_info'] = $this->ProductModel->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add Product';
        }
        if ($this->validateProductData($product_id) == false) {
            $this->load->view('header', $data);
            $this->load->view('addOrUpdateProduct', $data);
            $this->load->view('footer');
        } else {
            $productname = $this->input->post('product_name');
            $productdescription = $this->input->post('product_description');
            $productprice = $this->input->post('product_price');
            $productdiscount = $this->input->post('product_discount');
            $prodectsellingprice = $this->input->post('prodect_selling_price');
            $prodectcategory = $this->input->post('product_category_name');
            if ($product_id=='') {
                $table_name = "products";
                $insert_array = [ 'product_name' => $productname,'product_description'=>$productdescription, 'product_price' => $productprice,'product_discount' => $productdiscount ,'ip_address'=>$ip_address,'prodect_selling_price'=>$prodectsellingprice];
                $this->productModel->insert($table_name, $insert_array);
                redirect('product/');
            } else {
                $table_name = "products";
                $update_array = ['product_name' => $productname,'product_description'=>$productdescription, 'product_price'=>$productprice,'product_discount' => $productdiscount,'ip_address'=>$ip_address,'prodect_selling_price'=>$prodectsellingprice];
                $where_array = array('product_id' => aes256decrypt($product_id));
                $product_id = aes256decrypt($product_id);
              
                    $this->productModel->update($table_name, $update_array, $where_array);
                    redirect('product/');
            }
        }
    }

    public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload_success', $data);
                }
        } 

  /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function display all products
     * @LongDescription
     */
   public function productlist(){
   

  $query = $this->ProductModel->getProduct();
  $data['product_info'] = null;
  if($query){
   $data['product_info'] =  $query;
  }
  $this->load->view('header');
  $this->load->view('productlist.php', $data);
 }
 /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function update all products
     * @LongDescription
     */

 
    public function validateProductData($product_id)
    {
        if (isset($this->session->admin_email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productname', 'Product Name', 'required');
            $this->form_validation->set_rules('productdescription', 'product description', 'required');
            $this->form_validation->set_rules('productprice', 'product price', 'required');
            $this->form_validation->set_rules('productdiscount', 'product discount', 'required');
            $this->form_validation->set_rules('prodectsellingprice', 'prodect selling price', 'required');
            $this->form_validation->set_rules('prodectcategory', 'prodect category', 'required');

            if ($this->form_validation->run() == false) {
                return false;
            } else {
                return true;
            }
        } else {
            redirect('admin');
        }
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function delete row from data base
     * @LongDescription
     */

public function deleteProductData($product_id = '')
    {
        if (isset($this->session->admin_email)) {
            $table_name = "products";
            $where_array = array('product_id' => aes256decrypt($product_id) );
            $this->ProductModel->delete($table_name, $where_array);
            redirect('product/');
        } else {
            redirect('admin');
        }
    }

    public function showProductData($product_id = '')
    {
        if (isset($this->session->admin_email)) {
            $array = array('product_id','product_name','product_description','product_price','product_discount','prodect_selling_price');
            $table_name = "products";
            $where_array = array('product_id' => aes256decrypt($product_id) );
            $data['product_info'] = $this->ProductModel->select($array, $table_name, $where_array);
            $this->load->view('header', $data);
            $this->load->view('navigation');
            $this->load->view('viewSingleProductInfo', $data);
            $this->load->view('footer');
        } else {
            redirect('admin');
        }
    }
}

?>