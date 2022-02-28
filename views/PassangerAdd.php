<?php

namespace PHPMaker2022\phpmvc;

// Page object
$PassangerAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { passanger: currentTable } });
var currentForm, currentPageID;
var fpassangeradd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpassangeradd = new ew.Form("fpassangeradd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpassangeradd;

    // Add fields
    var fields = currentTable.fields;
    fpassangeradd.addFields([
        ["customer_name", [fields.customer_name.visible && fields.customer_name.required ? ew.Validators.required(fields.customer_name.caption) : null], fields.customer_name.isInvalid],
        ["how_many_people", [fields.how_many_people.visible && fields.how_many_people.required ? ew.Validators.required(fields.how_many_people.caption) : null, ew.Validators.integer], fields.how_many_people.isInvalid],
        ["transport_date", [fields.transport_date.visible && fields.transport_date.required ? ew.Validators.required(fields.transport_date.caption) : null, ew.Validators.datetime(fields.transport_date.clientFormatPattern)], fields.transport_date.isInvalid],
        ["insertUserID", [fields.insertUserID.visible && fields.insertUserID.required ? ew.Validators.required(fields.insertUserID.caption) : null], fields.insertUserID.isInvalid],
        ["insertWhen", [fields.insertWhen.visible && fields.insertWhen.required ? ew.Validators.required(fields.insertWhen.caption) : null], fields.insertWhen.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid]
    ]);

    // Form_CustomValidate
    fpassangeradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpassangeradd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpassangeradd.lists.insertUserID = <?= $Page->insertUserID->toClientList($Page) ?>;
    fpassangeradd.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fpassangeradd.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    loadjs.done("fpassangeradd");
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
<form name="fpassangeradd" id="fpassangeradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="passanger">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_passangeradd" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_customer_name"<?= $Page->customer_name->rowAttributes() ?>>
        <label id="elh_passanger_customer_name" for="x_customer_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->customer_name->caption() ?><?= $Page->customer_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->customer_name->cellAttributes() ?>>
<span id="el_passanger_customer_name">
<input type="<?= $Page->customer_name->getInputTextType() ?>" name="x_customer_name" id="x_customer_name" data-table="passanger" data-field="x_customer_name" value="<?= $Page->customer_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->customer_name->getPlaceHolder()) ?>"<?= $Page->customer_name->editAttributes() ?> aria-describedby="x_customer_name_help">
<?= $Page->customer_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->customer_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_customer_name"<?= $Page->customer_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_passanger_customer_name"><?= $Page->customer_name->caption() ?><?= $Page->customer_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->customer_name->cellAttributes() ?>>
<span id="el_passanger_customer_name">
<input type="<?= $Page->customer_name->getInputTextType() ?>" name="x_customer_name" id="x_customer_name" data-table="passanger" data-field="x_customer_name" value="<?= $Page->customer_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->customer_name->getPlaceHolder()) ?>"<?= $Page->customer_name->editAttributes() ?> aria-describedby="x_customer_name_help">
<?= $Page->customer_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->customer_name->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->how_many_people->Visible) { // how_many_people ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_how_many_people"<?= $Page->how_many_people->rowAttributes() ?>>
        <label id="elh_passanger_how_many_people" for="x_how_many_people" class="<?= $Page->LeftColumnClass ?>"><?= $Page->how_many_people->caption() ?><?= $Page->how_many_people->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->how_many_people->cellAttributes() ?>>
<span id="el_passanger_how_many_people">
<input type="<?= $Page->how_many_people->getInputTextType() ?>" name="x_how_many_people" id="x_how_many_people" data-table="passanger" data-field="x_how_many_people" value="<?= $Page->how_many_people->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->how_many_people->getPlaceHolder()) ?>"<?= $Page->how_many_people->editAttributes() ?> aria-describedby="x_how_many_people_help">
<?= $Page->how_many_people->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->how_many_people->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_how_many_people"<?= $Page->how_many_people->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_passanger_how_many_people"><?= $Page->how_many_people->caption() ?><?= $Page->how_many_people->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->how_many_people->cellAttributes() ?>>
<span id="el_passanger_how_many_people">
<input type="<?= $Page->how_many_people->getInputTextType() ?>" name="x_how_many_people" id="x_how_many_people" data-table="passanger" data-field="x_how_many_people" value="<?= $Page->how_many_people->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->how_many_people->getPlaceHolder()) ?>"<?= $Page->how_many_people->editAttributes() ?> aria-describedby="x_how_many_people_help">
<?= $Page->how_many_people->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->how_many_people->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->transport_date->Visible) { // transport_date ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_transport_date"<?= $Page->transport_date->rowAttributes() ?>>
        <label id="elh_passanger_transport_date" for="x_transport_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transport_date->caption() ?><?= $Page->transport_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->transport_date->cellAttributes() ?>>
<span id="el_passanger_transport_date">
<input type="<?= $Page->transport_date->getInputTextType() ?>" name="x_transport_date" id="x_transport_date" data-table="passanger" data-field="x_transport_date" value="<?= $Page->transport_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->transport_date->getPlaceHolder()) ?>"<?= $Page->transport_date->editAttributes() ?> aria-describedby="x_transport_date_help">
<?= $Page->transport_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transport_date->getErrorMessage() ?></div>
<?php if (!$Page->transport_date->ReadOnly && !$Page->transport_date->Disabled && !isset($Page->transport_date->EditAttrs["readonly"]) && !isset($Page->transport_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpassangeradd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpassangeradd", "x_transport_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_transport_date"<?= $Page->transport_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_passanger_transport_date"><?= $Page->transport_date->caption() ?><?= $Page->transport_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->transport_date->cellAttributes() ?>>
<span id="el_passanger_transport_date">
<input type="<?= $Page->transport_date->getInputTextType() ?>" name="x_transport_date" id="x_transport_date" data-table="passanger" data-field="x_transport_date" value="<?= $Page->transport_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->transport_date->getPlaceHolder()) ?>"<?= $Page->transport_date->editAttributes() ?> aria-describedby="x_transport_date_help">
<?= $Page->transport_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transport_date->getErrorMessage() ?></div>
<?php if (!$Page->transport_date->ReadOnly && !$Page->transport_date->Disabled && !isset($Page->transport_date->EditAttrs["readonly"]) && !isset($Page->transport_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpassangeradd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpassangeradd", "x_transport_date", jQuery.extend(true, {"useCurrent":false}, options));
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
        <label id="elh_passanger_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_passanger_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fpassangeradd_x_core_statusID"
        data-table="passanger"
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
loadjs.ready("fpassangeradd", function() {
    var options = { name: "x_core_statusID", selectId: "fpassangeradd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpassangeradd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fpassangeradd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fpassangeradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.passanger.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_passanger_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_passanger_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fpassangeradd_x_core_statusID"
        data-table="passanger"
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
loadjs.ready("fpassangeradd", function() {
    var options = { name: "x_core_statusID", selectId: "fpassangeradd_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpassangeradd.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fpassangeradd" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fpassangeradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.passanger.fields.core_statusID.selectOptions);
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
        <label id="elh_passanger_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_passanger_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fpassangeradd_x_core_languageID"
        data-table="passanger"
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
loadjs.ready("fpassangeradd", function() {
    var options = { name: "x_core_languageID", selectId: "fpassangeradd_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpassangeradd.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fpassangeradd" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fpassangeradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.passanger.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_passanger_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_passanger_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fpassangeradd_x_core_languageID"
        data-table="passanger"
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
loadjs.ready("fpassangeradd", function() {
    var options = { name: "x_core_languageID", selectId: "fpassangeradd_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpassangeradd.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fpassangeradd" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fpassangeradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.passanger.fields.core_languageID.selectOptions);
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
    ew.addEventHandlers("passanger");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
