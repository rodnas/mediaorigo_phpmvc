<?php

namespace PHPMaker2022\phpmvc;

// Page object
$DriverEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { driver: currentTable } });
var currentForm, currentPageID;
var fdriveredit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdriveredit = new ew.Form("fdriveredit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fdriveredit;

    // Add fields
    var fields = currentTable.fields;
    fdriveredit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["birth_year", [fields.birth_year.visible && fields.birth_year.required ? ew.Validators.required(fields.birth_year.caption) : null, ew.Validators.integer], fields.birth_year.isInvalid],
        ["license_typeID", [fields.license_typeID.visible && fields.license_typeID.required ? ew.Validators.required(fields.license_typeID.caption) : null], fields.license_typeID.isInvalid],
        ["modifyUserID", [fields.modifyUserID.visible && fields.modifyUserID.required ? ew.Validators.required(fields.modifyUserID.caption) : null], fields.modifyUserID.isInvalid],
        ["modifyWhen", [fields.modifyWhen.visible && fields.modifyWhen.required ? ew.Validators.required(fields.modifyWhen.caption) : null], fields.modifyWhen.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid]
    ]);

    // Form_CustomValidate
    fdriveredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdriveredit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdriveredit.lists.license_typeID = <?= $Page->license_typeID->toClientList($Page) ?>;
    fdriveredit.lists.modifyUserID = <?= $Page->modifyUserID->toClientList($Page) ?>;
    fdriveredit.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fdriveredit.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    loadjs.done("fdriveredit");
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
<form name="fdriveredit" id="fdriveredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="driver">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_driveredit" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_driver_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_driver_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="driver" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_driver_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="driver" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_driver_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_driver_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="driver" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_name"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el_driver_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="driver" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->birth_year->Visible) { // birth_year ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_birth_year"<?= $Page->birth_year->rowAttributes() ?>>
        <label id="elh_driver_birth_year" for="x_birth_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->birth_year->caption() ?><?= $Page->birth_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->birth_year->cellAttributes() ?>>
<span id="el_driver_birth_year">
<input type="<?= $Page->birth_year->getInputTextType() ?>" name="x_birth_year" id="x_birth_year" data-table="driver" data-field="x_birth_year" value="<?= $Page->birth_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->birth_year->getPlaceHolder()) ?>"<?= $Page->birth_year->editAttributes() ?> aria-describedby="x_birth_year_help">
<?= $Page->birth_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->birth_year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_birth_year"<?= $Page->birth_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_birth_year"><?= $Page->birth_year->caption() ?><?= $Page->birth_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->birth_year->cellAttributes() ?>>
<span id="el_driver_birth_year">
<input type="<?= $Page->birth_year->getInputTextType() ?>" name="x_birth_year" id="x_birth_year" data-table="driver" data-field="x_birth_year" value="<?= $Page->birth_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->birth_year->getPlaceHolder()) ?>"<?= $Page->birth_year->editAttributes() ?> aria-describedby="x_birth_year_help">
<?= $Page->birth_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->birth_year->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->license_typeID->Visible) { // license_typeID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_license_typeID"<?= $Page->license_typeID->rowAttributes() ?>>
        <label id="elh_driver_license_typeID" for="x_license_typeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->license_typeID->caption() ?><?= $Page->license_typeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->license_typeID->cellAttributes() ?>>
<span id="el_driver_license_typeID">
    <select
        id="x_license_typeID"
        name="x_license_typeID"
        class="form-select ew-select<?= $Page->license_typeID->isInvalidClass() ?>"
        data-select2-id="fdriveredit_x_license_typeID"
        data-table="driver"
        data-field="x_license_typeID"
        data-value-separator="<?= $Page->license_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->license_typeID->getPlaceHolder()) ?>"
        <?= $Page->license_typeID->editAttributes() ?>>
        <?= $Page->license_typeID->selectOptionListHtml("x_license_typeID") ?>
    </select>
    <?= $Page->license_typeID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->license_typeID->getErrorMessage() ?></div>
<?= $Page->license_typeID->Lookup->getParamTag($Page, "p_x_license_typeID") ?>
<script>
loadjs.ready("fdriveredit", function() {
    var options = { name: "x_license_typeID", selectId: "fdriveredit_x_license_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriveredit.lists.license_typeID.lookupOptions.length) {
        options.data = { id: "x_license_typeID", form: "fdriveredit" };
    } else {
        options.ajax = { id: "x_license_typeID", form: "fdriveredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.license_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_license_typeID"<?= $Page->license_typeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_license_typeID"><?= $Page->license_typeID->caption() ?><?= $Page->license_typeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->license_typeID->cellAttributes() ?>>
<span id="el_driver_license_typeID">
    <select
        id="x_license_typeID"
        name="x_license_typeID"
        class="form-select ew-select<?= $Page->license_typeID->isInvalidClass() ?>"
        data-select2-id="fdriveredit_x_license_typeID"
        data-table="driver"
        data-field="x_license_typeID"
        data-value-separator="<?= $Page->license_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->license_typeID->getPlaceHolder()) ?>"
        <?= $Page->license_typeID->editAttributes() ?>>
        <?= $Page->license_typeID->selectOptionListHtml("x_license_typeID") ?>
    </select>
    <?= $Page->license_typeID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->license_typeID->getErrorMessage() ?></div>
<?= $Page->license_typeID->Lookup->getParamTag($Page, "p_x_license_typeID") ?>
<script>
loadjs.ready("fdriveredit", function() {
    var options = { name: "x_license_typeID", selectId: "fdriveredit_x_license_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriveredit.lists.license_typeID.lookupOptions.length) {
        options.data = { id: "x_license_typeID", form: "fdriveredit" };
    } else {
        options.ajax = { id: "x_license_typeID", form: "fdriveredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.license_typeID.selectOptions);
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
        <label id="elh_driver_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_driver_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fdriveredit_x_core_statusID"
        data-table="driver"
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
loadjs.ready("fdriveredit", function() {
    var options = { name: "x_core_statusID", selectId: "fdriveredit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriveredit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fdriveredit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fdriveredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_driver_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fdriveredit_x_core_statusID"
        data-table="driver"
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
loadjs.ready("fdriveredit", function() {
    var options = { name: "x_core_statusID", selectId: "fdriveredit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriveredit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fdriveredit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fdriveredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label id="elh_driver_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_driver_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fdriveredit_x_core_languageID"
        data-table="driver"
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
loadjs.ready("fdriveredit", function() {
    var options = { name: "x_core_languageID", selectId: "fdriveredit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriveredit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fdriveredit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fdriveredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_driver_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fdriveredit_x_core_languageID"
        data-table="driver"
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
loadjs.ready("fdriveredit", function() {
    var options = { name: "x_core_languageID", selectId: "fdriveredit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriveredit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fdriveredit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fdriveredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("driver");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
