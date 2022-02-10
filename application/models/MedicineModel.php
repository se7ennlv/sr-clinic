<?php

class MedicineModel extends CI_Model
{

    public function FindOneMedicine($mId)
    {
        $this->db->where('MID', $mId);
        $query = $this->db->get('Medicines');

        return $query->row();
    }

    public function FindAllMedicines()
    {
        $query = $this->db->get('Medicines');

        return $query->result();
    }

    public function FindMedDataTable($param)
    {
        $keyword = $param['keyword'];

        $this->db->select('MID, Code, med.Name, Stock, Unit,Cost, QtyAlert, UpdatedAt');
        $this->db->from('Medicines med');
        $this->db->join('Units unt', 'med.Unit = unt.Name');
       
        $condition = "1=1";

        if (!empty($keyword)) {
            $condition .= " and (Code like '%{$keyword}%' or Unit like '%{$keyword}%') ";
        }

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $query = $this->db->get();
        $data = [];

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('Medicines')->where($condition)->count_all_results();
        $count = $this->db->from('Medicines')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function ExecuteInsertMedicine()
    {
        $data = array(
            'Code' => $this->input->post('Code'),
            'Name' => $this->input->post('Name'),
            'Stock' => $this->input->post('Stock'),
            'Unit' => $this->input->post('Unit'),
            'Cost' => $this->input->post('Cost')
        );

        $this->db->insert('Medicines', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Saved.')));
    }

    public function ExecuteUpdateMedicine()
    {
        $data = array(
            'Code' => $this->input->post('Code'),
            'Name' => $this->input->post('Name'),
            'Stock' => $this->input->post('Stock'),
			'Unit' => $this->input->post('Unit'),
			'Cost' => $this->input->post('Cost'),
            'UpdatedAt' => date('Y-m-d H:i:s')
        );

        $this->db->where('MID', $this->input->post('MID'));
        $this->db->update('Medicines', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Updated')));
    }

    public function ExecuteUpdateStock()
    {
        $medCode = $this->input->post('CodeImport');
        $qtyImport = $this->input->post('StockImport');

        $sql = "UPDATE Medicines SET Stock = (Stock + $qtyImport), UpdatedAt = GETDATE() WHERE Code = '{$medCode}' ";
        $this->db->query($sql);

        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Stock Updted')));
    }

    public function ExecuteDeleteMedicine($did)
    {
        $this->db->where('MID', $did);
        $this->db->delete('Medicines');
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Deleted')));
    }
}
