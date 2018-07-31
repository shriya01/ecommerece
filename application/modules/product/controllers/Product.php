<?php
class Product extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->library(array('form_validation','session'));
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
        $upload_result =$this->CheckUpload();
        if ($upload_result == false) {
            echo "there is some error in file uplad";
        } else {
            $image_name = $upload_result['upload_data']['file_name'];
            if ($product_id=='') {
                $table_name = "products";
                $insert_array = [ 'product_name' => $productname,'product_description'=>$productdescription, 'product_price' => $productprice,'product_discount' => $productdiscount ,'product_selling_price'=>$productsellingprice,'category_id' => $productcategory,'product_image'=>$image_name];
                $this->ProductModel->insert($table_name, $insert_array);
                redirect('product/');
            } else {
                $table_name = "products";
                $update_array = [ 'product_name' => $productname,'product_description'=>$productdescription, 'product_price' => $productprice,'product_discount' => $productdiscount ,'product_selling_price'=>$productsellingprice,'category_id' => $productcategory,'product_image'=>$image_name];
                $where_array = array('product_id' => $product_id);
                $this->ProductModel->update($table_name, $update_array, $where_array);
                redirect('product/');
            }
        }
    }
}
/**
* [CheckUpload description]
*/
public function CheckUpload()
{
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png';
    $this->load->library('upload', $config);
    if (! $this->upload->do_upload('product_image')) {
        $data['upload_error'] = array('error' => $this->upload->display_errors());
        return false;
    } else {
        $upload_success = array('upload_data' => $this->upload->data());
        return $upload_success;
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
/**
* [addToCart description]
*/
public function addToCart($product_id = '')
{
    $this->load->library('cart');
    $product_id = aes256decrypt($product_id);
    $product_info = $this->ProductModel->select(['product_image','product_name','product_selling_price'], 'products', ['product_id'=>$product_id]);
    foreach ($product_info as $key) {
        $product_name = $key['product_name'];
        $product_price = $key['product_selling_price'];
        $product_image = $key['product_image'];
    }
    $data = array(
        'id'      => $product_id,
        'qty'     => 1,
        'price'   => $product_price,
        'name'    => $product_name,
        'image' => $product_image 
    );

    $result = $this->cart->insert($data);
    $data['image'] = $product_image;
    $this->load->view('header');
    $this->load->view('cart',$data);
}
function remove($rowid) {
    $this->load->library('cart');

// Check rowid value.
    if ($rowid==="all"){
// Destroy data which store in  session.
        $this->cart->destroy();
    }else{
// Destroy selected rowid in session.
        $data = array(
            'rowid'   => $rowid,
            'qty'     => 0
        );
// Update cart data, after cancle.
        $this->cart->update($data);
    }

// This will show cancle data in cart.
    $this->load->view('header');
    $this->load->view('cart');
}

function update_cart(){
    $this->load->library('cart');
// Recieve post values,calcute them and update
    $cart_info =  $_POST['cart'] ;
    print_r($cart_info);
    foreach( $cart_info as $id => $cart)
    {   
        $rowid = $cart['rowid'];
        $price = $cart['price'];
        $amount = $price * $cart['qty'];
        $qty = $cart['qty'];

        $data = array(
            'rowid'   => $rowid,
            'price'   => $price,
            'amount' =>  $amount,
            'qty'     => $qty
        );

        $this->cart->update($data);
    }
    $this->load->view('header');
    $this->load->view('cart');        
}   
function billing_view(){
    $this->load->library('cart');
// Load "billing_view".
    $this->load->view('header');
    $this->load->view('product/billing_view');
}
public function save_order()
{
    $this->load->library('cart');
// This will store all values which inserted  from user.
    $user = array(
        'user_firstname'      => $this->input->post('name'),
        'user_email'     => $this->input->post('email'),
        'user_address'   => $this->input->post('address'),
        'user_mobile'     => $this->input->post('phone')
    );      
// And store user imformation in database.
    $user_id = $this->ProductModel->insert_user($user);

    $order = array(
        'date'          => date('Y-m-d'),
        'user_id'    => $user_id
    );      

    $ord_id = $this->ProductModel->insert_order($order);

    if ($cart = $this->cart->contents()):
        foreach ($cart as $item):
            $order_detail = array(
                'orderid'       => $ord_id,
                'product_id'     => $item['id'],
                'quantity'      => $item['qty'],
                'price'         => $item['price']
            );      

// Insert product imformation with order detail, store in cart also store in database. 

            $cust_id = $this->ProductModel->insert_order_detail($order_detail);
        endforeach;
    endif;

// After storing all imformation in database load "billing_success".
    $this->load->view('billing_success');
}
}
