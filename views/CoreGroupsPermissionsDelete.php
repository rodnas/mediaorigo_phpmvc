<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreGroupsPermissionsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_groups_permissions: currentTable } });
var currentForm, currentPageID;
var fcore_groups_permissionsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_groups_permissionsdelete = new ew.Form("fcore_groups_permissionsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcore_groups_permissionsdelete;
    loadjs.done("fcore_groups_permissionsdelete");
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
<form name="fcore_groups_permissionsdelete" id="fcore_groups_permissionsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_groups_permissions">
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
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
        <th class="<?= $Page->core_groupsID->headerCellClass() ?>"><span id="elh_core_groups_permissions_core_groupsID" class="core_groups_permissions_core_groupsID"><?= $Page->core_groupsID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
        <th class="<?= $Page->_tablename->headerCellClass() ?>"><span id="elh_core_groups_permissions__tablename" class="core_groups_permissions__tablename"><?= $Page->_tablename->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
        <th class="<?= $Page->_permission->headerCellClass() ?>"><span id="elh_core_groups_permissions__permission" class="core_groups_permissions__permission"><?= $Page->_permission->caption() ?></span></th>
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
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
        <td<?= $Page->core_groupsID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_groups_permissions_core_groupsID" class="el_core_groups_permissions_core_groupsID">
<span<?= $Page->core_groupsID->viewAttributes() ?>>
<?= $Page->core_groupsID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
        <td<?= $Page->_tablename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_groups_permissions__tablename" class="el_core_groups_permissions__tablename">
<span<?= $Page->_tablename->viewAttributes() ?>>
<?= $Page->_tablename->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
        <td<?= $Page->_permission->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_groups_permissions__permission" class="el_core_groups_permissions__permission">
<span<?= $Page->_permission->viewAttributes() ?>>
<?= $Page->_permission->getViewValue() ?></span>
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
