<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CargoDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cargo: currentTable } });
var currentForm, currentPageID;
var fcargodelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcargodelete = new ew.Form("fcargodelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcargodelete;
    loadjs.done("fcargodelete");
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
<form name="fcargodelete" id="fcargodelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cargo">
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
<?php if ($Page->place->Visible) { // place ?>
        <th class="<?= $Page->place->headerCellClass() ?>"><span id="elh_cargo_place" class="cargo_place"><?= $Page->place->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cargo_weight->Visible) { // cargo_weight ?>
        <th class="<?= $Page->cargo_weight->headerCellClass() ?>"><span id="elh_cargo_cargo_weight" class="cargo_cargo_weight"><?= $Page->cargo_weight->caption() ?></span></th>
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
        <th class="<?= $Page->transport_date->headerCellClass() ?>"><span id="elh_cargo_transport_date" class="cargo_transport_date"><?= $Page->transport_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th class="<?= $Page->core_statusID->headerCellClass() ?>"><span id="elh_cargo_core_statusID" class="cargo_core_statusID"><?= $Page->core_statusID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th class="<?= $Page->core_languageID->headerCellClass() ?>"><span id="elh_cargo_core_languageID" class="cargo_core_languageID"><?= $Page->core_languageID->caption() ?></span></th>
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
<?php if ($Page->place->Visible) { // place ?>
        <td<?= $Page->place->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cargo_place" class="el_cargo_place">
<span<?= $Page->place->viewAttributes() ?>>
<?= $Page->place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cargo_weight->Visible) { // cargo_weight ?>
        <td<?= $Page->cargo_weight->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cargo_cargo_weight" class="el_cargo_cargo_weight">
<span<?= $Page->cargo_weight->viewAttributes() ?>>
<?= $Page->cargo_weight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
        <td<?= $Page->transport_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cargo_transport_date" class="el_cargo_transport_date">
<span<?= $Page->transport_date->viewAttributes() ?>>
<?= $Page->transport_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cargo_core_statusID" class="el_cargo_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cargo_core_languageID" class="el_cargo_core_languageID">
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
