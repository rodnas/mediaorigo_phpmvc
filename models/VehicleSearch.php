<?php

namespace PHPMaker2022\phpmvc;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class VehicleSearch extends Vehicle
{
    use MessagesTrait;

    // Page ID
    public $PageID = "search";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'vehicle';

    // Page object name
    public $PageObjName = "VehicleSearch";

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
    public $FormClassName = "ew-form ew-search-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;

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
        $this->id->setVisibility();
        $this->vehicle_typeID->setVisibility();
        $this->lpn->setVisibility();
        $this->start_year->setVisibility();
        $this->person->setVisibility();
        $this->max_weight->setVisibility();
        $this->insertUserID->setVisibility();
        $this->insertWhen->setVisibility();
        $this->modifyUserID->setVisibility();
        $this->modifyWhen->setVisibility();
        $this->core_languageID->setVisibility();
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-search-form";
        if ($this->isPageRequest()) {
            // Get action
            $this->CurrentAction = Post("action");
            if ($this->isSearch()) {
                // Build search string for advanced search, remove blank field
                $this->loadSearchValues(); // Get search values
                if ($this->validateSearch()) {
                    $srchStr = $this->buildAdvancedSearch();
                } else {
                    $srchStr = "";
                }
                if ($srchStr != "") {
                    $srchStr = $this->getUrlParm($srchStr);
                    $srchStr = "VehicleList" . "?" . $srchStr;
                    $this->terminate($srchStr); // Go to list page
                    return;
                }
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Render row for search
        $this->RowType = ROWTYPE_SEARCH;
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

    // Build advanced search
    protected function buildAdvancedSearch()
    {
        $srchUrl = "";
        $this->buildSearchUrl($srchUrl, $this->id); // id
        $this->buildSearchUrl($srchUrl, $this->vehicle_typeID); // vehicle_typeID
        $this->buildSearchUrl($srchUrl, $this->lpn); // lpn
        $this->buildSearchUrl($srchUrl, $this->start_year); // start_year
        $this->buildSearchUrl($srchUrl, $this->person); // person
        $this->buildSearchUrl($srchUrl, $this->max_weight); // max_weight
        $this->buildSearchUrl($srchUrl, $this->insertUserID); // insertUserID
        $this->buildSearchUrl($srchUrl, $this->insertWhen); // insertWhen
        $this->buildSearchUrl($srchUrl, $this->modifyUserID); // modifyUserID
        $this->buildSearchUrl($srchUrl, $this->modifyWhen); // modifyWhen
        $this->buildSearchUrl($srchUrl, $this->core_languageID); // core_languageID
        $this->buildSearchUrl($srchUrl, $this->core_statusID); // core_statusID
        if ($srchUrl != "") {
            $srchUrl .= "&";
        }
        $srchUrl .= "cmd=search";
        return $srchUrl;
    }

    // Build search URL
    protected function buildSearchUrl(&$url, &$fld, $oprOnly = false)
    {
        global $CurrentForm;
        $wrk = "";
        $fldParm = $fld->Param;
        $fldVal = $CurrentForm->getValue("x_$fldParm");
        $fldOpr = $CurrentForm->getValue("z_$fldParm");
        $fldCond = $CurrentForm->getValue("v_$fldParm");
        $fldVal2 = $CurrentForm->getValue("y_$fldParm");
        $fldOpr2 = $CurrentForm->getValue("w_$fldParm");
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr ?? ""));
        $fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
        if ($fldOpr == "BETWEEN") {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            }
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
            if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            } elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
                $wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
            }
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&w_" . $fldParm . "=" . urlencode($fldOpr2);
            } elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
            }
        }
        if ($wrk != "") {
            if ($url != "") {
                $url .= "&";
            }
            $url .= $wrk;
        }
    }

    // Check if search value is numeric
    protected function searchValueIsNumeric($fld, $value)
    {
        if (IsFloatFormat($fld->Type)) {
            $value = ConvertToFloatString($value);
        }
        return is_numeric($value);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // id
        if ($this->id->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // vehicle_typeID
        if ($this->vehicle_typeID->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // lpn
        if ($this->lpn->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // start_year
        if ($this->start_year->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // person
        if ($this->person->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // max_weight
        if ($this->max_weight->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // insertUserID
        if ($this->insertUserID->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // insertWhen
        if ($this->insertWhen->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // modifyUserID
        if ($this->modifyUserID->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // modifyWhen
        if ($this->modifyWhen->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // core_languageID
        if ($this->core_languageID->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // core_statusID
        if ($this->core_statusID->AdvancedSearch->get()) {
            $hasValue = true;
        }
        return $hasValue;
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

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // vehicle_typeID
            $this->vehicle_typeID->LinkCustomAttributes = "";
            $this->vehicle_typeID->HrefValue = "";
            $this->vehicle_typeID->TooltipValue = "";

            // lpn
            $this->lpn->LinkCustomAttributes = "";
            $this->lpn->HrefValue = "";
            $this->lpn->TooltipValue = "";

            // start_year
            $this->start_year->LinkCustomAttributes = "";
            $this->start_year->HrefValue = "";
            $this->start_year->TooltipValue = "";

            // person
            $this->person->LinkCustomAttributes = "";
            $this->person->HrefValue = "";
            $this->person->TooltipValue = "";

            // max_weight
            $this->max_weight->LinkCustomAttributes = "";
            $this->max_weight->HrefValue = "";
            $this->max_weight->TooltipValue = "";

            // insertUserID
            $this->insertUserID->LinkCustomAttributes = "";
            $this->insertUserID->HrefValue = "";
            $this->insertUserID->TooltipValue = "";

            // insertWhen
            $this->insertWhen->LinkCustomAttributes = "";
            $this->insertWhen->HrefValue = "";
            $this->insertWhen->TooltipValue = "";

            // modifyUserID
            $this->modifyUserID->LinkCustomAttributes = "";
            $this->modifyUserID->HrefValue = "";
            $this->modifyUserID->TooltipValue = "";

            // modifyWhen
            $this->modifyWhen->LinkCustomAttributes = "";
            $this->modifyWhen->HrefValue = "";
            $this->modifyWhen->TooltipValue = "";

            // core_languageID
            $this->core_languageID->LinkCustomAttributes = "";
            $this->core_languageID->HrefValue = "";
            $this->core_languageID->TooltipValue = "";

            // core_statusID
            $this->core_statusID->LinkCustomAttributes = "";
            $this->core_statusID->HrefValue = "";
            $this->core_statusID->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());

            // vehicle_typeID
            $this->vehicle_typeID->setupEditAttributes();
            $this->vehicle_typeID->EditCustomAttributes = "";
            $curVal = trim(strval($this->vehicle_typeID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->vehicle_typeID->AdvancedSearch->ViewValue = $this->vehicle_typeID->lookupCacheOption($curVal);
            } else {
                $this->vehicle_typeID->AdvancedSearch->ViewValue = $this->vehicle_typeID->Lookup !== null && is_array($this->vehicle_typeID->lookupOptions()) ? $curVal : null;
            }
            if ($this->vehicle_typeID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->vehicle_typeID->EditValue = array_values($this->vehicle_typeID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->vehicle_typeID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
                $this->lpn->AdvancedSearch->SearchValue = HtmlDecode($this->lpn->AdvancedSearch->SearchValue);
            }
            $this->lpn->EditValue = HtmlEncode($this->lpn->AdvancedSearch->SearchValue);
            $this->lpn->PlaceHolder = RemoveHtml($this->lpn->caption());

            // start_year
            $this->start_year->setupEditAttributes();
            $this->start_year->EditCustomAttributes = "";
            $this->start_year->EditValue = HtmlEncode($this->start_year->AdvancedSearch->SearchValue);
            $this->start_year->PlaceHolder = RemoveHtml($this->start_year->caption());

            // person
            $this->person->setupEditAttributes();
            $this->person->EditCustomAttributes = "";
            $this->person->EditValue = HtmlEncode($this->person->AdvancedSearch->SearchValue);
            $this->person->PlaceHolder = RemoveHtml($this->person->caption());

            // max_weight
            $this->max_weight->setupEditAttributes();
            $this->max_weight->EditCustomAttributes = "";
            $this->max_weight->EditValue = HtmlEncode($this->max_weight->AdvancedSearch->SearchValue);
            $this->max_weight->PlaceHolder = RemoveHtml($this->max_weight->caption());

            // insertUserID
            $this->insertUserID->setupEditAttributes();
            $this->insertUserID->EditCustomAttributes = "";
            $curVal = trim(strval($this->insertUserID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->insertUserID->AdvancedSearch->ViewValue = $this->insertUserID->lookupCacheOption($curVal);
            } else {
                $this->insertUserID->AdvancedSearch->ViewValue = $this->insertUserID->Lookup !== null && is_array($this->insertUserID->lookupOptions()) ? $curVal : null;
            }
            if ($this->insertUserID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->insertUserID->EditValue = array_values($this->insertUserID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->insertUserID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->insertUserID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->insertUserID->EditValue = $arwrk;
            }
            $this->insertUserID->PlaceHolder = RemoveHtml($this->insertUserID->caption());

            // insertWhen
            $this->insertWhen->setupEditAttributes();
            $this->insertWhen->EditCustomAttributes = "";
            $this->insertWhen->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->insertWhen->AdvancedSearch->SearchValue, $this->insertWhen->formatPattern()), $this->insertWhen->formatPattern()));
            $this->insertWhen->PlaceHolder = RemoveHtml($this->insertWhen->caption());

            // modifyUserID
            $this->modifyUserID->setupEditAttributes();
            $this->modifyUserID->EditCustomAttributes = "";
            $curVal = trim(strval($this->modifyUserID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->modifyUserID->AdvancedSearch->ViewValue = $this->modifyUserID->lookupCacheOption($curVal);
            } else {
                $this->modifyUserID->AdvancedSearch->ViewValue = $this->modifyUserID->Lookup !== null && is_array($this->modifyUserID->lookupOptions()) ? $curVal : null;
            }
            if ($this->modifyUserID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->modifyUserID->EditValue = array_values($this->modifyUserID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->modifyUserID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->modifyUserID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->modifyUserID->EditValue = $arwrk;
            }
            $this->modifyUserID->PlaceHolder = RemoveHtml($this->modifyUserID->caption());

            // modifyWhen
            $this->modifyWhen->setupEditAttributes();
            $this->modifyWhen->EditCustomAttributes = "";
            $this->modifyWhen->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->modifyWhen->AdvancedSearch->SearchValue, $this->modifyWhen->formatPattern()), $this->modifyWhen->formatPattern()));
            $this->modifyWhen->PlaceHolder = RemoveHtml($this->modifyWhen->caption());

            // core_languageID
            $this->core_languageID->setupEditAttributes();
            $this->core_languageID->EditCustomAttributes = "";
            $curVal = trim(strval($this->core_languageID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->core_languageID->AdvancedSearch->ViewValue = $this->core_languageID->lookupCacheOption($curVal);
            } else {
                $this->core_languageID->AdvancedSearch->ViewValue = $this->core_languageID->Lookup !== null && is_array($this->core_languageID->lookupOptions()) ? $curVal : null;
            }
            if ($this->core_languageID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->core_languageID->EditValue = array_values($this->core_languageID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->core_languageID->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->core_languageID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->core_languageID->EditValue = $arwrk;
            }
            $this->core_languageID->PlaceHolder = RemoveHtml($this->core_languageID->caption());

            // core_statusID
            $this->core_statusID->setupEditAttributes();
            $this->core_statusID->EditCustomAttributes = "";
            $curVal = trim(strval($this->core_statusID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->core_statusID->AdvancedSearch->ViewValue = $this->core_statusID->lookupCacheOption($curVal);
            } else {
                $this->core_statusID->AdvancedSearch->ViewValue = $this->core_statusID->Lookup !== null && is_array($this->core_statusID->lookupOptions()) ? $curVal : null;
            }
            if ($this->core_statusID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->core_statusID->EditValue = array_values($this->core_statusID->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->core_statusID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if (!CheckInteger($this->id->AdvancedSearch->SearchValue)) {
            $this->id->addErrorMessage($this->id->getErrorMessage(false));
        }
        if (!CheckInteger($this->start_year->AdvancedSearch->SearchValue)) {
            $this->start_year->addErrorMessage($this->start_year->getErrorMessage(false));
        }
        if (!CheckInteger($this->person->AdvancedSearch->SearchValue)) {
            $this->person->addErrorMessage($this->person->getErrorMessage(false));
        }
        if (!CheckInteger($this->max_weight->AdvancedSearch->SearchValue)) {
            $this->max_weight->addErrorMessage($this->max_weight->getErrorMessage(false));
        }
        if (!CheckDate($this->insertWhen->AdvancedSearch->SearchValue, $this->insertWhen->formatPattern())) {
            $this->insertWhen->addErrorMessage($this->insertWhen->getErrorMessage(false));
        }
        if (!CheckDate($this->modifyWhen->AdvancedSearch->SearchValue, $this->modifyWhen->formatPattern())) {
            $this->modifyWhen->addErrorMessage($this->modifyWhen->getErrorMessage(false));
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->id->AdvancedSearch->load();
        $this->vehicle_typeID->AdvancedSearch->load();
        $this->lpn->AdvancedSearch->load();
        $this->start_year->AdvancedSearch->load();
        $this->person->AdvancedSearch->load();
        $this->max_weight->AdvancedSearch->load();
        $this->insertUserID->AdvancedSearch->load();
        $this->insertWhen->AdvancedSearch->load();
        $this->modifyUserID->AdvancedSearch->load();
        $this->modifyWhen->AdvancedSearch->load();
        $this->core_languageID->AdvancedSearch->load();
        $this->core_statusID->AdvancedSearch->load();
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("VehicleList"), "", $this->TableVar, true);
        $pageId = "search";
        $Breadcrumb->add("search", $pageId, $url);
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
