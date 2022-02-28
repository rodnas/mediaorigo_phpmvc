<?php

namespace PHPMaker2022\phpmvc;

// Page object
$TransportDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transport: currentTable } });
var currentForm, currentPageID;
var ftransportdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransportdelete = new ew.Form("ftransportdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftransportdelete;
    loadjs.done("ftransportdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftransportdelete" id="ftransportdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transport">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->vehicleID->Visible) { // vehicleID ?>
        <th class="<?= $Page->vehicleID->headerCellClass() ?>"><span id="elh_transport_vehicleID" class="transport_vehicleID"><?= $Page->vehicleID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->driverID->Visible) { // driverID ?>
        <th class="<?= $Page->driverID->headerCellClass() ?>"><span id="elh_transport_driverID" class="transport_driverID"><?= $Page->driverID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cargoID->Visible) { // cargoID ?>
        <th class="<?= $Page->cargoID->headerCellClass() ?>"><span id="elh_transport_cargoID" class="transport_cargoID"><?= $Page->cargoID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->passangerID->Visible) { // passangerID ?>
        <th class="<?= $Page->passangerID->headerCellClass() ?>"><span id="elh_transport_passangerID" class="transport_passangerID"><?= $Page->passangerID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->order_date->Visible) { // order_date ?>
        <th class="<?= $Page->order_date->headerCellClass() ?>"><span id="elh_transport_order_date" class="transport_order_date"><?= $Page->order_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th class="<?= $Page->core_statusID->headerCellClass() ?>"><span id="elh_transport_core_statusID" class="transport_core_statusID"><?= $Page->core_statusID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th class="<?= $Page->core_languageID->headerCellClass() ?>"><span id="elh_transport_core_languageID" class="transport_core_languageID"><?= $Page->core_languageID->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->vehicleID->Visible) { // vehicleID ?>
        <td<?= $Page->vehicleID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_vehicleID" class="el_transport_vehicleID">
<span<?= $Page->vehicleID->viewAttributes() ?>>
<?= $Page->vehicleID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->driverID->Visible) { // driverID ?>
        <td<?= $Page->driverID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_driverID" class="el_transport_driverID">
<span<?= $Page->driverID->viewAttributes() ?>>
<?= $Page->driverID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cargoID->Visible) { // cargoID ?>
        <td<?= $Page->cargoID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_cargoID" class="el_transport_cargoID">
<span<?= $Page->cargoID->viewAttributes() ?>>
<?= $Page->cargoID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->passangerID->Visible) { // passangerID ?>
        <td<?= $Page->passangerID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_passangerID" class="el_transport_passangerID">
<span<?= $Page->passangerID->viewAttributes() ?>>
<?= $Page->passangerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->order_date->Visible) { // order_date ?>
        <td<?= $Page->order_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_order_date" class="el_transport_order_date">
<span<?= $Page->order_date->viewAttributes() ?>>
<?= $Page->order_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_core_statusID" class="el_transport_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_core_languageID" class="el_transport_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
