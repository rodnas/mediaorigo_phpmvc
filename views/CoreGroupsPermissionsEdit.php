<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreGroupsPermissionsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_groups_permissions: currentTable } });
var currentForm, currentPageID;
var fcore_groups_permissionsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_groups_permissionsedit = new ew.Form("fcore_groups_permissionsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fcore_groups_permissionsedit;

    // Add fields
    var fields = currentTable.fields;
    fcore_groups_permissionsedit.addFields([
        ["core_groupsID", [fields.core_groupsID.visible && fields.core_groupsID.required ? ew.Validators.required(fields.core_groupsID.caption) : null], fields.core_groupsID.isInvalid],
        ["_tablename", [fields._tablename.visible && fields._tablename.required ? ew.Validators.required(fields._tablename.caption) : null], fields._tablename.isInvalid],
        ["_permission", [fields._permission.visible && fields._permission.required ? ew.Validators.required(fields._permission.caption) : null, ew.Validators.integer], fields._permission.isInvalid]
    ]);

    // Form_CustomValidate
    fcore_groups_permissionsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_groups_permissionsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_groups_permissionsedit.lists.core_groupsID = <?= $Page->core_groupsID->toClientList($Page) ?>;
    loadjs.done("fcore_groups_permissionsedit");
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
<?php if (!$Page->IsModal) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<form name="fcore_groups_permissionsedit" id="fcore_groups_permissionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_groups_permissions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_groups_permissionsedit" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <label id="elh_core_groups_permissions_core_groupsID" for="x_core_groupsID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_groupsID->caption() ?><?= $Page->core_groupsID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_groupsID->cellAttributes() ?>>
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_groups_permissionsedit_x_core_groupsID"
        data-table="core_groups_permissions"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <?= $Page->core_groupsID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage() ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_groups_permissionsedit", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_groups_permissionsedit_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groups_permissionsedit.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_groups_permissionsedit" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_groups_permissionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups_permissions.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="core_groups_permissions" data-field="x_core_groupsID" data-hidden="1" name="o_core_groupsID" id="o_core_groupsID" value="<?= HtmlEncode($Page->core_groupsID->OldValue ?? $Page->core_groupsID->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions_core_groupsID"><?= $Page->core_groupsID->caption() ?><?= $Page->core_groupsID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_groupsID->cellAttributes() ?>>
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_groups_permissionsedit_x_core_groupsID"
        data-table="core_groups_permissions"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <?= $Page->core_groupsID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage() ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_groups_permissionsedit", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_groups_permissionsedit_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groups_permissionsedit.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_groups_permissionsedit" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_groups_permissionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups_permissions.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="core_groups_permissions" data-field="x_core_groupsID" data-hidden="1" name="o_core_groupsID" id="o_core_groupsID" value="<?= HtmlEncode($Page->core_groupsID->OldValue ?? $Page->core_groupsID->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__tablename"<?= $Page->_tablename->rowAttributes() ?>>
        <label id="elh_core_groups_permissions__tablename" for="x__tablename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_tablename->caption() ?><?= $Page->_tablename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_tablename->cellAttributes() ?>>
<input type="<?= $Page->_tablename->getInputTextType() ?>" name="x__tablename" id="x__tablename" data-table="core_groups_permissions" data-field="x__tablename" value="<?= $Page->_tablename->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_tablename->getPlaceHolder()) ?>"<?= $Page->_tablename->editAttributes() ?> aria-describedby="x__tablename_help">
<?= $Page->_tablename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_tablename->getErrorMessage() ?></div>
<input type="hidden" data-table="core_groups_permissions" data-field="x__tablename" data-hidden="1" name="o__tablename" id="o__tablename" value="<?= HtmlEncode($Page->_tablename->OldValue ?? $Page->_tablename->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r__tablename"<?= $Page->_tablename->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions__tablename"><?= $Page->_tablename->caption() ?><?= $Page->_tablename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->_tablename->cellAttributes() ?>>
<input type="<?= $Page->_tablename->getInputTextType() ?>" name="x__tablename" id="x__tablename" data-table="core_groups_permissions" data-field="x__tablename" value="<?= $Page->_tablename->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_tablename->getPlaceHolder()) ?>"<?= $Page->_tablename->editAttributes() ?> aria-describedby="x__tablename_help">
<?= $Page->_tablename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_tablename->getErrorMessage() ?></div>
<input type="hidden" data-table="core_groups_permissions" data-field="x__tablename" data-hidden="1" name="o__tablename" id="o__tablename" value="<?= HtmlEncode($Page->_tablename->OldValue ?? $Page->_tablename->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__permission"<?= $Page->_permission->rowAttributes() ?>>
        <label id="elh_core_groups_permissions__permission" for="x__permission" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_permission->caption() ?><?= $Page->_permission->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_permission->cellAttributes() ?>>
<span id="el_core_groups_permissions__permission">
<input type="<?= $Page->_permission->getInputTextType() ?>" name="x__permission" id="x__permission" data-table="core_groups_permissions" data-field="x__permission" value="<?= $Page->_permission->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->_permission->getPlaceHolder()) ?>"<?= $Page->_permission->editAttributes() ?> aria-describedby="x__permission_help">
<?= $Page->_permission->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_permission->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r__permission"<?= $Page->_permission->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions__permission"><?= $Page->_permission->caption() ?><?= $Page->_permission->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->_permission->cellAttributes() ?>>
<span id="el_core_groups_permissions__permission">
<input type="<?= $Page->_permission->getInputTextType() ?>" name="x__permission" id="x__permission" data-table="core_groups_permissions" data-field="x__permission" value="<?= $Page->_permission->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->_permission->getPlaceHolder()) ?>"<?= $Page->_permission->editAttributes() ?> aria-describedby="x__permission_help">
<?= $Page->_permission->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_permission->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
<?php if (!$Page->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("core_groups_permissions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
