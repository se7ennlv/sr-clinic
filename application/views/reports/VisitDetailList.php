<table class="table table-wrapper table-sm" width="100%" cellspacing="0" id="dataTable">
    <thead class="bg-secondary text-white">
        <tr>
            <th class="text-right">Doc No.</th>
            <th colspan="4"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trans as $tran) : ?>
            <tr class="bg-light">
                <td class="text-right"><strong><?= $tran->CreatedAt; ?> | <?= $tran->DocNo; ?></strong></td>
                <td><strong>ID:</strong> <?= $tran->PatientID; ?></td>
                <td><strong>Name:</strong> <?= $tran->PatientName; ?></td>
                <td><strong>Gender:</strong> <?= $tran->Gender; ?></td>
                <td><strong>Dept:</strong> <?= $tran->DeptCode; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><strong>Med Code</strong></td>
                <td><strong>Med Name</strong></td>
                <td class="text-center"><strong>Qty Used</strong></td>
                <td><strong>Unit</strong></td>
            </tr>
            <?php foreach ($items as $item) : ?>
                <?php if ($tran->DocNo === $item->DocNo) : ?>
                    <tr class="table-borderless">
                        <td></td>
                        <td><?= $item->MedCode; ?></td>
                        <td><?= $item->MedName; ?></td>
                        <td class="text-center"><?= $item->QtyUsed; ?></td>
                        <td><?= $item->Unit; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
