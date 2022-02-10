<script>
    $(function() {
        $('.timepicker').timepicker({
            showInputs: true,
            defaultTime: false
        })
    });

    $(function() {
        $('.select2').select2();
    });

    function DataFilter(rawStr) {
        var newStr = rawStr.replace('%', '').replace('?', '').replace('+', '').replace(';', '').replace('E', '');
        var pid;

        if (newStr.length == 8) {
            pid = newStr
        } else if (newStr.length > 6) {
            pid = newStr.substr(0, 6);
        } else {
            pid = newStr;
        }

        return pid;
    }

    function OnChangeDate(fromDate, toDate) {
        var numDays = 0;

        if (!$.isEmptyObject(fromDate) && !$.isEmptyObject(toDate)) {
            if (fromDate.startsWith('1900') == false && toDate.startsWith('1900') == false) {
                numDays = moment(toDate).diff(moment(fromDate), 'days') + 1;

                if (numDays >= 2) {
                    SwalAlert('warning', 'Just remind, seem too many days');
                }

                if (numDays <= 0) {
                    SwalAlert('error', 'Incorrect date period!');
                    $('.btn-action').attr('disabled', true);
                } else {
                    $('.btn-action').attr('disabled', false);
                }
            }
        }

        $('#totalDays').text(numDays);

        return false;
    }

    $(function() {
        $('#medSelect').on('select2:select', function() {
            var objs = {
                MedCode: $(this).find(':selected').data('mcode'),
                MedName: $(this).find(':selected').data('mname'),
                Stock: $(this).find(':selected').data('mstock')
            }

            if (objs.Stock <= 0) {
                SwalAlert('error', 'Out of stock, please go to medicines manage');
            } else {
                MedAppending(objs)

                $('#itemList').find('tr:last td').eq(2).find("input").focus();
            }
        })
    });

    $(function() {
        $('#itemList').on('click', '.del-row', function() {
            $(this).closest('tr').remove();
        });
    });

    $(function() {
        $("input[name='IsCurable']").on('change', function() {
            if ($(this).val() == 0) {
                $('#HospitalCode').attr('disabled', false).prop('selectedIndex', 1);
            } else {
                $('#HospitalCode').attr('disabled', true).prop('selectedIndex', 0);
            }
        });
    });

    var MedTemplate = [
        '<tr>',
        '<td class="text-nowrap">{{MedCode}}</td>',
        '<td class="text-nowrap">{{MedName}}</td>',
        '<td class="text-center text-nowrap">{{Stock}}</td>',
        '<td class="text-center text-nowrap"><input type="number" class="form-control input-qty" min="1" value="{{QtyUsed}}"></td>',
        '<td class="text-center text-nowrap"><button type="button" class="btn btn-danger btn-sm btn-remove del-row"><i class="fas fa-times"></i></button></td>',
        '</tr>'
    ].join("\n")

    function MedAppending(data) {
        var html = Mustache.render(MedTemplate, data);
        $('#itemList').append(html);
    }
    //===================================================== end =======================================//


    //==================================== dispension transaction ==================================//
    function SaveDispensing(action, getDocNo) {
        if (action === 'update') {
            DeleteDispensing(getDocNo);
        }

        $('#itemList').find('tr').each(
            function() {
                var params = {
                    docNo: getDocNo,
                    mcode: $(this).find('td').eq(0).text(),
                    mname: $(this).find('td').eq(1).text(),
                    qty: $(this).find('td').eq(3).find("input").val(),
                }

                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('ServiceController/InitInsertDispensing'); ?>",
                    data: $.param(params),
                    async: false
                }).done(function(data) {
                    CutStock(params.mcode, params.qty);
                });
            }
        );
    }

    function DeleteDispensing(docNo) {
        $.ajax({
            type: 'GET',
            url: "<?= site_url('ServiceController/InitDeleteDispensing'); ?>/" + docNo,
            async: false
        });
    }

    function CutStock(mcode, qtyUsed) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('ServiceController/InitCutStock'); ?>",
            data: {
                mcode: mcode,
                qtyUsed: qtyUsed
            },
            async: false
        });

        return false;
    }
    //===================================================== end =======================================//


    //==================================== get sick leave by doc no and show print dialog ==================================//
    function GetSickLeaveByDocNo(docNo) {
        $.ajax({
            type: 'GET',
            url: "<?= site_url('ReportController/FetchSickLeaveByDocNo') ?>/" + docNo,
            dataType: 'JSON',
            catch: false
        }).done(function(data) {
            var lis = '';

            $('#symptom').empty();

            if (!$.isEmptyObject(data)) {
                $('#slDocno').text(data.sl.DocNo);
                $('#slDate').text(moment(data.sl.CreatedAt).format('DD/MM/YYYY'));
                $('#slRn').text(data.sl.Fname + ' ' + data.sl.Lname);
                $('#slPid').text(data.sl.PatientID);
                $('#slPname').text(data.sl.PatientName);
                $('#slDept').text(data.sl.DeptCode);

                $.each(data.sld, function(key, val) {
                    if (!$.isEmptyObject(val.SympDesc)) {
                        lis += '<li><i class="far fa-check-square"></i> ' + val.DiseaseGroupName + ' (' + val.SympDesc + ')' + '</li>';
                    } else {
                        lis += '<li><i class="far fa-check-square"></i> ' + val.DiseaseGroupName + '</li>';
                    }
                });

                $('#symptom').append(lis);

                $('#slDiagnosis').text(data.sl.Diagnosis);

                if (!$.isEmptyObject(data.sl.LeaveFrom) && !$.isEmptyObject(data.sl.LeaveTo)) {
                    var numDays = moment(data.sl.LeaveTo).diff(moment(data.sl.LeaveFrom), 'days') + 1;
                    $('#slTotalDays').text(numDays);
                }

                $('#slFdate').text(moment(data.sl.LeaveFrom).format('DD/MM/YYYY'));
                $('#slTdate').text(moment(data.sl.LeaveTo).format('DD/MM/YYYY'));
            }

            PrintDoc();
        })

        return false;
    }

    function PrintDoc() {
        $('#printDoc').printThis({
            header: null,
            footer: null,
            importCSS: true,
            importStyle: true,
            loadCSS: "<?= base_url() . "assets/"; ?>css/sb-admin-2.css",
            pageTitle: "Certificate",
            beforePrint: function() {
                $('#slModal').modal('hide');
            }
        });

        return false;
    }
    //======================================================= end ===================================================//
</script>