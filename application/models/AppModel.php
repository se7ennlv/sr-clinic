<?php

class AppModel extends CI_Model
{
    public function FindAllDepts()
    {
        $this->db->where('IsActive', 1);
        $query = $this->db->get('Departments');

        return $query->result();
    }

    public function FindAllJobs()
    {
        $query = $this->db->get('Jobs');
        
        return $query->result();
    }

    
}
