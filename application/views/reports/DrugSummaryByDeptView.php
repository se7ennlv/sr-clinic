<div class="card mb-4 border-top-primary">
	<div class="card-body">
		<h5 class="m-0 font-weight-bold text-primary pull-left">
			<i class="fa fa-th-list"></i> <strong>Summarize Distributed of Medicine by Department</strong>
		</h5>
		<hr>
		<form class="form-inline" action="#" autocomplete="off" method="POST">
			<div class="input-group ml-1 mr-1">
				<input type="text" name="fromDate" id="fromDate" class="form-control date-picker" readonly>
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i></span>
				</div>
				<input type="text" name="toDate" id="toDate" class="form-control date-picker" readonly>
			</div>
			<button type="button" class="btn btn-info" onclick="GetDataDeptList();"><i class="fas fa-sync-alt"></i> Show Data</button>
			<i class="fas fa-grip-lines-vertical ml-1 mr-1"></i>
			<button type="button" class="btn btn-success" id="btnExport"><i class="fas fa-file-excel"></i> Export</button>
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
			var currDate = moment().format("YYYY-MM-DD");

			$('#toDate').val(currDate);
			$('#fromDate').val(currDate);

			GetDataDeptList();
		});

		$(function() {
			$('.date-picker').datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
			})
		});
	});

	function GetDataDeptList() {
		// if ($('#frmDates').smkValidate()) {
		// 	var fDate = $('#fromDate').val();
		// 	var tDate = $('#toDate').val();
		 var formData = $('form').serialize();


			$.ajax({
				type: 'POST',
				url: "<?= site_url('ReportController/FetchAllDistributed') ?>",
				data: formData,
				beforeSend: function() {
					BlockUI('Processing...');
				}
			}).done(function(data) {
				UnblockUI();

				$('#dynamicData').html(data);
				console.log(data);

			}).fail(function(jqXHR, textStatus, errorThown) {
				console.log('error');

				SmkAlert('Something went wrong, please contact IT', 'danger');
			});
		//}

		return false;
	}

	$(function() {
		var table = $('#dataTable').DataTable();

		$("#btnExport").click(function(e) {
			table.page.len(-1).draw();
			window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dataTable').parent().html()));
			setTimeout(function() {
				table.page.len(10).draw();
			}, 1000)

		});
	});
</script>
