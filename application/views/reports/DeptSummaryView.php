<div class="card mb-4 border-top-primary">
    <div class="card-body">
        <h5 class="m-0 font-weight-bold text-primary pull-left">
            <i class="fa fa-th-list"></i> <strong>Visit Summary by Departments</strong>
        </h5>
        <hr>

        <form name="frmDates" id="frmDates" class="form-inline" action="#" autocomplete="off" method="POST" novalidate>
            <div class="input-group ml-1 mr-1 form-group">
                <label for="">Date Range:</label>&ensp;
                <input type="text" name="fromDate" id="fromDate" class="form-control date-picker" readonly required>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i></span>
                </div>
                <input type="text" name="toDate" id="toDate" class="form-control date-picker" readonly required>
            </div>
            <button type="button" class="btn btn-info" id="btnShow" onclick="GetDataList();"><i class="fas fa-sync-alt"></i> Process</button>
            <i class="fas fa-grip-lines-vertical ml-1 mr-1"></i>
            <button type="button" class="btn btn-success" onclick="ExportData();"><i class="fas fa-file-excel"></i> Export</button>
            <!-- <i class="fas fa-grip-lines-vertical ml-1 mr-1"></i>
			<button type="button" class="btn btn-info" id="btnShow" onclick="PrintVisitByDepartment();"><i class="fas fa-print"></i> Print</button> -->
        </form>

        <hr>

        <div class="table-responsive overflow-auto" style="max-height: 557px;" id="dynamicData">
            <!-- dynamic -->
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $(function() {
            $('.date-picker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            }).on('change', function(e) {
                var fDate = $('#fromDate').val();
                var tDate = $('#toDate').val();

                if ((Date.parse(fDate) >= Date.parse(tDate))) {
                    SwalAlert('error', 'End date should be greater than Start date');
                    $('#btnShow').addClass('d-none');
                } else {
                    $('#btnShow').removeClass('d-none');
                }
            });
        });

    });

    function GetDataList() {
        if ($('#frmDates').smkValidate()) {
            var fDate = $('#fromDate').val();
            var tDate = $('#toDate').val();

            $.ajax({
                type: 'GET',
                url: "<?= site_url('ReportController/FetchDeptSummary') ?>/" + fDate + '/' + tDate,
                beforeSend: function() {
                    BlockUI('Processing...');
                }
            }).done(function(data) {
                UnblockUI();
                $('#dynamicData').html(data);
            });
        }

        return false;
	}
	
	// function PrintVisitByDepartment()
	// {
	// 	if ($('#frmDates').smkValidate()) {
	// 		var fDate = $('#fromDate').val();
	// 		var tDate = $('#toDate').val();
	// 	var newWindow = window.open('http://172.16.98.171/srclinic_dev/ReportController/PrintReportPetiatBydept?fDate='+ fDate +'&tDate=' +tDate+'');
	// 	}
	// }
</script>
