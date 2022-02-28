<?php

namespace PHPMaker2022\phpmvc;

// Page object
$TransportList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transport: currentTable } });
var currentForm, currentPageID;
var ftransportlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransportlist = new ew.Form("ftransportlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ftransportlist;
    ftransportlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("ftransportlist");
});
var ftransportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ftransportsrch = new ew.Form("ftransportsrch", "list");
    currentSearchForm = ftransportsrch;

    // Add fields
    var fields = currentTable.fields;
    ftransportsrch.addFields([
        ["vehicleID", [], fields.vehicleID.isInvalid],
        ["driverID", [], fields.driverID.isInvalid],
        ["cargoID", [], fields.cargoID.isInvalid],
        ["passangerID", [], fields.passangerID.isInvalid],
        ["order_date", [ew.Validators.datetime(fields.order_date.clientFormatPattern)], fields.order_date.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid]
    ]);

    // Validate form
    ftransportsrch.validate = function () {
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
    ftransportsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransportsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ftransportsrch.lists.vehicleID = <?= $Page->vehicleID->toClientList($Page) ?>;
    ftransportsrch.lists.driverID = <?= $Page->driverID->toClientList($Page) ?>;
    ftransportsrch.lists.cargoID = <?= $Page->cargoID->toClientList($Page) ?>;
    ftransportsrch.lists.passangerID = <?= $Page->passangerID->toClientList($Page) ?>;

    // Filters
    ftransportsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ftransportsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="ftransportsrch" id="ftransportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ftransportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="transport">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->vehicleID->Visible) { // vehicleID ?>
<?php
if (!$Page->vehicleID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_vehicleID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->vehicleID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_vehicleID" class="ew-search-caption ew-label"><?= $Page->vehicleID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_vehicleID" id="z_vehicleID" value="=">
</div>
        </div>
        <div id="el_transport_vehicleID" class="ew-search-field">
    <select
        id="x_vehicleID"
        name="x_vehicleID"
        class="form-select ew-select<?= $Page->vehicleID->isInvalidClass() ?>"
        data-select2-id="ftransportsrch_x_vehicleID"
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
loadjs.ready("ftransportsrch", function() {
    var options = { name: "x_vehicleID", selectId: "ftransportsrch_x_vehicleID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsrch.lists.vehicleID.lookupOptions.length) {
        options.data = { id: "x_vehicleID", form: "ftransportsrch" };
    } else {
        options.ajax = { id: "x_vehicleID", form: "ftransportsrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.vehicleID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->driverID->Visible) { // driverID ?>
<?php
if (!$Page->driverID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_driverID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->driverID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_driverID" class="ew-search-caption ew-label"><?= $Page->driverID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_driverID" id="z_driverID" value="=">
</div>
        </div>
        <div id="el_transport_driverID" class="ew-search-field">
    <select
        id="x_driverID"
        name="x_driverID"
        class="form-select ew-select<?= $Page->driverID->isInvalidClass() ?>"
        data-select2-id="ftransportsrch_x_driverID"
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
loadjs.ready("ftransportsrch", function() {
    var options = { name: "x_driverID", selectId: "ftransportsrch_x_driverID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsrch.lists.driverID.lookupOptions.length) {
        options.data = { id: "x_driverID", form: "ftransportsrch" };
    } else {
        options.ajax = { id: "x_driverID", form: "ftransportsrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.driverID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->cargoID->Visible) { // cargoID ?>
<?php
if (!$Page->cargoID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_cargoID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->cargoID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_cargoID" class="ew-search-caption ew-label"><?= $Page->cargoID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_cargoID" id="z_cargoID" value="=">
</div>
        </div>
        <div id="el_transport_cargoID" class="ew-search-field">
    <select
        id="x_cargoID"
        name="x_cargoID"
        class="form-select ew-select<?= $Page->cargoID->isInvalidClass() ?>"
        data-select2-id="ftransportsrch_x_cargoID"
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
loadjs.ready("ftransportsrch", function() {
    var options = { name: "x_cargoID", selectId: "ftransportsrch_x_cargoID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsrch.lists.cargoID.lookupOptions.length) {
        options.data = { id: "x_cargoID", form: "ftransportsrch" };
    } else {
        options.ajax = { id: "x_cargoID", form: "ftransportsrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.cargoID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->passangerID->Visible) { // passangerID ?>
<?php
if (!$Page->passangerID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_passangerID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->passangerID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_passangerID" class="ew-search-caption ew-label"><?= $Page->passangerID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_passangerID" id="z_passangerID" value="=">
</div>
        </div>
        <div id="el_transport_passangerID" class="ew-search-field">
    <select
        id="x_passangerID"
        name="x_passangerID"
        class="form-select ew-select<?= $Page->passangerID->isInvalidClass() ?>"
        data-select2-id="ftransportsrch_x_passangerID"
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
loadjs.ready("ftransportsrch", function() {
    var options = { name: "x_passangerID", selectId: "ftransportsrch_x_passangerID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportsrch.lists.passangerID.lookupOptions.length) {
        options.data = { id: "x_passangerID", form: "ftransportsrch" };
    } else {
        options.ajax = { id: "x_passangerID", form: "ftransportsrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.passangerID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->order_date->Visible) { // order_date ?>
<?php
if (!$Page->order_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_order_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->order_date->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_order_date" class="ew-search-caption ew-label"><?= $Page->order_date->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_order_date" id="z_order_date" value="=">
</div>
        </div>
        <div id="el_transport_order_date" class="ew-search-field">
<input type="<?= $Page->order_date->getInputTextType() ?>" name="x_order_date" id="x_order_date" data-table="transport" data-field="x_order_date" value="<?= $Page->order_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->order_date->getPlaceHolder()) ?>"<?= $Page->order_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->order_date->getErrorMessage(false) ?></div>
<?php if (!$Page->order_date->ReadOnly && !$Page->order_date->Disabled && !isset($Page->order_date->EditAttrs["readonly"]) && !isset($Page->order_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportsrch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportsrch", "x_order_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ftransportsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ftransportsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ftransportsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ftransportsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> transport">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="ftransportlist" id="ftransportlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transport">
<div id="gmp_transport" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_transportlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->vehicleID->Visible) { // vehicleID ?>
        <th data-name="vehicleID" class="<?= $Page->vehicleID->headerCellClass() ?>"><div id="elh_transport_vehicleID" class="transport_vehicleID"><?= $Page->renderFieldHeader($Page->vehicleID) ?></div></th>
<?php } ?>
<?php if ($Page->driverID->Visible) { // driverID ?>
        <th data-name="driverID" class="<?= $Page->driverID->headerCellClass() ?>"><div id="elh_transport_driverID" class="transport_driverID"><?= $Page->renderFieldHeader($Page->driverID) ?></div></th>
<?php } ?>
<?php if ($Page->cargoID->Visible) { // cargoID ?>
        <th data-name="cargoID" class="<?= $Page->cargoID->headerCellClass() ?>"><div id="elh_transport_cargoID" class="transport_cargoID"><?= $Page->renderFieldHeader($Page->cargoID) ?></div></th>
<?php } ?>
<?php if ($Page->passangerID->Visible) { // passangerID ?>
        <th data-name="passangerID" class="<?= $Page->passangerID->headerCellClass() ?>"><div id="elh_transport_passangerID" class="transport_passangerID"><?= $Page->renderFieldHeader($Page->passangerID) ?></div></th>
<?php } ?>
<?php if ($Page->order_date->Visible) { // order_date ?>
        <th data-name="order_date" class="<?= $Page->order_date->headerCellClass() ?>"><div id="elh_transport_order_date" class="transport_order_date"><?= $Page->renderFieldHeader($Page->order_date) ?></div></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th data-name="core_statusID" class="<?= $Page->core_statusID->headerCellClass() ?>"><div id="elh_transport_core_statusID" class="transport_core_statusID"><?= $Page->renderFieldHeader($Page->core_statusID) ?></div></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th data-name="core_languageID" class="<?= $Page->core_languageID->headerCellClass() ?>"><div id="elh_transport_core_languageID" class="transport_core_languageID"><?= $Page->renderFieldHeader($Page->core_languageID) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_transport",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->vehicleID->Visible) { // vehicleID ?>
        <td data-name="vehicleID"<?= $Page->vehicleID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_vehicleID" class="el_transport_vehicleID">
<span<?= $Page->vehicleID->viewAttributes() ?>>
<?= $Page->vehicleID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->driverID->Visible) { // driverID ?>
        <td data-name="driverID"<?= $Page->driverID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_driverID" class="el_transport_driverID">
<span<?= $Page->driverID->viewAttributes() ?>>
<?= $Page->driverID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cargoID->Visible) { // cargoID ?>
        <td data-name="cargoID"<?= $Page->cargoID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_cargoID" class="el_transport_cargoID">
<span<?= $Page->cargoID->viewAttributes() ?>>
<?= $Page->cargoID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->passangerID->Visible) { // passangerID ?>
        <td data-name="passangerID"<?= $Page->passangerID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_passangerID" class="el_transport_passangerID">
<span<?= $Page->passangerID->viewAttributes() ?>>
<?= $Page->passangerID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order_date->Visible) { // order_date ?>
        <td data-name="order_date"<?= $Page->order_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_order_date" class="el_transport_order_date">
<span<?= $Page->order_date->viewAttributes() ?>>
<?= $Page->order_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td data-name="core_statusID"<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_core_statusID" class="el_transport_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td data-name="core_languageID"<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transport_core_languageID" class="el_transport_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
