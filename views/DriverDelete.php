<?php

namespace PHPMaker2022\phpmvc;

// Page object
$DriverDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { driver: currentTable } });
var currentForm, currentPageID;
var fdriverdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdriverdelete = new ew.Form("fdriverdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fdriverdelete;
    loadjs.done("fdriverdelete");
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
<form name="fdriverdelete" id="fdriverdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="driver">
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
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_driver_name" class="driver_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->birth_year->Visible) { // birth_year ?>
        <th class="<?= $Page->birth_year->headerCellClass() ?>"><span id="elh_driver_birth_year" class="driver_birth_year"><?= $Page->birth_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->license_typeID->Visible) { // license_typeID ?>
        <th class="<?= $Page->license_typeID->headerCellClass() ?>"><span id="elh_driver_license_typeID" class="driver_license_typeID"><?= $Page->license_typeID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th class="<?= $Page->core_statusID->headerCellClass() ?>"><span id="elh_driver_core_statusID" class="driver_core_statusID"><?= $Page->core_statusID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th class="<?= $Page->core_languageID->headerCellClass() ?>"><span id="elh_driver_core_languageID" class="driver_core_languageID"><?= $Page->core_languageID->caption() ?></span></th>
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
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_name" class="el_driver_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->birth_year->Visible) { // birth_year ?>
        <td<?= $Page->birth_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_birth_year" class="el_driver_birth_year">
<span<?= $Page->birth_year->viewAttributes() ?>>
<?= $Page->birth_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->license_typeID->Visible) { // license_typeID ?>
        <td<?= $Page->license_typeID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_license_typeID" class="el_driver_license_typeID">
<span<?= $Page->license_typeID->viewAttributes() ?>>
<?= $Page->license_typeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_core_statusID" class="el_driver_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_core_languageID" class="el_driver_core_languageID">
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
