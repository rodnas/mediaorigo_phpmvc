<?php

namespace PHPMaker2022\phpmvc;

// Page object
$DriverSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { driver: currentTable } });
var currentForm, currentPageID;
var fdriversearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fdriversearch = new ew.Form("fdriversearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fdriversearch;
    <?php } else { ?>
    currentForm = fdriversearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fdriversearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["name", [], fields.name.isInvalid],
        ["birth_year", [ew.Validators.integer], fields.birth_year.isInvalid],
        ["license_typeID", [], fields.license_typeID.isInvalid],
        ["insertUserID", [], fields.insertUserID.isInvalid],
        ["insertWhen", [ew.Validators.datetime(fields.insertWhen.clientFormatPattern)], fields.insertWhen.isInvalid],
        ["modifyUserID", [], fields.modifyUserID.isInvalid],
        ["modifyWhen", [ew.Validators.datetime(fields.modifyWhen.clientFormatPattern)], fields.modifyWhen.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid]
    ]);

    // Validate form
    fdriversearch.validate = function () {
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
    fdriversearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdriversearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdriversearch.lists.license_typeID = <?= $Page->license_typeID->toClientList($Page) ?>;
    fdriversearch.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    fdriversearch.lists.modifyUserID = <?= $Page->modifyUserID->toClientList($Page) ?>;
    fdriversearch.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fdriversearch.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    loadjs.done("fdriversearch");
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
<form name="fdriversearch" id="fdriversearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="driver">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_driversearch" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
            <span id="el_driver_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="driver" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_id"><?= $Page->id->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span></td>
        <td<?= $Page->id->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_id" class="ew-search-field">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="driver" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label for="x_name" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_name"><?= $Page->name->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_name" id="z_name" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->name->cellAttributes() ?>>
            <span id="el_driver_name" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="driver" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_name"><?= $Page->name->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_name" id="z_name" value="LIKE">
</span></td>
        <td<?= $Page->name->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_name" class="ew-search-field">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="driver" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->birth_year->Visible) { // birth_year ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_birth_year"<?= $Page->birth_year->rowAttributes() ?>>
        <label for="x_birth_year" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_birth_year"><?= $Page->birth_year->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_birth_year" id="z_birth_year" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->birth_year->cellAttributes() ?>>
            <span id="el_driver_birth_year" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->birth_year->getInputTextType() ?>" name="x_birth_year" id="x_birth_year" data-table="driver" data-field="x_birth_year" value="<?= $Page->birth_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->birth_year->getPlaceHolder()) ?>"<?= $Page->birth_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->birth_year->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_birth_year"<?= $Page->birth_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_birth_year"><?= $Page->birth_year->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_birth_year" id="z_birth_year" value="=">
</span></td>
        <td<?= $Page->birth_year->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_birth_year" class="ew-search-field">
