<?php
class Product extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
  $this->load->model('ProductModel');
  $this->load->library(array('form_validation','session'));
  $this->load->helper(array('url','html','form','encryption'));
  $this->load->database();
	}
	/**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function insert all products
     * @LongDescription
     */

public function index()
    {
       
        $table_name = "users";
        $array = array('product_name','product_description','product_price','user_gender','product_discount','prodect_selling_price');
        $where_array=array('is_deleted'=>1);
        $data['product_info'] = $this->ProductModel->select($array, $table_name, $where_array);
        $data['title']="product Information";
        $this->load->view('header', $data);
        $this->load->view('productlist', $data);
        $this->load->view('footer');
    }

public function addOrUpdateData($product_id = '')
    {
         $ip_address = $_SERVER['REMOTE_ADDR'];
        $this->load->helper('form');
        $data['product_id'] = $product_id;
        $data['user_info'] = [];
        if ($product_id != '') {
            $data['title']="Update Product";
            $array = array('product_id','product_name','product_description','product_price','user_gender','product_discount','prodect_selling_price');
            $table_name = "products";
            $where_array = array('product_id' => aes256decrypt($product_id));
            $data['user_info'] = $this->productModel->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add Product';
        }
        if ($this->validateUserData($product_id) == false) {
            $this->load->view('header', $data);
            $this->load->view('addOrUpdateProduct', $data);
            $this->load->view('footer');
        } else {
            $productname = $this->input->post('product_name');
            $productdescription = $this->input->post('product_description');
            $productprice = $this->input->post('product_price');
            $productdiscount = $this->input->post('product_discount');
             $prodectsellingprice = $this->input->post('prodect_selling_price');
            $gender = $this->input->post('gender');
            if ($product_id=='') {
                $table_name = "users";
                $password = $this->input->post('password');
                $insert_array = [ 'product_name' => $productname,'product_description'=>$productdescription, 'product_price' => $productprice,'product_discount' => $productdiscount ,'ip_address'=>$ip_address,'user_gender'=>$gender ,'prodect_selling_price'=>$prodectsellingprice];
                $this->productModel->insert($table_name, $insert_array);
                redirect('user/');
            } else {
                $table_name = "users";
                $update_array = ['product_name' => $productname,'product_description'=>$productdescription, 'product_price'=>$productprice,'product_discount' => $productdiscount,'ip_address'=>$ip_address,'user_gender'=>$gender ,'prodect_selling_price'=>$prodectsellingprice];
                $where_array = array('product_id' => aes256decrypt($product_id));
                $product_id = aes256decrypt($product_id);
                if ($is_unique_email = $this->productModel->is_unique_email($product_price, $product_id)) {
                    $this->productModel->update($table_name, $update_array, $where_array);
                    redirect('user/');
                } else {
                    $this->session->set_flashdata('error', 'Email Already Exists');
                    redirect('user/addOrUpdateData/'.aes256encrypt($product_id));
                }
            }
        }
    }

      public function InsertProduct()
  {
	  $this->form_validation->set_rules('product_name', ' product name', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('product_description', 'product description');
    $this->form_validation->set_rules('product_price', 'product price', 'trim|required');
    $this->form_validation->set_rules('product_discount', 'product discount', 'trim|required');
    $this->form_validation->set_rules('prodect_selling_price', 'prodect selling price', 'trim|required|min_length[4]|max_length[32]');
     $this->form_validation->set_rules('category_name', ' category name', 'trim|required|min_length[4]');
    
    
    $this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('product_view');
    }
    else
    {
      $ProductName  = $this->security->xss_clean($this->input->post('product_name'));
      $ProductDescription  = $this->security->xss_clean($this->input->post('product_description'));
      $ProductPrice   = $this->security->xss_clean($this->input->post('product_price'));
      $ProductDiscount    = $this->security->xss_clean($this->input->post('product_discount'));
      $ProdectSellingPrice   = $this->security->xss_clean($this->input->post('prodect_selling_price'));
      $CategoryName  = $this->security->xss_clean($this->input->post('category_name'));
      
      $insertData = array('product_name'=>$ProductName,'product_description'=>$ProductDescription,
                'product_price'=>$ProductPrice,
                'product_discount'=>$ProductDiscount,
                'prodect_selling_price'=>$ProdectSellingPrice, 'category_name'=>$CategoryName);
      $checkDuplicate = $this->ProductModel->checkDuplicate($ProductName);
      
      if($checkDuplicate == 0)
      {
        $insertData = $this->ProductModel->insertData($insertData);
      
        if($insertData)
        {
          redirect('product/productlist');
        }
        else
        {
          $data['errorMsg'] = 'Unable to save product. Please try again';
          $this->load->view('product_view',$data);
        }
      }
      
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

    public function validateCategoryData($product_id)
    {
        if (isset($this->session->admin_email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Product Name', 'required');
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
            $array = array('product_id','product_name');
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