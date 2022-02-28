<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreStatusAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_status: currentTable } });
var currentForm, currentPageID;
var fcore_statusadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_statusadd = new ew.Form("fcore_statusadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcore_statusadd;

    // Add fields
    var fields = currentTable.fields;
    fcore_statusadd.addFields([
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["insertUserID", [fields.insertUserID.visible && fields.insertUserID.required ? ew.Validators.required(fields.insertUserID.caption) : null], fields.insertUserID.isInvalid],
        ["insertWhen", [fields.insertWhen.visible && fields.insertWhen.required ? ew.Validators.required(fields.insertWhen.caption) : null], fields.insertWhen.isInvalid]
    ]);

    // Form_CustomValidate
    fcore_statusadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_statusadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_statusadd.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    fcore_statusadd.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fcore_statusadd.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    loadjs.done("fcore_statusadd");
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
<form name="fcore_statusadd" id="fcore_statusadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_status">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_statusadd" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_core_status_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_core_status_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="core_status" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_status_name"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el_core_status_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="core_status" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
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
        <label id="elh_core_status_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_core_status_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_statusadd_x_core_languageID"
        data-table="core_status"
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
loadjs.ready("fcore_statusadd", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_statusadd_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_statusadd.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_statusadd" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_statusadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_status.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_status_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_core_status_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_statusadd_x_core_languageID"
        data-table="core_status"
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
loadjs.ready("fcore_statusadd", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_statusadd_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_statusadd.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_statusadd" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_statusadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_status.fields.core_languageID.selectOptions);
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
        <label id="elh_core_status_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_status_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_statusadd_x_core_statusID"
        data-table="core_status"
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
loadjs.ready("fcore_statusadd", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_statusadd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_statusadd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_statusadd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_statusadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_status.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_status_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_status_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_statusadd_x_core_statusID"
        data-table="core_status"
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
loadjs.ready("fcore_statusadd", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_statusadd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_statusadd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_statusadd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_statusadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_status.fields.core_statusID.selectOptions);
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
    ew.addEventHandlers("core_status");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
