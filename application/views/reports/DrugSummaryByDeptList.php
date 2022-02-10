<table class="table table-wrapper table-sm" width="100%" cellspacing="0" id="dataTable">
	<thead class="bg-secondary text-white">
		<tr>
			<th><strong> DEPARTMENT.</strong></th>
			<th colspan="9"></th>
		</tr>
	</thead>
	<tbody>

		<?php $gransTotal = 0;
		foreach ($depts as $dept) : ?>

			<tr class="table-active">
				<td><strong><?= $dept->DeptCode; ?></strong></td>
				 <td><strong>DocNo</strong></td>
				<!-- <td><strong>Date</strong></td>  -->
				<td><strong>EMPID</strong></td>
				<td><strong>Midicine Code</strong></td>
				<td><strong>Medicine Name</strong></td>
				<td class="text-center"><strong>Unit</strong></td>
				<td class="text-center"><strong>QTY</strong></td>
				<td class="text-right"><strong>Cost</strong></td>
				<td class="text-right"><strong>Total</strong></td>
			</tr>
			<?php $SubTotal = 0;
			foreach ($details as $detail) :  ?>

				<?php if ($dept->DeptCode === $detail->DeptCode) : $SubTotal += $detail->Amount ?>
					<td></td>
					<td><?= $detail->DocNo; ?></td>
					<!-- <td><?= $detail->CreatedAt; ?></td> -->
					<td><?= $detail->PatientID; ?></td>
					<td><?= $detail->MedCode; ?></td>
					<td><?= $detail->MedName; ?></td>
					<td class="text-center"><?= $detail->Unit; ?></td>
					<td class="text-center"><?= $detail->QtyUsed; ?></td>
					<td class="text-nowrap text-right">
						<?= number_format($detail->Cost, 2, '.', ','); ?>
					</td>
					<td class="text-nowrap text-right">
						<?= number_format($detail->Amount, 2, '.', ','); ?>
					</td>
					<tr>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>

			<td class="text-nowrap text-right" colspan="8"><strong> Totals:</strong></td>

			<td class="text-nowrap text-right">
				<strong><?= number_format($SubTotal, 2, '.', ','); ?></strong>
			</td>
		<?php  $gransTotal += $SubTotal; endforeach; ?>
		<tr>
			<td class="text-nowrap text-right" colspan="7"> </td>
			<td class="text-right"><strong>Grand Total :</strong></td>
			<td class="text-right">
				<strong><?= number_format($gransTotal, 2, '.', ','); ?></strong>
			</td>
		</tr>
	</tbody>
</table>
