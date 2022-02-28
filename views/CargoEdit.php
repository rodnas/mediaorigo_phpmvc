<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CargoEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cargo: currentTable } });
var currentForm, currentPageID;
var fcargoedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcargoedit = new ew.Form("fcargoedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fcargoedit;

    // Add fields
    var fields = currentTable.fields;
    fcargoedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["place", [fields.place.visible && fields.place.required ? ew.Validators.required(fields.place.caption) : null], fields.place.isInvalid],
        ["cargo_weight", [fields.cargo_weight.visible && fields.cargo_weight.required ? ew.Validators.required(fields.cargo_weight.caption) : null, ew.Validators.integer], fields.cargo_weight.isInvalid],
        ["transport_date", [fields.transport_date.visible && fields.transport_date.required ? ew.Validators.required(fields.transport_date.caption) : null, ew.Validators.datetime(fields.transport_date.clientFormatPattern)], fields.transport_date.isInvalid],
        ["modifyUserID", [fields.modifyUserID.visible && fields.modifyUserID.required ? ew.Validators.required(fields.modifyUserID.caption) : null], fields.modifyUserID.isInvalid],
        ["modifyWhen", [fields.modifyWhen.visible && fields.modifyWhen.required ? ew.Validators.required(fields.modifyWhen.caption) : null], fields.modifyWhen.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid]
    ]);

    // Form_CustomValidate
    fcargoedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcargoedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcargoedit.lists.modifyUserID = <?= $Page->modifyUserID->toClientList($Page) ?>;
    fcargoedit.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fcargoedit.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    loadjs.done("fcargoedit");
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
<form name="fcargoedit" id="fcargoedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cargo">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_cargoedit" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_cargo_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_cargo_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="cargo" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_cargo_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="cargo" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->place->Visible) { // place ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_place"<?= $Page->place->rowAttributes() ?>>
        <label id="elh_cargo_place" for="x_place" class="<?= $Page->LeftColumnClass ?>"><?= $Page->place->caption() ?><?= $Page->place->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->place->cellAttributes() ?>>
<span id="el_cargo_place">
<input type="<?= $Page->place->getInputTextType() ?>" name="x_place" id="x_place" data-table="cargo" data-field="x_place" value="<?= $Page->place->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->place->getPlaceHolder()) ?>"<?= $Page->place->editAttributes() ?> aria-describedby="x_place_help">
<?= $Page->place->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->place->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_place"<?= $Page->place->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_place"><?= $Page->place->caption() ?><?= $Page->place->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->place->cellAttributes() ?>>
<span id="el_cargo_place">
<input type="<?= $Page->place->getInputTextType() ?>" name="x_place" id="x_place" data-table="cargo" data-field="x_place" value="<?= $Page->place->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->place->getPlaceHolder()) ?>"<?= $Page->place->editAttributes() ?> aria-describedby="x_place_help">
<?= $Page->place->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->place->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->cargo_weight->Visible) { // cargo_weight ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_cargo_weight"<?= $Page->cargo_weight->rowAttributes() ?>>
        <label id="elh_cargo_cargo_weight" for="x_cargo_weight" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cargo_weight->caption() ?><?= $Page->cargo_weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cargo_weight->cellAttributes() ?>>
<span id="el_cargo_cargo_weight">
<input type="<?= $Page->cargo_weight->getInputTextType() ?>" name="x_cargo_weight" id="x_cargo_weight" data-table="cargo" data-field="x_cargo_weight" value="<?= $Page->cargo_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cargo_weight->getPlaceHolder()) ?>"<?= $Page->cargo_weight->editAttributes() ?> aria-describedby="x_cargo_weight_help">
<?= $Page->cargo_weight->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cargo_weight->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_cargo_weight"<?= $Page->cargo_weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_cargo_weight"><?= $Page->cargo_weight->caption() ?><?= $Page->cargo_weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->cargo_weight->cellAttributes() ?>>
<span id="el_cargo_cargo_weight">
<input type="<?= $Page->cargo_weight->getInputTextType() ?>" name="x_cargo_weight" id="x_cargo_weight" data-table="cargo" data-field="x_cargo_weight" value="<?= $Page->cargo_weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cargo_weight->getPlaceHolder()) ?>"<?= $Page->cargo_weight->editAttributes() ?> aria-describedby="x_cargo_weight_help">
<?= $Page->cargo_weight->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cargo_weight->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_transport_date"<?= $Page->transport_date->rowAttributes() ?>>
        <label id="elh_cargo_transport_date" for="x_transport_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transport_date->caption() ?><?= $Page->transport_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->transport_date->cellAttributes() ?>>
<span id="el_cargo_transport_date">
<input type="<?= $Page->transport_date->getInputTextType() ?>" name="x_transport_date" id="x_transport_date" data-table="cargo" data-field="x_transport_date" value="<?= $Page->transport_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->transport_date->getPlaceHolder()) ?>"<?= $Page->transport_date->editAttributes() ?> aria-describedby="x_transport_date_help">
<?= $Page->transport_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transport_date->getErrorMessage() ?></div>
<?php if (!$Page->transport_date->ReadOnly && !$Page->transport_date->Disabled && !isset($Page->transport_date->EditAttrs["readonly"]) && !isset($Page->transport_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcargoedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcargoedit", "x_transport_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_transport_date"<?= $Page->transport_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_transport_date"><?= $Page->transport_date->caption() ?><?= $Page->transport_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->transport_date->cellAttributes() ?>>
<span id="el_cargo_transport_date">
<input type="<?= $Page->transport_date->getInputTextType() ?>" name="x_transport_date" id="x_transport_date" data-table="cargo" data-field="x_transport_date" value="<?= $Page->transport_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->transport_date->getPlaceHolder()) ?>"<?= $Page->transport_date->editAttributes() ?> aria-describedby="x_transport_date_help">
<?= $Page->transport_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transport_date->getErrorMessage() ?></div>
<?php if (!$Page->transport_date->ReadOnly && !$Page->transport_date->Disabled && !isset($Page->transport_date->EditAttrs["readonly"]) && !isset($Page->transport_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcargoedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcargoedit", "x_transport_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label id="elh_cargo_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_cargo_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcargoedit_x_core_statusID"
        data-table="cargo"
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
loadjs.ready("fcargoedit", function() {
    var options = { name: "x_core_statusID", selectId: "fcargoedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcargoedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcargoedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcargoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.cargo.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_cargo_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcargoedit_x_core_statusID"
        data-table="cargo"
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
loadjs.ready("fcargoedit", function() {
    var options = { name: "x_core_statusID", selectId: "fcargoedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcargoedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcargoedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcargoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.cargo.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label id="elh_cargo_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_cargo_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcargoedit_x_core_languageID"
        data-table="cargo"
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
loadjs.ready("fcargoedit", function() {
    var options = { name: "x_core_languageID", selectId: "fcargoedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcargoedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcargoedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcargoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.cargo.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cargo_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_cargo_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcargoedit_x_core_languageID"
        data-table="cargo"
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
loadjs.ready("fcargoedit", function() {
    var options = { name: "x_core_languageID", selectId: "fcargoedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcargoedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcargoedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcargoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.cargo.fields.core_languageID.selectOptions);
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
    ew.addEventHandlers("cargo");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
