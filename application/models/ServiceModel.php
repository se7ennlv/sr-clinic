<?php

class ServiceModel extends CI_Model
{
    public function FindDocNo()
    {
        $sql = "SELECT CONCAT('CL', RIGHT('00000000'+ CONVERT(VARCHAR,ISNULL(MAX(TID), 0)+1),9)) AS DocNo 
                FROM Transactions";
        $query = $this->db->query($sql);

        return $query->row();
    }

    public function ExecuteUpdateSickLeave()
    {
        $data = array(
            'IsSickLeave' => 1,
            'LeaveFrom' => $this->input->post('fdate'),
            'LeaveTo' => $this->input->post('tdate'),
            'Diagnosis' => $this->input->post('diagnosis')
        );

        $this->db->where('DocNo', $this->input->post('docNo'));
        $this->db->update('Transactions', $data);
    }

    public function ExecuteInsertTransaction()
    {
        $data = array(
            'DocNo' => $this->input->post('docNo'),
            'PatientID' => $this->input->post('PatientID'),
            'PatientName' => $this->input->post('PatientName'),
            'Gender' => $this->input->post('Gender'),
            'Position' => $this->input->post('Position'),
            'DeptCode' => $this->input->post('DeptCode'),
            'SSO' => $this->input->post('SSO'),
            'PatientGroupID' => $this->input->post('PatientGroupID'),
            'TimeIn' => $this->input->post('TimeIn'),
            'TimeOut' => $this->input->post('TimeOut'),
            'IsObserve' => $this->input->post('IsObserve'),
            'IsOnDuty' => $this->input->post('IsOnDuty'),
            'IsCurable' => $this->input->post('IsCurable'),
            'HospitalCode' => $this->input->post('HospitalCode'),
            'DisCode' => $this->input->post('disCodeList'),
            'CreatedBy' => $this->session->userdata('username')
        );

        $this->db->insert('Transactions', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Saved time-in')));
    }

    public function ExecuteUpdateTransaction()
    {
        $data = array(
            'TimeIn' => $this->input->post('TimeIn'),
            'TimeOut' => $this->input->post('TimeOut'),
            'IsObserve' => $this->input->post('IsObserve'),
            'IsOnDuty' => $this->input->post('IsOnDuty'),
            'IsCurable' => $this->input->post('IsCurable'),
            'LeaveFrom' => $this->input->post('LeaveFrom'),
            'LeaveTo' => $this->input->post('LeaveTo'),
            'Diagnosis' => $this->input->post('Diagnosis'),
            'HospitalCode' => $this->input->post('HospitalCode'),
            'DisCode' => $this->input->post('disCodeList'),
            'ModifiedAt' => date('Y-m-d H:i:s'),
            'ModifiedBy' => $this->session->userdata('username')
        );

        $this->db->where('DocNo', $this->input->post('docNo'));
        $this->db->update('Transactions', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'message' => 'Update time-in')));
    }

    public function ExecuteInsertDispensing()
    {
        $data = array(
            'DocNo' => $this->input->post('docNo'),
            'MedCode' => $this->input->post('mcode'),
            'MedName' => $this->input->post('mname'),
            'QtyUsed' => $this->input->post('qty')
        );

        $this->db->insert('Dispensing', $data);
    }

    public function ExecuteDeleteDispensing($docNo)
    {
        $this->db->where('DocNo', $docNo);
        $this->db->delete('Dispensing');
    }

    public function ExecuteInsertSickLeaveDetail()
    {
        $data = array(
            'DocNo' => $this->input->post('docNo'),
            'DiseaseGroupCode' => $this->input->post('diseaseCode'),
            'DiseaseGroupName' => $this->input->post('diseaseName'),
            'SympDesc' => $this->input->post('sympDesc')
        );

        $this->db->insert('SickLeaveDetails', $data);
    }

    public function ExecuteDeleteSickLeave($docNo)
    {
        $this->db->where('DocNo', $docNo);
        $this->db->delete('SickLeaveDetails');
    }

    public function ExecuteCutStock()
    {
        $mcode = $this->input->post('mcode');
        $qty = $this->input->post('qtyUsed');

        $sql = "UPDATE Medicines SET Stock = (Stock - {$qty}) WHERE Code = '{$mcode}' ";
        $this->db->query($sql);
    }

    public function FindDataByDocNo($docNo)
    {
        $this->db->where('DocNo', $docNo);
        $query = $this->db->get('Transactions');

        return $query->row();
    }

    public function FindDispensingByDocNo($docNo)
    {
        $this->db->select('MedCode, MedName, QtyUsed, Stock');
        $this->db->from('Dispensing dis');
        $this->db->join('Medicines med', 'dis.MedCode = med.Code');
        $this->db->where('DocNo', $docNo);
        $query = $this->db->get();

        return $query->result();
    }
}
