<?php

class UnitModel extends CI_Model
{
    public function FindOneUnit($uId)
    {
        $this->db->where('UID', $uId);
        $query = $this->db->get('Units');

        return $query->row();
    }

    public function FindAllUnits()
    {
        $query = $this->db->get('Units');

        return $query->result();
    }

    public function FindUnitDataTable($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');
        
         $condition = "1=1";
         
        if (!empty($keyword)) {
			$condition .= " and (Name like '%{$keyword}%') ";
        }

		$this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get('Units');
        $data = [];

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('Units')->where($condition)->count_all_results();
		$count = $this->db->from('Units')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        
        return $result;
    }

    public function ExecuteInsertUnit()
    {
        $data = array(
            'Name' => $this->input->post('Name'),
            'QtyAlert' => $this->input->post('QtyAlert')
        );

        $this->db->insert('Units', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Saved.')));
    }

    public function ExecuteUpdateUnit()
    {
        $data = array(
            'Name' => $this->input->post('Name'),
            'QtyAlert' => $this->input->post('QtyAlert')
        );

        $this->db->where('UID', $this->input->post('UID'));
        $this->db->update('Units', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Updated')));
    }

    public function ExecuteDeleteUnit($uid)
	{
        $this->db->where('UID', $uid);
        $this->db->delete('Units');
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Deleted')));
    }
    
        
}
