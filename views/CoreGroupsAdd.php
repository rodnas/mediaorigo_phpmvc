<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreGroupsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_groups: currentTable } });
var currentForm, currentPageID;
var fcore_groupsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_groupsadd = new ew.Form("fcore_groupsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcore_groupsadd;

    // Add fields
    var fields = currentTable.fields;
    fcore_groupsadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.userLevelId, ew.Validators.integer], fields.id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null, ew.Validators.userLevelName('id')], fields.name.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid]
    ]);

    // Form_CustomValidate
    fcore_groupsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_groupsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_groupsadd.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    fcore_groupsadd.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    loadjs.done("fcore_groupsadd");
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
<form name="fcore_groupsadd" id="fcore_groupsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_groups">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_groupsadd" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_core_groups_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_core_groups_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_groups" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_core_groups_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_groups" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_core_groups_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_core_groups_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="core_groups" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_name"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el_core_groups_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="core_groups" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label id="elh_core_groups_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_core_groups_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_groupsadd_x_core_languageID"
        data-table="core_groups"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <?= $Page->core_languageID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage() ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fcore_groupsadd", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_groupsadd_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groupsadd.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_groupsadd" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_groupsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_core_groups_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_groupsadd_x_core_languageID"
        data-table="core_groups"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <?= $Page->core_languageID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage() ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fcore_groupsadd", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_groupsadd_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groupsadd.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_groupsadd" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_groupsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label id="elh_core_groups_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_groups_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_groupsadd_x_core_statusID"
        data-table="core_groups"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <?= $Page->core_statusID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage() ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fcore_groupsadd", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_groupsadd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groupsadd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_groupsadd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_groupsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_groups_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_groupsadd_x_core_statusID"
        data-table="core_groups"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <?= $Page->core_statusID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage() ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fcore_groupsadd", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_groupsadd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groupsadd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_groupsadd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_groupsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
    <!-- row for permission values -->
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="rp_permission" class="row">
        <label id="elh_permission" class="<?= $Page->LeftColumnClass ?>"><?= HtmlTitle($Language->phrase("Permission")) ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowAdd" id="Add" value="<?= Config("ALLOW_ADD") ?>"><label class="form-check-label" for="Add"><?= $Language->phrase("PermissionAdd") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowDelete" id="Delete" value="<?= Config("ALLOW_DELETE") ?>"><label class="form-check-label" for="Delete"><?= $Language->phrase("PermissionDelete") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowEdit" id="Edit" value="<?= Config("ALLOW_EDIT") ?>"><label class="form-check-label" for="Edit"><?= $Language->phrase("PermissionEdit") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowList" id="List" value="<?= Config("ALLOW_LIST") ?>"><label class="form-check-label" for="List"><?= $Language->phrase("PermissionList") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowLookup" id="Lookup" value="<?= Config("ALLOW_LOOKUP") ?>"><label class="form-check-label" for="Lookup"><?= $Language->phrase("PermissionLookup") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowView" id="View" value="<?= Config("ALLOW_VIEW") ?>"><label class="form-check-label" for="View"><?= $Language->phrase("PermissionView") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowSearch" id="Search" value="<?= Config("ALLOW_SEARCH") ?>"><label class="form-check-label" for="Search"><?= $Language->phrase("PermissionSearch") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowImport" id="Import" value="<?= Config("ALLOW_IMPORT") ?>"><label class="form-check-label" for="Import"><?= $Language->phrase("PermissionImport") ?></label>
            </div>
<?php if (IsSysAdmin()) { ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowAdmin" id="Admin" value="<?= Config("ALLOW_ADMIN") ?>"><label class="form-check-label" for="Admin"><?= $Language->phrase("PermissionAdmin") ?></label>
            </div>
<?php } ?>
        </div>
    </div>
<?php } else { ?>
    <tr id="rp_permission">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_permission"><?= HtmlTitle($Language->phrase("Permission")) ?></span></td>
        <td>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowAdd" id="Add" value="<?= Config("ALLOW_ADD") ?>" /><label class="form-check-label" for="Add"><?= $Language->phrase("PermissionAdd") ?></label>
                </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowDelete" id="Delete" value="<?= Config("ALLOW_DELETE") ?>" /><label class="form-check-label" for="Delete"><?= $Language->phrase("PermissionDelete") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowEdit" id="Edit" value="<?= Config("ALLOW_EDIT") ?>" /><label class="form-check-label" for="Edit"><?= $Language->phrase("PermissionEdit") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowList" id="List" value="<?= Config("ALLOW_LIST") ?>" /><label class="form-check-label" for="List"><?= $Language->phrase("PermissionList") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowLookup" id="Lookup" value="<?= Config("ALLOW_LOOKUP") ?>" /><label class="form-check-label" for="Lookup"><?= $Language->phrase("PermissionLookup") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowView" id="View" value="<?= Config("ALLOW_VIEW") ?>" /><label class="form-check-label" for="View"><?= $Language->phrase("PermissionView") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowSearch" id="Search" value="<?= Config("ALLOW_SEARCH") ?>" /><label class="form-check-label" for="Search"><?= $Language->phrase("PermissionSearch") ?></label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowImport" id="Import" value="<?= Config("ALLOW_IMPORT") ?>"><label class="form-check-label" for="Import"><?= $Language->phrase("PermissionImport") ?></label>
            </div>
<?php if (IsSysAdmin()) { ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="x__AllowAdmin" id="Admin" value="<?= Config("ALLOW_ADMIN") ?>"><label class="form-check-label" for="Admin"><?= $Language->phrase("PermissionAdmin") ?></label>
            </div>
<?php } ?>
        </td>
    </tr>
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
<?php if (!$Page->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("core_groups");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
