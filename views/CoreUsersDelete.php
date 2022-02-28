<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreUsersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_users: currentTable } });
var currentForm, currentPageID;
var fcore_usersdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_usersdelete = new ew.Form("fcore_usersdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcore_usersdelete;
    loadjs.done("fcore_usersdelete");
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
<form name="fcore_usersdelete" id="fcore_usersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_users">
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
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_core_users__email" class="core_users__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nickname->Visible) { // nickname ?>
        <th class="<?= $Page->nickname->headerCellClass() ?>"><span id="elh_core_users_nickname" class="core_users_nickname"><?= $Page->nickname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_core_users__password" class="core_users__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th class="<?= $Page->core_languageID->headerCellClass() ?>"><span id="elh_core_users_core_languageID" class="core_users_core_languageID"><?= $Page->core_languageID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th class="<?= $Page->core_statusID->headerCellClass() ?>"><span id="elh_core_users_core_statusID" class="core_users_core_statusID"><?= $Page->core_statusID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
        <th class="<?= $Page->core_groupsID->headerCellClass() ?>"><span id="elh_core_users_core_groupsID" class="core_users_core_groupsID"><?= $Page->core_groupsID->caption() ?></span></th>
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
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_users__email" class="el_core_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nickname->Visible) { // nickname ?>
        <td<?= $Page->nickname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_users_nickname" class="el_core_users_nickname">
<span<?= $Page->nickname->viewAttributes() ?>>
<?= $Page->nickname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td<?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_users__password" class="el_core_users__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_users_core_languageID" class="el_core_users_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_users_core_statusID" class="el_core_users_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
        <td<?= $Page->core_groupsID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_core_users_core_groupsID" class="el_core_users_core_groupsID">
<span<?= $Page->core_groupsID->viewAttributes() ?>>
<?= $Page->core_groupsID->getViewValue() ?></span>
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
