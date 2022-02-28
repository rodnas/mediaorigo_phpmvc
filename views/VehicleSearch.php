<?php

namespace PHPMaker2022\phpmvc;

// Page object
$VehicleSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vehicle: currentTable } });
var currentForm, currentPageID;
var fvehiclesearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fvehiclesearch = new ew.Form("fvehiclesearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fvehiclesearch;
    <?php } else { ?>
    currentForm = fvehiclesearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fvehiclesearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["vehicle_typeID", [], fields.vehicle_typeID.isInvalid],
        ["lpn", [], fields.lpn.isInvalid],
        ["start_year", [ew.Validators.integer], fields.start_year.isInvalid],
        ["person", [ew.Validators.integer], fields.person.isInvalid],
        ["max_weight", [ew.Validators.integer], fields.max_weight.isInvalid],
        ["insertUserID", [], fields.insertUserID.isInvalid],
        ["insertWhen", [ew.Validators.datetime(fields.insertWhen.clientFormatPattern)], fields.insertWhen.isInvalid],
        ["modifyUserID", [], fields.modifyUserID.isInvalid],
        ["modifyWhen", [ew.Validators.datetime(fields.modifyWhen.clientFormatPattern)], fields.modifyWhen.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid]
    ]);

    // Validate form
    fvehiclesearch.validate = function () {
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
    fvehiclesearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvehiclesearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fvehiclesearch.lists.vehicle_typeID = <?= $Page->vehicle_typeID->toClientList($Page) ?>;
    fvehiclesearch.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    fvehiclesearch.lists.modifyUserID = <?= $Page->modifyUserID->toClientList($Page) ?>;
    fvehiclesearch.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    fvehiclesearch.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    loadjs.done("fvehiclesearch");
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
<form name="fvehiclesearch" id="fvehiclesearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vehicle">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_vehiclesearch" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
            <span id="el_vehicle_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="vehicle" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_id"><?= $Page->id->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span></td>
        <td<?= $Page->id->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_id" class="ew-search-field">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="vehicle" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_vehicle_typeID"<?= $Page->vehicle_typeID->rowAttributes() ?>>
        <label for="x_vehicle_typeID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_vehicle_typeID"><?= $Page->vehicle_typeID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_vehicle_typeID" id="z_vehicle_typeID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->vehicle_typeID->cellAttributes() ?>>
            <span id="el_vehicle_vehicle_typeID" class="ew-search-field ew-search-field-single">
    <select
        id="x_vehicle_typeID"
        name="x_vehicle_typeID"
        class="form-select ew-select<?= $Page->vehicle_typeID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_vehicle_typeID"
        data-table="vehicle"
        data-field="x_vehicle_typeID"
        data-value-separator="<?= $Page->vehicle_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicle_typeID->getPlaceHolder()) ?>"
        <?= $Page->vehicle_typeID->editAttributes() ?>>
        <?= $Page->vehicle_typeID->selectOptionListHtml("x_vehicle_typeID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->vehicle_typeID->getErrorMessage(false) ?></div>
<?= $Page->vehicle_typeID->Lookup->getParamTag($Page, "p_x_vehicle_typeID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_vehicle_typeID", selectId: "fvehiclesearch_x_vehicle_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.vehicle_typeID.lookupOptions.length) {
        options.data = { id: "x_vehicle_typeID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_vehicle_typeID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.vehicle_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_vehicle_typeID"<?= $Page->vehicle_typeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_vehicle_typeID"><?= $Page->vehicle_typeID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_vehicle_typeID" id="z_vehicle_typeID" value="=">
</span></td>
        <td<?= $Page->vehicle_typeID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_vehicle_typeID" class="ew-search-field">
    <select
        id="x_vehicle_typeID"
        name="x_vehicle_typeID"
        class="form-select ew-select<?= $Page->vehicle_typeID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_vehicle_typeID"
        data-table="vehicle"
        data-field="x_vehicle_typeID"
        data-value-separator="<?= $Page->vehicle_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicle_typeID->getPlaceHolder()) ?>"
        <?= $Page->vehicle_typeID->editAttributes() ?>>
        <?= $Page->vehicle_typeID->selectOptionListHtml("x_vehicle_typeID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->vehicle_typeID->getErrorMessage(false) ?></div>
<?= $Page->vehicle_typeID->Lookup->getParamTag($Page, "p_x_vehicle_typeID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_vehicle_typeID", selectId: "fvehiclesearch_x_vehicle_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.vehicle_typeID.lookupOptions.length) {
        options.data = { id: "x_vehicle_typeID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_vehicle_typeID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.vehicle_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_lpn"<?= $Page->lpn->rowAttributes() ?>>
        <label for="x_lpn" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_lpn"><?= $Page->lpn->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_lpn" id="z_lpn" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->lpn->cellAttributes() ?>>
            <span id="el_vehicle_lpn" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->lpn->getInputTextType() ?>" name="x_lpn" id="x_lpn" data-table="vehicle" data-field="x_lpn" value="<?= $Page->lpn->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->lpn->getPlaceHolder()) ?>"<?= $Page->lpn->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->lpn->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_lpn"<?= $Page->lpn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_lpn"><?= $Page->lpn->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_lpn" id="z_lpn" value="LIKE">
</span></td>
        <td<?= $Page->lpn->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_lpn" class="ew-search-field">
<input type="<?= $Page->lpn->getInputTextType() ?>" name="x_lpn" id="x_lpn" data-table="vehicle" data-field="x_lpn" value="<?= $Page->lpn->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->lpn->getPlaceHolder()) ?>"<?= $Page->lpn->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->lpn->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_start_year"<?= $Page->start_year->rowAttributes() ?>>
        <label for="x_start_year" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_start_year"><?= $Page->start_year->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_start_year" id="z_start_year" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->start_year->cellAttributes() ?>>
            <span id="el_vehicle_start_year" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->start_year->getInputTextType() ?>" name="x_start_year" id="x_start_year" data-table="vehicle" data-field="x_start_year" value="<?= $Page->start_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->start_year->getPlaceHolder()) ?>"<?= $Page->start_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->start_year->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_start_year"<?= $Page->start_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_start_year"><?= $Page->start_year->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_start_year" id="z_start_year" value="=">
</span></td>
        <td<?= $Page->start_year->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_start_year" class="ew-search-field">
<input type="<?= $Page->start_year->getInputTextType() ?>" name="x_start_year" id="x_start_year" data-table="vehicle" data-field="x_start_year" value="<?= $Page->start_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->start_year->getPlaceHolder()) ?>"<?= $Page->start_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->start_year->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_person"<?= $Page->person->rowAttributes() ?>>
        <label for="x_person" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_person"><?= $Page->person->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_person" id="z_person" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->person->cellAttributes() ?>>
            <span id="el_vehicle_person" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->person->getInputTextType() ?>" name="x_person" id="x_person" data-table="vehicle" data-field="x_person" value="<?= $Page->person->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->person->getPlaceHolder()) ?>"<?= $Page->person->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->person->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_person"<?= $Page->person->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_person"><?= $Page->person->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_person" id="z_person" value="=">
</span></td>
        <td<?= $Page->person->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_person" class="ew-search-field">
<input type="<?= $Page->person->getInputTextType() ?>" name="x_person" id="x_person" data-table="vehicle" data-field="x_person" value="<?= $Page->person->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->person->getPlaceHolder()) ?>"<?= $Page->person->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->person->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_max_weight"<?= $Page->max_weight->rowAttributes() ?>>
        <label for="x_max_weight" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_max_weight"><?= $Page->max_weight->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_max_weight" id="z_max_weight" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->max_weight->cellAttributes() ?>>
            <span id="el_vehicle_max_weight" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->max_weight->getInputTextType() ?>" name="x_max_weight" id="x_max_weight" data-table="vehicle" data-field="x_max_weight" value="<?= $Page->max_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->max_weight->getPlaceHolder()) ?>"<?= $Page->max_weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->max_weight->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_max_weight"<?= $Page->max_weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_max_weight"><?= $Page->max_weight->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_max_weight" id="z_max_weight" value="=">
</span></td>
        <td<?= $Page->max_weight->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_max_weight" class="ew-search-field">
<input type="<?= $Page->max_weight->getInputTextType() ?>" name="x_max_weight" id="x_max_weight" data-table="vehicle" data-field="x_max_weight" value="<?= $Page->max_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->max_weight->getPlaceHolder()) ?>"<?= $Page->max_weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->max_weight->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->insertUserID->Visible) { // insertUserID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <label for="x_insertUserID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_insertUserID"><?= $Page->insertUserID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertUserID" id="z_insertUserID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->insertUserID->cellAttributes() ?>>
            <span id="el_vehicle_insertUserID" class="ew-search-field ew-search-field-single">
    <select
        id="x_insertUserID"
        name="x_insertUserID"
        class="form-select ew-select<?= $Page->insertUserID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_insertUserID"
        data-table="vehicle"
        data-field="x_insertUserID"
        data-value-separator="<?= $Page->insertUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insertUserID->getPlaceHolder()) ?>"
        <?= $Page->insertUserID->editAttributes() ?>>
        <?= $Page->insertUserID->selectOptionListHtml("x_insertUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->insertUserID->getErrorMessage(false) ?></div>
<?= $Page->insertUserID->Lookup->getParamTag($Page, "p_x_insertUserID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_insertUserID", selectId: "fvehiclesearch_x_insertUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.insertUserID.lookupOptions.length) {
        options.data = { id: "x_insertUserID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_insertUserID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.insertUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_insertUserID"><?= $Page->insertUserID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertUserID" id="z_insertUserID" value="=">
</span></td>
        <td<?= $Page->insertUserID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_insertUserID" class="ew-search-field">
    <select
        id="x_insertUserID"
        name="x_insertUserID"
        class="form-select ew-select<?= $Page->insertUserID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_insertUserID"
        data-table="vehicle"
        data-field="x_insertUserID"
        data-value-separator="<?= $Page->insertUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insertUserID->getPlaceHolder()) ?>"
        <?= $Page->insertUserID->editAttributes() ?>>
        <?= $Page->insertUserID->selectOptionListHtml("x_insertUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->insertUserID->getErrorMessage(false) ?></div>
<?= $Page->insertUserID->Lookup->getParamTag($Page, "p_x_insertUserID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_insertUserID", selectId: "fvehiclesearch_x_insertUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.insertUserID.lookupOptions.length) {
        options.data = { id: "x_insertUserID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_insertUserID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.insertUserID.selectOptions);
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
        <label for="x_insertWhen" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_insertWhen"><?= $Page->insertWhen->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertWhen" id="z_insertWhen" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->insertWhen->cellAttributes() ?>>
            <span id="el_vehicle_insertWhen" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->insertWhen->getInputTextType() ?>" name="x_insertWhen" id="x_insertWhen" data-table="vehicle" data-field="x_insertWhen" value="<?= $Page->insertWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->insertWhen->getPlaceHolder()) ?>"<?= $Page->insertWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->insertWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->insertWhen->ReadOnly && !$Page->insertWhen->Disabled && !isset($Page->insertWhen->EditAttrs["readonly"]) && !isset($Page->insertWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvehiclesearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fvehiclesearch", "x_insertWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_insertWhen"<?= $Page->insertWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_insertWhen"><?= $Page->insertWhen->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertWhen" id="z_insertWhen" value="=">
</span></td>
        <td<?= $Page->insertWhen->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_insertWhen" class="ew-search-field">
<input type="<?= $Page->insertWhen->getInputTextType() ?>" name="x_insertWhen" id="x_insertWhen" data-table="vehicle" data-field="x_insertWhen" value="<?= $Page->insertWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->insertWhen->getPlaceHolder()) ?>"<?= $Page->insertWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->insertWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->insertWhen->ReadOnly && !$Page->insertWhen->Disabled && !isset($Page->insertWhen->EditAttrs["readonly"]) && !isset($Page->insertWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvehiclesearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fvehiclesearch", "x_insertWhen", jQuery.extend(true, {"useCurrent":false}, options));
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
        <label for="x_modifyUserID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_modifyUserID"><?= $Page->modifyUserID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyUserID" id="z_modifyUserID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifyUserID->cellAttributes() ?>>
            <span id="el_vehicle_modifyUserID" class="ew-search-field ew-search-field-single">
    <select
        id="x_modifyUserID"
        name="x_modifyUserID"
        class="form-select ew-select<?= $Page->modifyUserID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_modifyUserID"
        data-table="vehicle"
        data-field="x_modifyUserID"
        data-value-separator="<?= $Page->modifyUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->modifyUserID->getPlaceHolder()) ?>"
        <?= $Page->modifyUserID->editAttributes() ?>>
        <?= $Page->modifyUserID->selectOptionListHtml("x_modifyUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->modifyUserID->getErrorMessage(false) ?></div>
<?= $Page->modifyUserID->Lookup->getParamTag($Page, "p_x_modifyUserID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_modifyUserID", selectId: "fvehiclesearch_x_modifyUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.modifyUserID.lookupOptions.length) {
        options.data = { id: "x_modifyUserID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_modifyUserID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.modifyUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_modifyUserID"<?= $Page->modifyUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_modifyUserID"><?= $Page->modifyUserID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyUserID" id="z_modifyUserID" value="=">
</span></td>
        <td<?= $Page->modifyUserID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_modifyUserID" class="ew-search-field">
    <select
        id="x_modifyUserID"
        name="x_modifyUserID"
        class="form-select ew-select<?= $Page->modifyUserID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_modifyUserID"
        data-table="vehicle"
        data-field="x_modifyUserID"
        data-value-separator="<?= $Page->modifyUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->modifyUserID->getPlaceHolder()) ?>"
        <?= $Page->modifyUserID->editAttributes() ?>>
        <?= $Page->modifyUserID->selectOptionListHtml("x_modifyUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->modifyUserID->getErrorMessage(false) ?></div>
<?= $Page->modifyUserID->Lookup->getParamTag($Page, "p_x_modifyUserID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_modifyUserID", selectId: "fvehiclesearch_x_modifyUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.modifyUserID.lookupOptions.length) {
        options.data = { id: "x_modifyUserID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_modifyUserID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.modifyUserID.selectOptions);
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
        <label for="x_modifyWhen" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_modifyWhen"><?= $Page->modifyWhen->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyWhen" id="z_modifyWhen" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifyWhen->cellAttributes() ?>>
            <span id="el_vehicle_modifyWhen" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->modifyWhen->getInputTextType() ?>" name="x_modifyWhen" id="x_modifyWhen" data-table="vehicle" data-field="x_modifyWhen" value="<?= $Page->modifyWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifyWhen->getPlaceHolder()) ?>"<?= $Page->modifyWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifyWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->modifyWhen->ReadOnly && !$Page->modifyWhen->Disabled && !isset($Page->modifyWhen->EditAttrs["readonly"]) && !isset($Page->modifyWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvehiclesearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fvehiclesearch", "x_modifyWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_modifyWhen"<?= $Page->modifyWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_modifyWhen"><?= $Page->modifyWhen->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyWhen" id="z_modifyWhen" value="=">
</span></td>
        <td<?= $Page->modifyWhen->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_modifyWhen" class="ew-search-field">
<input type="<?= $Page->modifyWhen->getInputTextType() ?>" name="x_modifyWhen" id="x_modifyWhen" data-table="vehicle" data-field="x_modifyWhen" value="<?= $Page->modifyWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifyWhen->getPlaceHolder()) ?>"<?= $Page->modifyWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifyWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->modifyWhen->ReadOnly && !$Page->modifyWhen->Disabled && !isset($Page->modifyWhen->EditAttrs["readonly"]) && !isset($Page->modifyWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvehiclesearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fvehiclesearch", "x_modifyWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_core_languageID"><?= $Page->core_languageID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_languageID->cellAttributes() ?>>
            <span id="el_vehicle_core_languageID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_core_languageID"
        data-table="vehicle"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_core_languageID", selectId: "fvehiclesearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_core_languageID"><?= $Page->core_languageID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_core_languageID" class="ew-search-field">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_core_languageID"
        data-table="vehicle"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_core_languageID", selectId: "fvehiclesearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_vehicle_core_statusID"><?= $Page->core_statusID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_statusID->cellAttributes() ?>>
            <span id="el_vehicle_core_statusID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_core_statusID"
        data-table="vehicle"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_core_statusID", selectId: "fvehiclesearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_vehicle_core_statusID" class="ew-search-field">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fvehiclesearch_x_core_statusID"
        data-table="vehicle"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fvehiclesearch", function() {
    var options = { name: "x_core_statusID", selectId: "fvehiclesearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fvehiclesearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fvehiclesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_statusID.selectOptions);
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
    ew.addEventHandlers("vehicle");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
