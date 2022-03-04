<?php

namespace PHPMaker2022\phpmvc;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class VehicleAdd extends Vehicle
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'vehicle';

    // Page object name
    public $PageObjName = "VehicleAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (vehicle)
        if (!isset($GLOBALS["vehicle"]) || get_class($GLOBALS["vehicle"]) == PROJECT_NAMESPACE . "vehicle") {
            $GLOBALS["vehicle"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'vehicle');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("vehicle");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "VehicleView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->Visible = false;
        $this->vehicle_typeID->setVisibility();
        $this->lpn->setVisibility();
        $this->start_year->setVisibility();
        $this->person->setVisibility();
        $this->max_weight->setVisibility();
        $this->insertUserID->setVisibility();
        $this->insertWhen->setVisibility();
        $this->modifyUserID->setVisibility();
        $this->modifyWhen->Visible = false;
        $this->core_languageID->Visible = false;
        $this->core_statusID->setVisibility();
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->vehicle_typeID);
        $this->setupLookupOptions($this->insertUserID);
        $this->setupLookupOptions($this->modifyUserID);
        $this->setupLookupOptions($this->core_languageID);
        $this->setupLookupOptions($this->core_statusID);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("VehicleList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "VehicleList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "VehicleView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->core_languageID->DefaultValue = 0;
        $this->core_statusID->DefaultValue = 1;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'vehicle_typeID' first before field var 'x_vehicle_typeID'
        $val = $CurrentForm->hasValue("vehicle_typeID") ? $CurrentForm->getValue("vehicle_typeID") : $CurrentForm->getValue("x_vehicle_typeID");
        if (!$this->vehicle_typeID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->vehicle_typeID->Visible = false; // Disable update for API request
            } else {
                $this->vehicle_typeID->setFormValue($val);
            }
        }

        // Check field name 'lpn' first before field var 'x_lpn'
        $val = $CurrentForm->hasValue("lpn") ? $CurrentForm->getValue("lpn") : $CurrentForm->getValue("x_lpn");
        if (!$this->lpn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lpn->Visible = false; // Disable update for API request
            } else {
                $this->lpn->setFormValue($val);
            }
        }

        // Check field name 'start_year' first before field var 'x_start_year'
        $val = $CurrentForm->hasValue("start_year") ? $CurrentForm->getValue("start_year") : $CurrentForm->getValue("x_start_year");
        if (!$this->start_year->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->start_year->Visible = false; // Disable update for API request
            } else {
                $this->start_year->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'person' first before field var 'x_person'
        $val = $CurrentForm->hasValue("person") ? $CurrentForm->getValue("person") : $CurrentForm->getValue("x_person");
        if (!$this->person->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->person->Visible = false; // Disable update for API request
            } else {
                $this->person->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'max_weight' first before field var 'x_max_weight'
        $val = $CurrentForm->hasValue("max_weight") ? $CurrentForm->getValue("max_weight") : $CurrentForm->getValue("x_max_weight");
        if (!$this->max_weight->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_weight->Visible = false; // Disable update for API request
            } else {
                $this->max_weight->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'insertUserID' first before field var 'x_insertUserID'
        $val = $CurrentForm->hasValue("insertUserID") ? $CurrentForm->getValue("insertUserID") : $CurrentForm->getValue("x_insertUserID");
        if (!$this->insertUserID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insertUserID->Visible = false; // Disable update for API request
            } else {
                $this->insertUserID->setFormValue($val);
            }
        }

        // Check field name 'insertWhen' first before field var 'x_insertWhen'
        $val = $CurrentForm->hasValue("insertWhen") ? $CurrentForm->getValue("insertWhen") : $CurrentForm->getValue("x_insertWhen");
        if (!$this->insertWhen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insertWhen->Visible = false; // Disable update for API request
            } else {
                $this->insertWhen->setFormValue($val);
            }
            $this->insertWhen->CurrentValue = UnFormatDateTime($this->insertWhen->CurrentValue, $this->insertWhen->formatPattern());
        }

        // Check field name 'modifyUserID' first before field var 'x_modifyUserID'
        $val = $CurrentForm->hasValue("modifyUserID") ? $CurrentForm->getValue("modifyUserID") : $CurrentForm->getValue("x_modifyUserID");
        if (!$this->modifyUserID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->modifyUserID->Visible = false; // Disable update for API request
            } else {
                $this->modifyUserID->setFormValue($val);
            }
        }

        // Check field name 'core_statusID' first before field var 'x_core_statusID'
        $val = $CurrentForm->hasValue("core_statusID") ? $CurrentForm->getValue("core_statusID") : $CurrentForm->getValue("x_core_statusID");
        if (!$this->core_statusID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->core_statusID->Visible = false; // Disable update for API request
            } else {
                $this->core_statusID->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->vehicle_typeID->CurrentValue = $this->vehicle_typeID->FormValue;
        $this->lpn->CurrentValue = $this->lpn->FormValue;
        $this->start_year->CurrentValue = $this->start_year->FormValue;
        $this->person->CurrentValue = $this->person->FormValue;
        $this->max_weight->CurrentValue = $this->max_weight->FormValue;
        $this->insertUserID->CurrentValue = $this->insertUserID->FormValue;
        $this->insertWhen->CurrentValue = $this->insertWhen->FormValue;
        $this->insertWhen->CurrentValue = UnFormatDateTime($this->insertWhen->CurrentValue, $this->insertWhen->formatPattern());
        $this->modifyUserID->CurrentValue = $this->modifyUserID->FormValue;
        $this->core_statusID->CurrentValue = $this->core_statusID->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->vehicle_typeID->setDbValue($row['vehicle_typeID']);
        $this->lpn->setDbValue($row['lpn']);
        $this->start_year->setDbValue($row['start_year']);
        $this->person->setDbValue($row['person']);
        $this->max_weight->setDbValue($row['max_weight']);
        $this->insertUserID->setDbValue($row['insertUserID']);
        $this->insertWhen->setDbValue($row['insertWhen']);
        $this->modifyUserID->setDbValue($row['modifyUserID']);
        $this->modifyWhen->setDbValue($row['modifyWhen']);
        $this->core_languageID->setDbValue($row['core_languageID']);
        $this->core_statusID->setDbValue($row['core_statusID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['vehicle_typeID'] = $this->vehicle_typeID->DefaultValue;
        $row['lpn'] = $this->lpn->DefaultValue;
        $row['start_year'] = $this->start_year->DefaultValue;
        $row['person'] = $this->person->DefaultValue;
        $row['max_weight'] = $this->max_weight->DefaultValue;
        $row['insertUserID'] = $this->insertUserID->DefaultValue;
        $row['insertWhen'] = $this->insertWhen->DefaultValue;
        $row['modifyUserID'] = $this->modifyUserID->DefaultValue;
        $row['modifyWhen'] = $this->modifyWhen->DefaultValue;
        $row['core_languageID'] = $this->core_languageID->DefaultValue;
        $row['core_statusID'] = $this->core_statusID->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // vehicle_typeID
        $this->vehicle_typeID->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // lpn
        $this->lpn->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // start_year
        $this->start_year->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // person
        $this->person->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // max_weight
        $this->max_weight->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // insertUserID
        $this->insertUserID->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // insertWhen
        $this->insertWhen->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // modifyUserID
        $this->modifyUserID->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // modifyWhen
        $this->modifyWhen->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // core_languageID
        $this->core_languageID->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // core_statusID
        $this->core_statusID->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // vehicle_typeID
            $curVal = strval($this->vehicle_typeID->CurrentValue);
            if ($curVal != "") {
                $this->vehicle_typeID->ViewValue = $this->vehicle_typeID->lookupCacheOption($curVal);
                if ($this->vehicle_typeID->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->vehicle_typeID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->vehicle_typeID->Lookup->renderViewRow($rswrk[0]);
                        $this->vehicle_typeID->ViewValue = $this->vehicle_typeID->displayValue($arwrk);
                    } else {
                        $this->vehicle_typeID->ViewValue = FormatNumber($this->vehicle_typeID->CurrentValue, $this->vehicle_typeID->formatPattern());
                    }
                }
            } else {
                $this->vehicle_typeID->ViewValue = null;
            }
            $this->vehicle_typeID->ViewCustomAttributes = "";

            // lpn
            $this->lpn->ViewValue = $this->lpn->CurrentValue;
            $this->lpn->ViewCustomAttributes = "";

            // start_year
            $this->start_year->ViewValue = $this->start_year->CurrentValue;
            $this->start_year->ViewCustomAttributes = "";

            // person
            $this->person->ViewValue = $this->person->CurrentValue;
            $this->person->ViewValue = FormatNumber($this->person->ViewValue, $this->person->formatPattern());
            $this->person->ViewCustomAttributes = "";

            // max_weight
            $this->max_weight->ViewValue = $this->max_weight->CurrentValue;
            $this->max_weight->ViewValue = FormatNumber($this->max_weight->ViewValue, $this->max_weight->formatPattern());
            $this->max_weight->ViewCustomAttributes = "";

            // insertUserID
            $curVal = strval($this->insertUserID->CurrentValue);
            if ($curVal != "") {
                $this->insertUserID->ViewValue = $this->insertUserID->lookupCacheOption($curVal);
                if ($this->insertUserID->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->insertUserID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->insertUserID->Lookup->renderViewRow($rswrk[0]);
                        $this->insertUserID->ViewValue = $this->insertUserID->displayValue($arwrk);
                    } else {
                        $this->insertUserID->ViewValue = FormatNumber($this->insertUserID->CurrentValue, $this->insertUserID->formatPattern());
                    }
                }
            } else {
                $this->insertUserID->ViewValue = null;
            }
            $this->insertUserID->ViewCustomAttributes = "";

            // insertWhen
            $this->insertWhen->ViewValue = $this->insertWhen->CurrentValue;
            $this->insertWhen->ViewValue = FormatDateTime($this->insertWhen->ViewValue, $this->insertWhen->formatPattern());
            $this->insertWhen->ViewCustomAttributes = "";

            // modifyUserID
            $curVal = strval($this->modifyUserID->CurrentValue);
            if ($curVal != "") {
                $this->modifyUserID->ViewValue = $this->modifyUserID->lookupCacheOption($curVal);
                if ($this->modifyUserID->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->modifyUserID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->modifyUserID->Lookup->renderViewRow($rswrk[0]);
                        $this->modifyUserID->ViewValue = $this->modifyUserID->displayValue($arwrk);
                    } else {
                        $this->modifyUserID->ViewValue = FormatNumber($this->modifyUserID->CurrentValue, $this->modifyUserID->formatPattern());
                    }
                }
            } else {
                $this->modifyUserID->ViewValue = null;
            }
            $this->modifyUserID->ViewCustomAttributes = "";

            // modifyWhen
            $this->modifyWhen->ViewValue = $this->modifyWhen->CurrentValue;
            $this->modifyWhen->ViewValue = FormatDateTime($this->modifyWhen->ViewValue, $this->modifyWhen->formatPattern());
            $this->modifyWhen->ViewCustomAttributes = "";

            // core_languageID
            $curVal = strval($this->core_languageID->CurrentValue);
            if ($curVal != "") {
                $this->core_languageID->ViewValue = $this->core_languageID->lookupCacheOption($curVal);
                if ($this->core_languageID->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->core_languageID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->core_languageID->Lookup->renderViewRow($rswrk[0]);
                        $this->core_languageID->ViewValue = $this->core_languageID->displayValue($arwrk);
                    } else {
                        $this->core_languageID->ViewValue = $this->core_languageID->CurrentValue;
                    }
                }
            } else {
                $this->core_languageID->ViewValue = null;
            }
            $this->core_languageID->ViewCustomAttributes = "";

            // core_statusID
            $curVal = strval($this->core_statusID->CurrentValue);
            if ($curVal != "") {
                $this->core_statusID->ViewValue = $this->core_statusID->lookupCacheOption($curVal);
                if ($this->core_statusID->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->core_statusID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->core_statusID->Lookup->renderViewRow($rswrk[0]);
                        $this->core_statusID->ViewValue = $this->core_statusID->displayValue($arwrk);
                    } else {
                        $this->core_statusID->ViewValue = FormatNumber($this->core_statusID->CurrentValue, $this->core_statusID->formatPattern());
                    }
                }
            } else {
                $this->core_statusID->ViewValue = null;
            }
            $this->core_statusID->ViewCustomAttributes = "";

            // vehicle_typeID
            $this->vehicle_typeID->LinkCustomAttributes = "";
            $this->vehicle_typeID->HrefValue = "";

            // lpn
            $this->lpn->LinkCustomAttributes = "";
            $this->lpn->HrefValue = "";

            // start_year
            $this->start_year->LinkCustomAttributes = "";
            $this->start_year->HrefValue = "";

            // person
            $this->person->LinkCustomAttributes = "";
            $this->person->HrefValue = "";

            // max_weight
            $this->max_weight->LinkCustomAttributes = "";
            $this->max_weight->HrefValue = "";

            // insertUserID
            $this->insertUserID->LinkCustomAttributes = "";
            $this->insertUserID->HrefValue = "";

            // insertWhen
            $this->insertWhen->LinkCustomAttributes = "";
            $this->insertWhen->HrefValue = "";

            // modifyUserID
            $this->modifyUserID->LinkCustomAttributes = "";
            $this->modifyUserID->HrefValue = "";

            // core_statusID
            $this->core_statusID->LinkCustomAttributes = "";
            $this->core_statusID->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // vehicle_typeID
            $this->vehicle_typeID->setupEditAttributes();
            $this->vehicle_typeID->EditCustomAttributes = "";
            $curVal = trim(strval($this->vehicle_typeID->CurrentValue));
            if ($curVal != "") {
                $this->vehicle_typeID->ViewValue = $this->vehicle_typeID->lookupCacheOption($curVal);
            } else {
                $this->vehicle_typeID->ViewValue = $this->vehicle_typeID->Lookup !== null && is_array($this->vehicle_typeID->lookupOptions()) ? $curVal : null;
            }
            if ($this->vehicle_typeID->ViewValue !== null) { // Load from cache
                $this->vehicle_typeID->EditValue = array_values($this->vehicle_typeID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->vehicle_typeID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->vehicle_typeID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->vehicle_typeID->EditValue = $arwrk;
            }
            $this->vehicle_typeID->PlaceHolder = RemoveHtml($this->vehicle_typeID->caption());

            // lpn
            $this->lpn->setupEditAttributes();
            $this->lpn->EditCustomAttributes = "";
            if (!$this->lpn->Raw) {
                $this->lpn->CurrentValue = HtmlDecode($this->lpn->CurrentValue);
            }
            $this->lpn->EditValue = HtmlEncode($this->lpn->CurrentValue);
            $this->lpn->PlaceHolder = RemoveHtml($this->lpn->caption());

            // start_year
            $this->start_year->setupEditAttributes();
            $this->start_year->EditCustomAttributes = "";
            $this->start_year->EditValue = HtmlEncode($this->start_year->CurrentValue);
            $this->start_year->PlaceHolder = RemoveHtml($this->start_year->caption());
            if (strval($this->start_year->EditValue) != "" && is_numeric($this->start_year->EditValue)) {
                $this->start_year->EditValue = $this->start_year->EditValue;
            }

            // person
            $this->person->setupEditAttributes();
            $this->person->EditCustomAttributes = "";
            $this->person->EditValue = HtmlEncode($this->person->CurrentValue);
            $this->person->PlaceHolder = RemoveHtml($this->person->caption());
            if (strval($this->person->EditValue) != "" && is_numeric($this->person->EditValue)) {
                $this->person->EditValue = FormatNumber($this->person->EditValue, null);
            }

            // max_weight
            $this->max_weight->setupEditAttributes();
            $this->max_weight->EditCustomAttributes = "";
            $this->max_weight->EditValue = HtmlEncode($this->max_weight->CurrentValue);
            $this->max_weight->PlaceHolder = RemoveHtml($this->max_weight->caption());
            if (strval($this->max_weight->EditValue) != "" && is_numeric($this->max_weight->EditValue)) {
                $this->max_weight->EditValue = FormatNumber($this->max_weight->EditValue, null);
            }

            // insertUserID

            // insertWhen

            // modifyUserID

            // core_statusID
            $this->core_statusID->setupEditAttributes();
            $this->core_statusID->EditCustomAttributes = "";
            $curVal = trim(strval($this->core_statusID->CurrentValue));
            if ($curVal != "") {
                $this->core_statusID->ViewValue = $this->core_statusID->lookupCacheOption($curVal);
            } else {
                $this->core_statusID->ViewValue = $this->core_statusID->Lookup !== null && is_array($this->core_statusID->lookupOptions()) ? $curVal : null;
            }
            if ($this->core_statusID->ViewValue !== null) { // Load from cache
                $this->core_statusID->EditValue = array_values($this->core_statusID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->core_statusID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->core_statusID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->core_statusID->EditValue = $arwrk;
            }
            $this->core_statusID->PlaceHolder = RemoveHtml($this->core_statusID->caption());

            // Add refer script

            // vehicle_typeID
            $this->vehicle_typeID->LinkCustomAttributes = "";
            $this->vehicle_typeID->HrefValue = "";

            // lpn
            $this->lpn->LinkCustomAttributes = "";
            $this->lpn->HrefValue = "";

            // start_year
            $this->start_year->LinkCustomAttributes = "";
            $this->start_year->HrefValue = "";

            // person
            $this->person->LinkCustomAttributes = "";
            $this->person->HrefValue = "";

            // max_weight
            $this->max_weight->LinkCustomAttributes = "";
            $this->max_weight->HrefValue = "";

            // insertUserID
            $this->insertUserID->LinkCustomAttributes = "";
            $this->insertUserID->HrefValue = "";

            // insertWhen
            $this->insertWhen->LinkCustomAttributes = "";
            $this->insertWhen->HrefValue = "";

            // modifyUserID
            $this->modifyUserID->LinkCustomAttributes = "";
            $this->modifyUserID->HrefValue = "";

            // core_statusID
            $this->core_statusID->LinkCustomAttributes = "";
            $this->core_statusID->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->vehicle_typeID->Required) {
            if (!$this->vehicle_typeID->IsDetailKey && EmptyValue($this->vehicle_typeID->FormValue)) {
                $this->vehicle_typeID->addErrorMessage(str_replace("%s", $this->vehicle_typeID->caption(), $this->vehicle_typeID->RequiredErrorMessage));
            }
        }
        if ($this->lpn->Required) {
            if (!$this->lpn->IsDetailKey && EmptyValue($this->lpn->FormValue)) {
                $this->lpn->addErrorMessage(str_replace("%s", $this->lpn->caption(), $this->lpn->RequiredErrorMessage));
            }
        }
        if ($this->start_year->Required) {
            if (!$this->start_year->IsDetailKey && EmptyValue($this->start_year->FormValue)) {
                $this->start_year->addErrorMessage(str_replace("%s", $this->start_year->caption(), $this->start_year->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->start_year->FormValue)) {
            $this->start_year->addErrorMessage($this->start_year->getErrorMessage(false));
        }
        if ($this->person->Required) {
            if (!$this->person->IsDetailKey && EmptyValue($this->person->FormValue)) {
                $this->person->addErrorMessage(str_replace("%s", $this->person->caption(), $this->person->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->person->FormValue)) {
            $this->person->addErrorMessage($this->person->getErrorMessage(false));
        }
        if ($this->max_weight->Required) {
            if (!$this->max_weight->IsDetailKey && EmptyValue($this->max_weight->FormValue)) {
                $this->max_weight->addErrorMessage(str_replace("%s", $this->max_weight->caption(), $this->max_weight->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->max_weight->FormValue)) {
            $this->max_weight->addErrorMessage($this->max_weight->getErrorMessage(false));
        }
        if ($this->insertUserID->Required) {
            if (!$this->insertUserID->IsDetailKey && EmptyValue($this->insertUserID->FormValue)) {
                $this->insertUserID->addErrorMessage(str_replace("%s", $this->insertUserID->caption(), $this->insertUserID->RequiredErrorMessage));
            }
        }
        if ($this->insertWhen->Required) {
            if (!$this->insertWhen->IsDetailKey && EmptyValue($this->insertWhen->FormValue)) {
                $this->insertWhen->addErrorMessage(str_replace("%s", $this->insertWhen->caption(), $this->insertWhen->RequiredErrorMessage));
            }
        }
        if ($this->modifyUserID->Required) {
            if (!$this->modifyUserID->IsDetailKey && EmptyValue($this->modifyUserID->FormValue)) {
                $this->modifyUserID->addErrorMessage(str_replace("%s", $this->modifyUserID->caption(), $this->modifyUserID->RequiredErrorMessage));
            }
        }
        if ($this->core_statusID->Required) {
            if (!$this->core_statusID->IsDetailKey && EmptyValue($this->core_statusID->FormValue)) {
                $this->core_statusID->addErrorMessage(str_replace("%s", $this->core_statusID->caption(), $this->core_statusID->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // vehicle_typeID
        $this->vehicle_typeID->setDbValueDef($rsnew, $this->vehicle_typeID->CurrentValue, null, false);

        // lpn
        $this->lpn->setDbValueDef($rsnew, $this->lpn->CurrentValue, null, false);

        // start_year
        $this->start_year->setDbValueDef($rsnew, $this->start_year->CurrentValue, null, false);

        // person
        $this->person->setDbValueDef($rsnew, $this->person->CurrentValue, null, false);

        // max_weight
        $this->max_weight->setDbValueDef($rsnew, $this->max_weight->CurrentValue, null, false);

        // insertUserID
        $this->insertUserID->CurrentValue = CurrentUserID();
        $this->insertUserID->setDbValueDef($rsnew, $this->insertUserID->CurrentValue, null);

        // insertWhen
        $this->insertWhen->CurrentValue = CurrentDateTime();
        $this->insertWhen->setDbValueDef($rsnew, $this->insertWhen->CurrentValue, null);

        // modifyUserID
        $this->modifyUserID->CurrentValue = CurrentUserID();
        $this->modifyUserID->setDbValueDef($rsnew, $this->modifyUserID->CurrentValue, null);

        // core_statusID
        $this->core_statusID->setDbValueDef($rsnew, $this->core_statusID->CurrentValue, null, strval($this->core_statusID->CurrentValue ?? "") == "");

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        if ($rsold) {
        }

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("VehicleList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_vehicle_typeID":
                    break;
                case "x_insertUserID":
                    break;
                case "x_modifyUserID":
                    break;
                case "x_core_languageID":
                    break;
                case "x_core_statusID":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
