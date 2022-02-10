<?php

class ReportModel extends CI_Model
{
	public function FindAllVisit()
	{
		$isAll = $this->input->post('isAll');
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$condition = "CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'";

		$this->db->select('*');
		$this->db->from('Transactions');
		$this->db->where('IsVoid', 0);

		if ($isAll == 1) {
			$this->db->where('IsSickLeave', 0);
		} else if ($isAll == 2) {
			$this->db->where('IsSickLeave', 1);
		} else if ($isAll == 3) {
			$this->db->where('IsObserve', 1);
		}

		$this->db->where($condition, "", FALSE);
		$this->db->order_by('CreatedAt', 'desc');
		$query = $this->db->get();

		return $query->result();
	}

	public function FindAllDocNo()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT CONVERT(DATE, CreatedAt) AS CreatedAt, DocNo, PatientID, PatientName, Gender, DeptCode
                FROM Transactions 
                WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
                AND IsVoid = 0";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function FindAllDetail()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT DeptCode, DocNo,CONVERT(DATE, CreatedAt) as CreatedAt, PatientID,MedCode,MedName,Unit,QtyUsed,Cost, SUM((Cost) * (QtyUsed)) AS Amount
		FROM SumDrug
		WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
		GROUP BY DeptCode, DocNo,CONVERT(DATE, CreatedAt),PatientID,MedCode,MedName,Unit,QtyUsed,Cost
		ORDER BY DocNo";

		// $sql  = "SELECT MedName,MedCode,DeptCode,Unit,QtyUsed,Cost ,SUM((Cost) * (QtyUsed)) AS Amount-- ,CONVERT(DATE, CreatedAt) as CreatedAt
		// from DeptView
		// WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
		// GROUP BY DeptCode ,MedCode,MedName,Unit,QtyUsed,Cost-- ,CONVERT(DATE, CreatedAt)
		// ORDER BY DeptCode";

