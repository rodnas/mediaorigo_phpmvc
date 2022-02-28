<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreUsersEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_users: currentTable } });
var currentForm, currentPageID;
var fcore_usersedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcore_usersedit = new ew.Form("fcore_usersedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fcore_usersedit;

    // Add fields
    var fields = currentTable.fields;
    fcore_usersedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["nickname", [fields.nickname.visible && fields.nickname.required ? ew.Validators.required(fields.nickname.caption) : null], fields.nickname.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["core_languageID", [fields.core_languageID.visible && fields.core_languageID.required ? ew.Validators.required(fields.core_languageID.caption) : null], fields.core_languageID.isInvalid],
        ["core_statusID", [fields.core_statusID.visible && fields.core_statusID.required ? ew.Validators.required(fields.core_statusID.caption) : null], fields.core_statusID.isInvalid],
        ["core_groupsID", [fields.core_groupsID.visible && fields.core_groupsID.required ? ew.Validators.required(fields.core_groupsID.caption) : null], fields.core_groupsID.isInvalid]
    ]);

    // Form_CustomValidate
    fcore_usersedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_usersedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_usersedit.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    fcore_usersedit.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fcore_usersedit.lists.core_groupsID = <?= $Page->core_groupsID->toClientList($Page) ?>;
    loadjs.done("fcore_usersedit");
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
<form name="fcore_usersedit" id="fcore_usersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_usersedit" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_core_users_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_core_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="core_users" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el_core_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="core_users" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_core_users__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_core_users__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="core_users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users__email"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el_core_users__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="core_users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->nickname->Visible) { // nickname ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_nickname"<?= $Page->nickname->rowAttributes() ?>>
        <label id="elh_core_users_nickname" for="x_nickname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nickname->caption() ?><?= $Page->nickname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nickname->cellAttributes() ?>>
<span id="el_core_users_nickname">
<input type="<?= $Page->nickname->getInputTextType() ?>" name="x_nickname" id="x_nickname" data-table="core_users" data-field="x_nickname" value="<?= $Page->nickname->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nickname->getPlaceHolder()) ?>"<?= $Page->nickname->editAttributes() ?> aria-describedby="x_nickname_help">
<?= $Page->nickname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nickname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_nickname"<?= $Page->nickname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_nickname"><?= $Page->nickname->caption() ?><?= $Page->nickname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->nickname->cellAttributes() ?>>
<span id="el_core_users_nickname">
<input type="<?= $Page->nickname->getInputTextType() ?>" name="x_nickname" id="x_nickname" data-table="core_users" data-field="x_nickname" value="<?= $Page->nickname->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nickname->getPlaceHolder()) ?>"<?= $Page->nickname->editAttributes() ?> aria-describedby="x_nickname_help">
<?= $Page->nickname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nickname->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_core_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_core_users__password">
<div class="input-group" id="ig__password">
    <input type="password" autocomplete="new-password" data-table="core_users" data-field="x__password" name="x__password" id="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
    <button type="button" class="btn btn-default ew-toggle-password" data-ew-action="password"><i class="fas fa-eye"></i></button>
    <button type="button" class="btn btn-default ew-password-generator rounded-end" title="<?= HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x__password" data-password-confirm="c__password"><?= $Language->phrase("GeneratePassword") ?></button>
</div>
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users__password"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->_password->cellAttributes() ?>>
<span id="el_core_users__password">
<div class="input-group" id="ig__password">
    <input type="password" autocomplete="new-password" data-table="core_users" data-field="x__password" name="x__password" id="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
    <button type="button" class="btn btn-default ew-toggle-password" data-ew-action="password"><i class="fas fa-eye"></i></button>
    <button type="button" class="btn btn-default ew-password-generator rounded-end" title="<?= HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x__password" data-password-confirm="c__password"><?= $Language->phrase("GeneratePassword") ?></button>
</div>
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label id="elh_core_users_core_languageID" for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_core_users_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_usersedit_x_core_languageID"
        data-table="core_users"
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
loadjs.ready("fcore_usersedit", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_usersedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_usersedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_usersedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_core_languageID"><?= $Page->core_languageID->caption() ?><?= $Page->core_languageID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
<span id="el_core_users_core_languageID">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_usersedit_x_core_languageID"
        data-table="core_users"
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
loadjs.ready("fcore_usersedit", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_usersedit_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_usersedit.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_usersedit" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label id="elh_core_users_core_statusID" for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_users_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_usersedit_x_core_statusID"
        data-table="core_users"
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
loadjs.ready("fcore_usersedit", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_usersedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_usersedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_usersedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_core_statusID"><?= $Page->core_statusID->caption() ?><?= $Page->core_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
<span id="el_core_users_core_statusID">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_usersedit_x_core_statusID"
        data-table="core_users"
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
loadjs.ready("fcore_usersedit", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_usersedit_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_usersedit.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_usersedit" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <label id="elh_core_users_core_groupsID" for="x_core_groupsID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->core_groupsID->caption() ?><?= $Page->core_groupsID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->core_groupsID->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_core_users_core_groupsID">
<span class="form-control-plaintext"><?= $Page->core_groupsID->getDisplayValue($Page->core_groupsID->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_core_users_core_groupsID">
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_usersedit_x_core_groupsID"
        data-table="core_users"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <?= $Page->core_groupsID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage() ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_usersedit", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_usersedit_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_usersedit.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_usersedit" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_core_groupsID"><?= $Page->core_groupsID->caption() ?><?= $Page->core_groupsID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->core_groupsID->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_core_users_core_groupsID">
<span class="form-control-plaintext"><?= $Page->core_groupsID->getDisplayValue($Page->core_groupsID->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_core_users_core_groupsID">
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_usersedit_x_core_groupsID"
        data-table="core_users"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <?= $Page->core_groupsID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage() ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_usersedit", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_usersedit_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_usersedit.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_usersedit" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
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
    ew.addEventHandlers("core_users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
