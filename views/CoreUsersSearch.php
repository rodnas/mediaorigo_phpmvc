<?php

namespace PHPMaker2022\phpmvc;

// Page object
$CoreUsersSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { core_users: currentTable } });
var currentForm, currentPageID;
var fcore_userssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcore_userssearch = new ew.Form("fcore_userssearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fcore_userssearch;
    <?php } else { ?>
    currentForm = fcore_userssearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fcore_userssearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["_email", [], fields._email.isInvalid],
        ["nickname", [], fields.nickname.isInvalid],
        ["_password", [], fields._password.isInvalid],
        ["core_languageID", [], fields.core_languageID.isInvalid],
        ["core_statusID", [], fields.core_statusID.isInvalid],
        ["core_groupsID", [], fields.core_groupsID.isInvalid]
    ]);

    // Validate form
    fcore_userssearch.validate = function () {
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
    fcore_userssearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcore_userssearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcore_userssearch.lists.core_languageID = <?= $Page->core_languageID->toClientList($Page) ?>;
    fcore_userssearch.lists.core_statusID = <?= $Page->core_statusID->toClientList($Page) ?>;
    fcore_userssearch.lists.core_groupsID = <?= $Page->core_groupsID->toClientList($Page) ?>;
    loadjs.done("fcore_userssearch");
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
<form name="fcore_userssearch" id="fcore_userssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="core_users">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_core_userssearch" class="table table-striped table-bordered table-hover table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
            <span id="el_core_users_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_users" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_id"><?= $Page->id->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span></td>
        <td<?= $Page->id->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users_id" class="ew-search-field">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="core_users" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label for="x__email" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users__email"><?= $Page->_email->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__email" id="z__email" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_email->cellAttributes() ?>>
            <span id="el_core_users__email" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="core_users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users__email"><?= $Page->_email->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__email" id="z__email" value="LIKE">
</span></td>
        <td<?= $Page->_email->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users__email" class="ew-search-field">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="core_users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->nickname->Visible) { // nickname ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_nickname"<?= $Page->nickname->rowAttributes() ?>>
        <label for="x_nickname" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users_nickname"><?= $Page->nickname->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nickname" id="z_nickname" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nickname->cellAttributes() ?>>
            <span id="el_core_users_nickname" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nickname->getInputTextType() ?>" name="x_nickname" id="x_nickname" data-table="core_users" data-field="x_nickname" value="<?= $Page->nickname->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nickname->getPlaceHolder()) ?>"<?= $Page->nickname->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nickname->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_nickname"<?= $Page->nickname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_nickname"><?= $Page->nickname->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nickname" id="z_nickname" value="LIKE">
</span></td>
        <td<?= $Page->nickname->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users_nickname" class="ew-search-field">
<input type="<?= $Page->nickname->getInputTextType() ?>" name="x_nickname" id="x_nickname" data-table="core_users" data-field="x_nickname" value="<?= $Page->nickname->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nickname->getPlaceHolder()) ?>"<?= $Page->nickname->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nickname->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label for="x__password" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users__password"><?= $Page->_password->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__password" id="z__password" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_password->cellAttributes() ?>>
            <span id="el_core_users__password" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="core_users" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users__password"><?= $Page->_password->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__password" id="z__password" value="LIKE">
</span></td>
        <td<?= $Page->_password->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users__password" class="ew-search-field">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="core_users" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage(false) ?></div>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_languageID->Visible) { // core_languageID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <label for="x_core_languageID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users_core_languageID"><?= $Page->core_languageID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_languageID->cellAttributes() ?>>
            <span id="el_core_users_core_languageID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_userssearch_x_core_languageID"
        data-table="core_users"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fcore_userssearch", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_userssearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_userssearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_userssearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_userssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_languageID"<?= $Page->core_languageID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_core_languageID"><?= $Page->core_languageID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_core_languageID" id="z_core_languageID" value="LIKE">
