<?php

class EmployeeModel extends CI_Model
{
    public function FindOnePic($empId)
    {
        $this->db->select('PhotoFile');
        $this->db->from('FullTimeEmps');
        $this->db->where('PID', $empId);
        
        $query = $this->db->get();

        if (!empty($query)) {
            return  $query->row('PhotoFile');
        }
    }
}
