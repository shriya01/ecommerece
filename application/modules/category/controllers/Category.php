<?php 

/**
*
*/
class Category extends MX_Controller
{
    public function __construct()
    {
        $this->load->helper(array('url','encryption'));
        $this->load->library('session');
        $this->load->model('Category_Model');
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function display all categories when admin is logged in
     * @LongDescription
     */
    public function index()
    {
        if (isset($this->session->admin_email)) {
            $table_name = "category";
            $array = array('category_id','category_name');
            $where_array = array('is_deleted'=>1);
            $data['category_info'] = $this->Category_Model->select($array, $table_name, $where_array);
            $data['title']="Category List";
            $this->load->view('header', $data);
            $this->load->view('navigation');
            $this->load->view('categoryList', $data);
        } else {
            redirect('admin');
        }
    }

    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function display form to add or update in case category id is specified category when admin is logged in
     * @param string $category_id [description]
     */
    public function addOrUpdateCategory($category_id = '')
    {
        if (isset($this->session->admin_email)) {
            $this->load->helper('form');
            $data['category_id'] = $category_id;
            $data['category_info'] = [];
            if ($category_id != '') {
                $data['title']="Update Category Details";
                $array = array('category_id','category_name');
                $table_name = "category";
                $where_array = array('category_id' => aes256decrypt($category_id));
                $data['category_info'] = $this->Category_Model->select($array, $table_name, $where_array);
            } else {
                $data['title'] = 'Add Category Details';
            }
            if ($this->validateCategoryData($category_id) == false) {
                $this->load->view('header', $data);


                $this->load->view('navigation');

                $this->load->view('addOrUpdateCategory', $data);
                $this->load->view('footer');
            } else {
                $name = $this->input->post('name');
                if (isset($category_id)&& $category_id!='') {
                    $table_name = 'category';
                    $update_array = ['category_name' => $name];
                    $where_array=['category_id' => aes256decrypt($category_id)];
                    if ($this->Category_Model->update($table_name, $update_array, $where_array)) {
                        redirect('category/');
                    }
                } else {
                    $table_name = 'category';
                    $insert_array = ['category_name' => $name];
                    if ($this->Category_Model->insert($table_name, $insert_array)) {
                        redirect('category/');
                    }
                }
            }
        } else {
            redirect('admin');
        }
    }
    /**
     * @DateOfCreation     25-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the category form
     * @param  string $user_id [User Encrypted Id]
     * @return [boolean]       [true or false]
     */
    public function validateCategoryData($category_id)
    {
        if (isset($this->session->admin_email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Category Name', 'required');
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
     * @ShortDescription   Delete the category from database
     * @LongDescription
     * @param string $category_id
     */
    public function deleteCategoryData($category_id = '')
    {
        if (isset($this->session->admin_email)) {
            $table_name = "category";
            $where_array = array('category_id' => aes256decrypt($category_id) );
            $this->Category_Model->delete($table_name, $where_array);
            redirect('category/');
        } else {
            redirect('admin');
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Show category details from the database of the category id specified
     * @LongDescription
     * @param string $category_id
     */
    public function showCategoryData($category_id = '')
    {
        if (isset($this->session->admin_email)) {
            $array = array('category_id','category_name');
            $table_name = "category";
            $where_array = array('category_id' => aes256decrypt($category_id) );
            $data['category_info'] = $this->Category_Model->select($array, $table_name, $where_array);
            $this->load->view('header', $data);
            $this->load->view('navigation');
            $this->load->view('viewSingleCategoryInfo', $data);
            $this->load->view('footer');
        } else {
            redirect('admin');
        }
    }
}