<input type="<?= $Page->birth_year->getInputTextType() ?>" name="x_birth_year" id="x_birth_year" data-table="driver" data-field="x_birth_year" value="<?= $Page->birth_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->birth_year->getPlaceHolder()) ?>"<?= $Page->birth_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->birth_year->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->license_typeID->Visible) { // license_typeID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_license_typeID"<?= $Page->license_typeID->rowAttributes() ?>>
        <label for="x_license_typeID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_license_typeID"><?= $Page->license_typeID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_license_typeID" id="z_license_typeID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->license_typeID->cellAttributes() ?>>
            <span id="el_driver_license_typeID" class="ew-search-field ew-search-field-single">
    <select
        id="x_license_typeID"
        name="x_license_typeID"
        class="form-select ew-select<?= $Page->license_typeID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_license_typeID"
        data-table="driver"
        data-field="x_license_typeID"
        data-value-separator="<?= $Page->license_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->license_typeID->getPlaceHolder()) ?>"
        <?= $Page->license_typeID->editAttributes() ?>>
        <?= $Page->license_typeID->selectOptionListHtml("x_license_typeID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->license_typeID->getErrorMessage(false) ?></div>
<?= $Page->license_typeID->Lookup->getParamTag($Page, "p_x_license_typeID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_license_typeID", selectId: "fdriversearch_x_license_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.license_typeID.lookupOptions.length) {
        options.data = { id: "x_license_typeID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_license_typeID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.license_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_license_typeID"<?= $Page->license_typeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_license_typeID"><?= $Page->license_typeID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_license_typeID" id="z_license_typeID" value="=">
</span></td>
        <td<?= $Page->license_typeID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_license_typeID" class="ew-search-field">
    <select
        id="x_license_typeID"
        name="x_license_typeID"
        class="form-select ew-select<?= $Page->license_typeID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_license_typeID"
        data-table="driver"
        data-field="x_license_typeID"
        data-value-separator="<?= $Page->license_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->license_typeID->getPlaceHolder()) ?>"
        <?= $Page->license_typeID->editAttributes() ?>>
        <?= $Page->license_typeID->selectOptionListHtml("x_license_typeID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->license_typeID->getErrorMessage(false) ?></div>
<?= $Page->license_typeID->Lookup->getParamTag($Page, "p_x_license_typeID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_license_typeID", selectId: "fdriversearch_x_license_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.license_typeID.lookupOptions.length) {
        options.data = { id: "x_license_typeID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_license_typeID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.license_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->insertUserID->Visible) { // insertUserID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <label for="x_insertUserID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_insertUserID"><?= $Page->insertUserID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertUserID" id="z_insertUserID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->insertUserID->cellAttributes() ?>>
            <span id="el_driver_insertUserID" class="ew-search-field ew-search-field-single">
    <select
        id="x_insertUserID"
        name="x_insertUserID"
        class="form-select ew-select<?= $Page->insertUserID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_insertUserID"
        data-table="driver"
        data-field="x_insertUserID"
        data-value-separator="<?= $Page->insertUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insertUserID->getPlaceHolder()) ?>"
        <?= $Page->insertUserID->editAttributes() ?>>
        <?= $Page->insertUserID->selectOptionListHtml("x_insertUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->insertUserID->getErrorMessage(false) ?></div>
<?= $Page->insertUserID->Lookup->getParamTag($Page, "p_x_insertUserID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_insertUserID", selectId: "fdriversearch_x_insertUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.insertUserID.lookupOptions.length) {
        options.data = { id: "x_insertUserID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_insertUserID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.insertUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_insertUserID"><?= $Page->insertUserID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertUserID" id="z_insertUserID" value="=">
</span></td>
        <td<?= $Page->insertUserID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_insertUserID" class="ew-search-field">
    <select
        id="x_insertUserID"
        name="x_insertUserID"
        class="form-select ew-select<?= $Page->insertUserID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_insertUserID"
        data-table="driver"
        data-field="x_insertUserID"
        data-value-separator="<?= $Page->insertUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insertUserID->getPlaceHolder()) ?>"
        <?= $Page->insertUserID->editAttributes() ?>>
        <?= $Page->insertUserID->selectOptionListHtml("x_insertUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->insertUserID->getErrorMessage(false) ?></div>
<?= $Page->insertUserID->Lookup->getParamTag($Page, "p_x_insertUserID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_insertUserID", selectId: "fdriversearch_x_insertUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.insertUserID.lookupOptions.length) {
        options.data = { id: "x_insertUserID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_insertUserID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.insertUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->insertWhen->Visible) { // insertWhen ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_insertWhen"<?= $Page->insertWhen->rowAttributes() ?>>
        <label for="x_insertWhen" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_insertWhen"><?= $Page->insertWhen->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertWhen" id="z_insertWhen" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->insertWhen->cellAttributes() ?>>
            <span id="el_driver_insertWhen" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->insertWhen->getInputTextType() ?>" name="x_insertWhen" id="x_insertWhen" data-table="driver" data-field="x_insertWhen" value="<?= $Page->insertWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->insertWhen->getPlaceHolder()) ?>"<?= $Page->insertWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->insertWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->insertWhen->ReadOnly && !$Page->insertWhen->Disabled && !isset($Page->insertWhen->EditAttrs["readonly"]) && !isset($Page->insertWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdriversearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fdriversearch", "x_insertWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_insertWhen"<?= $Page->insertWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_insertWhen"><?= $Page->insertWhen->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertWhen" id="z_insertWhen" value="=">
</span></td>
        <td<?= $Page->insertWhen->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_insertWhen" class="ew-search-field">
<input type="<?= $Page->insertWhen->getInputTextType() ?>" name="x_insertWhen" id="x_insertWhen" data-table="driver" data-field="x_insertWhen" value="<?= $Page->insertWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->insertWhen->getPlaceHolder()) ?>"<?= $Page->insertWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->insertWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->insertWhen->ReadOnly && !$Page->insertWhen->Disabled && !isset($Page->insertWhen->EditAttrs["readonly"]) && !isset($Page->insertWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdriversearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fdriversearch", "x_insertWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->modifyUserID->Visible) { // modifyUserID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_modifyUserID"<?= $Page->modifyUserID->rowAttributes() ?>>
        <label for="x_modifyUserID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_modifyUserID"><?= $Page->modifyUserID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyUserID" id="z_modifyUserID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifyUserID->cellAttributes() ?>>
            <span id="el_driver_modifyUserID" class="ew-search-field ew-search-field-single">
    <select
        id="x_modifyUserID"
        name="x_modifyUserID"
        class="form-select ew-select<?= $Page->modifyUserID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_modifyUserID"
        data-table="driver"
        data-field="x_modifyUserID"
        data-value-separator="<?= $Page->modifyUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->modifyUserID->getPlaceHolder()) ?>"
        <?= $Page->modifyUserID->editAttributes() ?>>
        <?= $Page->modifyUserID->selectOptionListHtml("x_modifyUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->modifyUserID->getErrorMessage(false) ?></div>
<?= $Page->modifyUserID->Lookup->getParamTag($Page, "p_x_modifyUserID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_modifyUserID", selectId: "fdriversearch_x_modifyUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.modifyUserID.lookupOptions.length) {
        options.data = { id: "x_modifyUserID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_modifyUserID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.modifyUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_modifyUserID"<?= $Page->modifyUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_modifyUserID"><?= $Page->modifyUserID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyUserID" id="z_modifyUserID" value="=">
</span></td>
        <td<?= $Page->modifyUserID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_modifyUserID" class="ew-search-field">
    <select
        id="x_modifyUserID"
        name="x_modifyUserID"
        class="form-select ew-select<?= $Page->modifyUserID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_modifyUserID"
        data-table="driver"
        data-field="x_modifyUserID"
        data-value-separator="<?= $Page->modifyUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->modifyUserID->getPlaceHolder()) ?>"
        <?= $Page->modifyUserID->editAttributes() ?>>
        <?= $Page->modifyUserID->selectOptionListHtml("x_modifyUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->modifyUserID->getErrorMessage(false) ?></div>
<?= $Page->modifyUserID->Lookup->getParamTag($Page, "p_x_modifyUserID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_modifyUserID", selectId: "fdriversearch_x_modifyUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.modifyUserID.lookupOptions.length) {
        options.data = { id: "x_modifyUserID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_modifyUserID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.modifyUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->modifyWhen->Visible) { // modifyWhen ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_modifyWhen"<?= $Page->modifyWhen->rowAttributes() ?>>
        <label for="x_modifyWhen" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_modifyWhen"><?= $Page->modifyWhen->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyWhen" id="z_modifyWhen" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifyWhen->cellAttributes() ?>>
            <span id="el_driver_modifyWhen" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->modifyWhen->getInputTextType() ?>" name="x_modifyWhen" id="x_modifyWhen" data-table="driver" data-field="x_modifyWhen" value="<?= $Page->modifyWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifyWhen->getPlaceHolder()) ?>"<?= $Page->modifyWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifyWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->modifyWhen->ReadOnly && !$Page->modifyWhen->Disabled && !isset($Page->modifyWhen->EditAttrs["readonly"]) && !isset($Page->modifyWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdriversearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fdriversearch", "x_modifyWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_modifyWhen"<?= $Page->modifyWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_modifyWhen"><?= $Page->modifyWhen->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyWhen" id="z_modifyWhen" value="=">
</span></td>
        <td<?= $Page->modifyWhen->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_modifyWhen" class="ew-search-field">
<input type="<?= $Page->modifyWhen->getInputTextType() ?>" name="x_modifyWhen" id="x_modifyWhen" data-table="driver" data-field="x_modifyWhen" value="<?= $Page->modifyWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifyWhen->getPlaceHolder()) ?>"<?= $Page->modifyWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifyWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->modifyWhen->ReadOnly && !$Page->modifyWhen->Disabled && !isset($Page->modifyWhen->EditAttrs["readonly"]) && !isset($Page->modifyWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdriversearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fdriversearch", "x_modifyWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_core_statusID"><?= $Page->core_statusID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_statusID->cellAttributes() ?>>
            <span id="el_driver_core_statusID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_core_statusID"
        data-table="driver"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_core_statusID", selectId: "fdriversearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_core_statusID" class="ew-search-field">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_core_statusID"
        data-table="driver"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_core_statusID", selectId: "fdriversearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_driver_core_languageID"><?= $Page->core_languageID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_languageID->cellAttributes() ?>>
            <span id="el_driver_core_languageID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_core_languageID"
        data-table="driver"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_core_languageID", selectId: "fdriversearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_driver_core_languageID"><?= $Page->core_languageID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_driver_core_languageID" class="ew-search-field">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fdriversearch_x_core_languageID"
        data-table="driver"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fdriversearch", function() {
    var options = { name: "x_core_languageID", selectId: "fdriversearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fdriversearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fdriversearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("driver");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
