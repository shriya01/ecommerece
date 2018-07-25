<?php 
/**
 * Admin_Model Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation    25-July-2018
 * @DateOfDeprecated
 * @ShortDescription
 * @LongDescription   Inherits all properties and methods specified in MY_Model class
 */
class Admin_Model extends MY_Model
{

	/**
     * @DateOfCreation        5 April 2018 11:47 AM
     * @DateOfDeprecated
     * @ShortDescription      to check user is vaild or not
     * @LongDescription
     * @param1                 string  $email User Email
     * @param2                 string  $password User Password
     * @return                 boolean Either True or False
     */
    public function isValidUser($email,$password)
    {
        $this->db->select('user_email,user_password');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', $password);
        $this->db->where('user_type_id',1);
        $query = $this->db->get('users');
        if ($query->num_rows()==1) {
            return true;
        } else {
            return false;
        }
    }
}