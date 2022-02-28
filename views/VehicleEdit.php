<?php

namespace PHPMaker2022\phpmvc;

// Page object
$VehicleEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vehicle: currentTable } });
var currentForm, currentPageID;
var fvehicleedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvehicleedit = new ew.Form("fvehicleedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fvehicleedit;

    // Add fields
    var fields = currentTable.fields;
    fvehicleedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["vehicle_typeID", [fields.vehicle_typeID.visible && fields.vehicle_typeID.required ? ew.Validators.required(fields.vehicle_typeID.caption) : null], fields.vehicle_typeID.isInvalid],
        ["lpn", [fields.lpn.visible && fields.lpn.required ? ew.Validators.required(fields.lpn.caption) : null], fields.lpn.isInvalid],
        ["start_year", [fields.start_year.visible && fields.start_year.required ? ew.Validators.required(fields.start_year.caption) : null, ew.Validators.integer], fields.start_year.isInvalid],
        ["person", [fields.person.visible && fields.person.required ? ew.Validators.required(fields.person.caption) : null, ew.Validators.integer], fields.person.isInvalid],
        ["max_weight", [fields.max_weight.visible && fields.max_weight.required ? ew.Validators.required(fields.max_weight.caption) : null, ew.Validators.integer], fields.max_weight.isInvalid],
        ["insertUserID", [fields.insertUserID.visible && fields.insertUserID.required ? ew.Validators.required(fields.insertUserID.caption) : null], fields.insertUserID.isInvalid],
        ["modifyWhen", [fields.modifyWhen.visible && fields.modifyWhen.required ? ew.Validators.required(fields.modifyWhen.caption) : null], fields.modifyWhen.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid]
    ]);

    // Form_CustomValidate
    fvehicleedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvehicleedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fvehicleedit.lists.vehicle_typeID = <?= $Page->vehicle_typeID->toClientList($Page) ?>;
    fvehicleedit.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    fvehicleedit.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    fvehicleedit.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    loadjs.done("fvehicleedit");
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
<form name="fvehicleedit" id="fvehicleedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vehicle">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_vehicleedit" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_vehicle_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_vehicle_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vehicle" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_vehicle_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vehicle" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_vehicle_typeID"<?= $Page->vehicle_typeID->rowAttributes() ?>>
        <label id="elh_vehicle_vehicle_typeID" for="x_vehicle_typeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->vehicle_typeID->caption() ?><?= $Page->vehicle_typeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->vehicle_typeID->cellAttributes() ?>>
<span id="el_vehicle_vehicle_typeID">
    <select
        id="x_vehicle_typeID"
        name="x_vehicle_typeID"
        class="form-select ew-select<?= $Page->vehicle_typeID->isInvalidClass() ?>"
        data-select2-id="fvehicleedit_x_vehicle_typeID"
        data-table="vehicle"
        data-field="x_vehicle_typeID"
        data-value-separator="<?= $Page->vehicle_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicle_typeID->getPlaceHolder()) ?>"
        <?= $Page->vehicle_typeID->editAttributes() ?>>
        <?= $Page->vehicle_typeID->selectOptionListHtml("x_vehicle_typeID") ?>
    </select>
    <?= $Page->vehicle_typeID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->vehicle_typeID->getErrorMessage() ?></div>
