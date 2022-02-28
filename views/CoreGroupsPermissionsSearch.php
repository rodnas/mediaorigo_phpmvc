<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreGroupsPermissionsSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_groups_permissions: currentTable } });
var currentForm, currentPageID;
var fcore_groups_permissionssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcore_groups_permissionssearch = new ew.Form("fcore_groups_permissionssearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fcore_groups_permissionssearch;
    <?php } else { ?>
    currentForm = fcore_groups_permissionssearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fcore_groups_permissionssearch.addFields([
        ["core_groupsID", [], fields.core_groupsID.isInvalid],
        ["_tablename", [], fields._tablename.isInvalid],
        ["_permission", [ew.Validators.integer], fields._permission.isInvalid]
    ]);

    // Validate form
    fcore_groups_permissionssearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fcore_groups_permissionssearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_groups_permissionssearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_groups_permissionssearch.lists.core_groupsID = <?= $Page->core_groupsID->toClientList($Page) ?>;
    loadjs.done("fcore_groups_permissionssearch");
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
<form name="fcore_groups_permissionssearch" id="fcore_groups_permissionssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_groups_permissions">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_groups_permissionssearch" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <label for="x_core_groupsID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_groups_permissions_core_groupsID"><?= $Page->core_groupsID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_groupsID" id="z_core_groupsID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_groupsID->cellAttributes() ?>>
            <span id="el_core_groups_permissions_core_groupsID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_groups_permissionssearch_x_core_groupsID"
        data-table="core_groups_permissions"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage(false) ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_groups_permissionssearch", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_groups_permissionssearch_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groups_permissionssearch.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_groups_permissionssearch" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_groups_permissionssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups_permissions.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions_core_groupsID"><?= $Page->core_groupsID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_groupsID" id="z_core_groupsID" value="=">
</span></td>
        <td<?= $Page->core_groupsID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_groups_permissions_core_groupsID" class="ew-search-field">
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_groups_permissionssearch_x_core_groupsID"
        data-table="core_groups_permissions"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage(false) ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_groups_permissionssearch", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_groups_permissionssearch_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_groups_permissionssearch.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_groups_permissionssearch" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_groups_permissionssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_groups_permissions.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__tablename"<?= $Page->_tablename->rowAttributes() ?>>
        <label for="x__tablename" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_groups_permissions__tablename"><?= $Page->_tablename->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__tablename" id="z__tablename" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_tablename->cellAttributes() ?>>
            <span id="el_core_groups_permissions__tablename" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_tablename->getInputTextType() ?>" name="x__tablename" id="x__tablename" data-table="core_groups_permissions" data-field="x__tablename" value="<?= $Page->_tablename->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_tablename->getPlaceHolder()) ?>"<?= $Page->_tablename->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_tablename->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r__tablename"<?= $Page->_tablename->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions__tablename"><?= $Page->_tablename->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__tablename" id="z__tablename" value="LIKE">
</span></td>
        <td<?= $Page->_tablename->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_groups_permissions__tablename" class="ew-search-field">
<input type="<?= $Page->_tablename->getInputTextType() ?>" name="x__tablename" id="x__tablename" data-table="core_groups_permissions" data-field="x__tablename" value="<?= $Page->_tablename->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_tablename->getPlaceHolder()) ?>"<?= $Page->_tablename->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_tablename->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__permission"<?= $Page->_permission->rowAttributes() ?>>
        <label for="x__permission" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_groups_permissions__permission"><?= $Page->_permission->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z__permission" id="z__permission" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_permission->cellAttributes() ?>>
            <span id="el_core_groups_permissions__permission" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_permission->getInputTextType() ?>" name="x__permission" id="x__permission" data-table="core_groups_permissions" data-field="x__permission" value="<?= $Page->_permission->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->_permission->getPlaceHolder()) ?>"<?= $Page->_permission->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_permission->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r__permission"<?= $Page->_permission->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_groups_permissions__permission"><?= $Page->_permission->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z__permission" id="z__permission" value="=">
</span></td>
        <td<?= $Page->_permission->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_groups_permissions__permission" class="ew-search-field">
<input type="<?= $Page->_permission->getInputTextType() ?>" name="x__permission" id="x__permission" data-table="core_groups_permissions" data-field="x__permission" value="<?= $Page->_permission->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->_permission->getPlaceHolder()) ?>"<?= $Page->_permission->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_permission->getErrorMessage(false) ?></div>
</span>
            </div>
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
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" data-ew-action="reload"><?= $Language->phrase("Reset") ?></button>
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
    ew.addEventHandlers("core_groups_permissions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
