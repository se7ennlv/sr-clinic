<?php

class PatientModel extends CI_Model
{
    public function FindOnePatient()
    {
        $pid = $this->input->post('pid');
        $group = $this->input->post('group');

        $this->db->where('PID', $pid);
        $this->db->where('PatientGroupID', $group);
        $this->db->where('IsActive', 1);

        $query = $this->db->get('PatientHistory');

        return $query->row();
    }

    public function FindCountOnePatient($pid, $groupId)
    {
        $sql = "SELECT COUNT(*) AS [RowCount] FROM PatientHistory WHERE PID = '{$pid}' AND PatientGroupID = {$groupId} AND IsActive = 1 ";
        $query = $this->db->query($sql);

        return $query->row('RowCount');
    }

    public function FindPatientHisDataTable($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = "1=1";

        if (!empty($keyword)) {
            $condition .= " and (PID like '%{$keyword}%' or FullName like '%{$keyword}%' or DeptCode like '%{$keyword}%') ";
        }

        $this->db->where($condition);
        $this->db->where('IsActive', 1);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $query = $this->db->get('PatientHistory');
        $data = [];

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('PatientHistory')->where($condition)->where('IsActive', 1)->count_all_results();
        $count = $this->db->from('PatientHistory')->where('IsActive', 1)->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function ExecuteInsertPatient()
    {
        $data = array(
            'PID' => $this->input->post('PID'),
            'FullName' => $this->input->post('FullName'),
            'PhotoFile' => $this->input->post('PhotoFile'),
            'BirthDate' => $this->input->post('BirthDate'),
            'Gender' => $this->input->post('Gender'),
            'Tel' => $this->input->post('Tel'),
            'DeptCode' => $this->input->post('DeptCode'),
            'Positions' => $this->input->post('Positions'),
            'IDCard' => $this->input->post('IDCard'),
            'SSO' => $this->input->post('SSO'),
            'Address' => $this->input->post('Address'),
            'PatientGroupID' => $this->input->post('PatientGroupID'),
            'PyLevel' => $this->input->post('PyLevel'),
            'BloodGroup' => $this->input->post('BloodGroup'),
            'Weight' => $this->input->post('Weight'),
            'Height' => $this->input->post('Height'),
            'BMI' => $this->input->post('BMI'),
            'MedCode' => $this->input->post('medCodeList'),
            'MedDesc' => $this->input->post('medDescList'),
            'DisCode' => $this->input->post('disCodeList'),
            'DisDesc' => $this->input->post('disDescList'),
            'Surgery' => $this->input->post('Surgery')
        );

        $this->db->insert('PatientHistory', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Saved.')));
    }

    public function ExecuteUpdatePatient()
    {
        $data = array(
            'FullName' => $this->input->post('FullName'),
            'PhotoFile' => $this->input->post('PhotoFile'),
            'BirthDate' => $this->input->post('BirthDate'),
            'Gender' => $this->input->post('Gender'),
            'Tel' => $this->input->post('Tel'),
            'DeptCode' => $this->input->post('DeptCode'),
            'Positions' => $this->input->post('Positions'),
            'IDCard' => $this->input->post('IDCard'),
            'SSO' => $this->input->post('SSO'),
            'Address' => $this->input->post('Address'),
            'PatientGroupID' => $this->input->post('PatientGroupID'),
            'PyLevel' => $this->input->post('PyLevel'),
            'BloodGroup' => $this->input->post('BloodGroup'),
            'Weight' => $this->input->post('Weight'),
            'Height' => $this->input->post('Height'),
            'BMI' => $this->input->post('BMI'),
            'MedCode' => $this->input->post('medCodeList'),
            'MedDesc' => $this->input->post('medDescList'),
            'DisCode' => $this->input->post('disCodeList'),
            'DisDesc' => $this->input->post('disDescList'),
            'Surgery' => $this->input->post('Surgery'),
            'UpdatedAt' => date('Y-m-d H:i:s')
        );

        $this->db->where('PID', $this->input->post('PID'));
        $this->db->update('PatientHistory', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Updated')));
    }

    public function ExecuteDisablePatient($phid)
    {
        $data = array(
            'IsActive' => 0
        );

        $this->db->where('PHID', $phid);
        $this->db->update('PatientHistory', $data);

        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Disabled.')));
    }

    public function FindOneFullTimeEmp($empId)
    {
        $this->db->where('PID', $empId);
        $query = $this->db->get('FullTimeEmps');

        return $query->row();
    }

    public function FindOneDailyEmp($empId)
    {
        $this->db->where('PID', $empId);
        $query = $this->db->get('DailyEmps');

        return $query->row();
    }

    public function FindOneCustomer($custId)
    {
        $this->db->where('PID', $custId);
        $query = $this->db->get('Customers');

        return $query->row();
    }

}
