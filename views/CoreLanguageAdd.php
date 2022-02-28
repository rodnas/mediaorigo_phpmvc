<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreLanguageAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_language: currentTable } });
var currentForm, currentPageID;
var fcore_languageadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_languageadd = new ew.Form("fcore_languageadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcore_languageadd;

    // Add fields
    var fields = currentTable.fields;
    fcore_languageadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["imageURL", [fields.imageURL.visible && fields.imageURL.required ? ew.Validators.fileRequired(fields.imageURL.caption) : null], fields.imageURL.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["insertUserID", [fields.insertUserID.visible && fields.insertUserID.required ? ew.Validators.required(fields.insertUserID.caption) : null], fields.insertUserID.isInvalid],
        ["insertWhen", [fields.insertWhen.visible && fields.insertWhen.required ? ew.Validators.required(fields.insertWhen.caption) : null], fields.insertWhen.isInvalid]
    ]);

    // Form_CustomValidate
    fcore_languageadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_languageadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_languageadd.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fcore_languageadd.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    loadjs.done("fcore_languageadd");
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
<form name="fcore_languageadd" id="fcore_languageadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_language">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_languageadd" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_core_language_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_core_language_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_language" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_language_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_core_language_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_language" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->imageURL->Visible) { // imageURL ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_imageURL"<?= $Page->imageURL->rowAttributes() ?>>
        <label id="elh_core_language_imageURL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->imageURL->caption() ?><?= $Page->imageURL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->imageURL->cellAttributes() ?>>
<span id="el_core_language_imageURL">
<div id="fd_x_imageURL" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->imageURL->title() ?>" data-table="core_language" data-field="x_imageURL" name="x_imageURL" id="x_imageURL" lang="<?= CurrentLanguageID() ?>"<?= $Page->imageURL->editAttributes() ?> aria-describedby="x_imageURL_help"<?= ($Page->imageURL->ReadOnly || $Page->imageURL->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->imageURL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->imageURL->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_imageURL" id= "fn_x_imageURL" value="<?= $Page->imageURL->Upload->FileName ?>">
<input type="hidden" name="fa_x_imageURL" id= "fa_x_imageURL" value="0">
<input type="hidden" name="fs_x_imageURL" id= "fs_x_imageURL" value="100">
<input type="hidden" name="fx_x_imageURL" id= "fx_x_imageURL" value="<?= $Page->imageURL->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imageURL" id= "fm_x_imageURL" value="<?= $Page->imageURL->UploadMaxFileSize ?>">
<table id="ft_x_imageURL" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_imageURL"<?= $Page->imageURL->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_language_imageURL"><?= $Page->imageURL->caption() ?><?= $Page->imageURL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->imageURL->cellAttributes() ?>>
<span id="el_core_language_imageURL">
<div id="fd_x_imageURL" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->imageURL->title() ?>" data-table="core_language" data-field="x_imageURL" name="x_imageURL" id="x_imageURL" lang="<?= CurrentLanguageID() ?>"<?= $Page->imageURL->editAttributes() ?> aria-describedby="x_imageURL_help"<?= ($Page->imageURL->ReadOnly || $Page->imageURL->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->imageURL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->imageURL->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_imageURL" id= "fn_x_imageURL" value="<?= $Page->imageURL->Upload->FileName ?>">
<input type="hidden" name="fa_x_imageURL" id= "fa_x_imageURL" value="0">
<input type="hidden" name="fs_x_imageURL" id= "fs_x_imageURL" value="100">
<input type="hidden" name="fx_x_imageURL" id= "fx_x_imageURL" value="<?= $Page->imageURL->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imageURL" id= "fm_x_imageURL" value="<?= $Page->imageURL->UploadMaxFileSize ?>">
<table id="ft_x_imageURL" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label id="elh_core_language_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_language_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_languageadd_x_core_statusID"
        data-table="core_language"
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
loadjs.ready("fcore_languageadd", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_languageadd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_languageadd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_languageadd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_languageadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_language.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_language_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_language_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_languageadd_x_core_statusID"
        data-table="core_language"
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
loadjs.ready("fcore_languageadd", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_languageadd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_languageadd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_languageadd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_languageadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_language.fields.core_statusID.selectOptions);
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
    ew.addEventHandlers("core_language");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
