<div class="card mb-4 border-top-warning">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fas fa-procedures"></i> <strong>Patients Health History Report</strong></h5>
        <hr>
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered dataTable table-wrapper" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th class="text-nowrap">Patient ID</th>
                        <th class="text-nowrap">Patient Name</th>
                        <th class="text-center text-nowrap">Gender</th>
                        <th class="text-nowrap">Dept</th>
                        <th class="text-nowrap">Position</th>
                        <th class="text-nowrap">Patient Group</th>
                        <th class="text-center">Blood Group</th>
                        <th class="text-center">Weight</th>
                        <th class="text-center">Height</th>
                        <th class="text-center">BMI</th>
                        <th class="text-center">Medicines Allergy</th>
                        <th class="text-center">Congenital Disease</th>
                        <th class="text-center">Surgery</th>
                        <th class="text-center">Last Update</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        FetchDataTable();
    });

    function FetchDataTable() {
        $('#dataTable').DataTable({
            pageLength: 10,
            serverSide: true,
            processing: true,
            ajax: {
                method: 'POST',
                url: "<?php echo site_url('ReportController/FetchHealthHisDataTable'); ?>"
            },
            columns: [{
                    data: 'PatientID',
                    className: "text-center"
                },
                {
                    data: 'PatientName'
                },
                {
                    data: 'Gender',
                    className: "text-center"
                },
                {
                    data: 'Dept'
                },
                {
                    data: 'Position',
                    className: "text-center"
                },
                {
                    data: {
                        PatientGroupID: 'PatientGroupID',
                        PatientGroupName: 'PatientGroupName'
                    },
                    render: function(data, type, row) {
                        var className = (data.PatientGroupID == 1) ? className = 'badge-primary' : (data.PatientGroupID == 2) ? className = 'badge-success' : className = 'badge-warning';

                        return '<span class="badge ' + className + '">' + data.PatientGroupName + '</span>';
                    },
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
                    className: "text-center",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<span class="data-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="' + data + '">' + data + '</span>';
                    }

                },
                {
                    data: 'DisDesc',
                    className: "text-center",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<span class="data-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="' + data + '">' + data + '</span>';
                    }
                },
                {
                    data: 'Surgery',
                    className: "text-center",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<span class="data-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="' + data + '">' + data + '</span>';
                    }
                },
                {
                    data: 'UpdatedAt',
                    className: 'text-center',
                    render: function(data) {
                        return moment().format('YYYY-MM-DD h:mm:ss')
                    }
                },
                {
                    data: {
                        PatientID: 'PatientID',
                        PatientGroupID: 'PatientGroupID',
                        PatientGroupName: 'PatientGroupName',
                    },
                    render: function(data, type, row) {
                        var btnActions;
                        btnActions = '<a href="#" onClick="UpdateHealthHisInfo(' + data.PatientID + ', ' + data.PatientGroupID + ', \'' + data.PatientGroupName + '\')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';

                        return btnActions;
                    },
                    orderable: false,
                    className: "text-center text-nowrap"
                }

            ],
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="fas fa-file-excel"></i> Export to Excel</i>',
                title: 'patients-health-history-report'
            }],
            drawCallback: function() {
                $('[data-toggle="popover"]').popover();
            },
        });
    }


    function UpdateHealthHisInfo(pid, groupId, groupName) {
        $.ajax({
            url: "<?= site_url('ServiceController/HealthHisRecordView'); ?>"
        }).done(function(data) {
            $("#mainApp").html(data);
            $('#PatientID').val(pid);
            GetPatientGroup(groupId, groupName);
            GetPatientsInfo();
        });

        return false;
    }
</script>