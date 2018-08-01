<?php
class MY_Modell extends CI_Model 
{

 function __construct()
 {
  parent::__construct();
 }

 function checkDuplicate($product_name)
	{
		$this->load->database();
		$this->db->select('product_name');
		$this->db->from('products');
		$this->db->like('product_name', $product_name);
		return $this->db->count_all_results();
	}
 function insertData($data)
	{
		$this->load->database();
		if($this->db->insert('products', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	function getProduct(){
		$user_id = $this->session->user_id;
		//echo $user_id; die();
  $this->db->select("*");
  $this->db->from('products');
 // $this->db->where('user_id !=',$user_id);
  $query = $this->db->get();
  
  return $query->result_array();
  echo ("</pre>");
  
 }
 public function get_product_by_id($product_id = 0)
    {
        if ($product_id === 0)
        {
            $query = $this->db->get('products');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('products', array('product_id' => $product_id));
        return $query->row_array();
    }
    public function set_product($product_id = 0)
    {
        $this->load->helper('url');
 
        $slug = url_title($this->input->post('product_name'), 'dash', TRUE);
 
        $data = array(
            'title' => $this->input->post('product_name'),
            'slug' => $slug,
            'text' => $this->input->post('')
        );
        
        if ($id == 0) {
            return $this->db->insert('products', $data);
        } else {
            $this->db->where('product_id', $product_id);
            return $this->db->update('products', $data);
        }
    }


  public function delete_product($product_id)
    {
        $this->db->where('product_id', $product_id);
        return $this->db->delete('products');
    }
}
?>