		$query = $this->db->query($sql);
		return $query->result();
	}
	public function FindTranDepts()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT DeptCode
		FROM SumDrug
		WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
		GROUP BY DeptCode";
		$query = $this->db->query($sql);

		return $query->result();
	}
	public function FindDocNo1()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT CONVERT(DATE, CreatedAt) AS CreatedAt, DocNo, PatientID, PatientName, Gender, DeptCode
                FROM Transactions 
                WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
				AND IsVoid = 0
				ORDER BY DeptCode";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function FindAllVisitDetail()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT DocNo, MedCode, MedName, unt.Name AS [Unit], QtyUsed 
                FROM Dispensing dps
                INNER JOIN Medicines med ON dps.MedCode = med.Code
                INNER JOIN Units unt ON med.Unit = unt.Name
                WHERE CONVERT(DATE, dps.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
                ";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function FindVisitByDocNo($docNo)
	{
		$this->db->where('DocNo', $docNo);
		$query = $this->db->get('Transactions');

		return $query->row();
	}

	public function FindSickLeaveByDocNo($docNo)
	{
		$this->db->select('DocNo, Transactions.CreatedAt, Fname, Lname, PatientID, PatientName, DeptCode, LeaveFrom, LeaveTo, Diagnosis');
		$this->db->from('Transactions');
		$this->db->join('Users', 'CreatedBy = Username');
		$this->db->where('DocNo', $docNo);
		$query = $this->db->get();

		return $query->row();
	}

	public function FindSickLeaveDetailByDocNo($docNo)
	{
		$this->db->where('DocNo', $docNo);
		$query = $this->db->get('SickLeaveDetails');

		return $query->result();
	}

	public function FindDispensingByDocNo($docNo)
	{
		$this->db->select('MedCode, MedName, Stock, QtyUsed');
		$this->db->from('Dispensing');
		$this->db->join('Medicines', 'MedCode = Code');
		$this->db->where('DocNo', $docNo);

		$query = $this->db->get();

		return $query->result();
	}

	public function ExecuteVoided($id)
	{
		$data = array(
			'IsVoid' => 1,
		);

		$this->db->where('TID', $id);
		$this->db->update('Transactions', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => "success", "message" => 'Voided')));
	}

	public function FindFullEmpsDataTable($param)
	{
		$keyword = $param['keyword'];
		$this->db->select('*');
		$condition = "1=1";

		if (!empty($keyword)) {
			$condition .= " and (EmpID like '%{$keyword}%' or EmpName like '%{$keyword}%') ";
		}

		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get('FullTimeEmps');
		$data = [];

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		$count_condition = $this->db->from('FullTimeEmps')->where($condition)->count_all_results();
		$count = $this->db->from('FullTimeEmps')->count_all_results();
		$result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

		return $result;
	}

	public function FindDailyEmpsDataTable($param)
	{
		$keyword = $param['keyword'];
		$this->db->select('*');
		$condition = "1=1";

		if (!empty($keyword)) {
			$condition .= " and (EmpID like '%{$keyword}%' or EmpName like '%{$keyword}%') ";
		}

		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get('DailyEmps');
		$data = [];

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		$count_condition = $this->db->from('DailyEmps')->where($condition)->count_all_results();
		$count = $this->db->from('DailyEmps')->count_all_results();
		$result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

		return $result;
	}

	public function FindCustomersDataTable($param)
	{
		$keyword = $param['keyword'];
		$this->db->select('*');
		$condition = "1=1";

		if (!empty($keyword)) {
			$condition .= " and (CustID like '%{$keyword}%' or CustName like '%{$keyword}%') ";
		}

		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get('Customers');
		$data = [];

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		$count_condition = $this->db->from('Customers')->where($condition)->count_all_results();
		$count = $this->db->from('Customers')->count_all_results();
		$result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

		return $result;
	}

	public function FindMedAlerts()
	{
		$sql = "SELECT TOP(5) Code, med.Name, Stock, Unit, QtyAlert FROM Medicines med INNER JOIN Units unt ON med.Unit = unt.Name WHERE Stock <= QtyAlert";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function FindCountByPatientGroup()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT 
                FullTimeTotal = (SELECT COUNT(*) AS FullTimeTotal FROM (SELECT PatientID FROM Transactions WHERE PatientGroupID = 1 AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS FullTime),
                DailyTotal = (SELECT COUNT(*) AS FullTimeTotal FROM (SELECT PatientID FROM Transactions WHERE PatientGroupID = 2 AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS FullTime),
                CustTotal = (SELECT COUNT(*) AS FullTimeTotal FROM (SELECT PatientID FROM Transactions WHERE PatientGroupID = 3 AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS CustTotal)
            ";
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function FindCountByGender()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "SELECT
                Female = (SELECT COUNT(*) AS FTotal FROM (SELECT PatientID FROM Transactions WHERE Gender = 'F' AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS FTotal),
                Male = (SELECT COUNT(*) AS MTotal FROM (SELECT PatientID FROM Transactions WHERE Gender = 'M' AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS MTotal)
            ";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function FindCountByDept()
	{
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');

		$sql = "WITH cte AS (
                SELECT CASE WHEN LEN(trans.DeptCode) <= 0 THEN 'Unknow' ELSE trans.DeptCode END AS [DeptCode], DeptBgColor, DeptHoverColor, DeptTextColor, PatientID
                FROM Transactions trans 
                LEFT JOIN Departments dept ON trans.DeptCode = dept.DeptCode 
                WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'  AND trans.IsVoid = 0
                GROUP BY trans.DeptCode, DeptBgColor, DeptHoverColor, DeptTextColor, PatientID
                )
                SELECT cte.DeptCode, DeptBgColor, DeptHoverColor, DeptTextColor, COUNT(*) AS [Total]
                FROM cte
                GROUP BY cte.DeptCode, DeptBgColor, DeptHoverColor, DeptTextColor
                ORDER BY cte.DeptCode ASC
            ";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function FindAllMedAlerts()
	{
		$sql = "SELECT Code, med.Name, Stock, Unit, QtyAlert FROM Medicines med INNER JOIN Units unt ON med.Unit = unt.Name WHERE Stock <= QtyAlert";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function CountAllMedLowStock()
	{
		$sql = "SELECT COUNT(*) AS [Total] FROM Medicines med INNER JOIN Units unt ON med.Unit = unt.Name WHERE Stock <= QtyAlert";
		$query = $this->db->query($sql);

		return  $query->row('Total');
	}

	public function FindAllDepts()
	{
		$sql = "SELECT DISTINCT CASE WHEN LEN(DeptCode) <= 0 THEN 'zOthers' ELSE DeptCode END AS DeptCode FROM Transactions ORDER BY DeptCode";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function FindAllMed()
	{
		$sql = "SELECT DISTINCT dis.MedCode,dis.MedName FROM Transactions tra INNER JOIN Dispensing dis ON tra.DocNo = dis.DocNo ORDER BY dis.MedCode";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function FindCountOneDeptByDate($deptCode, $date)
	{
		$dept = '';

		($deptCode === 'zOthers') ? $dept = '' : $dept = $deptCode;

		$sql = "WITH RawData AS(
                SELECT PatientID, DeptCode, CONVERT(DATE, CreatedAt) AS CreatedAt
                FROM Transactions
                GROUP BY PatientID, DeptCode, CONVERT(DATE, CreatedAt)
                )
                SELECT COUNT(*) AS Total
                FROM RawData
                WHERE DeptCode = '{$dept}' AND CONVERT(DATE, CreatedAt) = '{$date}' 
            ";
		$query = $this->db->query($sql);

		return $query->row('Total');
	}
	public function FindCountOneMedByDate($MedName, $date)
	{
		$sql = "WITH RawData AS(
			SELECT tra.DocNo,tra.PatientID,dis.MedCode,dis.MedName,dis.QtyUsed, CONVERT(DATE, tra.CreatedAt) AS CreatedAt
			FROM Transactions tra
			INNER JOIN Dispensing dis ON tra.DocNo = dis.DocNo
			GROUP BY dis.QtyUsed ,tra.DocNo,tra.PatientID,dis.MedCode,dis.MedName, CONVERT(DATE, tra.CreatedAt))
			SELECT COALESCE(SUM(QtyUsed),0) AS Total
			FROM RawData
			WHERE MedName ='{$MedName}' AND CONVERT(DATE, CreatedAt) = '{$date}'
                
            ";
		$query = $this->db->query($sql);

		return $query->row('Total');
	}

	public function FindCountOneGenderByDate($gender, $date)
	{
		$sql = "WITH RawData AS(
                SELECT PatientID, Gender, CONVERT(DATE, CreatedAt) AS CreatedAt
                FROM Transactions
                GROUP BY PatientID, Gender, CONVERT(DATE, CreatedAt)
                )
                SELECT COUNT(*) AS Total
                FROM RawData
                WHERE Gender = '{$gender}' AND CONVERT(DATE, CreatedAt) = '{$date}' 
            ";

		$query = $this->db->query($sql);

		return $query->row('Total');
	}


	// ----------------------------- Khamla New Report----------------------
	public function FindCountByGender1()
	{
		$fromDate = $this->input->get('fDate');
		$toDate = $this->input->get('tDate');
		$sql ="SELECT MaleT =(SELECT COUNT(*) FROM Transactions  WHERE Gender = 'M' AND CONVERT(DATE,CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'),
		FemaleT =(SELECT COUNT(*) FROM Transactions  WHERE Gender = 'F' AND CONVERT(DATE,CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'),
		(SELECT SUM((Cost) * (QtyUsed)) AS TotalSumaryMonth 
		FROM SumDrug WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') as TotalSumaryMonth,
		(SELECT  AVG(Cost) as PerTimeAvg FROM SumDrug
		WHERE CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') as PerTimeAvg";
		$query = $this->db->query($sql);
		return $query->row();
	}
	public function FindCountMaleFemale()
	{
		$fromDate = $this->input->get('fDate');
		$toDate = $this->input->get('tDate');

		$sql = "SELECT Female = (SELECT COUNT(*) AS FTotal FROM (SELECT PatientID FROM Transactions WHERE Gender = 'F' AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS FTotal),
		 Male = (SELECT COUNT(*) AS MTotal FROM (SELECT PatientID FROM Transactions WHERE Gender = 'M' AND CONVERT(DATE, CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}' AND IsVoid = 0 GROUP BY PatientID) AS MTotal)";

		$query = $this->db->query($sql);
		return $query->row();
	}
	public function tt()
	{
		$sql ="";
		$query = $this->db->query($sql);

		return $query->row('Total');

	}
	public function FindAllVisitByDepts()
	{

		$fromDate = $this->input->get('fDate');
		$toDate = $this->input->get('tDate');

		$sql ="SELECT DISTINCT(Departments.DeptName) AS DeptName,

		(SELECT COUNT(*) FROM Transactions subTran WHERE mainTran.DeptCode = subTran.DeptCode AND Gender = 'M' AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Male,
		(SELECT COUNT(*) FROM Transactions subTran WHERE mainTran.DeptCode = subTran.DeptCode AND Gender = 'F' AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Female,
		(SELECT COUNT(*) FROM Transactions subTran WHERE subTran.DeptCode = mainTran.DeptCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Total,
		(SELECT Sum(Amount) FROM SumDrug subTran WHERE subTran.DeptCode = mainTran.DeptCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Amount,
		(SELECT Sum(Amount) *100/(SELECT Sum(Amount) FROM SumDrug  WHERE CONVERT(DATE,CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') FROM SumDrug subTran WHERE subTran.DeptCode = mainTran.DeptCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS pPercent
		FROM Transactions mainTran
		INNER JOIN Departments ON mainTran.DeptCode = Departments.DeptCode
		WHERE CONVERT(DATE, mainTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
		ORDER BY Departments.DeptName";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function FindDiseases()
	{
		$fromDate = $this->input->get('fDate');
		$toDate = $this->input->get('tDate');
		$sql ="SELECT DISTINCT(Diseases.Name) AS DiseasesName,Diseases.Code,
		(SELECT COUNT(*) FROM Transactions subTran WHERE mainTran.DisCode = subTran.DisCode AND Gender = 'M' AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Male,
		(SELECT COUNT(*) FROM Transactions subTran WHERE mainTran.DisCode = subTran.DisCode AND Gender = 'F' AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Female,
		(SELECT COUNT(*) FROM Transactions subTran WHERE subTran.DisCode = mainTran.DisCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Total,
		(SELECT Sum(Amount) FROM SumDrug subTran WHERE subTran.DisCode = mainTran.DisCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Amount,
		(SELECT SUM(Amount)*100/(SELECT Sum(Amount) FROM SumDrug  WHERE CONVERT(DATE,CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}')  FROM SumDrug subTran 
		WHERE subTran.DisCode = mainTran.DisCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS pPercent
		FROM Transactions mainTran
		INNER JOIN Diseases ON mainTran.DisCode = Diseases.Code
		WHERE CONVERT(DATE, mainTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
		ORDER BY DiseasesName";

		// $sql ="SELECT DISTINCT(Diseases.Name) AS DiseasesName,Diseases.Code,

		// (SELECT COUNT(*) FROM Transactions subTran WHERE mainTran.DisCode = subTran.DisCode AND Gender = 'M' AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Male,
		// (SELECT COUNT(*) FROM Transactions subTran WHERE mainTran.DisCode = subTran.DisCode AND Gender = 'F' AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Female,
		// (SELECT COUNT(*) FROM Transactions subTran WHERE subTran.DisCode = mainTran.DisCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Total,
		// (SELECT Sum(Amount) FROM SumDrug subTran WHERE subTran.DisCode = mainTran.DisCode AND CONVERT(DATE, subTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}') AS Amount
		// FROM Transactions mainTran
		// INNER JOIN Diseases ON mainTran.DisCode = Diseases.Code
		// WHERE CONVERT(DATE, mainTran.CreatedAt) BETWEEN '{$fromDate}' AND '{$toDate}'
		// ORDER BY DiseasesName";
			$query = $this->db->query($sql);
			return $query->result();
	}

	
}
