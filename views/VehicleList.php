<?php

namespace PHPMaker2022\phpmvc;

// Page object
$VehicleList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vehicle: currentTable } });
var currentForm, currentPageID;
var fvehiclelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvehiclelist = new ew.Form("fvehiclelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fvehiclelist;
    fvehiclelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fvehiclelist");
});
var fvehiclesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fvehiclesrch = new ew.Form("fvehiclesrch", "list");
    currentSearchForm = fvehiclesrch;

    // Add fields
    var fields = currentTable.fields;
    fvehiclesrch.addFields([
        ["vehicle_typeID", [], fields.vehicle_typeID.isInvalid],
        ["lpn", [], fields.lpn.isInvalid],
        ["start_year", [ew.Validators.integer], fields.start_year.isInvalid],
        ["person", [ew.Validators.integer], fields.person.isInvalid],
        ["max_weight", [ew.Validators.integer], fields.max_weight.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid]
    ]);

    // Validate form
    fvehiclesrch.validate = function () {
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
    fvehiclesrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvehiclesrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fvehiclesrch.lists.vehicle_typeID = <?= $Page->vehicle_typeID->toClientList($Page) ?>;

    // Filters
    fvehiclesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fvehiclesrch");
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
<form name="fvehiclesrch" id="fvehiclesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fvehiclesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vehicle">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
<?php
if (!$Page->vehicle_typeID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_vehicle_typeID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->vehicle_typeID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_vehicle_typeID" class="ew-search-caption ew-label"><?= $Page->vehicle_typeID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_vehicle_typeID" id="z_vehicle_typeID" value="=">
</div>
        </div>
        <div id="el_vehicle_vehicle_typeID" class="ew-search-field">
    <select
        id="x_vehicle_typeID"
        name="x_vehicle_typeID"
        class="form-select ew-select<?= $Page->vehicle_typeID->isInvalidClass() ?>"
        data-select2-id="fvehiclesrch_x_vehicle_typeID"
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
loadjs.ready("fvehiclesrch", function() {
    var options = { name: "x_vehicle_typeID", selectId: "fvehiclesrch_x_vehicle_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fvehiclesrch.lists.vehicle_typeID.lookupOptions.length) {
        options.data = { id: "x_vehicle_typeID", form: "fvehiclesrch" };
    } else {
        options.ajax = { id: "x_vehicle_typeID", form: "fvehiclesrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.vehicle.fields.vehicle_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
<?php
if (!$Page->lpn->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_lpn" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->lpn->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_lpn" class="ew-search-caption ew-label"><?= $Page->lpn->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_lpn" id="z_lpn" value="LIKE">
</div>
        </div>
        <div id="el_vehicle_lpn" class="ew-search-field">
<input type="<?= $Page->lpn->getInputTextType() ?>" name="x_lpn" id="x_lpn" data-table="vehicle" data-field="x_lpn" value="<?= $Page->lpn->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->lpn->getPlaceHolder()) ?>"<?= $Page->lpn->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->lpn->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
<?php
if (!$Page->start_year->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_start_year" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->start_year->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_start_year" class="ew-search-caption ew-label"><?= $Page->start_year->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_start_year" id="z_start_year" value="=">
</div>
        </div>
        <div id="el_vehicle_start_year" class="ew-search-field">
<input type="<?= $Page->start_year->getInputTextType() ?>" name="x_start_year" id="x_start_year" data-table="vehicle" data-field="x_start_year" value="<?= $Page->start_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->start_year->getPlaceHolder()) ?>"<?= $Page->start_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->start_year->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
<?php
if (!$Page->person->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_person" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->person->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_person" class="ew-search-caption ew-label"><?= $Page->person->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_person" id="z_person" value="=">
</div>
        </div>
        <div id="el_vehicle_person" class="ew-search-field">
<input type="<?= $Page->person->getInputTextType() ?>" name="x_person" id="x_person" data-table="vehicle" data-field="x_person" value="<?= $Page->person->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->person->getPlaceHolder()) ?>"<?= $Page->person->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->person->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
<?php
if (!$Page->max_weight->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_max_weight" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->max_weight->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_max_weight" class="ew-search-caption ew-label"><?= $Page->max_weight->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_max_weight" id="z_max_weight" value="=">
</div>
        </div>
        <div id="el_vehicle_max_weight" class="ew-search-field">
<input type="<?= $Page->max_weight->getInputTextType() ?>" name="x_max_weight" id="x_max_weight" data-table="vehicle" data-field="x_max_weight" value="<?= $Page->max_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->max_weight->getPlaceHolder()) ?>"<?= $Page->max_weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->max_weight->getErrorMessage(false) ?></div>
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fvehiclesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fvehiclesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fvehiclesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fvehiclesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vehicle">
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
<form name="fvehiclelist" id="fvehiclelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vehicle">
<div id="gmp_vehicle" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_vehiclelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
        <th data-name="vehicle_typeID" class="<?= $Page->vehicle_typeID->headerCellClass() ?>"><div id="elh_vehicle_vehicle_typeID" class="vehicle_vehicle_typeID"><?= $Page->renderFieldHeader($Page->vehicle_typeID) ?></div></th>
<?php } ?>
<?php if ($Page->lpn->Visible) { // lpn ?>
        <th data-name="lpn" class="<?= $Page->lpn->headerCellClass() ?>"><div id="elh_vehicle_lpn" class="vehicle_lpn"><?= $Page->renderFieldHeader($Page->lpn) ?></div></th>
<?php } ?>
<?php if ($Page->start_year->Visible) { // start_year ?>
        <th data-name="start_year" class="<?= $Page->start_year->headerCellClass() ?>"><div id="elh_vehicle_start_year" class="vehicle_start_year"><?= $Page->renderFieldHeader($Page->start_year) ?></div></th>
<?php } ?>
<?php if ($Page->person->Visible) { // person ?>
        <th data-name="person" class="<?= $Page->person->headerCellClass() ?>"><div id="elh_vehicle_person" class="vehicle_person"><?= $Page->renderFieldHeader($Page->person) ?></div></th>
<?php } ?>
<?php if ($Page->max_weight->Visible) { // max_weight ?>
        <th data-name="max_weight" class="<?= $Page->max_weight->headerCellClass() ?>"><div id="elh_vehicle_max_weight" class="vehicle_max_weight"><?= $Page->renderFieldHeader($Page->max_weight) ?></div></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th data-name="core_languageID" class="<?= $Page->core_languageID->headerCellClass() ?>"><div id="elh_vehicle_core_languageID" class="vehicle_core_languageID"><?= $Page->renderFieldHeader($Page->core_languageID) ?></div></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th data-name="core_statusID" class="<?= $Page->core_statusID->headerCellClass() ?>"><div id="elh_vehicle_core_statusID" class="vehicle_core_statusID"><?= $Page->renderFieldHeader($Page->core_statusID) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_vehicle",
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
    <?php if ($Page->vehicle_typeID->Visible) { // vehicle_typeID ?>
        <td data-name="vehicle_typeID"<?= $Page->vehicle_typeID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_vehicle_typeID" class="el_vehicle_vehicle_typeID">
<span<?= $Page->vehicle_typeID->viewAttributes() ?>>
<?= $Page->vehicle_typeID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lpn->Visible) { // lpn ?>
        <td data-name="lpn"<?= $Page->lpn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_lpn" class="el_vehicle_lpn">
<span<?= $Page->lpn->viewAttributes() ?>>
<?= $Page->lpn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->start_year->Visible) { // start_year ?>
        <td data-name="start_year"<?= $Page->start_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_start_year" class="el_vehicle_start_year">
<span<?= $Page->start_year->viewAttributes() ?>>
<?= $Page->start_year->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->person->Visible) { // person ?>
        <td data-name="person"<?= $Page->person->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_person" class="el_vehicle_person">
<span<?= $Page->person->viewAttributes() ?>>
<?= $Page->person->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_weight->Visible) { // max_weight ?>
        <td data-name="max_weight"<?= $Page->max_weight->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_max_weight" class="el_vehicle_max_weight">
<span<?= $Page->max_weight->viewAttributes() ?>>
<?= $Page->max_weight->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td data-name="core_languageID"<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_core_languageID" class="el_vehicle_core_languageID">
<span<?= $Page->core_languageID->viewAttributes() ?>>
<?= $Page->core_languageID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td data-name="core_statusID"<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vehicle_core_statusID" class="el_vehicle_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
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
    ew.addEventHandlers("vehicle");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
