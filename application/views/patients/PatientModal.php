<div id="patientModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel"><i class="fas fa-user-injured"></i> Patient Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmData" id="frmData" method="POST" autocomplete="off" novalidate="off">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card mb-4 border-left-primary">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <h4>General Info</h4>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-circle fa-5x" id="userIcon"></i>
                                            <a href="#" class="fancybox p-image">
                                                <img src="" class="rounded mx-auto d-block p-image">
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table inside-hor-border">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right"><strong>Group:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <select name="PatientGroupID" id="PatientGroupID" class="form-control custom-select-sm">
                                                                    <option value="1" class="text-primary font-weight-bold">Full-Time Employee</option>
                                                                    <option value="2" class="text-success font-weight-bold">Daily Employee</option>
                                                                    <option value="3" class="text-warning font-weight-bold">Customer</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="text-right"><strong>Photo File:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <input type="text" name="PhotoFile" id="PhotoFile" class="form-control custom-select-sm" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right text-nowrap"><strong>PID:</strong></td>
                                                        <td>
                                                            <div class="input-group form-group no-mb" style="cursor: pointer;">
                                                                <input type="hidden" name="PHID" id="PHID">
                                                                <input type="text" name="PID" id="PID" class="form-control custom-select-sm" maxlength="8" autocomplete="off" required>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" onclick="GetPatientsInfo();"><i class="fas fa-binoculars"></i></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right text-nowrap"><strong>Birth Date:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <input type="date" name="BirthDate" id="BirthDate" class="form-control custom-select-sm">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right text-nowrap"><strong>Full Name:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <input type="text" name="FullName" id="FullName" class="form-control custom-select-sm" required>
                                                            </div>
                                                        </td>
                                                        <td class="text-right"><strong>Phone:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <input type="text" name="Tel" id="Tel" class="form-control custom-select-sm">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Sex:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <select name="Gender" id="Gender" class="form-control custom-select-sm" required>
                                                                    <option value="">Select</option>
                                                                    <option value="M">Male</option>
                                                                    <option value="F">Female</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="text-right"><strong>ID Card:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <input type="text" name="IDCard" id="IDCard" class="form-control custom-select-sm">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Position:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <select name="Positions" id="Positions" class="form-control job-list select2 custom-select-sm" style="width: 100%">
                                                                    <option value="">Select</option>
                                                                    <?php foreach ($jobs as $job) { ?>
                                                                        <option value="<?= $job->JobName; ?>"><?= $job->JobName; ?></option>
                                                                    <?php  } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="text-right"><strong>SSO:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <input type="text" name="SSO" id="SSO" class="form-control custom-select-sm">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>DEPT:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <select name="DeptCode" id="DeptCode" class="form-control select2 custom-select-sm" style="width: 100%">>
                                                                    <option value="">Select</option>
                                                                    <?php foreach ($depts as $dept) { ?>
                                                                        <option value="<?= $dept->DeptCode; ?>"><?= $dept->DeptCode; ?></option>
                                                                    <?php  } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="text-right"><strong>Level:</strong></td>
                                                        <td>
                                                            <div class="form-group no-mb">
                                                                <select name="PyLevel" id="PyLevel" class="form-control custom-select-sm">
                                                                    <option value="">Select</option>
                                                                    <option value="VVIP">VVIP</option>
                                                                    <option value="VIP">VIP</option>
                                                                    <option value="BLACK">BLACK</option>
                                                                    <option value="GOLD">GOLD</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">
                                                            <strong>Address:</strong>
                                                        </td>
                                                        <td colspan="3">
                                                            <div class="form-group no-mb">
                                                                <textarea name="Address" id="Address" cols="15" rows="3" class="form-control custom-select-sm"></textarea>
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
                        <div class="col-md-5">
                            <div class="card mb-4 py-3 border-left-warning">
                                <div class="card-body">
                                    <table class="table table-no-border">
                                        <tr>
                                            <td colspan="4" class="text-nowrap"><strong>Medicines Allergy</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="form-group form-table">
                                                    <select name="" id="medSelect" class="form-control select2" multiple="multiple" style="width: 100%">
                                                        <?php foreach ($mds as $md) { ?>
                                                            <option value="<?= $md->Code; ?>"><?= $md->Code; ?>-<?= $md->Name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-nowrap"><strong>Congenital Disease</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="form-group form-table">
                                                    <select name="" id="disSelect" class="form-control select2 test" multiple="multiple" style="width: 100%">
                                                        <?php foreach ($dises as $dis) { ?>
                                                            <option value="<?= $dis->Code; ?>"><?= $dis->Code; ?>-<?= $dis->Name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap"><strong>Surgery:</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="form-group form-table">
                                                    <textarea name="Surgery" id="Surgery" cols="15" rows="2" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-nowrap"><span class="text-danger">*</span> <strong>Blood Group</strong></td>
                                            <td class="text-center text-nowrap"><span class="text-danger">*</span> <strong>Height</strong></td>
                                            <td class="text-center text-nowrap"><span class="text-danger">*</span> <strong>Weight</strong></td>
                                            <td class="text-center text-nowrap"><strong>BMI</strong></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group form-table">
                                                    <select name="BloodGroup" id="BloodGroup" class="form-control custom-select-sm">
                                                        <option value="">Select</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group form-table">
                                                    <input type="number" name="Height" id="Height" class="form-control custom-select-sm" onkeyup="BMICalc($.trim($('#Weight').val()), $.trim($('#Height').val()));">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group form-table">
                                                    <input type="number" name="Weight" id="Weight" class="form-control custom-select-sm" onkeyup="BMICalc($.trim($('#Weight').val()), $.trim($('#Height').val()));">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-group form-table">
                                                    <input type="text" name="BMI" id="BMI" class="form-control custom-select-sm text-center text-white" readonly style="width: 5rem; cursor: pointer;">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <hr class="sidebar-divider">

                                    <div class="form-group mt-2">
                                        <button type="button" class="btn btn-primary" onclick="AddPatient();" id="btnActions"><i class="fas fa-save"></i> Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var actions;

    $(function() {
        $('#PID').on("keypress", function(e) {
            if (e.which == 13) {
                GetPatientsInfo();
            }
        });

        return false;
    });

    function GetPatientsInfo() {
        var rawStr = $('#PID').val();
        var pid = DataFilter(rawStr);
        var groupId = $('#PatientGroupID').val();

        if (pid.length <= 0) {
            SwalAlert('error', 'Please enter ID');
        } else {
            CheckPatientOnDB(pid, groupId, function(data) {
                if (data <= 0) {
                    if (groupId == 1) {
                        FetchOneFullTimeEmp(pid);
                    } else if (groupId == 2) {
                        FetchOneDailyEmp(pid);
                    } else {
                        FetchOneCustomer(pid);
                    }

                    $('#btnActions').html('<i class="fas fa-save"></i> Save');
                    actions = 'add';
                } else {
                    FetchOnePatient(pid, groupId);
                    $('#btnActions').html('<i class="fas fa-edit"></i> Update');
                    actions = 'update';
                }
            });
        }

        $('#PID').val(pid);

        return false;
    }

    function CheckPatientOnDB(pid, groupId, callback) {
        return $.ajax({
                method: 'GET',
                url: "<?= site_url('PatientController/FetchCountOnePatient') ?>/" + pid + "/" + groupId
            })
            .done(callback)
            .fail(function(jqXHR, textStatus, errorThrown) {
                SmkAlert('Something went wrong, please contact IT', 'danger');
            });
    }

    function DataAppending(photo, name, gender, job, dept, addr, birth, tel, idCard, sso, pyl, meds, diss, surg, blg, h, w, bmi) {
        if (!$.isEmptyObject(photo)) {
            var fileDir;
            var group = $('#PatientGroupID').val();

            if (group == 1) {
                fileDir = 'http://172.16.98.81:8090/psa/files/' + photo;

                $('#userIcon').addClass('d-none');
                $('.p-image').attr('href', fileDir).attr('title', name).attr('src', fileDir);
            } else if (group == 3) {
                fileDir = 'http://172.16.98.171/srm/uploads/' + photo;

                $('#userIcon').addClass('d-none');
                $('.p-image').attr('href', fileDir).attr('title', name).attr('src', fileDir);
            } else {
                $('#userIcon').removeClass('d-none');
            }
        } else {
            $('#userIcon').removeClass('d-none');
        }

        var medList = null;
        var disList = null;
        var medArray = new Array();
        var disArray = new Array();

        if (!$.isEmptyObject(meds)) {
            medList = meds;
            medArray = medList.split(',');
        }

        if (!$.isEmptyObject(diss)) {
            disList = diss;
            disArray = disList.split(',');
        }

        $('#FullName').val(name);
        $('#PhotoFile').val(photo);
        $('#Gender').val(gender);
        $('#Positions').val(job).change();
        $('#DeptCode').val(dept).change();
        $('#Address').val(addr);
        $('#BirthDate').val(birth);
        $('#Tel').val(tel);
        $('#IDCard').val(idCard);
        $('#SSO').val(sso);
        $('#PyLevel').val(pyl);
        $('#medSelect').val(medArray).change();
        $('#disSelect').val(disArray).change();
        $('#Surgery').val(surg);
        $('#BloodGroup').val(blg);
        $('#Height').val(h);
        $('#Weight').val(w);
        $('#BMI').val(bmi);

        BMICalc(w, h);
    }

    function FetchOnePatient(pid, groupId) {
        $.ajax({
            method: 'POST',
            url: "<?= site_url('PatientController/FetchOnePatient') ?>",
            data: {
                pid: pid,
                group: groupId
            },
            dataType: 'JSON',
            cache: false
        }).done(function(data) {
            if (!$.isEmptyObject(data)) {

                $('#PHID').val(data.PHID);

                DataAppending(data.PhotoFile, data.FullName, data.Gender, data.Positions, data.DeptCode, data.Address, data.BirthDate, data.Tel, data.IDCard, data.SSO, data.PyLevel, data.MedCode, data.DisCode, data.Surgery, data.BloodGroup, data.Height, data.Weight, data.BMI);
            } else {
                SwalAlert('warning', 'Sorry nurse, find not found please check entered ID and group selected');
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });

        return false;
    }

    function FetchOneFullTimeEmp(empId) {
        $.ajax({
            type: 'GET',
            url: "<?= site_url('PatientController/FetchOneFullTimeEmp') ?>/" + empId,
            dataType: 'json',
            cache: false
        }).done(function(data) {
            if (!$.isEmptyObject(data)) {
                DataAppending(data.PhotoFile, data.FullName, data.Gender, data.Position, data.DeptCode, data.Address, data.BirthDay, data.Phone, data.IDCard, data.SSN, null);
            } else {
                SwalAlert('warning', 'Sorry nurse, find not found please check entered ID and group selected');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });

        return false;
    }

    function FetchOneDailyEmp(empId) {
        $.ajax({
            type: 'GET',
            url: "<?= site_url('PatientController/FetchOneDailyEmp') ?>/" + empId,
            dataType: 'json',
            cache: false
        }).done(function(data) {
            if (!$.isEmptyObject(data)) {
                DataAppending(null, data.FullName, null, null, data.DeptCode, null, null, null, null, null, null);
            } else {
                SwalAlert('warning', 'Sorry nurse, find not found please check entered ID and group selected');
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });

        return false;
    }

    function FetchOneCustomer(custId) {
        $.ajax({
            type: 'GET',
            url: "<?= site_url('PatientController/FetchOneCustomer') ?>/" + custId,
            dataType: 'json',
            cache: false
        }).done(function(data) {
            if (!$.isEmptyObject(data)) {
                DataAppending(data.PhotoFile, data.FullName, data.Gender, null, null, null, null, null, null, null, data.Level);
            } else {
                SwalAlert('warning', 'Sorry nurse, find not found please check entered ID and group selected');
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });

        return false;
    }

    function BMICalc(weight, height) {
        if ((weight != null && weight > 0) && (height != null && height > 0)) {
            var bmi;
            var newCm = parseFloat(height / 100);

            bmi = weight / (newCm * newCm);
            bmi = bmi.toFixed(2);

            if (bmi <= 18.5) {
                $('#BMI').removeClass('bg-success bg-warning bg-danger').addClass('bg-secondary');
            }
            if (bmi >= 18.5 && bmi <= 25) {
                $('#BMI').removeClass('bg-secondary bg-warning bg-danger').addClass('bg-success');
            }
            if (bmi >= 25 && bmi <= 30) {
                $('#BMI').removeClass('bg-success bg-secondary bg-danger').addClass('bg-warning');
            }
            if (bmi > 30) {
                $('#BMI').removeClass('bg-success bg-secondary bg-warning').addClass('bg-danger');
            }

            $('#BMI').val(bmi);
        } else {
            $('#BMI').removeClass('bg-secondary bg-success bg-warning bg-danger');
        }
    }

    function AddPatient() {
        if ($('#frmData').smkValidate()) {
            var url;
            var formData = $('#frmData').serialize();

            var medCodeList = new Array();
            var medDescList = new Array();
            var disCodeList = new Array();
            var disDescList = new Array();

            $.each($('#medSelect').select2('data'), function(key, item) {
                medCodeList.push(item.id);
                medDescList.push(item.text);
            });

            $.each($('#disSelect').select2('data'), function(key, item) {
                disCodeList.push(item.id);
                disDescList.push(item.text);
            });

            var params = {
                medCodeList: medCodeList.join(','),
                medDescList: medDescList.join(', '),
                disCodeList: disCodeList.join(','),
                disDescList: disDescList.join(', ')
            }

            var msg;

            if (actions === 'add') {
                msg = 'Saving...'
                url = "<?= site_url('PatientController/InitInsertPatient') ?>";
            } else {
                msg = 'Updating...';
                url = "<?= site_url('PatientController/InitUpdatePatient') ?>";
            }

            $.ajax({
                type: 'POST',
                url: url,
                data: formData + '&' + $.param(params),
                beforeSend: function() {
                        BlockUI(msg);
                    }
            }).done(function(data) {
                UnblockUI();

                $.smkAlert({
                    type: data.status,
                    text: data.message
                });

                $('#patientModal').modal('hide');
                $('#dataTable').DataTable().ajax.reload(null, false);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                SmkAlert('Something went wrong, please contact IT', 'danger');
            });

        }
    }

    $(function() {
        $('#patientModal').on('hidden.bs.modal', function() {
            $('#frmData').smkClear();
            $('#btnActions').html('<i class="fas fa-save"></i> Save');
            $('#userIcon').addClass('d-none');

            $('.p-image').attr('href', '').attr('title', '').attr('src', '');
            $('#userIcon').removeClass('d-none');
        });
    });

    $(function() {
        $('.fancybox').fancybox();
    });
</script>