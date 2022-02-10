<div class="card mb-4 py-3 border-top-primary">
	<div class="card-body">
		<h5 class="m-0 font-weight-bold text-primary pull-left"><i class="fas fa-th-list"></i> <strong>Medicines Management</strong></h5>
		<hr>

		<button type="button" class="btn btn-primary" onclick="Add();">
			<i class="fas fa-plus-circle"></i> Add New Item
		</button>
		<i class="fas fa-grip-lines-vertical"></i>
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#stockModal">
			<i class="fas fa-cubes"></i> Stock Improt
		</button>
		<i class="fas fa-grip-lines-vertical"></i>
		<button type="button" class="btn btn-success" onclick="ExportData();">
			<i class="fas fa-file-excel"></i> Export to Excel</i>
		</button>
		<hr>

		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center text-nowrap">Code</th>
						<th class="text-nowrap">Name</th>
						<th class="text-nowrap text-center">Stock</th>
						<th class="text-nowrap text-center">Units</th>
						<th class="text-nowrap text-center">Cost</th>
						<th class="text-nowrap text-center">Low Stock Alert</th>
						<th class="text-nowrap text-center">Last Update</th>
						<th class="text-center text-nowrap">Options</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="medModal" tabindex="-1" role="dialog" aria-labelledby="medModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-head text-primary" id="medModal">
					<i class="fas fa-plus-circle"></i> Add New Medicine
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="frmMed" action="#" method="POST" autocomplete="off" novalidate="off">
				<div class="modal-body">

					<div class="form-group has-feedback">
						<input type="text" class="form-control" name="Code" id="Code" placeholder="Enter code" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="Name" id="Name" placeholder="Eenter name" required>
					</div>
					<div class="form-group">
						<select name="Unit" id="Unit" class="form-control" required>
							<option value="">Select unit for dispensing to patients</option>
							<?php
							foreach ($units as $unit) { ?>
								<option value="<?= $unit->Name; ?>"><?= $unit->Name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Quantity:</label>
						<input type="number" class="form-control" name="Stock" id="Stock" placeholder="Eenter qty" required>
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Price:</label>
						<input type="text" class="form-control" name="Cost" id="Cost" placeholder="Eenter Cost" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="MID" id="MID" />
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary" id="stockModal">
					<i class="fas fa-cubes"></i> Stock Import
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" id="frmStock" method="POST" autocomplete="off" novalidate="off">
				<div class="modal-body">
					<div class="form-group has-feedback">
						<select name="CodeImport" id="CodeImport" class="form-control select2 custom-select-lg" data-placeholder="Select Medicine" style="width: 100%;" required>
							<option value=""></option>
							<?php foreach ($mds as $md) { ?>
								<option value="<?= $md->Code; ?>"><?= $md->Code; ?>-<?= $md->Name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="StockImport" id="StockImport" placeholder="Eenter stock qty" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Import</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	var events;

	$(function() {
		$('.select2').select2();
	});

	$(document).ready(function() {
		$('#dataTable').DataTable({
			pageLength: 10,
			serverSide: true,
			processing: true,
			ajax: {
				url: '<?php echo site_url('MedicineController/FetchMedDataTable'); ?>'
			},
			columns: [{
					data: "MID",
					className: 'text-center',
					orderable: false,
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					data: 'Code',
					className: "text-center"
				},
				{
					data: 'Name'
				},
				{
					data: 'Stock',
					orderable: false,
					className: 'text-center'
				},
				{
					data: 'Unit',
					className: 'text-center'
				},
				{
					data: 'Cost',
					className: 'text-center',
					render: function(data) {
						return number_format(data, 2, '.', ',')
					}
				},
				{
					data: 'QtyAlert',
					className: 'text-center'
				},
				{
					data: 'UpdatedAt',
					className: 'text-center',
					render: function(data) {
						return moment().format('YYYY-MM-DD h:mm:ss')
					}
				},
				{
					data: 'MID',
					render: function(data, type, row) {
						var btnActions = '<a href="#" class="btn btn-warning btn-xs" onclick="Update(' + data + ');" title="Edit"><i class="fas fa-edit"></i></a> ' +
							'<a href="#" class="btn btn-danger btn-xs" title="Delete" onclick="Delete(' + data + ');"><i class="fas fa-times"></i></a>';
						return btnActions;

					},
					orderable: false,
					className: "text-center"
				}
			],
			dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			buttons: [{
				extend: 'excel',
				className: 'btn btn-success d-none btn-export',
				text: '<i class="fas fa-file-excel"></i> Export to Excel</i>',
				title: 'Medicines-List'
			}]
		});
	});

	function Add() {
		events = 'add';

		$('#medModal').modal('show');
		$('.text-head').html('<i class="fas fa-plus-circle"></i> Add New Medicine');
	}

	function Update(mid) {
		events = 'update';

		$.ajax({
			type: "GET",
			url: "<?= site_url('MedicineController/FetchOneMedicine') ?>/" + mid,
			dataType: "JSON"
		}).done(function(data) {
			$('#medModal').modal('show');
			$('.text-head').html('<i class="fas fa-edit"></i> Update medicine Info');
			$('#MID').val(data.MID);
			$('#Code').val(data.Code);
			$('#Name').val(data.Name);
			$('#Unit').val(data.Unit);
			$('#Stock').val(data.Stock);
			$('#Cost').val(numeral(data.Cost).format('0,0.00'));

		}).fail(function(jqXHR, textStatus, errorThrown) {
			SmkAlert('Something went wrong, please contact IT', 'danger');
		});
	}

	function Delete(did) {
		Swal.fire({
			type: 'question',
			title: 'Confirm ?',
			showCancelButton: true,
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: 'GET',
					url: '<?= site_url('MedicineController/InitDeleteMedicine') ?>/' + did
				}).done(function(data) {
					SmkAlert(data.message, data.status);
					$('#dataTable').DataTable().ajax.reload(null, false);
				});

			}
		})
	}

	$(function() {
		$('#frmMed').on('submit', function(e) {
			e.preventDefault();

			var msg;

			if (events === 'add') {
				msg = 'Saving...'
				url = "<?= site_url('MedicineController/InitInsertMedicine') ?>";
			} else {
				msg = 'Updating...';
				url = "<?= site_url('MedicineController/InitUpdateMedicine') ?>";
			}

			if ($(this).smkValidate()) {
				var formData = $(this).serialize();

				$.ajax({
					type: 'POST',
					url: url,
					data: formData,
					beforeSend: function() {
						BlockUI(msg);
					}
				}).done(function(data) {
					UnblockUI();

					SmkAlert(data.message, data.status);

					$('#medModal').modal('hide');
					$('#dataTable').DataTable().ajax.reload(null, false);
				}).fail(function(jqXHR, textStatus, errorThrown) {
					SmkAlert('Something went wrong, please contact IT', 'danger');
				});
			}
		});
	});

	$(function() {
		$('#frmStock').on('submit', function(e) {
			e.preventDefault();

			if ($(this).smkValidate()) {
				var formData = $(this).serialize();

				$.ajax({
					type: 'POST',
					url: "<?= site_url('MedicineController/InitUpdateStock') ?>",
					data: formData
				}).done(function(data) {
					SmkAlert(data.message, data.status);

					$('#stockModal').modal('hide');
					$('#dataTable').DataTable().ajax.reload(null, false);
				}).fail(function(jqXHR, textStatus, errorThrown) {
					SmkAlert('Something went wrong, please contact IT', 'danger');
				});
			}
		});
	});

	$(function() {
		$('.modal').on('hidden.bs.modal', function() {
			$('form').smkClear();
		});
	});

	function ExportData() {
		$('.btn-export').trigger('click');
	}
</script>
