<?php
class Product extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->library(array('form_validation','session','upload'));
        $this->load->helper(array('url','html','form','encryption'));
    }
/**
* @DateOfCreation     25-July-2018
* @DateOfDeprecated
* @ShortDescription   This function insert all products
* @LongDescription
*/
public function index()
{
    $joins = array(array( 'table' => 'category', 'condition' => 'category.category_id = products.category_id', 'jointype' => 'INNER'));
    $data['product_info'] = $this->ProductModel->get_joins('products', ['product_id','category_name','product_name','product_description','product_price','product_discount','product_selling_price'], $joins);
    $data['title']="product Information";
    $this->load->view('header', $data);
    $this->load->view('productlist', $data);
    $this->load->view('footer');
}
/**
* [addOrUpdateProduct description]
* @param string $product_id [description]
*/
public function addOrUpdateProduct($product_id = '')
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $this->load->helper('form');
    $data['product_id'] = $product_id;
    $data['product_info'] = [];
    if ($product_id != '') {
        $data['title']="Update Product";
        $product_id = aes256decrypt($product_id) ;
        $joins = array(array( 'table' => 'category', 'condition' => 'category.category_id = products.category_id where product_id = \''.$product_id.'\'', 'jointype' => 'INNER'));
        $data['product_info'] = $this->ProductModel->get_joins('products', ['product_id','product_description','products.category_id','product_name','product_description','product_price','product_discount','product_selling_price'], $joins);
    } else {
        $data['title'] = 'Add Product';
    }
    if ($this->validateProductData($product_id) == false) {
        $product_categories= $this->ProductModel->select(['category_id','category_name'], 'category');

        foreach ($product_categories as $row) {
            $categories[$row['category_id']] = $row['category_name'];
# code...
        }
        $data['product_categories'] = $categories;
        $this->load->view('header', $data);
        $this->load->view('addOrUpdateProduct', $data);
        $this->load->view('footer');
    } else {
        $productname = $this->input->post('product_name');
        $productdescription = $this->input->post('product_description');
        $productprice = $this->input->post('product_price');
        $productdiscount = $this->input->post('product_discount');
        $productsellingprice = $this->input->post('product_selling_price');
        $productcategory = $this->input->post('category_name');
       print_r($this->do_upload);
        die;
        if ($product_id=='') {
            $table_name = "products";
            $insert_array = [ 'product_name' => $productname,'product_description'=>$productdescription, 'product_price' => $productprice,'product_discount' => $productdiscount ,'product_selling_price'=>$productsellingprice,'category_id' => $productcategory];
            $this->ProductModel->insert($table_name, $insert_array);
            redirect('product/');
        } else {

          $table_name = "products";
            $update_array = [ 'product_name' => $productname,'product_description'=>$productdescription, 'product_price' => $productprice,'product_discount' => $productdiscount ,'product_selling_price'=>$productsellingprice,'category_id' => $productcategory];
            $where_array = array('product_id' => $product_id);
      $this->ProductModel->update($table_name, $update_array, $where_array);
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

    if (! $this->upload->do_upload('product_image')) {
        $error = array('error' => $this->upload->display_errors());
        return $error;
    } else {
        $data = array('upload_data' => $this->upload->data());
        return $data;
    }
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
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('product_price', 'product price', 'required');
        $this->form_validation->set_rules('product_discount', 'product discount', 'required');
        $this->form_validation->set_rules('product_selling_price', 'prodect selling price', 'required');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select Category']);
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
/**
* [showProductData description]
* @param  string $product_id [description]
* @return [type]             [description]
*/
public function showProductData($product_id = '')
{
    if (isset($this->session->admin_email)) {
        $product_id = aes256decrypt($product_id) ;
        $joins = array(array( 'table' => 'category', 'condition' => 'category.category_id = products.category_id where product_id = \''.$product_id.'\'', 'jointype' => 'INNER'));
        $data['product_info'] = $this->ProductModel->get_joins('products', ['product_id','category_name','product_name','product_description','product_price','product_discount','product_selling_price'], $joins);
        $this->load->view('header', $data);
        $this->load->view('navigation');
        $this->load->view('viewSingleProductInfo', $data);
        $this->load->view('footer');
    } else {
        redirect('admin');
    }
}
}