</span></td>
        <td<?= $Page->core_languageID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users_core_languageID" class="ew-search-field">
    <select
        id="x_core_languageID"
        name="x_core_languageID"
        class="form-select ew-select<?= $Page->core_languageID->isInvalidClass() ?>"
        data-select2-id="fcore_userssearch_x_core_languageID"
        data-table="core_users"
        data-field="x_core_languageID"
        data-value-separator="<?= $Page->core_languageID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_languageID->getPlaceHolder()) ?>"
        <?= $Page->core_languageID->editAttributes() ?>>
        <?= $Page->core_languageID->selectOptionListHtml("x_core_languageID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_languageID->getErrorMessage(false) ?></div>
<?= $Page->core_languageID->Lookup->getParamTag($Page, "p_x_core_languageID") ?>
<script>
loadjs.ready("fcore_userssearch", function() {
    var options = { name: "x_core_languageID", selectId: "fcore_userssearch_x_core_languageID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_userssearch.lists.core_languageID.lookupOptions.length) {
        options.data = { id: "x_core_languageID", form: "fcore_userssearch" };
    } else {
        options.ajax = { id: "x_core_languageID", form: "fcore_userssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_languageID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_statusID->Visible) { // core_statusID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <label for="x_core_statusID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users_core_statusID"><?= $Page->core_statusID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_statusID->cellAttributes() ?>>
            <span id="el_core_users_core_statusID" class="ew-search-field ew-search-field-single">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_userssearch_x_core_statusID"
        data-table="core_users"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fcore_userssearch", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_userssearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_userssearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_userssearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_userssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_statusID"<?= $Page->core_statusID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_core_statusID"><?= $Page->core_statusID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_statusID" id="z_core_statusID" value="=">
</span></td>
        <td<?= $Page->core_statusID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users_core_statusID" class="ew-search-field">
    <select
        id="x_core_statusID"
        name="x_core_statusID"
        class="form-select ew-select<?= $Page->core_statusID->isInvalidClass() ?>"
        data-select2-id="fcore_userssearch_x_core_statusID"
        data-table="core_users"
        data-field="x_core_statusID"
        data-value-separator="<?= $Page->core_statusID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_statusID->getPlaceHolder()) ?>"
        <?= $Page->core_statusID->editAttributes() ?>>
        <?= $Page->core_statusID->selectOptionListHtml("x_core_statusID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_statusID->getErrorMessage(false) ?></div>
<?= $Page->core_statusID->Lookup->getParamTag($Page, "p_x_core_statusID") ?>
<script>
loadjs.ready("fcore_userssearch", function() {
    var options = { name: "x_core_statusID", selectId: "fcore_userssearch_x_core_statusID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_userssearch.lists.core_statusID.lookupOptions.length) {
        options.data = { id: "x_core_statusID", form: "fcore_userssearch" };
    } else {
        options.ajax = { id: "x_core_statusID", form: "fcore_userssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_statusID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
            </div>
        </td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->core_groupsID->Visible) { // core_groupsID ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <label for="x_core_groupsID" class="<?= $Page->LeftColumnClass ?>"><span id="elh_core_users_core_groupsID"><?= $Page->core_groupsID->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_groupsID" id="z_core_groupsID" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->core_groupsID->cellAttributes() ?>>
            <span id="el_core_users_core_groupsID" class="ew-search-field ew-search-field-single">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span class="form-control-plaintext"><?= $Page->core_groupsID->getDisplayValue($Page->core_groupsID->EditValue) ?></span>
<?php } else { ?>
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_userssearch_x_core_groupsID"
        data-table="core_users"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage(false) ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_userssearch", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_userssearch_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_userssearch.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_userssearch" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_userssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <tr id="r_core_groupsID"<?= $Page->core_groupsID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_core_users_core_groupsID"><?= $Page->core_groupsID->caption() ?></span></td>
        <td class="w-col-1"><span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_core_groupsID" id="z_core_groupsID" value="=">
</span></td>
        <td<?= $Page->core_groupsID->cellAttributes() ?>>
            <div class="text-nowrap">
                <span id="el_core_users_core_groupsID" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span class="form-control-plaintext"><?= $Page->core_groupsID->getDisplayValue($Page->core_groupsID->EditValue) ?></span>
<?php } else { ?>
    <select
        id="x_core_groupsID"
        name="x_core_groupsID"
        class="form-select ew-select<?= $Page->core_groupsID->isInvalidClass() ?>"
        data-select2-id="fcore_userssearch_x_core_groupsID"
        data-table="core_users"
        data-field="x_core_groupsID"
        data-value-separator="<?= $Page->core_groupsID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->core_groupsID->getPlaceHolder()) ?>"
        <?= $Page->core_groupsID->editAttributes() ?>>
        <?= $Page->core_groupsID->selectOptionListHtml("x_core_groupsID") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->core_groupsID->getErrorMessage(false) ?></div>
<?= $Page->core_groupsID->Lookup->getParamTag($Page, "p_x_core_groupsID") ?>
<script>
loadjs.ready("fcore_userssearch", function() {
    var options = { name: "x_core_groupsID", selectId: "fcore_userssearch_x_core_groupsID" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcore_userssearch.lists.core_groupsID.lookupOptions.length) {
        options.data = { id: "x_core_groupsID", form: "fcore_userssearch" };
    } else {
        options.ajax = { id: "x_core_groupsID", form: "fcore_userssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.core_users.fields.core_groupsID.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
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
    ew.addEventHandlers("core_users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
