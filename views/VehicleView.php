<?php

namespace PHPMaker2022\phpmvc;

// Page object
$VehicleView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vehicle: currentTable } });
var currentForm, currentPageID;
var fvehicleview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvehicleview = new ew.Form("fvehicleview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fvehicleview;
    loadjs.done("fvehicleview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<?php } ?>
<form name="fvehicleview" id="fvehicleview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vehicle">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_vehicle_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
    <tr id="r_vehicle_typeID"<?= $Page->vehicle_typeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_vehicle_typeID"><?= $Page->vehicle_typeID->caption() ?></span></td>
        <td data-name="vehicle_typeID"<?= $Page->vehicle_typeID->cellAttributes() ?>>
<span id="el_vehicle_vehicle_typeID">
<span<?= $Page->vehicle_typeID->viewAttributes() ?>>
<?= $Page->vehicle_typeID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
    <tr id="r_lpn"<?= $Page->lpn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_lpn"><?= $Page->lpn->caption() ?></span></td>
        <td data-name="lpn"<?= $Page->lpn->cellAttributes() ?>>
<span id="el_vehicle_lpn">
<span<?= $Page->lpn->viewAttributes() ?>>
<?= $Page->lpn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
    <tr id="r_start_year"<?= $Page->start_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_start_year"><?= $Page->start_year->caption() ?></span></td>
        <td data-name="start_year"<?= $Page->start_year->cellAttributes() ?>>
<span id="el_vehicle_start_year">
<span<?= $Page->start_year->viewAttributes() ?>>
<?= $Page->start_year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
    <tr id="r_person"<?= $Page->person->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_person"><?= $Page->person->caption() ?></span></td>
        <td data-name="person"<?= $Page->person->cellAttributes() ?>>
<span id="el_vehicle_person">
<span<?= $Page->person->viewAttributes() ?>>
<?= $Page->person->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
    <tr id="r_max_weight"<?= $Page->max_weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_max_weight"><?= $Page->max_weight->caption() ?></span></td>
        <td data-name="max_weight"<?= $Page->max_weight->cellAttributes() ?>>
<span id="el_vehicle_max_weight">
<span<?= $Page->max_weight->viewAttributes() ?>>
<?= $Page->max_weight->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insertUserID->Visible) { // insertUserID ?>
    <tr id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_insertUserID"><?= $Page->insertUserID->caption() ?></span></td>
        <td data-name="insertUserID"<?= $Page->insertUserID->cellAttributes() ?>>
<span id="el_vehicle_insertUserID">
<span<?= $Page->insertUserID->viewAttributes() ?>>
<?= $Page->insertUserID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insertWhen->Visible) { // insertWhen ?>
    <tr id="r_insertWhen"<?= $Page->insertWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_insertWhen"><?= $Page->insertWhen->caption() ?></span></td>
        <td data-name="insertWhen"<?= $Page->insertWhen->cellAttributes() ?>>
<span id="el_vehicle_insertWhen">
<span<?= $Page->insertWhen->viewAttributes() ?>>
<?= $Page->insertWhen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifyUserID->Visible) { // modifyUserID ?>
    <tr id="r_modifyUserID"<?= $Page->modifyUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_modifyUserID"><?= $Page->modifyUserID->caption() ?></span></td>
        <td data-name="modifyUserID"<?= $Page->modifyUserID->cellAttributes() ?>>
<span id="el_vehicle_modifyUserID">
<span<?= $Page->modifyUserID->viewAttributes() ?>>
<?= $Page->modifyUserID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifyWhen->Visible) { // modifyWhen ?>
    <tr id="r_modifyWhen"<?= $Page->modifyWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_modifyWhen"><?= $Page->modifyWhen->caption() ?></span></td>
        <td data-name="modifyWhen"<?= $Page->modifyWhen->cellAttributes() ?>>
<span id="el_vehicle_modifyWhen">
<span<?= $Page->modifyWhen->viewAttributes() ?>>
<?= $Page->modifyWhen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_core_languageID"><?= $Page->core_languageID->caption() ?></span></td>
        <td data-name="core_languageID"<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_vehicle_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td data-name="core_statusID"<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_vehicle_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
