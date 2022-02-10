<?php

class DiseaseModel extends CI_Model
{
    public function FindAllDiseasesGroup()
    {
        $query = $this->db->get('DiseaseGroup');
        
        return $query->result();
    }

    public function FindAllVitalSigns()
    {
        $query = $this->db->get('VitalSignsGroup');

        return $query->result();
    }

    public function FindOneDisease($dId)
    {
        $this->db->where('DID', $dId);
        $query = $this->db->get('Diseases');

        return $query->row();
    }

    public function FindAllDiseases()
    {
        $query = $this->db->get('Diseases');

        return $query->result();
    }

    public function FindDiseaseDataTable($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

         $condition = "1=1";
         
        if (!empty($keyword)) {
			$condition .= " and (Code like '%{$keyword}%' or Name like '%{$keyword}%') ";
        }
        
		$this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get('Diseases');
        $data = [];

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('Diseases')->where($condition)->count_all_results();
		$count = $this->db->from('Diseases')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        
        return $result;
    }

    public function ExecuteInsertDisease()
    {
        $data = array(
            'Code' => $this->input->post('Code'),
            'Name' => $this->input->post('Name')
        );

        $this->db->insert('Diseases', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Saved.')));
    }

    public function ExecuteUpdateDisease()
    {
        $data = array(
            'Code' => $this->input->post('Code'),
            'Name' => $this->input->post('Name')
        );

        $this->db->where('DID', $this->input->post('DID'));
        $this->db->update('Diseases', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Updated')));
    }

    public function ExecuteDeleteDisease($did)
	{
        $this->db->where('DID', $did);
        $this->db->delete('Diseases');
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Deleted')));
	}
    
}
