<div id="updateModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-edit"></i> <strong>UPDATE DATA DOCNO</strong>
                            <i class="fas fa-grip-lines-vertical"></i>
                            <small class="text-danger" id="docNo"></small>
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="frmUpdate" method="POST" , autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body pt-1">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                        <h4>Visit Info</h4>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fab fa-accessible-icon fa-3x"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <table class="table table-no-border">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-right"><strong>Time-In:</strong></td>
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
                                            </div>

                                            <div class="row no-gutters align-items-center mt-4">
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

                                <div class="col-md-6">
                                    <div class="card border-right-warning shadow h-100 py-2">
                                        <div class="card-body pt-1">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                        <h4>Sick Leave Info</h4>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-medical fa-3x"></i>
                                                </div>
                                            </div>

                                            <section class="mb-2">
                                                <h6 class="mb-2">
                                                    <strong>Advice for sick leave:</strong> <span id="totalDays" class="font-weight-bold">1</span> <strong>Day(s)</strong>
                                                </h6>
                                            </section>
                                            <hr>
                                            <section class="mb-2">
                                                <div class="input-group">
                                                    <input type="date" name="LeaveFrom" id="LeaveFrom" class="form-control" onchange="OnChangeDate($('#LeaveFrom').val(), $('#LeaveTo').val());">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text input-group-text-sm">
                                                            <i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" name="LeaveTo" id="LeaveTo" class="form-control" onchange="OnChangeDate($('#LeaveFrom').val(), $('#LeaveTo').val());">
                                                </div>
                                            </section>
                                            <section class="mb-4">
                                                <textarea name="Diagnosis" id="Diagnosis" cols="30" rows="3" class="form-control" placeholder="Diagnosis and Note"></textarea>
                                            </section>
                                            <hr>
                                            <section class="mb-2 text-right">
                                                <button type="button" class="btn btn-primary btn-action" onclick="UpdateData();"><i class="fas fa-sync-alt"></i> Update Data</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                            </section>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var getDocNo;
    var isSickLeave;

    $(function() {
        $('#updateModal').on('show.bs.modal', function(e) {
            getDocNo = $(e.relatedTarget).data('docno');
            $(e.currentTarget).find('#docNo').text(getDocNo);

            GetData(getDocNo);
        });
    })

    $(function() {
        $('#updateModal').on('hide.bs.modal', function(e) {
            $('#frmUpdate')[0].reset();
            $('#itemList tr').remove();
            $('.modal-backdrop').remove();
        });
    })

    function GetData(docNo) {
        $.ajax({
            type: "GET",
            url: "<?= site_url('ReportController/FetchDataByDocNo') ?>/" + docNo,
            dataType: "JSON",
            cache: false
        }).done(function(data) {
            isSickLeave = data.visit.IsSickLeave;

            $('#TimeIn').timepicker('setTime', data.visit.TimeIn);

            if (data.visit.TimeOut.startsWith('00:00:00') == false) {
                $('#TimeOut').timepicker('setTime', data.visit.TimeOut);
            }

            if (data.visit.IsOnDuty) {
                $("input[name='IsOnDuty'][value=1]").prop('checked', true);
            } else {
                $("input[name='IsOnDuty'][value=0]").prop('checked', true);
            }

            if (data.visit.IsObserve) {
                $('#observe').prop('checked', true);
            } else {
                $('#observe').prop('checked', false);
            }

            if (data.visit.IsCurable) {
                $("input[name='IsCurable'][value=1]").prop('checked', true);
                $('#HospitalCode').prop('disabled', true)
            } else {
                $("input[name='IsCurable'][value=0]").prop('checked', true);
                $('#HospitalCode').prop('disabled', false)
            }

            $('#HospitalCode').val(data.visit.HospitalCode);

            var disList = data.visit.DisCode;

            if (!$.isEmptyObject(disList)) {
                var disArray = new Array();
                disArray = disList.split(',');

                $('#disSelect').val(disArray).change();
            }

            if (!$.isEmptyObject(data.dispensing)) {
                $.each(data.dispensing, function(i, val) {
                    MedAppending(val);
                });
            }

            var fDate;
            var tDate;
            var currentDate = moment().format('YYYY-MM-DD');

            if ($.isEmptyObject(data.visit.LeaveFrom) || data.visit.LeaveFrom.startsWith('1900') == false) {
                if (data.visit.IsSickLeave == 1) {
                    fDate = currentDate;
                }
            } else {
                fDate = moment(data.visit.LeaveFrom).format('YYYY-MM-DD');
            }

            if ($.isEmptyObject(data.visit.LeaveTo) || data.visit.LeaveTo.startsWith('1900') == false) {
                if (data.visit.IsSickLeave == 1) {
                    tDate = currentDate;
                }
            } else {
                tDate = moment(data.visit.LeaveTo).format('YYYY-MM-DD');
            }

            $('#LeaveFrom').val(fDate);
            $('#LeaveTo').val(tDate);

            OnChangeDate(fDate, tDate);

            $('#Diagnosis').val(data.visit.Diagnosis);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });
    }

    function UpdateData() {
        var formData = $('#frmUpdate').serialize();
        var disCodeList = new Array();

        $.each($('#disSelect').select2('data'), function(key, item) {
            disCodeList.push(item.id);
        });

        var params = {
            docNo: getDocNo,
            disCodeList: disCodeList.join(','),
        }

        $.ajax({
            type: 'POST',
            url: "<?= site_url('ServiceController/InitUpdateTransaction') ?>",
            data: formData + '&' + $.param(params)
        }).done(function(data) {
            SaveDispensing('update', getDocNo);

            $('#updateModal').modal('hide');

            if (isSickLeave == 1) {
                GetSickLeaveByDocNo(getDocNo);
            }

            GetVisitList();
        }).fail(function(jqXHR, textStatus, errorThrown) {
            SmkAlert('Something went wrong, please contact IT', 'danger');
        });
    }
</script>