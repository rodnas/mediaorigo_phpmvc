<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CargoView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cargo: currentTable } });
var currentForm, currentPageID;
var fcargoview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcargoview = new ew.Form("fcargoview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcargoview;
    loadjs.done("fcargoview");
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
<form name="fcargoview" id="fcargoview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cargo">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_cargo_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->place->Visible) { // place ?>
    <tr id="r_place"<?= $Page->place->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_place"><?= $Page->place->caption() ?></span></td>
        <td data-name="place"<?= $Page->place->cellAttributes() ?>>
<span id="el_cargo_place">
<span<?= $Page->place->viewAttributes() ?>>
<?= $Page->place->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cargo_weight->Visible) { // cargo_weight ?>
    <tr id="r_cargo_weight"<?= $Page->cargo_weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_cargo_weight"><?= $Page->cargo_weight->caption() ?></span></td>
        <td data-name="cargo_weight"<?= $Page->cargo_weight->cellAttributes() ?>>
<span id="el_cargo_cargo_weight">
<span<?= $Page->cargo_weight->viewAttributes() ?>>
<?= $Page->cargo_weight->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
    <tr id="r_transport_date"<?= $Page->transport_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_transport_date"><?= $Page->transport_date->caption() ?></span></td>
        <td data-name="transport_date"<?= $Page->transport_date->cellAttributes() ?>>
<span id="el_cargo_transport_date">
<span<?= $Page->transport_date->viewAttributes() ?>>
<?= $Page->transport_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insertUserID->Visible) { // insertUserID ?>
    <tr id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_insertUserID"><?= $Page->insertUserID->caption() ?></span></td>
        <td data-name="insertUserID"<?= $Page->insertUserID->cellAttributes() ?>>
<span id="el_cargo_insertUserID">
<span<?= $Page->insertUserID->viewAttributes() ?>>
<?= $Page->insertUserID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insertWhen->Visible) { // insertWhen ?>
    <tr id="r_insertWhen"<?= $Page->insertWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_insertWhen"><?= $Page->insertWhen->caption() ?></span></td>
        <td data-name="insertWhen"<?= $Page->insertWhen->cellAttributes() ?>>
<span id="el_cargo_insertWhen">
<span<?= $Page->insertWhen->viewAttributes() ?>>
<?= $Page->insertWhen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifyUserID->Visible) { // modifyUserID ?>
    <tr id="r_modifyUserID"<?= $Page->modifyUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_modifyUserID"><?= $Page->modifyUserID->caption() ?></span></td>
        <td data-name="modifyUserID"<?= $Page->modifyUserID->cellAttributes() ?>>
<span id="el_cargo_modifyUserID">
<span<?= $Page->modifyUserID->viewAttributes() ?>>
<?= $Page->modifyUserID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifyWhen->Visible) { // modifyWhen ?>
    <tr id="r_modifyWhen"<?= $Page->modifyWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_modifyWhen"><?= $Page->modifyWhen->caption() ?></span></td>
        <td data-name="modifyWhen"<?= $Page->modifyWhen->cellAttributes() ?>>
<span id="el_cargo_modifyWhen">
<span<?= $Page->modifyWhen->viewAttributes() ?>>
<?= $Page->modifyWhen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td data-name="core_statusID"<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_cargo_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_core_languageID"><?= $Page->core_languageID->caption() ?></span></td>
        <td data-name="core_languageID"<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_cargo_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
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
