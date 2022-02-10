<div class="card mb-4 py-3 border-top-primary">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fas fa-th-list"></i> <strong>Patient History List</strong></h5>
        <hr>
        <button type="button" class="btn btn-primary" onclick="PatientModal();">
            <i class="fas fa-plus-circle"></i> Add New
        </button>
        <i class="fas fa-grip-lines-vertical"></i>
        <button type="button" class="btn btn-success" onclick="ExportDate();">
            <i class="fas fa-file-excel"></i> Export to Excel</i>
        </button>
        <i class="fas fa-grip-lines-vertical"></i>
        <span class="text-info font-weight-bold"><i class="fas fa-info-circle"></i> Double click on the row to update</span>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered stripe row-border order-column table-wrapper" id="dataTable" width="100%" style="cursor: pointer;">
                <thead>
                    <tr>
                        <th class="text-nowrap text-center">#</th>
                        <th class="text-nowrap text-center">ID</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap text-center">Gender</th>
                        <th class="text-nowrap text-center">Age</th>
                        <th class="text-nowrap">Dept</th>
                        <th class="text-nowrap">Position</th>
                        <th class="text-nowrap text-center">ID Card</th>
                        <th class="text-nowrap text-center">SSO</th>
                        <th class="text-nowrap">Phone</th>
                        <th class="text-nowrap text-center">Group</th>
                        <th class="text-nowrap text-center">Player Level</th>
                        <th class="text-nowrap text-center">Blood Group</th>
                        <th class="text-nowrap text-center">Weigth</th>
                        <th class="text-nowrap text-center">Height</th>
                        <th class="text-nowrap text-center">BMI</th>
                        <th class="text-nowrap">Medicines Allergy</th>
                        <th class="text-nowrap">Congenital Diseases</th>
                        <th class="text-nowrap">Surgery</th>
                        <th class="text-nowrap text-center">Last Update</th>
                        <th class="text-nowrap text-center">Actions</th>
                        <th class="d-none">PID</th>
                        <th class="d-none">GroupID</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#dataTable').DataTable({
            pageLength: 10,
            serverSide: true,
            processing: true,
            order: [
                [10, 'asc']
            ],
            ajax: {
                url: "<?= site_url('PatientController/FetchPatientHisDataTable'); ?>"
            },
            columns: [{
                    data: "PHID",
                    className: 'text-center',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'PID',
                    className: "text-center"
                },
                {
                    data: 'FullName',
                    className: "text-nowrap"
                },
                {
                    data: 'Gender',
                    className: "text-center"
                },
                {
                    data: 'BirthDate',
                    className: "text-center",
                    render: function(data, type, row) {
                        var age = moment().diff(data, 'years');

                        return (!isNaN(age)) ? age : null;
                    }
                },
                {
                    data: 'DeptCode',
                    className: "text-nowrap"
                },
                {
                    data: 'Positions',
                    className: "text-nowrap"
                },
                {
                    data: 'IDCard',
                    className: "text-center"
                },
                {
                    data: 'SSO',
                    className: "text-nowrap"
                },
                {
                    data: 'Tel',
                    className: "text-nowrap text-center"
                },
                {
                    data: 'PatientGroupID',
                    className: "text-center",
                    render: function(data, type, row) {
                        var fullTime = '<span class="badge badge-primary">full-time</span>';
                        var daily = '<span class="badge badge-success">daily</span>';
                        var customer = '<span class="badge badge-warning">customer</span>';

                        return (data == 1) ? fullTime : (data == 2) ? daily : customer
                    }
                },
                {
                    data: 'PyLevel',
                    className: "text-center"
                },
                {
                    data: 'BloodGroup',
                    className: "text-center"
                },
                {
                    data: 'Weight',
                    className: "text-center"
                },
                {
                    data: 'Height',
                    className: "text-center"
                },
                {
                    data: 'BMI',
                    className: "text-center"
                },
                {
                    data: 'MedDesc',
                    className: "text-nowrap",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<span class="data-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="' + data + '">' + data + '</span>';
                    }
                },
                {
                    data: 'DisDesc',
                    className: "text-nowrap",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<span class="data-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="' + data + '">' + data + '</span>';
                    }
                },
                {
                    data: 'Surgery',
                    className: "text-nowrap",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<span class="data-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="' + data + '">' + data + '</span>';
                    }
                },
                {
                    data: 'UpdatedAt',
                    className: "text-center text-nowrap",
                    render: function(data) {
                        return (moment(data).isValid()) ? moment(data).format('YYYY-MM-DD h:mm') : null;
                    }

                },
                {
                    data: 'PHID',
                    className: 'text-nowrap text-center',
                    render: function(data, type, row) {
                        var btnActions = '<a href="#" onclick="ConfirmActions(' + data + ')" class="btn btn-danger btn-xs text-white" title="delete"><i class="fas fa-times"></i></a>';

                        return btnActions;
                    }
                },
                {
                    data: 'PHID',
                    className: "d-none"
                },
                {
                    data: 'PatientGroupID',
                    className: "d-none"
                }
            ],
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success d-none btn-exp',
                text: '<i class="fas fa-file-excel"></i> Export to Excel</i>',
                title: 'patients-report'
            }],
            drawCallback: function() {
                $('[data-toggle="popover"]').popover();
            },
        });
    });

    function DisablePatient(phid) {
        $.ajax({
            method: 'POST',
            url: "<?= site_url('PatientController/InitDisablePatient') ?>/" + phid,
        }).done(function(data) {
            $.smkAlert({
                type: data.status,
                text: data.message
            });

            $('#dataTable').DataTable().ajax.reload(null, false);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });
    }

    function ExportDate() {
        $('.btn-exp').click();
    }

    function ConfirmActions(phid) {
        Swal.fire({
            title: null,
            text: "Please confirm?",
            type: 'question',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                DisablePatient(phid);
            }
        });
    }

    function PatientModal() {
        $('#patientModal').modal('show');
    }

    function UpdatePatient(phid, pid, groupId) {
        $('#PatientGroupID').val(groupId);
        $('#PHID').val(phid);
        $('#PID').val(pid);
        $('#patientModal').modal('show');

        GetPatientsInfo();

        return false;
    }

    $('#dataTable').on('dblclick', 'tr', function() {
        var phid = $(this).find('td:eq(21)').text().trim();
        var pid = $(this).find('td:eq(1)').text();
        var groupId = $(this).find('td:eq(22)').text();

        UpdatePatient(phid, pid, groupId);
    });
</script>