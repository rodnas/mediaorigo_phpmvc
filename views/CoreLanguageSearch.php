<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreLanguageSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_language: currentTable } });
var currentForm, currentPageID;
var fcore_languagesearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcore_languagesearch = new ew.Form("fcore_languagesearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fcore_languagesearch;
    <?php } else { ?>
    currentForm = fcore_languagesearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fcore_languagesearch.addFields([
        ["id", [], fields.id.isInvalid],
        ["imageURL", [], fields.imageURL.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid]
    ]);

    // Validate form
    fcore_languagesearch.validate = function () {
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
    fcore_languagesearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_languagesearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_languagesearch.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    loadjs.done("fcore_languagesearch");
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
<form name="fcore_languagesearch" id="fcore_languagesearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_language">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_languagesearch" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_language_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_id" id="z_id" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
            <span id="el_core_language_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_language" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_language_id"><?= $Page->id->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_id" id="z_id" value="LIKE">
</span></td>
        <td<?= $Page->id->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_language_id" class="ew-search-field">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_language" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->imageURL->Visible) { // imageURL ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_imageURL"<?= $Page->imageURL->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_language_imageURL"><?= $Page->imageURL->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_imageURL" id="z_imageURL" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->imageURL->cellAttributes() ?>>
            <span id="el_core_language_imageURL" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->imageURL->getInputTextType() ?>" name="x_imageURL" id="x_imageURL" data-table="core_language" data-field="x_imageURL" value="<?= $Page->imageURL->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->imageURL->getPlaceHolder()) ?>"<?= $Page->imageURL->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->imageURL->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_imageURL"<?= $Page->imageURL->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_language_imageURL"><?= $Page->imageURL->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_imageURL" id="z_imageURL" value="LIKE">
</span></td>
        <td<?= $Page->imageURL->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_language_imageURL" class="ew-search-field">
<input type="<?= $Page->imageURL->getInputTextType() ?>" name="x_imageURL" id="x_imageURL" data-table="core_language" data-field="x_imageURL" value="<?= $Page->imageURL->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->imageURL->getPlaceHolder()) ?>"<?= $Page->imageURL->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->imageURL->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_language_core_statusID"><?= $Page->core_statusID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_statusID->cellAttributes() ?>>
            <span id="el_core_language_core_statusID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_languagesearch_x_core_statusID"
        data-table="core_language"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fcore_languagesearch", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_languagesearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_languagesearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_languagesearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_languagesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_language.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_language_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_language_core_statusID" class="ew-search-field">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_languagesearch_x_core_statusID"
        data-table="core_language"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fcore_languagesearch", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_languagesearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_languagesearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_languagesearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_languagesearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_language.fields.core_statusID.selectOptions);
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
    ew.addEventHandlers("core_language");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
