<?php

namespace PHPMaker2022\phpmvc;

// Page object
$PassangerList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { passanger: currentTable } });
var currentForm, currentPageID;
var fpassangerlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpassangerlist = new ew.Form("fpassangerlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpassangerlist;
    fpassangerlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fpassangerlist");
});
var fpassangersrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpassangersrch = new ew.Form("fpassangersrch", "list");
    currentSearchForm = fpassangersrch;

    // Add fields
    var fields = currentTable.fields;
    fpassangersrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["customer_name", [], fields.customer_name.isInvalid],
        ["how_many_people", [ew.Validators.integer], fields.how_many_people.isInvalid],
        ["transport_date", [ew.Validators.datetime(fields.transport_date.clientFormatPattern)], fields.transport_date.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid]
    ]);

    // Validate form
    fpassangersrch.validate = function () {
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
    fpassangersrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpassangersrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists

    // Filters
    fpassangersrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpassangersrch");
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
<form name="fpassangersrch" id="fpassangersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpassangersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="passanger">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
<?php
if (!$Page->customer_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_customer_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->customer_name->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_customer_name" class="ew-search-caption ew-label"><?= $Page->customer_name->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_customer_name" id="z_customer_name" value="LIKE">
</div>
        </div>
        <div id="el_passanger_customer_name" class="ew-search-field">
<input type="<?= $Page->customer_name->getInputTextType() ?>" name="x_customer_name" id="x_customer_name" data-table="passanger" data-field="x_customer_name" value="<?= $Page->customer_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->customer_name->getPlaceHolder()) ?>"<?= $Page->customer_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->customer_name->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->how_many_people->Visible) { // how_many_people ?>
<?php
if (!$Page->how_many_people->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_how_many_people" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->how_many_people->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_how_many_people" class="ew-search-caption ew-label"><?= $Page->how_many_people->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_how_many_people" id="z_how_many_people" value="=">
</div>
        </div>
        <div id="el_passanger_how_many_people" class="ew-search-field">
<input type="<?= $Page->how_many_people->getInputTextType() ?>" name="x_how_many_people" id="x_how_many_people" data-table="passanger" data-field="x_how_many_people" value="<?= $Page->how_many_people->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->how_many_people->getPlaceHolder()) ?>"<?= $Page->how_many_people->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->how_many_people->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
<?php
if (!$Page->transport_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_transport_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->transport_date->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_transport_date" class="ew-search-caption ew-label"><?= $Page->transport_date->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_transport_date" id="z_transport_date" value="=">
</div>
        </div>
        <div id="el_passanger_transport_date" class="ew-search-field">
<input type="<?= $Page->transport_date->getInputTextType() ?>" name="x_transport_date" id="x_transport_date" data-table="passanger" data-field="x_transport_date" value="<?= $Page->transport_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->transport_date->getPlaceHolder()) ?>"<?= $Page->transport_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->transport_date->getErrorMessage(false) ?></div>
<?php if (!$Page->transport_date->ReadOnly && !$Page->transport_date->Disabled && !isset($Page->transport_date->EditAttrs["readonly"]) && !isset($Page->transport_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpassangersrch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpassangersrch", "x_transport_date", jQuery.extend(true, {"useCurrent":false}, options));
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpassangersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpassangersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpassangersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpassangersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> passanger">
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
<form name="fpassangerlist" id="fpassangerlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="passanger">
<div id="gmp_passanger" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_passangerlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_passanger_id" class="passanger_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
        <th data-name="customer_name" class="<?= $Page->customer_name->headerCellClass() ?>"><div id="elh_passanger_customer_name" class="passanger_customer_name"><?= $Page->renderFieldHeader($Page->customer_name) ?></div></th>
<?php } ?>
<?php if ($Page->how_many_people->Visible) { // how_many_people ?>
        <th data-name="how_many_people" class="<?= $Page->how_many_people->headerCellClass() ?>"><div id="elh_passanger_how_many_people" class="passanger_how_many_people"><?= $Page->renderFieldHeader($Page->how_many_people) ?></div></th>
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
        <th data-name="transport_date" class="<?= $Page->transport_date->headerCellClass() ?>"><div id="elh_passanger_transport_date" class="passanger_transport_date"><?= $Page->renderFieldHeader($Page->transport_date) ?></div></th>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <th data-name="core_statusID" class="<?= $Page->core_statusID->headerCellClass() ?>"><div id="elh_passanger_core_statusID" class="passanger_core_statusID"><?= $Page->renderFieldHeader($Page->core_statusID) ?></div></th>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <th data-name="core_languageID" class="<?= $Page->core_languageID->headerCellClass() ?>"><div id="elh_passanger_core_languageID" class="passanger_core_languageID"><?= $Page->renderFieldHeader($Page->core_languageID) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_passanger",
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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_passanger_id" class="el_passanger_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->customer_name->Visible) { // customer_name ?>
        <td data-name="customer_name"<?= $Page->customer_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_passanger_customer_name" class="el_passanger_customer_name">
<span<?= $Page->customer_name->viewAttributes() ?>>
<?= $Page->customer_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->how_many_people->Visible) { // how_many_people ?>
        <td data-name="how_many_people"<?= $Page->how_many_people->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_passanger_how_many_people" class="el_passanger_how_many_people">
<span<?= $Page->how_many_people->viewAttributes() ?>>
<?= $Page->how_many_people->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->transport_date->Visible) { // transport_date ?>
        <td data-name="transport_date"<?= $Page->transport_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_passanger_transport_date" class="el_passanger_transport_date">
<span<?= $Page->transport_date->viewAttributes() ?>>
<?= $Page->transport_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_statusID->Visible) { // core_statusID ?>
        <td data-name="core_statusID"<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_passanger_core_statusID" class="el_passanger_core_statusID">
<span<?= $Page->core_statusID->viewAttributes() ?>>
<?= $Page->core_statusID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->core_languageID->Visible) { // core_languageID ?>
        <td data-name="core_languageID"<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_passanger_core_languageID" class="el_passanger_core_languageID">
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
    ew.addEventHandlers("passanger");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
