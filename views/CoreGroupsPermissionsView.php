<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreGroupsPermissionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_groups_permissions: currentTable } });
var currentForm, currentPageID;
var fcore_groups_permissionsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_groups_permissionsview = new ew.Form("fcore_groups_permissionsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcore_groups_permissionsview;
    loadjs.done("fcore_groups_permissionsview");
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
<form name="fcore_groups_permissionsview" id="fcore_groups_permissionsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_groups_permissions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
    <tr id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions_core_groupsID"><?= $Page->core_groupsID->caption() ?></span></td>
        <td data-name="core_groupsID"<?= $Page->core_groupsID->cellAttributes() ?>>
<span id="el_core_groups_permissions_core_groupsID">
<span<?= $Page->core_groupsID->viewAttributes() ?>>
<?= $Page->core_groupsID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
    <tr id="r__tablename"<?= $Page->_tablename->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions__tablename"><?= $Page->_tablename->caption() ?></span></td>
        <td data-name="_tablename"<?= $Page->_tablename->cellAttributes() ?>>
<span id="el_core_groups_permissions__tablename">
<span<?= $Page->_tablename->viewAttributes() ?>>
<?= $Page->_tablename->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
    <tr id="r__permission"<?= $Page->_permission->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions__permission"><?= $Page->_permission->caption() ?></span></td>
        <td data-name="_permission"<?= $Page->_permission->cellAttributes() ?>>
<span id="el_core_groups_permissions__permission">
<span<?= $Page->_permission->viewAttributes() ?>>
<?= $Page->_permission->getViewValue() ?></span>
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
