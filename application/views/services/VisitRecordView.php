<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-user-plus"></i> <strong id="title">New Visit Record</strong>
            <i class="fas fa-grip-lines-vertical"></i>
            <span class="d-none" id="actions"><?= $actions; ?></span>
            <small class="text-danger" id="docNo"><?= $docno->DocNo; ?></small>
        </h6>
    </div>
    <div class="card-body">
        <form name="frmData" id="frmData" method="POST" autocomplete="off" novalidate="off">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body pt-1">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <h4>PATIENT INFO</h4>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-auto">
                                    <i class="fab fa-accessible-icon fa-3x text-success"></i>
                                </div>
                                <div class="table-responsive">
                                    <table class="table inside-hor-border">
                                        <tbody>
                                            <tr>
                                                <td rowspan="7" class="text-center">
                                                    <img id="pic" src="<?= base_url() ?>./assets/img/user-injured.png" class="img-thumbnail img-fluid" style="max-width: 175px; max-height: 180px"> </td>
                                                <td class="text-right">
                                                    <strong title="Patient Group">Group:</strong>
                                                </td>
                                                <td>
                                                    <div class="input-group" style="cursor: pointer;">
                                                        <select name="PatientGroupID" id="PatientGroupID" class="form-control custom-select-sm">
                                                            <option value="1" class="text-primary font-weight-bold">Full-Time Employee</option>
                                                            <option value="2" class="text-success font-weight-bold">Daily Employee</option>
                                                            <option value="3" class="text-warning font-weight-bold">Customer</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-nowrap">
                                                    <span class="text-danger">*</span> <strong>Patient ID:</strong>
                                                </td>
                                                <td>
                                                    <div class="input-group" style="cursor: pointer">
                                                        <input type="text" name="PatientID" id="PatientID" class="form-control custom-select-sm" maxlength="10" autocomplete="off" autofocus>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" onClick="CheckGroup();">
                                                                <i class="fas fa-binoculars"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Name:</strong>
                                                </td>
                                                <td>
                                                    <label class="p-name"></label>
                                                    <input type="hidden" name="PatientName" id="PatientName" class="p-name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Gender:</strong>
                                                </td>
                                                <td>
                                                    <div class="input-group" style="cursor: pointer;">
                                                        <select name="Gender" id="Gender" class="form-control custom-select-sm">
                                                            <option value="">Select</option>
                                                            <option value="M">M</option>
                                                            <option value="F">F</option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-restroom"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Position:</strong>
                                                </td>
                                                <td>
                                                    <label class="position"></label>
                                                    <input type="hidden" name="Position" class="position">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>DEPT:</strong>
                                                </td>
                                                <td>
                                                    <label class="dept-code"></label>
                                                    <input type="hidden" name="DeptCode" class="dept-code">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>SSO:</strong>
                                                </td>
                                                <td>
                                                    <label class="sso"></label>
                                                    <input type="hidden" name="SSO" class="sso">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-right">
                                                    <div class="form-group mt-5">
                                                        <button type="button" class="btn btn-primary btn-action" onClick="SubmitVisit(1);"><i class="fas fa-save"></i> Save Visit</button>
                                                        <button type="button" class="btn btn-success btn-action" data-toggle="modal" data-target="#slModal" data-docno="<?= $docno->DocNo; ?>" onClick="SubmitVisit(2);"><i class="fas fa-file-medical"></i> Save and Sick Leave</button>
                                                        <a href="./" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body pt-1">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        <h4>SERVICES</h4>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-auto">
                                    <i class="fab fa-servicestack text-warning fa-3x"></i>
                                </div>
                            </div>
                            <table class="table table-no-border">
                                <tbody>
                                    <tr>
                                        <td class="text-right"><span class="text-danger">*</span> <strong>Time-In:</strong></td>
                                        <td>
                                            <div class="input-group form-group form-table">
                                                <input type="text" name="TimeIn" id="TimeIn" data-format="hh:mm:ss" class="form-control timepicker custom-select-sm" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td valign="middle" class="text-right text-nowrap">
                                            <div class="form-check form-check-inline form-group form-table">
                                                <input class="form-check-input" type="radio" name="IsOnDuty" id="rd1" value="1" checked>
                                                <label class="form-check-label" for="rd1">
                                                    <strong>On Duty</strong>
                                                </label>
                                            </div>
                                        </td>
                                        <td valign="middle" class="text-nowrap">
                                            <div class="form-check form-check-inline form-group form-table">
                                                <input class="form-check-input" type="radio" name="IsOnDuty" id="rd2" value="0">
                                                <label class="form-check-label" for="rd2">
                                                    <strong>Day Off</strong>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right text-nowrap">
                                            <strong>Time-Out:</strong>
                                        </td>
                                        <td>
                                            <div class="input-group form-group form-table">
                                                <input type="text" name="TimeOut" id="TimeOut" data-format="hh:mm:ss" class="form-control timepicker custom-select-sm" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td valign="middle" class="text-right text-nowrap">
                                            <div class="form-check form-check-inline form-group form-table">
                                                <input class="form-check-input" type="radio" name="IsCurable" id="rd3" value="1" checked>
                                                <label class="form-check-label" for="rd3">
                                                    <strong>Curable</strong>
                                                </label>
                                            </div>
                                        </td>
                                        <td valign="middle" class="text-nowrap">
                                            <div class="form-check form-check-inline form-group form-table">
                                                <input class="form-check-input" type="radio" name="IsCurable" id="rd4" value="0">
                                                <label class="form-check-label" for="rd4">
                                                    <strong>Sent to Hospital</strong>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-center">
                                            <div class="form-check form-group form-table pl-0">
                                                <input type="checkbox" name="IsObserve" id="observe" class="form-check-input" value="1">
                                                <label class="form-check-label" for="observe">
                                                    <strong>Observe</strong>
                                                </label>
                                            </div>
                                        </td>
                                        <td valign="middle" class="text-right text-nowrap">
                                            <strong><i class="fas fa-ambulance"></i> Hospital</strong>
                                        </td>
                                        <td valign="middle" class="text-right text-nowrap">
                                            <div class="form-group form-table">
                                                <select name="HospitalCode" id="HospitalCode" class="form-control custom-select-sm" disabled>
                                                    <option value="">Select Hospital</option>
                                                    <option value="SH">Savannakhet Hospital</option>
                                                    <option value="MH">Mukdahan Hospital</option>
                                                    <option value="KH">Kaisone Hospital</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Diseases:</strong></td>
                                        <td colspan="3">
                                            <div class="form-group form-table">
                                                <select name="" id="disSelect" class="form-control select2" multiple="multiple" data-placeholder="Select Disease" style="width: 100%;">
                                                    <?php foreach ($dises as $dis) { ?>
                                                        <option value="<?= $dis->Code; ?>"><?= $dis->Code; ?>-<?= $dis->Name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row no-gutters align-items-center mt-5">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        <h4>Dispensing</h4>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-briefcase-medical fa-3x"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <select name="" id="medSelect" class="form-control select2" data-placeholder="Select Medicine" style="width: 100%;">
                                        <option value=""></option>
                                        <?php foreach ($mds as $md) { ?>
                                            <option value="<?= $md->MID; ?>" data-mcode="<?= $md->Code; ?>" data-mname="<?= $md->Name; ?>" data-mstock="<?= $md->Stock; ?>"><?= $md->Code; ?>-<?= $md->Name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row overflow-auto mt-1" style="height: 250px;">
                                <div class="col">
                                    <table class="table table-wrapper mt-3">
                                        <thead>
                                            <tr class="bg-gray-600 text-white">
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Remove</th>
                                            </tr>
                                        </thead>

                                        <tbody id="itemList">
                                            <!-- Dynamic data -->
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var getDocNo;

    $(document).ready(function() {
        getDocNo = $('#docNo').text();
    });

    $(function() {
        $('#PatientID').on("keypress", function(e) {
            if (e.which == 13) {
                CheckGroup();
            }
        });

        return false;
    });

    function CheckGroup() {
        var rawStr = $('#PatientID').val();
        var pid = DataFilter(rawStr);
        var group = $.trim($('#PatientGroupID').val());
        var url;

        console.log(pid);
        console.log(group);
        
        

        if (pid.length > 0) {
            if (group == 1) {
                url = "<?= site_url('PatientController/FetchOneFullTimeEmp') ?>";
            } else if (group == 2) {
                url = "<?= site_url('PatientController/FetchOneDailyEmp') ?>";
            } else {
                url = "<?= site_url('PatientController/FetchOneCustomer') ?>";
            }

            GetPatientData(url, pid, group);
        } else {
            SwalAlert('error', 'Please enter the patient ID!');
        }

        $('#PatientID').val(pid);

        return false;
    }

    function GetPatientData(url, pid, group) {
        $.ajax({
            type: 'GET',
            url: url + '/' + pid,
            dataType: 'JSON',
            beforeSend: function() {
                BlockUI('Retrieving data...');
            }
        }).done(function(data) {
            UnblockUI();

            if (!$.isEmptyObject(data)) {
                DataAppending(group, data.PhotoFile, data.FullName, data.Gender, data.Position, data.DeptCode, data.SSO);
            } else {
                SwalAlert('warning', 'Sorry, find not found please check entered ID and group selected');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });

        return false;
    }

    function DataAppending(group, photo, name, gender, job, dept, sso) {
        var file;

        if (!$.isEmptyObject(photo)) {
            if (group == 1) {
                file = 'http://172.16.98.81:8090/psa/files/' + photo;
            } else if (group == 3) {
                file = 'http://172.16.98.171/srm/uploads/' + photo;
            } else {
                file = "<?= base_url() ?>./assets/img/user-injured.png";
            }
        } else {
            file = "<?= base_url() ?>./assets/img/user-injured.png";
        }

        $('#pic').attr('src', file);
        $('.p-name').text(name).val(name);
        $('#Gender').val(gender);
        $('.position').text(job).val(job);
        $('.dept-code').text(dept).val(dept);
        $('.sso').text(sso).val(sso);
    }

    function DataValidate() {
        var pid = $.trim($('#PatientID').val());
        var pname = $.trim($('#PatientName').val());
        var gender = $.trim($('#Gender').val());
        var timeIn = $.trim($('#TimeIn').val());

        if ($.isEmptyObject(pid)) {
            SwalAlert('error', 'Please enter patient ID!');
            return false;
        } else if ($.isEmptyObject(pname)) {
            SwalAlert('error', 'The patient name cannot be blank');
            return false;
        } else if ($.isEmptyObject(gender)) {
            SwalAlert('error', 'The gender cannot be blank');
            return false;
        } else if ($.isEmptyObject(timeIn)) {
            SwalAlert('error', 'Please enter time-in!');
            return false;
        } else {
            return true;
        }
    }

    function SubmitVisit(action) {
        var formData = $('#frmData').serialize();
        var disCodeList = new Array();

        $.each($('#disSelect').select2('data'), function(key, item) {
            disCodeList.push(item.id);
        });

        var params = {
            docNo: getDocNo,
            disCodeList: disCodeList.join(','),
        }

        if (DataValidate()) {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('ServiceController/InitInsertTransaction') ?>",
                data: formData + '&' + $.param(params),
                beforeSend: function() {
                    BlockUI('Submiting...');
                }
            }).done(function(data) {
                UnblockUI();

                var isHasMed = $('#itemList tr').length;

                if (isHasMed > 0) {
                    SaveDispensing('add', getDocNo);
                }

                if (action == 1) {
                    VisitRecord();
                }

                SmkAlert(data.message, data.status);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                SmkAlert('Something went wrong, please contact IT', 'danger');
            });
        }
    }
</script>