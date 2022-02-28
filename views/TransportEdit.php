<?php

namespace PHPMaker2022\phpmvc;

// Page object
$TransportEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transport: currentTable } });
var currentForm, currentPageID;
var ftransportedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransportedit = new ew.Form("ftransportedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ftransportedit;

    // Add fields
    var fields = currentTable.fields;
    ftransportedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["vehicleID", [fields.vehicleID.visible && fields.vehicleID.required ? ew.Validators.required(fields.vehicleID.caption) : null], fields.vehicleID.isInvalid],
        ["driverID", [fields.driverID.visible && fields.driverID.required ? ew.Validators.required(fields.driverID.caption) : null], fields.driverID.isInvalid],
        ["cargoID", [fields.cargoID.visible && fields.cargoID.required ? ew.Validators.required(fields.cargoID.caption) : null], fields.cargoID.isInvalid],
        ["passangerID", [fields.passangerID.visible && fields.passangerID.required ? ew.Validators.required(fields.passangerID.caption) : null], fields.passangerID.isInvalid],
        ["order_date", [fields.order_date.visible && fields.order_date.required ? ew.Validators.required(fields.order_date.caption) : null, ew.Validators.datetime(fields.order_date.clientFormatPattern)], fields.order_date.isInvalid],
        ["modifyUserID", [fields.modifyUserID.visible && fields.modifyUserID.required ? ew.Validators.required(fields.modifyUserID.caption) : null], fields.modifyUserID.isInvalid],
        ["modifyWhen", [fields.modifyWhen.visible && fields.modifyWhen.required ? ew.Validators.required(fields.modifyWhen.caption) : null], fields.modifyWhen.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid]
    ]);

    // Form_CustomValidate
    ftransportedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransportedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ftransportedit.lists.vehicleID = <?= $Page->vehicleID->toClientList($Page) ?>;
    ftransportedit.lists.driverID = <?= $Page->driverID->toClientList($Page) ?>;
    ftransportedit.lists.cargoID = <?= $Page->cargoID->toClientList($Page) ?>;
    ftransportedit.lists.passangerID = <?= $Page->passangerID->toClientList($Page) ?>;
    ftransportedit.lists.modifyUserID = <?= $Page->modifyUserID->toClientList($Page) ?>;
    ftransportedit.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    ftransportedit.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    loadjs.done("ftransportedit");
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
<form name="ftransportedit" id="ftransportedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transport">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_transportedit" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_transport_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_transport_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="transport" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_transport_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="transport" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->vehicleID->Visible) { // vehicleID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_vehicleID"<?= $Page->vehicleID->rowAttributes() ?>>
        <label id="elh_transport_vehicleID" for="x_vehicleID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->vehicleID->caption() ?><?= $Page->vehicleID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->vehicleID->cellAttributes() ?>>
<span id="el_transport_vehicleID">
    <select
        id="x_vehicleID"
        name="x_vehicleID"
        class="form-select ew-select<?= $Page->vehicleID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_vehicleID"
        data-table="transport"
        data-field="x_vehicleID"
        data-value-separator="<?= $Page->vehicleID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicleID->getPlaceHolder()) ?>"
        <?= $Page->vehicleID->editAttributes() ?>>
        <?= $Page->vehicleID->selectOptionListHtml("x_vehicleID") ?>
    </select>
    <?= $Page->vehicleID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->vehicleID->getErrorMessage() ?></div>