<?= $Page->vehicle_typeID->Lookup->getParamTag($Page, "p_x_vehicle_typeID") ?>
<script>
loadjs.ready("fvehicleedit", function() {
    var options = { name: "x_vehicle_typeID", selectId: "fvehicleedit_x_vehicle_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehicleedit.lists.vehicle_typeID.lookupOptions.length) {
        options.data = { id: "x_vehicle_typeID", form: "fvehicleedit" };
    } else {
        options.ajax = { id: "x_vehicle_typeID", form: "fvehicleedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.vehicle_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_vehicle_typeID"<?= $Page->vehicle_typeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_vehicle_typeID"><?= $Page->vehicle_typeID->caption() ?><?= $Page->vehicle_typeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->vehicle_typeID->cellAttributes() ?>>
<span id="el_vehicle_vehicle_typeID">
    <select
        id="x_vehicle_typeID"
        name="x_vehicle_typeID"
        class="form-select ew-select<?= $Page->vehicle_typeID->isInvalidClass() ?>"
        data-select2-id="fvehicleedit_x_vehicle_typeID"
        data-table="vehicle"
        data-field="x_vehicle_typeID"
        data-value-separator="<?= $Page->vehicle_typeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicle_typeID->getPlaceHolder()) ?>"
        <?= $Page->vehicle_typeID->editAttributes() ?>>
        <?= $Page->vehicle_typeID->selectOptionListHtml("x_vehicle_typeID") ?>
    </select>
    <?= $Page->vehicle_typeID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->vehicle_typeID->getErrorMessage() ?></div>
<?= $Page->vehicle_typeID->Lookup->getParamTag($Page, "p_x_vehicle_typeID") ?>
<script>
loadjs.ready("fvehicleedit", function() {
    var options = { name: "x_vehicle_typeID", selectId: "fvehicleedit_x_vehicle_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehicleedit.lists.vehicle_typeID.lookupOptions.length) {
        options.data = { id: "x_vehicle_typeID", form: "fvehicleedit" };
    } else {
        options.ajax = { id: "x_vehicle_typeID", form: "fvehicleedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.vehicle_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_lpn"<?= $Page->lpn->rowAttributes() ?>>
        <label id="elh_vehicle_lpn" for="x_lpn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lpn->caption() ?><?= $Page->lpn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lpn->cellAttributes() ?>>
<span id="el_vehicle_lpn">
<input type="<?= $Page->lpn->getInputTextType() ?>" name="x_lpn" id="x_lpn" data-table="vehicle" data-field="x_lpn" value="<?= $Page->lpn->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->lpn->getPlaceHolder()) ?>"<?= $Page->lpn->editAttributes() ?> aria-describedby="x_lpn_help">
<?= $Page->lpn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lpn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_lpn"<?= $Page->lpn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_lpn"><?= $Page->lpn->caption() ?><?= $Page->lpn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->lpn->cellAttributes() ?>>
<span id="el_vehicle_lpn">
<input type="<?= $Page->lpn->getInputTextType() ?>" name="x_lpn" id="x_lpn" data-table="vehicle" data-field="x_lpn" value="<?= $Page->lpn->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->lpn->getPlaceHolder()) ?>"<?= $Page->lpn->editAttributes() ?> aria-describedby="x_lpn_help">
<?= $Page->lpn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lpn->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_start_year"<?= $Page->start_year->rowAttributes() ?>>
        <label id="elh_vehicle_start_year" for="x_start_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->start_year->caption() ?><?= $Page->start_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->start_year->cellAttributes() ?>>
<span id="el_vehicle_start_year">
<input type="<?= $Page->start_year->getInputTextType() ?>" name="x_start_year" id="x_start_year" data-table="vehicle" data-field="x_start_year" value="<?= $Page->start_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->start_year->getPlaceHolder()) ?>"<?= $Page->start_year->editAttributes() ?> aria-describedby="x_start_year_help">
<?= $Page->start_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->start_year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_start_year"<?= $Page->start_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_start_year"><?= $Page->start_year->caption() ?><?= $Page->start_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->start_year->cellAttributes() ?>>
<span id="el_vehicle_start_year">
<input type="<?= $Page->start_year->getInputTextType() ?>" name="x_start_year" id="x_start_year" data-table="vehicle" data-field="x_start_year" value="<?= $Page->start_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->start_year->getPlaceHolder()) ?>"<?= $Page->start_year->editAttributes() ?> aria-describedby="x_start_year_help">
<?= $Page->start_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->start_year->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_person"<?= $Page->person->rowAttributes() ?>>
        <label id="elh_vehicle_person" for="x_person" class="<?= $Page->LeftColumnClass ?>"><?= $Page->person->caption() ?><?= $Page->person->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->person->cellAttributes() ?>>
<span id="el_vehicle_person">
<input type="<?= $Page->person->getInputTextType() ?>" name="x_person" id="x_person" data-table="vehicle" data-field="x_person" value="<?= $Page->person->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->person->getPlaceHolder()) ?>"<?= $Page->person->editAttributes() ?> aria-describedby="x_person_help">
<?= $Page->person->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->person->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_person"<?= $Page->person->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_person"><?= $Page->person->caption() ?><?= $Page->person->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->person->cellAttributes() ?>>
<span id="el_vehicle_person">
<input type="<?= $Page->person->getInputTextType() ?>" name="x_person" id="x_person" data-table="vehicle" data-field="x_person" value="<?= $Page->person->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->person->getPlaceHolder()) ?>"<?= $Page->person->editAttributes() ?> aria-describedby="x_person_help">
<?= $Page->person->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->person->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_max_weight"<?= $Page->max_weight->rowAttributes() ?>>
        <label id="elh_vehicle_max_weight" for="x_max_weight" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_weight->caption() ?><?= $Page->max_weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->max_weight->cellAttributes() ?>>
<span id="el_vehicle_max_weight">
<input type="<?= $Page->max_weight->getInputTextType() ?>" name="x_max_weight" id="x_max_weight" data-table="vehicle" data-field="x_max_weight" value="<?= $Page->max_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->max_weight->getPlaceHolder()) ?>"<?= $Page->max_weight->editAttributes() ?> aria-describedby="x_max_weight_help">
<?= $Page->max_weight->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_weight->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_max_weight"<?= $Page->max_weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_max_weight"><?= $Page->max_weight->caption() ?><?= $Page->max_weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->max_weight->cellAttributes() ?>>
<span id="el_vehicle_max_weight">
<input type="<?= $Page->max_weight->getInputTextType() ?>" name="x_max_weight" id="x_max_weight" data-table="vehicle" data-field="x_max_weight" value="<?= $Page->max_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->max_weight->getPlaceHolder()) ?>"<?= $Page->max_weight->editAttributes() ?> aria-describedby="x_max_weight_help">
<?= $Page->max_weight->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_weight->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label id="elh_vehicle_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_vehicle_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fvehicleedit_x_core_languageID"
        data-table="vehicle"
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
loadjs.ready("fvehicleedit", function() {
    var options = { name: "x_core_languageID", selectId: "fvehicleedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehicleedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fvehicleedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fvehicleedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_vehicle_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fvehicleedit_x_core_languageID"
        data-table="vehicle"
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
loadjs.ready("fvehicleedit", function() {
    var options = { name: "x_core_languageID", selectId: "fvehicleedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehicleedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fvehicleedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fvehicleedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_languageID.selectOptions);
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
        <label id="elh_vehicle_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_vehicle_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fvehicleedit_x_core_statusID"
        data-table="vehicle"
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
loadjs.ready("fvehicleedit", function() {
    var options = { name: "x_core_statusID", selectId: "fvehicleedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehicleedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fvehicleedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fvehicleedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vehicle_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_vehicle_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fvehicleedit_x_core_statusID"
        data-table="vehicle"
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
loadjs.ready("fvehicleedit", function() {
    var options = { name: "x_core_statusID", selectId: "fvehicleedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehicleedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fvehicleedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fvehicleedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.core_statusID.selectOptions);
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
    ew.addEventHandlers("vehicle");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
