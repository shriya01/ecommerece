<?php
class Product extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
  $this->load->model('ProductModel');
  $this->load->library(array('form_validation','session'));
  $this->load->helper(array('url','html','form'));
  $this->load->database();
	}
	/**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function insert all products
     * @LongDescription
     */

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
  $data['all_data'] = null;
  if($query){
   $data['all_data'] =  $query;
  }
  $this->load->view('productlist.php', $data);
 }
 /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function update all products
     * @LongDescription
     */
public function edit($product_id)
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
        
    $data['product_name'] = 'Edit a product item';        
    $data['product_item'] = $this->ProductModel->get_product_by_id($product_id);
    $this->form_validation->set_rules('product_name', ' product name', 'trim|required');
    $this->form_validation->set_rules('product_description', 'product description','trim|required');
    $this->form_validation->set_rules('product_price', 'product price', 'trim|required');
    $this->form_validation->set_rules('product_discount', 'product discount', 'trim|required');
    $this->form_validation->set_rules('prodect_selling_price', 'prodect selling price', 'trim|required');
     $this->form_validation->set_rules('category_name', ' category name', 'trim|required');
    
    
    $this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('product_view');
    }
        else
        {
            $this->ProductModel->set_products($product_id);
            //$this->load->view('news/success');
             redirect('product/productlist', 'refresh');  
        }
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function delete row from data base
     * @LongDescription
     */

public function delete($product_id)
    {
        echo $product_id;
        
        if (empty($product_id))
        {
            show_404();
        }
                
        $product_item = $this->ProductModel->get_product_by_id($product_id);
        
        $this->ProductModel->delete_product($product_id);        
        //redirect( base_url() . 'index.php/product'); 
        redirect('product/productlist', 'refresh');       
    }
}

?>