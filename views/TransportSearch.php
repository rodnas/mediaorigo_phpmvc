<?php

namespace PHPMaker2022\phpmvc;

// Page object
$TransportSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transport: currentTable } });
var currentForm, currentPageID;
var ftransportsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ftransportsearch = new ew.Form("ftransportsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = ftransportsearch;
    <?php } else { ?>
    currentForm = ftransportsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    ftransportsearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["vehicleID", [], fields.vehicleID.isInvalid],
        ["driverID", [], fields.driverID.isInvalid],
        ["cargoID", [], fields.cargoID.isInvalid],
        ["passangerID", [], fields.passangerID.isInvalid],
        ["order_date", [ew.Validators.datetime(fields.order_date.clientFormatPattern)], fields.order_date.isInvalid],
        ["insertUserID", [], fields.insertUserID.isInvalid],
        ["insertWhen", [ew.Validators.datetime(fields.insertWhen.clientFormatPattern)], fields.insertWhen.isInvalid],
        ["modifyUserID", [], fields.modifyUserID.isInvalid],
        ["modifyWhen", [ew.Validators.datetime(fields.modifyWhen.clientFormatPattern)], fields.modifyWhen.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid]
    ]);

    // Validate form
    ftransportsearch.validate = function () {
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
    ftransportsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransportsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ftransportsearch.lists.vehicleID = <?= $Page->vehicleID->toClientList($Page) ?>;
    ftransportsearch.lists.driverID = <?= $Page->driverID->toClientList($Page) ?>;
    ftransportsearch.lists.cargoID = <?= $Page->cargoID->toClientList($Page) ?>;
    ftransportsearch.lists.passangerID = <?= $Page->passangerID->toClientList($Page) ?>;
    ftransportsearch.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    ftransportsearch.lists.modifyUserID = <?= $Page->modifyUserID->toClientList($Page) ?>;
    ftransportsearch.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    ftransportsearch.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    loadjs.done("ftransportsearch");
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
<form name="ftransportsearch" id="ftransportsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transport">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_transportsearch" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
            <span id="el_transport_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="transport" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_id"><?= $Page->id->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span></td>
        <td<?= $Page->id->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_id" class="ew-search-field">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="transport" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->vehicleID->Visible) { // vehicleID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_vehicleID"<?= $Page->vehicleID->rowAttributes() ?>>
        <label for="x_vehicleID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_vehicleID"><?= $Page->vehicleID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_vehicleID" id="z_vehicleID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->vehicleID->cellAttributes() ?>>
            <span id="el_transport_vehicleID" class="ew-search-field ew-search-field-single">
    <select
        id="x_vehicleID"
        name="x_vehicleID"
        class="form-select ew-select<?= $Page->vehicleID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_vehicleID"
        data-table="transport"
        data-field="x_vehicleID"
        data-value-separator="<?= $Page->vehicleID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicleID->getPlaceHolder()) ?>"
        <?= $Page->vehicleID->editAttributes() ?>>
        <?= $Page->vehicleID->selectOptionListHtml("x_vehicleID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->vehicleID->getErrorMessage(false) ?></div>
<?= $Page->vehicleID->Lookup->getParamTag($Page, "p_x_vehicleID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_vehicleID", selectId: "ftransportsearch_x_vehicleID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.vehicleID.lookupOptions.length) {
        options.data = { id: "x_vehicleID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_vehicleID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.vehicleID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_vehicleID"<?= $Page->vehicleID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_vehicleID"><?= $Page->vehicleID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_vehicleID" id="z_vehicleID" value="=">
</span></td>
        <td<?= $Page->vehicleID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_vehicleID" class="ew-search-field">
    <select
        id="x_vehicleID"
        name="x_vehicleID"
        class="form-select ew-select<?= $Page->vehicleID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_vehicleID"
        data-table="transport"
        data-field="x_vehicleID"
        data-value-separator="<?= $Page->vehicleID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicleID->getPlaceHolder()) ?>"
        <?= $Page->vehicleID->editAttributes() ?>>
        <?= $Page->vehicleID->selectOptionListHtml("x_vehicleID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->vehicleID->getErrorMessage(false) ?></div>
<?= $Page->vehicleID->Lookup->getParamTag($Page, "p_x_vehicleID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_vehicleID", selectId: "ftransportsearch_x_vehicleID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.vehicleID.lookupOptions.length) {
        options.data = { id: "x_vehicleID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_vehicleID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.vehicleID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->driverID->Visible) { // driverID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_driverID"<?= $Page->driverID->rowAttributes() ?>>
        <label for="x_driverID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_driverID"><?= $Page->driverID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_driverID" id="z_driverID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->driverID->cellAttributes() ?>>
            <span id="el_transport_driverID" class="ew-search-field ew-search-field-single">
    <select
        id="x_driverID"
        name="x_driverID"
        class="form-select ew-select<?= $Page->driverID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_driverID"
        data-table="transport"
        data-field="x_driverID"
        data-value-separator="<?= $Page->driverID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->driverID->getPlaceHolder()) ?>"
        <?= $Page->driverID->editAttributes() ?>>
        <?= $Page->driverID->selectOptionListHtml("x_driverID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->driverID->getErrorMessage(false) ?></div>
<?= $Page->driverID->Lookup->getParamTag($Page, "p_x_driverID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_driverID", selectId: "ftransportsearch_x_driverID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.driverID.lookupOptions.length) {
        options.data = { id: "x_driverID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_driverID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.driverID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_driverID"<?= $Page->driverID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_driverID"><?= $Page->driverID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_driverID" id="z_driverID" value="=">
</span></td>
        <td<?= $Page->driverID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_driverID" class="ew-search-field">
    <select
        id="x_driverID"
        name="x_driverID"
        class="form-select ew-select<?= $Page->driverID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_driverID"
        data-table="transport"
        data-field="x_driverID"
        data-value-separator="<?= $Page->driverID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->driverID->getPlaceHolder()) ?>"
        <?= $Page->driverID->editAttributes() ?>>
        <?= $Page->driverID->selectOptionListHtml("x_driverID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->driverID->getErrorMessage(false) ?></div>
<?= $Page->driverID->Lookup->getParamTag($Page, "p_x_driverID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_driverID", selectId: "ftransportsearch_x_driverID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.driverID.lookupOptions.length) {
        options.data = { id: "x_driverID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_driverID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.driverID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->cargoID->Visible) { // cargoID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_cargoID"<?= $Page->cargoID->rowAttributes() ?>>
        <label for="x_cargoID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_cargoID"><?= $Page->cargoID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_cargoID" id="z_cargoID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->cargoID->cellAttributes() ?>>
            <span id="el_transport_cargoID" class="ew-search-field ew-search-field-single">
    <select
        id="x_cargoID"
        name="x_cargoID"
        class="form-select ew-select<?= $Page->cargoID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_cargoID"
        data-table="transport"
        data-field="x_cargoID"
        data-value-separator="<?= $Page->cargoID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->cargoID->getPlaceHolder()) ?>"
        <?= $Page->cargoID->editAttributes() ?>>
        <?= $Page->cargoID->selectOptionListHtml("x_cargoID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->cargoID->getErrorMessage(false) ?></div>
<?= $Page->cargoID->Lookup->getParamTag($Page, "p_x_cargoID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_cargoID", selectId: "ftransportsearch_x_cargoID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.cargoID.lookupOptions.length) {
        options.data = { id: "x_cargoID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_cargoID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.cargoID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_cargoID"<?= $Page->cargoID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_cargoID"><?= $Page->cargoID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_cargoID" id="z_cargoID" value="=">
</span></td>
        <td<?= $Page->cargoID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_cargoID" class="ew-search-field">
    <select
        id="x_cargoID"
        name="x_cargoID"
        class="form-select ew-select<?= $Page->cargoID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_cargoID"
        data-table="transport"
        data-field="x_cargoID"
        data-value-separator="<?= $Page->cargoID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->cargoID->getPlaceHolder()) ?>"
        <?= $Page->cargoID->editAttributes() ?>>
        <?= $Page->cargoID->selectOptionListHtml("x_cargoID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->cargoID->getErrorMessage(false) ?></div>
<?= $Page->cargoID->Lookup->getParamTag($Page, "p_x_cargoID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_cargoID", selectId: "ftransportsearch_x_cargoID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.cargoID.lookupOptions.length) {
        options.data = { id: "x_cargoID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_cargoID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.cargoID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->passangerID->Visible) { // passangerID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_passangerID"<?= $Page->passangerID->rowAttributes() ?>>
        <label for="x_passangerID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_passangerID"><?= $Page->passangerID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_passangerID" id="z_passangerID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->passangerID->cellAttributes() ?>>
            <span id="el_transport_passangerID" class="ew-search-field ew-search-field-single">
    <select
        id="x_passangerID"
        name="x_passangerID"
        class="form-select ew-select<?= $Page->passangerID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_passangerID"
        data-table="transport"
        data-field="x_passangerID"
        data-value-separator="<?= $Page->passangerID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->passangerID->getPlaceHolder()) ?>"
        <?= $Page->passangerID->editAttributes() ?>>
        <?= $Page->passangerID->selectOptionListHtml("x_passangerID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->passangerID->getErrorMessage(false) ?></div>
<?= $Page->passangerID->Lookup->getParamTag($Page, "p_x_passangerID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_passangerID", selectId: "ftransportsearch_x_passangerID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.passangerID.lookupOptions.length) {
        options.data = { id: "x_passangerID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_passangerID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.passangerID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_passangerID"<?= $Page->passangerID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_passangerID"><?= $Page->passangerID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_passangerID" id="z_passangerID" value="=">
</span></td>
        <td<?= $Page->passangerID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_passangerID" class="ew-search-field">
    <select
        id="x_passangerID"
        name="x_passangerID"
        class="form-select ew-select<?= $Page->passangerID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_passangerID"
        data-table="transport"
        data-field="x_passangerID"
        data-value-separator="<?= $Page->passangerID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->passangerID->getPlaceHolder()) ?>"
        <?= $Page->passangerID->editAttributes() ?>>
        <?= $Page->passangerID->selectOptionListHtml("x_passangerID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->passangerID->getErrorMessage(false) ?></div>
<?= $Page->passangerID->Lookup->getParamTag($Page, "p_x_passangerID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_passangerID", selectId: "ftransportsearch_x_passangerID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.passangerID.lookupOptions.length) {
        options.data = { id: "x_passangerID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_passangerID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.passangerID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->order_date->Visible) { // order_date ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_order_date"<?= $Page->order_date->rowAttributes() ?>>
        <label for="x_order_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_order_date"><?= $Page->order_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_order_date" id="z_order_date" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->order_date->cellAttributes() ?>>
            <span id="el_transport_order_date" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->order_date->getInputTextType() ?>" name="x_order_date" id="x_order_date" data-table="transport" data-field="x_order_date" value="<?= $Page->order_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->order_date->getPlaceHolder()) ?>"<?= $Page->order_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->order_date->getErrorMessage(false) ?></div>
<?php if (!$Page->order_date->ReadOnly && !$Page->order_date->Disabled && !isset($Page->order_date->EditAttrs["readonly"]) && !isset($Page->order_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsearch", "datetimepicker"], function () {
    let format = "<?= "y-MM-dd" ?>",
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
    ew.createDateTimePicker("ftransportsearch", "x_order_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_order_date"<?= $Page->order_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_order_date"><?= $Page->order_date->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_order_date" id="z_order_date" value="=">
</span></td>
        <td<?= $Page->order_date->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_order_date" class="ew-search-field">
<input type="<?= $Page->order_date->getInputTextType() ?>" name="x_order_date" id="x_order_date" data-table="transport" data-field="x_order_date" value="<?= $Page->order_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->order_date->getPlaceHolder()) ?>"<?= $Page->order_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->order_date->getErrorMessage(false) ?></div>
<?php if (!$Page->order_date->ReadOnly && !$Page->order_date->Disabled && !isset($Page->order_date->EditAttrs["readonly"]) && !isset($Page->order_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsearch", "datetimepicker"], function () {
    let format = "<?= "y-MM-dd" ?>",
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
    ew.createDateTimePicker("ftransportsearch", "x_order_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->insertUserID->Visible) { // insertUserID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <label for="x_insertUserID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_insertUserID"><?= $Page->insertUserID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertUserID" id="z_insertUserID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->insertUserID->cellAttributes() ?>>
            <span id="el_transport_insertUserID" class="ew-search-field ew-search-field-single">
    <select
        id="x_insertUserID"
        name="x_insertUserID"
        class="form-select ew-select<?= $Page->insertUserID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_insertUserID"
        data-table="transport"
        data-field="x_insertUserID"
        data-value-separator="<?= $Page->insertUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insertUserID->getPlaceHolder()) ?>"
        <?= $Page->insertUserID->editAttributes() ?>>
        <?= $Page->insertUserID->selectOptionListHtml("x_insertUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->insertUserID->getErrorMessage(false) ?></div>
<?= $Page->insertUserID->Lookup->getParamTag($Page, "p_x_insertUserID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_insertUserID", selectId: "ftransportsearch_x_insertUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.insertUserID.lookupOptions.length) {
        options.data = { id: "x_insertUserID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_insertUserID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.insertUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_insertUserID"<?= $Page->insertUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_insertUserID"><?= $Page->insertUserID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertUserID" id="z_insertUserID" value="=">
</span></td>
        <td<?= $Page->insertUserID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_insertUserID" class="ew-search-field">
    <select
        id="x_insertUserID"
        name="x_insertUserID"
        class="form-select ew-select<?= $Page->insertUserID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_insertUserID"
        data-table="transport"
        data-field="x_insertUserID"
        data-value-separator="<?= $Page->insertUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insertUserID->getPlaceHolder()) ?>"
        <?= $Page->insertUserID->editAttributes() ?>>
        <?= $Page->insertUserID->selectOptionListHtml("x_insertUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->insertUserID->getErrorMessage(false) ?></div>
<?= $Page->insertUserID->Lookup->getParamTag($Page, "p_x_insertUserID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_insertUserID", selectId: "ftransportsearch_x_insertUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.insertUserID.lookupOptions.length) {
        options.data = { id: "x_insertUserID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_insertUserID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.insertUserID.selectOptions);
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
        <label for="x_insertWhen" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_insertWhen"><?= $Page->insertWhen->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertWhen" id="z_insertWhen" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->insertWhen->cellAttributes() ?>>
            <span id="el_transport_insertWhen" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->insertWhen->getInputTextType() ?>" name="x_insertWhen" id="x_insertWhen" data-table="transport" data-field="x_insertWhen" value="<?= $Page->insertWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->insertWhen->getPlaceHolder()) ?>"<?= $Page->insertWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->insertWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->insertWhen->ReadOnly && !$Page->insertWhen->Disabled && !isset($Page->insertWhen->EditAttrs["readonly"]) && !isset($Page->insertWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportsearch", "x_insertWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_insertWhen"<?= $Page->insertWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_insertWhen"><?= $Page->insertWhen->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_insertWhen" id="z_insertWhen" value="=">
</span></td>
        <td<?= $Page->insertWhen->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_insertWhen" class="ew-search-field">
<input type="<?= $Page->insertWhen->getInputTextType() ?>" name="x_insertWhen" id="x_insertWhen" data-table="transport" data-field="x_insertWhen" value="<?= $Page->insertWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->insertWhen->getPlaceHolder()) ?>"<?= $Page->insertWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->insertWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->insertWhen->ReadOnly && !$Page->insertWhen->Disabled && !isset($Page->insertWhen->EditAttrs["readonly"]) && !isset($Page->insertWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportsearch", "x_insertWhen", jQuery.extend(true, {"useCurrent":false}, options));
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
        <label for="x_modifyUserID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_modifyUserID"><?= $Page->modifyUserID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyUserID" id="z_modifyUserID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifyUserID->cellAttributes() ?>>
            <span id="el_transport_modifyUserID" class="ew-search-field ew-search-field-single">
    <select
        id="x_modifyUserID"
        name="x_modifyUserID"
        class="form-select ew-select<?= $Page->modifyUserID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_modifyUserID"
        data-table="transport"
        data-field="x_modifyUserID"
        data-value-separator="<?= $Page->modifyUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->modifyUserID->getPlaceHolder()) ?>"
        <?= $Page->modifyUserID->editAttributes() ?>>
        <?= $Page->modifyUserID->selectOptionListHtml("x_modifyUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->modifyUserID->getErrorMessage(false) ?></div>
<?= $Page->modifyUserID->Lookup->getParamTag($Page, "p_x_modifyUserID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_modifyUserID", selectId: "ftransportsearch_x_modifyUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.modifyUserID.lookupOptions.length) {
        options.data = { id: "x_modifyUserID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_modifyUserID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.modifyUserID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_modifyUserID"<?= $Page->modifyUserID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_modifyUserID"><?= $Page->modifyUserID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyUserID" id="z_modifyUserID" value="=">
</span></td>
        <td<?= $Page->modifyUserID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_modifyUserID" class="ew-search-field">
    <select
        id="x_modifyUserID"
        name="x_modifyUserID"
        class="form-select ew-select<?= $Page->modifyUserID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_modifyUserID"
        data-table="transport"
        data-field="x_modifyUserID"
        data-value-separator="<?= $Page->modifyUserID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->modifyUserID->getPlaceHolder()) ?>"
        <?= $Page->modifyUserID->editAttributes() ?>>
        <?= $Page->modifyUserID->selectOptionListHtml("x_modifyUserID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->modifyUserID->getErrorMessage(false) ?></div>
<?= $Page->modifyUserID->Lookup->getParamTag($Page, "p_x_modifyUserID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_modifyUserID", selectId: "ftransportsearch_x_modifyUserID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.modifyUserID.lookupOptions.length) {
        options.data = { id: "x_modifyUserID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_modifyUserID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.modifyUserID.selectOptions);
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
        <label for="x_modifyWhen" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_modifyWhen"><?= $Page->modifyWhen->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyWhen" id="z_modifyWhen" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifyWhen->cellAttributes() ?>>
            <span id="el_transport_modifyWhen" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->modifyWhen->getInputTextType() ?>" name="x_modifyWhen" id="x_modifyWhen" data-table="transport" data-field="x_modifyWhen" value="<?= $Page->modifyWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifyWhen->getPlaceHolder()) ?>"<?= $Page->modifyWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifyWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->modifyWhen->ReadOnly && !$Page->modifyWhen->Disabled && !isset($Page->modifyWhen->EditAttrs["readonly"]) && !isset($Page->modifyWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportsearch", "x_modifyWhen", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_modifyWhen"<?= $Page->modifyWhen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_modifyWhen"><?= $Page->modifyWhen->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_modifyWhen" id="z_modifyWhen" value="=">
</span></td>
        <td<?= $Page->modifyWhen->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_modifyWhen" class="ew-search-field">
<input type="<?= $Page->modifyWhen->getInputTextType() ?>" name="x_modifyWhen" id="x_modifyWhen" data-table="transport" data-field="x_modifyWhen" value="<?= $Page->modifyWhen->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifyWhen->getPlaceHolder()) ?>"<?= $Page->modifyWhen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifyWhen->getErrorMessage(false) ?></div>
<?php if (!$Page->modifyWhen->ReadOnly && !$Page->modifyWhen->Disabled && !isset($Page->modifyWhen->EditAttrs["readonly"]) && !isset($Page->modifyWhen->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportsearch", "x_modifyWhen", jQuery.extend(true, {"useCurrent":false}, options));
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
        <label for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_core_statusID"><?= $Page->core_statusID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_statusID->cellAttributes() ?>>
            <span id="el_transport_core_statusID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_core_statusID"
        data-table="transport"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_core_statusID", selectId: "ftransportsearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_core_statusID" class="ew-search-field">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_core_statusID"
        data-table="transport"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_core_statusID", selectId: "ftransportsearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_statusID.selectOptions);
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
        <label for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transport_core_languageID"><?= $Page->core_languageID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_languageID->cellAttributes() ?>>
            <span id="el_transport_core_languageID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_core_languageID"
        data-table="transport"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_core_languageID", selectId: "ftransportsearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_core_languageID"><?= $Page->core_languageID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_transport_core_languageID" class="ew-search-field">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="ftransportsearch_x_core_languageID"
        data-table="transport"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("ftransportsearch", function() {
    var options = { name: "x_core_languageID", selectId: "ftransportsearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "ftransportsearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "ftransportsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_languageID.selectOptions);
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
    ew.addEventHandlers("transport");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
