<!-- Sick leave modal -->
<div id="slModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="card border-both-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning mb-1">
                                <h4>Sick leave submission</h4>
                            </div>
                            <hr>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-signature fa-3x"></i>
                        </div>
                    </div>
                    <form name="frmSL" id="frmSL" action="#" method="POST" autocomplete="off" novalidate>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <h4 class="text-primary"><span class="text-danger">*</span> Diseases Group</h4>
                                            <hr>
                                            <?php foreach ($dgroups as $dgroup) { ?>
                                                <div class="form-check">
                                                    <input type="checkbox" name="DiseaseGroup[]" class="form-check-input disgroup" id="<?= $dgroup->GroupCode; ?>" value="<?= $dgroup->GroupCode; ?>" data-display="<?= $dgroup->GroupName; ?>" onchange="GetChecked();" required>
                                                    <label class="form-check-label" for="<?= $dgroup->GroupCode; ?>">
                                                        <?= $dgroup->GroupName; ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card shadow mb-4" style="width: 15rem;">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">VITAL SIGNS</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <?php foreach ($vss as $vs) { ?>
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="font-size: 12px;"><?= $vs->Name; ?></span>
                                                            </div>
                                                            <input type="text" name="xxx[]" id="<?= 'vs' . $vs->VSID; ?>" class="form-control custom-select-sm vital-signs" maxlength="<?= $vs->MaxLength; ?>" readonly autocomplete="off">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" style="font-size: 12px;"><?= $vs->Unit; ?></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <textarea name="" id="remark1" cols="20" rows="2" class="form-control" placeholder="Severe pain remark" readonly></textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="" id="remark2" cols="20" rows="2" class="form-control mt-2" placeholder="Other remark" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <section>
                                    <h6 class="mb-2">
                                        <span class="text-danger">*</span><strong>Advice for sick leave:</strong> <span id="totalDays" class="font-weight-bold">1</span> <strong>Day(s)</strong>
                                    </h6>
                                    <hr>
                                    <div class="input-group">
                                        <input type="date" name="fromDate" id="LeaveFrom" class="form-control" value="<?= date('Y-m-d'); ?>" onchange="OnChangeDate($('#LeaveFrom').val(), $('#LeaveTo').val());">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-group-text-sm">
                                                <i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="toDate" id="LeaveTo" class="form-control" value="<?= date('Y-m-d'); ?>" onchange="OnChangeDate($('#LeaveFrom').val(), $('#LeaveTo').val());">
                                    </div>
                                </section>
                                <section class="mt-2">
                                    <div class="form-group">
                                        <span class="text-danger">*</span>
                                        <textarea name="diagnosis" id="diagnose" cols="30" rows="3" class="form-control" placeholder="Diagnosis and Note" required></textarea>
                                    </div>
                                </section>
                                <section class="mt-5">
                                    <button type="submit" class="btn btn-primary btn-action"><i class="fas fa-share"></i> Submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                </section>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        var getDocNo;

        $(function() {
            $('#slModal').on('show.bs.modal', function(e) {
                getDocNo = $(e.relatedTarget).data('docno');
            });
        })

        $(function() {
            $('#slModal').on('hide.bs.modal', function(e) {
                $('.modal-backdrop').remove();
                VisitRecord();
            });
        })

        function GetChecked() {
            if ($('input[id=VS]').is(':checked')) {
                $('.vital-signs').attr('readonly', false).eq(0).focus();
            } else {
                $('.vital-signs').attr('readonly', true).val('');
            }

            if ($('input[id=VP]').is(':checked')) {
                $('#remark1').attr('readonly', false).focus().attr('required', true);
            } else {
                $('#remark1').attr('readonly', true).val('').attr('required', false);
            }

            if ($('input[id=OTH]').is(':checked')) {
                $('#remark2').attr('readonly', false).focus().attr('required', true);
            } else {
                $('#remark2').attr('readonly', true).val('').attr('required', false);
            }

            return false;
        }

        $(function() {
            $('#frmSL').on('submit', function(e) {
                e.preventDefault();

                if ($(this).smkValidate()) {
                    SubmitSickLeave();
                }
            });
        });

        function SubmitSickLeave() {
            var params = {
                docNo: getDocNo,
                fdate: $('#LeaveFrom').val(),
                tdate: $('#LeaveTo').val(),
                diagnosis: $('#diagnose').val()
            }            

            $.ajax({
                type: 'POST',
                url: "<?= site_url('ServiceController/InitUpdateSickLeave') ?>",
                data: $.param(params),
                beforeSend: function() {
                    BlockUI('Submiting...');
                }
            }).done(function(data) {
                UnblockUI();
                
                $('input.disgroup:checkbox:checked').each(function() {
                    var diseCode = $(this).val();
                    var remarks = '';

                    if (diseCode == 'VP') {
                        remarks = $('#remark1').val();
                    } else if (diseCode == 'OTH') {
                        remarks = $('#remark2').val();
                    } else if (diseCode == 'VS') {
                        var bt = $.trim($('#vs' + 1).val());
                        var p = $.trim($('#vs' + 2).val());
                        var pr = $.trim($('#vs' + 3).val());
                        var bp = $.trim($('#vs' + 4).val());
                        var os = $.trim($('#vs' + 5).val());
                        var vitalSigns = '';

                        if (bt.length > 0) {
                            vitalSigns += 'BT=' + bt + 'C°, '
                        }
                        if (p.length > 0) {
                            vitalSigns += 'P=' + p + 'bpm, '
                        }
                        if (pr.length > 0) {
                            vitalSigns += 'PR=' + pr + 'bpm, '
                        }
                        if (bp.length > 0) {
                            vitalSigns += 'BP=' + bp + 'mm.Hg., '
                        }
                        if (os.length > 0) {
                            vitalSigns += 'O₂Sat=' + os + '%'
                        }

                        remarks = vitalSigns;
                    }

                    var params = {
                        docNo: getDocNo,
                        diseaseCode: diseCode,
                        diseaseName: $(this).data('display'),
                        sympDesc: remarks
                    }

                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('ServiceController/InitInsertSickLeaveDetail') ?>",
                        data: $.param(params),
                        async: false
                    });
                });

                GetSickLeaveByDocNo(getDocNo);
            });
        }
    </script>