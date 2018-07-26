<?php 

class MY_Model extends CI_Model
{
    /**
    * Loads The Database
    */
    public function __construct()
    {
        $this->load->database();
    }
    /**
    * Select data from database
    * @param  array  $array
    * @param  string $table_name
    * @return Result Object
    */
    public function select($array = [], $table_name, $where_array = [])
    {
        $this->db->select($array);
        $this->db->where($where_array);
        $query = $this->db->get($table_name);
        return $query->result_array();
    }
    /**
    * Insert data into database
    * @param  string $table_name
    * @param  array  $insert_array [key value pair to be inserted]
    */
    public function insert($table_name, $insert_array = [])
    {
        return $this->db->insert($table_name, $insert_array);
    }
    /**
    * Update data into database
    * @param  string $table_name
    * @param  array  $update_array [key value pair to be updated]
    * @param  array $where_array
    */
    public function update($table_name, $update_array = [], $where_array = [])
    {
        $this->db->where($where_array);
        return $this->db->update($table_name, $update_array);
    }
    /**
    * Delete data from database
    * @param  string $table_name
    * @param  array $where_array
    */
    public function delete($table_name, $where_array = [])
    {
        $this->db->where($where_array);
        return $this->db->update($table_name, ['is_deleted' => 2]);
    }
    /**
    * checks the uniqueness of email while update
    * @param  [string] $email [user email ]
    * @param  [type]  $user_id [id of the user ]
    * @return boolean          [either return true or false]
    */
    public function is_unique_email($email, $user_id)
    {
        $this->db->select('user_email');
        $this->db->where('user_email', $email);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('users');
        $result_array = $query->result_array();
        if ($query->num_rows()>0) {
            //if user email and new email is same or not modified returns true
            foreach ($result_array as $key) {
                # code...
                if ($key['user_email'] == $email) {
                    return true;
                }
            }
        } else {
            $this->db->select('user_email');
            $this->db->where('user_email', $email);
            $query = $this->db->get('users');
            //if email exists and belongs to someone else account return false
            if ($query->num_rows()>0) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function is_unique_product($product_name, $product_id)
    {
        $this->db->select('product_name');
        $this->db->where('product_name', $product_name);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('products');
        $result_array = $query->result_array();
        if ($query->num_rows()>0) {
            //if user product_name and new product_name is same or not modified returns true
            foreach ($result_array as $key) {
                # code...
                if ($key['product_name'] == $product_name) {
                    return true;
                }
            }
        } else {
            $this->db->select('product_name');
            $this->db->where('product_name', $product_name);
            $query = $this->db->get('products');
            //if product_name exists and belongs to someone else account return false
            if ($query->num_rows()>0) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
    * [get_joins description]
    * @param  [type] $table   [description]
    * @param  [type] $columns [description]
    * @param  [type] $joins   [description]
    * @return [type]          [description]
    */
    public function get_joins($table, $columns, $joins)
    {
        $this->db->select($columns)->from($table);
        if (is_array($joins) && count($joins) > 0) {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }
        return $this->db->get()->result_array();
    }
    
 

/**
    * get product from data base data into database
    * 
    */
    function getProduct(){
        
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

}
