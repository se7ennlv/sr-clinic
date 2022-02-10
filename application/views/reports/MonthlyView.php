<div class="card mb-4 border-top-primary">
	<div class="card-body">
		<h5 class="m-0 font-weight-bold text-primary pull-left">
			<i class="fa fa-th-list"></i> <strong>Monthly reports</strong>
		</h5>
		<hr>

		<form name="frmDates" id="frmDates" class="form-inline" action="#" autocomplete="off" method="POST" novalidate>
			<div class="input-group ml-1 mr-1 mt-4 form-group">
				<label for="">Date Range:</label>&ensp;
				<input type="text" name="fromDate" id="fromDate" class="form-control date-picker" readonly required>
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i></span>
				</div>
				<input type="text" name="toDate" id="toDate" class="form-control date-picker" readonly required>
			</div>
			<div class="form-group mt-4">
				<button type="button" class="btn btn-info" id="btnShow1" onclick="PrintReport();"><i class="fas fa-print"></i> Summary Monthly Report</button>
				<i class="fas fa-grip-lines-vertical ml-1 mr-1"></i>
				<button type="button" class="btn btn-info" id="btnShow2" onclick="PrintVisitByDepartment();"><i class="fas fa-print"></i> Summary Patient by Department</button>
				<i class="fas fa-grip-lines-vertical ml-1 mr-1"></i>
				<button type="button" class="btn btn-info" id="btnShow3" onclick="PrintDiseases();"><i class="fas fa-print"></i> Summary Diseases</button>
			</div>
			<!-- <i class="fas fa-grip-lines-vertical ml-1 mr-1"></i>
            <button type="button" class="btn btn-success"><i class="fas fa-file-excel"></i> Export</button> -->
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
					$('#btnShow1').addClass('d-none');
					$('#btnShow2').addClass('d-none');
					$('#btnShow3').addClass('d-none');
				} else {
					$('#btnShow1').removeClass('d-none');
					$('#btnShow2').removeClass('d-none');
					$('#btnShow3').removeClass('d-none');
				}
			});
		});

	});

	function PrintReport() {
		if ($('#frmDates').smkValidate()) {
			var fDate = $('#fromDate').val();
			var tDate = $('#toDate').val();
			var newWindow = window.open('http://172.16.98.171/srclinic/ReportController/PrintReportView?fDate=' +
				fDate + '&tDate=' + tDate + '');
			// if (window.focus) {
			//     newWindow.focus();
			//     newWindow.print();
			// }
		}
	}

	function PrintVisitByDepartment() {
		if ($('#frmDates').smkValidate()) {
			var fDate = $('#fromDate').val();
			var tDate = $('#toDate').val();
			var newWindow = window.open(
				'http://172.16.98.171/srclinic/ReportController/PrintReportPetiatBydept?fDate=' + fDate +
				'&tDate=' + tDate + '');
		}
	}

	function PrintDiseases() {
		if ($('#frmDates').smkValidate()) {
			var fDate = $('#fromDate').val();
			var tDate = $('#toDate').val();
			var newWindow = window.open(
				'http://172.16.98.171/srclinic/ReportController/PrintReportDiseases?fDate=' + fDate +
				'&tDate=' + tDate + '');
		}
	}
</script>
