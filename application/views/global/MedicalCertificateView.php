<style>
    .sl-text-header {
        font-size: 1.5em;
    }

    .sl-text-body {
        font-size: 1.3em;
    }

    .sl-text-bottom {
        font-size: 1em;
    }
</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="printDoc" style="border-bottom: none; margin-bottom: 0; padding-bottom: 0">
            <div class="card" style="border: none; max-width: 52rem;">
                <div class="card-body" style="font-family: Phetsarath OT; padding-bottom: 0">
                    <table class="table" style="margin-bottom: 0;">
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center" style="border-top: none;">
                                    <img src="<?= base_url() ?>./assets/img/sl_logo.png" class="rounded mx-auto d-block" style="width: 120px; height: 110px">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right" style="border-top: none;">
                                    <strong class="sl-text-header">Savan Resorts Medical Certificate</strong>
                                    <strong class="sl-text-body" style="margin-left: 90px;">No.</strong><u id="slDocno" class="sl-text-body">SL190901</u>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right" style="border-top: none;">
                                    <strong class="sl-text-header">ໃບຢັ້ງຢືນທາງການແພດ-ສະຫວັນ ຣີສອດສ ໌</strong>
                                    <strong class="sl-text-body" style="margin-left: 20px;">ວັນທີ/Date: </strong><u id="slDate" class="sl-text-body">208/09/2019</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: none;">
                                    <strong class="sl-text-body">ຊື່/Name: </strong><u id="slRn" class="sl-text-body">Seven Ninlavanh</u>
                                </td>
                                <td class="text-right" style="border-top: none;">
                                    <strong class="sl-text-body">a Registered Nurse(RN)</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-top: none;">
                                    <strong class="sl-text-body">ໄດ້ກວດ/have examined Patient: </strong><u id="slPname" class="sl-text-body">Mr.Seven Ninlavanh</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: none;">
                                    <strong class="sl-text-body">ເລກບັດພະນັກງານ/ID: </strong><u id="slPid" class="sl-text-body">207830</u>
                                </td>
                                <td style="border-top: none;">
                                    <strong class="sl-text-body">ພະແນກ/DEPT: </strong><u id="slDept" class="sl-text-body">IT</u>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-top: none;">
                                    <strong class="sl-text-body">ອາການ/and have found</strong>
                                </td>
                            </tr>
                            <tr style="height: 120px">
                                <td colspan="2">

                                    <ul id="symptom" style="list-style-type: none;">
                                        <!-- Dynamic Data -->
                                    </ul>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-top: none;">
                                    <strong class="sl-text-body">ມະຕິພະຍາດ/Diagnosis: </strong><u id="slDiagnosis" class="sl-text-body">Severe Dysmenorrhea</u>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-top: none;">
                                    <strong class="sl-text-body">ແນະນຳໃຫ້ພັກ/Advice for sick leave: </strong><u id="slTotalDays" class="sl-text-body">1</u>
                                    <strong class="sl-text-body">ວັນ/Day(s)</strong>
                                </td>
                            </tr>
                            <tr style="height: 90px;">
                                <td colspan="2" valign="top" style="border-top: none;">
                                    <strong class="sl-text-body">ຈາກ/From: </strong><u id="slFdate" class="sl-text-body">28/09/2019</u>
                                    <strong class="ml-5 sl-text-body">ເຖິງ/To: </strong><u id="slTdate" class="sl-text-body">28/09/2019</u>
                                </td>
                            </tr>
                            <tr style="height: 85px;">
                                <td class="text-center" valign="bottom" style="border-top: none;">
                                    <p>__________________________________<br>
                                        <strong class="sl-text-body">Employee's Signature/Date<br>
                                            ລາຍເຊັນພະນັກງານ/ວັນທີ
                                        </strong>
                                        <br>
                                    </p>
                                </td>
                                <td class="text-center" valign="bottom" style="border-top: none;">
                                    <p>__________________________________<br>
                                        <strong class="sl-text-body">In charge Nurse Signature/Date<br>
                                            ລາຍເຊັນແພດຜູ້ກວດ/ວັນທີ
                                        </strong>
                                    </p>
                                </td>
                            </tr>
                            <tr style="height: 85px;">
                                <td class="text-center" valign="bottom" style="border-top: none;">
                                    <p>________________________________________<br>
                                        <strong class="sl-text-body">Head of Department Sigature/Date<br>
                                            ຫົວໜ້າພະແນກ/ວັນທີ
                                        </strong><br>
                                    </p>
                                </td>
                                <td class="text-center" valign="bottom" style="border-top: none;">
                                    <p>________________________________________<br>
                                        <strong class="sl-text-body">Manager of Human Resources/Date<br>
                                            ຜູ້ຈັດການພະແນກບຸກຄະລາກອນ/ວັນທີ
                                        </strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center sl-text-bottom" style="border-bottom: none;" valign="bottom">
                                    * This certificate only be used for medical purposes and not intended to be used for legal purposes
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

