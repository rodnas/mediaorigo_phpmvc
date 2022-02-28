<?php

namespace PHPMaker2022\phpmvc;

// Page object
$VehicleDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vehicle: currentTable } });
var currentForm, currentPageID;
var fvehicledelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvehicledelete = new ew.Form("fvehicledelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fvehicledelete;
    loadjs.done("fvehicledelete");
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
<form name="fvehicledelete" id="fvehicledelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vehicle">
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
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
        <th class="<?= $Page->vehicle_typeID->headerCellClass() ?>"><span id="elh_vehicle_vehicle_typeID" class="vehicle_vehicle_typeID"><?= $Page->vehicle_typeID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
        <th class="<?= $Page->lpn->headerCellClass() ?>"><span id="elh_vehicle_lpn" class="vehicle_lpn"><?= $Page->lpn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
        <th class="<?= $Page->start_year->headerCellClass() ?>"><span id="elh_vehicle_start_year" class="vehicle_start_year"><?= $Page->start_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
        <th class="<?= $Page->person->headerCellClass() ?>"><span id="elh_vehicle_person" class="vehicle_person"><?= $Page->person->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
        <th class="<?= $Page->max_weight->headerCellClass() ?>"><span id="elh_vehicle_max_weight" class="vehicle_max_weight"><?= $Page->max_weight->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th class="<?= $Page->core_languageID->headerCellClass() ?>"><span id="elh_vehicle_core_languageID" class="vehicle_core_languageID"><?= $Page->core_languageID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th class="<?= $Page->core_statusID->headerCellClass() ?>"><span id="elh_vehicle_core_statusID" class="vehicle_core_statusID"><?= $Page->core_statusID->caption() ?></span></th>
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
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
        <td<?= $Page->vehicle_typeID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_vehicle_typeID" class="el_vehicle_vehicle_typeID">
<span<?= $Page->vehicle_typeID->viewAttributes() ?>>
<?= $Page->vehicle_typeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
        <td<?= $Page->lpn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_lpn" class="el_vehicle_lpn">
<span<?= $Page->lpn->viewAttributes() ?>>
<?= $Page->lpn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
        <td<?= $Page->start_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_start_year" class="el_vehicle_start_year">
<span<?= $Page->start_year->viewAttributes() ?>>
<?= $Page->start_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
        <td<?= $Page->person->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_person" class="el_vehicle_person">
<span<?= $Page->person->viewAttributes() ?>>
<?= $Page->person->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
        <td<?= $Page->max_weight->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_max_weight" class="el_vehicle_max_weight">
<span<?= $Page->max_weight->viewAttributes() ?>>
<?= $Page->max_weight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_core_languageID" class="el_vehicle_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_core_statusID" class="el_vehicle_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
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
