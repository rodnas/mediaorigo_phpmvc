<?php

namespace PHPMaker2022\phpmvc;

// Page object
$DriverList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { driver: currentTable } });
var currentForm, currentPageID;
var fdriverlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdriverlist = new ew.Form("fdriverlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fdriverlist;
    fdriverlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fdriverlist");
});
var fdriversrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fdriversrch = new ew.Form("fdriversrch", "list");
    currentSearchForm = fdriversrch;

    // Add fields
    var fields = currentTable.fields;
    fdriversrch.addFields([
        ["name", [], fields.name.isInvalid],
        ["birth_year", [ew.Validators.integer], fields.birth_year.isInvalid],
        ["license_typeID", [], fields.license_typeID.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid]
    ]);

    // Validate form
    fdriversrch.validate = function () {
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
    fdriversrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdriversrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdriversrch.lists.license_typeID = <?= $Page->license_typeID->toClientList($Page) ?>;
    fdriversrch.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fdriversrch.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;

    // Filters
    fdriversrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fdriversrch");
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
<form name="fdriversrch" id="fdriversrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fdriversrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="driver">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->name->Visible) { // name ?>
<?php
if (!$Page->name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->name->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_name" class="ew-search-caption ew-label"><?= $Page->name->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_name" id="z_name" value="LIKE">
</div>
        </div>
        <div id="el_driver_name" class="ew-search-field">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="driver" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->birth_year->Visible) { // birth_year ?>
<?php
if (!$Page->birth_year->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_birth_year" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->birth_year->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_birth_year" class="ew-search-caption ew-label"><?= $Page->birth_year->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_birth_year" id="z_birth_year" value="=">
</div>
        </div>
        <div id="el_driver_birth_year" class="ew-search-field">
<input type="<?= $Page->birth_year->getInputTextType() ?>" name="x_birth_year" id="x_birth_year" data-table="driver" data-field="x_birth_year" value="<?= $Page->birth_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->birth_year->getPlaceHolder()) ?>"<?= $Page->birth_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->birth_year->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->license_typeID->Visible) { // license_typeID ?>
<?php
if (!$Page->license_typeID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_license_typeID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->license_typeID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_license_typeID" class="ew-search-caption ew-label"><?= $Page->license_typeID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_license_typeID" id="z_license_typeID" value="=">
</div>
        </div>
        <div id="el_driver_license_typeID" class="ew-search-field">
    <select
        id="x_license_typeID"
        name="x_license_typeID"
        class="form-select ew-select<?= $Page->license_typeID->isInvalidClass() ?>"
        data-select2-id="fdriversrch_x_license_typeID"
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
loadjs.ready("fdriversrch", function() {
    var options = { name: "x_license_typeID", selectId: "fdriversrch_x_license_typeID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversrch.lists.license_typeID.lookupOptions.length) {
        options.data = { id: "x_license_typeID", form: "fdriversrch" };
    } else {
        options.ajax = { id: "x_license_typeID", form: "fdriversrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.license_typeID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php
if (!$Page->core_statusID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_core_statusID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->core_statusID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_core_statusID" class="ew-search-caption ew-label"><?= $Page->core_statusID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</div>
        </div>
        <div id="el_driver_core_statusID" class="ew-search-field">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fdriversrch_x_core_statusID"
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
loadjs.ready("fdriversrch", function() {
    var options = { name: "x_core_statusID", selectId: "fdriversrch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversrch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fdriversrch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fdriversrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php
if (!$Page->core_languageID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_core_languageID" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->core_languageID->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_core_languageID" class="ew-search-caption ew-label"><?= $Page->core_languageID->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</div>
        </div>
        <div id="el_driver_core_languageID" class="ew-search-field">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fdriversrch_x_core_languageID"
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
loadjs.ready("fdriversrch", function() {
    var options = { name: "x_core_languageID", selectId: "fdriversrch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdriversrch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fdriversrch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fdriversrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.driver.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fdriversrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fdriversrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fdriversrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fdriversrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> driver">
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
<form name="fdriverlist" id="fdriverlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="driver">
<div id="gmp_driver" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_driverlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->name->Visible) { // name ?>
        <th data-name="name" class="<?= $Page->name->headerCellClass() ?>"><div id="elh_driver_name" class="driver_name"><?= $Page->renderFieldHeader($Page->name) ?></div></th>
<?php } ?>
<?php if ($Page->birth_year->Visible) { // birth_year ?>
        <th data-name="birth_year" class="<?= $Page->birth_year->headerCellClass() ?>"><div id="elh_driver_birth_year" class="driver_birth_year"><?= $Page->renderFieldHeader($Page->birth_year) ?></div></th>
<?php } ?>
<?php if ($Page->license_typeID->Visible) { // license_typeID ?>
        <th data-name="license_typeID" class="<?= $Page->license_typeID->headerCellClass() ?>"><div id="elh_driver_license_typeID" class="driver_license_typeID"><?= $Page->renderFieldHeader($Page->license_typeID) ?></div></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th data-name="core_statusID" class="<?= $Page->core_statusID->headerCellClass() ?>"><div id="elh_driver_core_statusID" class="driver_core_statusID"><?= $Page->renderFieldHeader($Page->core_statusID) ?></div></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th data-name="core_languageID" class="<?= $Page->core_languageID->headerCellClass() ?>"><div id="elh_driver_core_languageID" class="driver_core_languageID"><?= $Page->renderFieldHeader($Page->core_languageID) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_driver",
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
    <?php if ($Page->name->Visible) { // name ?>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_name" class="el_driver_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->birth_year->Visible) { // birth_year ?>
        <td data-name="birth_year"<?= $Page->birth_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_birth_year" class="el_driver_birth_year">
<span<?= $Page->birth_year->viewAttributes() ?>>
<?= $Page->birth_year->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->license_typeID->Visible) { // license_typeID ?>
        <td data-name="license_typeID"<?= $Page->license_typeID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_license_typeID" class="el_driver_license_typeID">
<span<?= $Page->license_typeID->viewAttributes() ?>>
<?= $Page->license_typeID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td data-name="core_statusID"<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_core_statusID" class="el_driver_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td data-name="core_languageID"<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_driver_core_languageID" class="el_driver_core_languageID">
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
    ew.addEventHandlers("driver");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
