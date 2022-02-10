<?php

class UserModel extends CI_Model
{
    public function LoginValid($usr, $pwd)
    {
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('Username', $usr);
        $this->db->where('Password', $pwd);
        $this->db->where('IsActive', 1);
        $query = $this->db->get();
        $row = $query->row();

        return $row;
    }

}