<?= $Page->vehicleID->Lookup->getParamTag($Page, "p_x_vehicleID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_vehicleID", selectId: "ftransportedit_x_vehicleID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.vehicleID.lookupOptions.length) {
        options.data = { id: "x_vehicleID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_vehicleID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.vehicleID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_vehicleID"<?= $Page->vehicleID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_vehicleID"><?= $Page->vehicleID->caption() ?><?= $Page->vehicleID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->vehicleID->cellAttributes() ?>>
<span id="el_transport_vehicleID">
    <select
        id="x_vehicleID"
        name="x_vehicleID"
        class="form-select ew-select<?= $Page->vehicleID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_vehicleID"
        data-table="transport"
        data-field="x_vehicleID"
        data-value-separator="<?= $Page->vehicleID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->vehicleID->getPlaceHolder()) ?>"
        <?= $Page->vehicleID->editAttributes() ?>>
        <?= $Page->vehicleID->selectOptionListHtml("x_vehicleID") ?>
    </select>
    <?= $Page->vehicleID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->vehicleID->getErrorMessage() ?></div>
<?= $Page->vehicleID->Lookup->getParamTag($Page, "p_x_vehicleID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_vehicleID", selectId: "ftransportedit_x_vehicleID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.vehicleID.lookupOptions.length) {
        options.data = { id: "x_vehicleID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_vehicleID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.vehicleID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->driverID->Visible) { // driverID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_driverID"<?= $Page->driverID->rowAttributes() ?>>
        <label id="elh_transport_driverID" for="x_driverID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->driverID->caption() ?><?= $Page->driverID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->driverID->cellAttributes() ?>>
<span id="el_transport_driverID">
    <select
        id="x_driverID"
        name="x_driverID"
        class="form-select ew-select<?= $Page->driverID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_driverID"
        data-table="transport"
        data-field="x_driverID"
        data-value-separator="<?= $Page->driverID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->driverID->getPlaceHolder()) ?>"
        <?= $Page->driverID->editAttributes() ?>>
        <?= $Page->driverID->selectOptionListHtml("x_driverID") ?>
    </select>
    <?= $Page->driverID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->driverID->getErrorMessage() ?></div>
<?= $Page->driverID->Lookup->getParamTag($Page, "p_x_driverID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_driverID", selectId: "ftransportedit_x_driverID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.driverID.lookupOptions.length) {
        options.data = { id: "x_driverID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_driverID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.driverID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_driverID"<?= $Page->driverID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_driverID"><?= $Page->driverID->caption() ?><?= $Page->driverID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->driverID->cellAttributes() ?>>
<span id="el_transport_driverID">
    <select
        id="x_driverID"
        name="x_driverID"
        class="form-select ew-select<?= $Page->driverID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_driverID"
        data-table="transport"
        data-field="x_driverID"
        data-value-separator="<?= $Page->driverID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->driverID->getPlaceHolder()) ?>"
        <?= $Page->driverID->editAttributes() ?>>
        <?= $Page->driverID->selectOptionListHtml("x_driverID") ?>
    </select>
    <?= $Page->driverID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->driverID->getErrorMessage() ?></div>
<?= $Page->driverID->Lookup->getParamTag($Page, "p_x_driverID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_driverID", selectId: "ftransportedit_x_driverID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.driverID.lookupOptions.length) {
        options.data = { id: "x_driverID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_driverID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.driverID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->cargoID->Visible) { // cargoID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_cargoID"<?= $Page->cargoID->rowAttributes() ?>>
        <label id="elh_transport_cargoID" for="x_cargoID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cargoID->caption() ?><?= $Page->cargoID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cargoID->cellAttributes() ?>>
<span id="el_transport_cargoID">
    <select
        id="x_cargoID"
        name="x_cargoID"
        class="form-select ew-select<?= $Page->cargoID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_cargoID"
        data-table="transport"
        data-field="x_cargoID"
        data-value-separator="<?= $Page->cargoID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->cargoID->getPlaceHolder()) ?>"
        <?= $Page->cargoID->editAttributes() ?>>
        <?= $Page->cargoID->selectOptionListHtml("x_cargoID") ?>
    </select>
    <?= $Page->cargoID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->cargoID->getErrorMessage() ?></div>
<?= $Page->cargoID->Lookup->getParamTag($Page, "p_x_cargoID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_cargoID", selectId: "ftransportedit_x_cargoID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.cargoID.lookupOptions.length) {
        options.data = { id: "x_cargoID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_cargoID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.cargoID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_cargoID"<?= $Page->cargoID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_cargoID"><?= $Page->cargoID->caption() ?><?= $Page->cargoID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->cargoID->cellAttributes() ?>>
<span id="el_transport_cargoID">
    <select
        id="x_cargoID"
        name="x_cargoID"
        class="form-select ew-select<?= $Page->cargoID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_cargoID"
        data-table="transport"
        data-field="x_cargoID"
        data-value-separator="<?= $Page->cargoID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->cargoID->getPlaceHolder()) ?>"
        <?= $Page->cargoID->editAttributes() ?>>
        <?= $Page->cargoID->selectOptionListHtml("x_cargoID") ?>
    </select>
    <?= $Page->cargoID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->cargoID->getErrorMessage() ?></div>
<?= $Page->cargoID->Lookup->getParamTag($Page, "p_x_cargoID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_cargoID", selectId: "ftransportedit_x_cargoID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.cargoID.lookupOptions.length) {
        options.data = { id: "x_cargoID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_cargoID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.cargoID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->passangerID->Visible) { // passangerID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_passangerID"<?= $Page->passangerID->rowAttributes() ?>>
        <label id="elh_transport_passangerID" for="x_passangerID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->passangerID->caption() ?><?= $Page->passangerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->passangerID->cellAttributes() ?>>
<span id="el_transport_passangerID">
    <select
        id="x_passangerID"
        name="x_passangerID"
        class="form-select ew-select<?= $Page->passangerID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_passangerID"
        data-table="transport"
        data-field="x_passangerID"
        data-value-separator="<?= $Page->passangerID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->passangerID->getPlaceHolder()) ?>"
        <?= $Page->passangerID->editAttributes() ?>>
        <?= $Page->passangerID->selectOptionListHtml("x_passangerID") ?>
    </select>
    <?= $Page->passangerID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->passangerID->getErrorMessage() ?></div>
<?= $Page->passangerID->Lookup->getParamTag($Page, "p_x_passangerID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_passangerID", selectId: "ftransportedit_x_passangerID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.passangerID.lookupOptions.length) {
        options.data = { id: "x_passangerID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_passangerID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.passangerID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_passangerID"<?= $Page->passangerID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_passangerID"><?= $Page->passangerID->caption() ?><?= $Page->passangerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->passangerID->cellAttributes() ?>>
<span id="el_transport_passangerID">
    <select
        id="x_passangerID"
        name="x_passangerID"
        class="form-select ew-select<?= $Page->passangerID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_passangerID"
        data-table="transport"
        data-field="x_passangerID"
        data-value-separator="<?= $Page->passangerID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->passangerID->getPlaceHolder()) ?>"
        <?= $Page->passangerID->editAttributes() ?>>
        <?= $Page->passangerID->selectOptionListHtml("x_passangerID") ?>
    </select>
    <?= $Page->passangerID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->passangerID->getErrorMessage() ?></div>
<?= $Page->passangerID->Lookup->getParamTag($Page, "p_x_passangerID") ?>
<script>
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_passangerID", selectId: "ftransportedit_x_passangerID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.passangerID.lookupOptions.length) {
        options.data = { id: "x_passangerID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_passangerID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.passangerID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->order_date->Visible) { // order_date ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_order_date"<?= $Page->order_date->rowAttributes() ?>>
        <label id="elh_transport_order_date" for="x_order_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_date->caption() ?><?= $Page->order_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_date->cellAttributes() ?>>
<span id="el_transport_order_date">
<input type="<?= $Page->order_date->getInputTextType() ?>" name="x_order_date" id="x_order_date" data-table="transport" data-field="x_order_date" value="<?= $Page->order_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->order_date->getPlaceHolder()) ?>"<?= $Page->order_date->editAttributes() ?> aria-describedby="x_order_date_help">
<?= $Page->order_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_date->getErrorMessage() ?></div>
<?php if (!$Page->order_date->ReadOnly && !$Page->order_date->Disabled && !isset($Page->order_date->EditAttrs["readonly"]) && !isset($Page->order_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportedit", "x_order_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_order_date"<?= $Page->order_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_order_date"><?= $Page->order_date->caption() ?><?= $Page->order_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->order_date->cellAttributes() ?>>
<span id="el_transport_order_date">
<input type="<?= $Page->order_date->getInputTextType() ?>" name="x_order_date" id="x_order_date" data-table="transport" data-field="x_order_date" value="<?= $Page->order_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->order_date->getPlaceHolder()) ?>"<?= $Page->order_date->editAttributes() ?> aria-describedby="x_order_date_help">
<?= $Page->order_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_date->getErrorMessage() ?></div>
<?php if (!$Page->order_date->ReadOnly && !$Page->order_date->Disabled && !isset($Page->order_date->EditAttrs["readonly"]) && !isset($Page->order_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransportedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransportedit", "x_order_date", jQuery.extend(true, {"useCurrent":false}, options));
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
        <label id="elh_transport_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_transport_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_core_statusID"
        data-table="transport"
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
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_core_statusID", selectId: "ftransportedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_transport_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_core_statusID"
        data-table="transport"
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
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_core_statusID", selectId: "ftransportedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_statusID.selectOptions);
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
        <label id="elh_transport_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_transport_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_core_languageID"
        data-table="transport"
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
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_core_languageID", selectId: "ftransportedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transport_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_transport_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="ftransportedit_x_core_languageID"
        data-table="transport"
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
loadjs.ready("ftransportedit", function() {
    var options = { name: "x_core_languageID", selectId: "ftransportedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftransportedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "ftransportedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "ftransportedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.transport.fields.core_languageID.selectOptions);
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
    ew.addEventHandlers("transport");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
