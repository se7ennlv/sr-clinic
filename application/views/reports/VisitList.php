<table class="table table-bordered table-wrapper" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th class="text-nowrap text-center">Date Time</th>
            <th class="text-nowrap text-center">Doc No</th>
            <th class="text-nowrap text-center">ID</th>
            <th class="text-nowrap">Name</th>
            <th class="text-nowrap text-center">Gender</th>
            <th class="text-nowrap">Position</th>
            <th class="text-nowrap">Dept</th>
            <th class="text-nowrap">SSO</th>
            <th class="text-nowrap text-center">Group</th>
            <th class="text-nowrap">Is Observe at Clinic</th>
            <th class="text-nowrap">Time-In</th>
            <th class="text-nowrap">Time-Out</th>
            <th class="text-nowrap">Is On Duty</th>
            <th class="text-nowrap">Is Curable</th>
            <th class="text-nowrap">Hospital</th>
            <th class="text-nowrap">Is Sick Leave</th>
            <th class="text-nowrap text-center">Leave From</th>
            <th class="text-nowrap text-center">Leave To</th>
            <th class="text-nowrap">Diangosis</th>
            <th class="text-nowrap">Nurse</th>
            <th class="text-nowrap">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($lists as $list) :
            $i = $i + 1
            ?>
            <tr>
                <td class="text-center"><?= $i; ?></td>
                <td class="text-nowrap text-center"><?= nice_date($list->CreatedAt, 'Y-m-d H:i:s'); ?></td>
                <td class="text-nowrap text-center"><?= $list->DocNo; ?></td>
                <td class="text-nowrap text-center"><?= $list->PatientID; ?></td>
                <td class="text-nowrap"><?= $list->PatientName; ?></td>
                <td class="text-nowrap text-center"><?= $list->Gender; ?></td>
                <td class="text-nowrap"><?= $list->Position; ?></td>
                <td class="text-nowrap"><?= $list->DeptCode; ?></td>
                <td class="text-nowrap"><?= $list->SSO; ?></td>
                <td class="text-nowrap text-center">
                    <?php
                        if ($list->PatientGroupID == 1) {
                            echo '<span class="badge badge-primary">full-time</span>';
                        } else if ($list->PatientGroupID == 2) {
                            echo '<span class="badge badge-info">daily</span>';
                        } else {
                            echo '<span class="badge badge-warning">customer</span>';
                        }
                        ?>
                </td>
                <td class="text-nowrap text-center">
                    <?= ($list->IsObserve == 0 or $list->IsObserve == null) ? '<span class="badge badge-secondary">no</span>' : '<span class="badge badge-info">yes</span>'; ?>
                </td>
                <td class="text-nowrap text-center"><?= nice_date($list->TimeIn, 'H:i:s'); ?></td>
                <td class="text-nowrap text-center"><?= (nice_date($list->TimeOut, 'H:i:s') != '00:00:00') ? nice_date($list->TimeOut, 'H:i:s') : null; ?></td>
                <td class="text-nowrap text-center">
                    <?= ($list->IsOnDuty == 0 or $list->IsOnDuty == null) ? '<span class="badge badge-secondary">no</span>' : '<span class="badge badge-info">yes</span>'; ?>
                </td>
                <td class="text-nowrap text-center">
                    <?= ($list->IsCurable == 0 or $list->IsCurable == null) ? '<span class="badge badge-secondary">no</span>' : '<span class="badge badge-info">yes</span>'; ?>
                </td>
                <td class="text-nowrap text-center"><?= $list->HospitalCode; ?></td>
                <td class="text-nowrap text-center">
                    <?= ($list->IsSickLeave == 0 or $list->IsSickLeave == null) ? '<span class="badge badge-secondary">no</span>' : '<span class="badge badge-info">yes</span>'; ?>
                </td>
                <td class="text-nowrap text-center">
                    <?= (!empty($list->LeaveFrom) && nice_date($list->LeaveFrom, 'Y') != '1900') ? nice_date($list->LeaveFrom, 'Y-m-d') : ''; ?>
                </td>
                <td class="text-nowrap text-center">
                    <?= (!empty($list->LeaveTo) && nice_date($list->LeaveFrom, 'Y') != '1900') ? nice_date($list->LeaveTo, 'Y-m-d') : ''; ?>
                </td>
                <td class="text-nowrap"><?= $list->Diagnosis; ?></td>
                <td class="text-nowrap text-center"><?= $list->CreatedBy; ?></td>
                <td class="text-nowrap text-center">
                    <?php
                        if ($list->IsSickLeave == 1) { ?>
                        <a href="#" id='<?= $list->DocNo; ?>' class="btn btn-warning btn-sm" title="re-print" onclick="GetSickLeaveByDocNo(this.id);"><i class="fa fa-print"></i></a>
                    <?php } ?>
                    <a href="#updateModal" data-toggle="modal" data-docno="<?= $list->DocNo; ?>" class="btn btn-info btn-sm" title="edit sick laeve"><i class="fas fa-edit"></i></a>
                    <a href="#" id="<?= $list->TID; ?>" class="btn btn-danger btn-sm" onclick="OnVoid(this.id);" title="void"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            order: [
                [1, 'desc']
            ],
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success d-none btn-export',
                text: '<i class="fas fa-file-excel"></i> Export to Excel</i>',
                title: 'visit-record-list'
            }]
        });
    });

    function OnVoid(id) {
        Swal.fire({
            title: 'Confirm?',
            text: "",
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'GET',
                    url: "<?= base_url('ReportController/InitVoided') ?>/" + id,
                }).done(function(data) {
                    $.smkAlert({
                        text: data.message,
                        type: data.status
                    });

                    GetVisitList();

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    SmkAlert('Something went wrong, please contact IT', 'danger');
                });
            }
        })
    }

    function ExportData(btnExp) {
        $('.btn-export').trigger('click');
    }
</script>