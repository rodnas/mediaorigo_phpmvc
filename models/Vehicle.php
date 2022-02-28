<?php

namespace PHPMaker2022\phpmvc;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for vehicle
 */
class Vehicle extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $vehicle_typeID;
    public $lpn;
    public $start_year;
    public $person;
    public $max_weight;
    public $insertUserID;
    public $insertWhen;
    public $modifyUserID;
    public $modifyWhen;
    public $core_languageID;
    public $core_statusID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'vehicle';
        $this->TableName = 'vehicle';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`vehicle`";
        $this->Dbid = 'DB';
        $this->ExportAll = false;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'vehicle',
            'vehicle',
            'x_id',
            'id',
            '`id`',
            '`id`',
            21,
            11,
            -1,
            false,
            '`id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // vehicle_typeID
        $this->vehicle_typeID = new DbField(
            'vehicle',
            'vehicle',
            'x_vehicle_typeID',
            'vehicle_typeID',
            '`vehicle_typeID`',
            '`vehicle_typeID`',
            19,
            11,
            -1,
            false,
            '`vehicle_typeID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->vehicle_typeID->InputTextType = "text";
        $this->vehicle_typeID->Required = true; // Required field
        $this->vehicle_typeID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->vehicle_typeID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->vehicle_typeID->Lookup = new Lookup('vehicle_typeID', 'vehicle_type', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
            default:
                $this->vehicle_typeID->Lookup = new Lookup('vehicle_typeID', 'vehicle_type', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
        }
        $this->vehicle_typeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['vehicle_typeID'] = &$this->vehicle_typeID;

        // lpn
        $this->lpn = new DbField(
            'vehicle',
            'vehicle',
            'x_lpn',
            'lpn',
            '`lpn`',
            '`lpn`',
            200,
            6,
            -1,
            false,
            '`lpn`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->lpn->InputTextType = "text";
        $this->lpn->Required = true; // Required field
        $this->Fields['lpn'] = &$this->lpn;

        // start_year
        $this->start_year = new DbField(
            'vehicle',
            'vehicle',
            'x_start_year',
            'start_year',
            '`start_year`',
            '`start_year`',
            19,
            4,
            -1,
            false,
            '`start_year`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->start_year->InputTextType = "text";
        $this->start_year->Required = true; // Required field
        $this->start_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['start_year'] = &$this->start_year;

        // person
        $this->person = new DbField(
            'vehicle',
            'vehicle',
            'x_person',
            'person',
            '`person`',
            '`person`',
            3,
            11,
            -1,
            false,
            '`person`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->person->InputTextType = "text";
        $this->person->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['person'] = &$this->person;

        // max_weight
        $this->max_weight = new DbField(
            'vehicle',
            'vehicle',
            'x_max_weight',
            'max_weight',
            '`max_weight`',
            '`max_weight`',
            3,
            11,
            -1,
            false,
            '`max_weight`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->max_weight->InputTextType = "text";
        $this->max_weight->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['max_weight'] = &$this->max_weight;

        // insertUserID
        $this->insertUserID = new DbField(
            'vehicle',
            'vehicle',
            'x_insertUserID',
            'insertUserID',
            '`insertUserID`',
            '`insertUserID`',
            21,
            20,
            -1,
            false,
            '`insertUserID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->insertUserID->InputTextType = "text";
        $this->insertUserID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->insertUserID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->insertUserID->Lookup = new Lookup('insertUserID', 'core_users', false, 'id', ["nickname","","",""], [], [], [], [], [], [], '', '', "`nickname`");
                break;
            default:
                $this->insertUserID->Lookup = new Lookup('insertUserID', 'core_users', false, 'id', ["nickname","","",""], [], [], [], [], [], [], '', '', "`nickname`");
                break;
        }
        $this->insertUserID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['insertUserID'] = &$this->insertUserID;

        // insertWhen
        $this->insertWhen = new DbField(
            'vehicle',
            'vehicle',
            'x_insertWhen',
            'insertWhen',
            '`insertWhen`',
            CastDateFieldForLike("`insertWhen`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`insertWhen`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->insertWhen->InputTextType = "text";
        $this->insertWhen->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['insertWhen'] = &$this->insertWhen;

        // modifyUserID
        $this->modifyUserID = new DbField(
            'vehicle',
            'vehicle',
            'x_modifyUserID',
            'modifyUserID',
            '`modifyUserID`',
            '`modifyUserID`',
            21,
            20,
            -1,
            false,
            '`modifyUserID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->modifyUserID->InputTextType = "text";
        $this->modifyUserID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->modifyUserID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->modifyUserID->Lookup = new Lookup('modifyUserID', 'core_users', false, 'id', ["nickname","","",""], [], [], [], [], [], [], '', '', "`nickname`");
                break;
            default:
                $this->modifyUserID->Lookup = new Lookup('modifyUserID', 'core_users', false, 'id', ["nickname","","",""], [], [], [], [], [], [], '', '', "`nickname`");
                break;
        }
        $this->modifyUserID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['modifyUserID'] = &$this->modifyUserID;

        // modifyWhen
        $this->modifyWhen = new DbField(
            'vehicle',
            'vehicle',
            'x_modifyWhen',
            'modifyWhen',
            '`modifyWhen`',
            CastDateFieldForLike("`modifyWhen`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`modifyWhen`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->modifyWhen->InputTextType = "text";
        $this->modifyWhen->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['modifyWhen'] = &$this->modifyWhen;

        // core_languageID
        $this->core_languageID = new DbField(
            'vehicle',
            'vehicle',
            'x_core_languageID',
            'core_languageID',
            '`core_languageID`',
            '`core_languageID`',
            200,
            2,
            -1,
            false,
            '`core_languageID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->core_languageID->InputTextType = "text";
        $this->core_languageID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->core_languageID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->core_languageID->Lookup = new Lookup('core_languageID', 'core_language', false, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "`id`");
                break;
            default:
                $this->core_languageID->Lookup = new Lookup('core_languageID', 'core_language', false, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "`id`");
                break;
        }
        $this->Fields['core_languageID'] = &$this->core_languageID;

        // core_statusID
        $this->core_statusID = new DbField(
            'vehicle',
            'vehicle',
            'x_core_statusID',
            'core_statusID',
            '`core_statusID`',
            '`core_statusID`',
            19,
            1,
            -1,
            false,
            '`core_statusID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->core_statusID->InputTextType = "text";
        $this->core_statusID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->core_statusID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->core_statusID->Lookup = new Lookup('core_statusID', 'core_status', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
            default:
                $this->core_statusID->Lookup = new Lookup('core_statusID', 'core_status', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
        }
        $this->core_statusID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['core_statusID'] = &$this->core_statusID;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`vehicle`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->vehicle_typeID->DbValue = $row['vehicle_typeID'];
        $this->lpn->DbValue = $row['lpn'];
        $this->start_year->DbValue = $row['start_year'];
        $this->person->DbValue = $row['person'];
        $this->max_weight->DbValue = $row['max_weight'];
        $this->insertUserID->DbValue = $row['insertUserID'];
        $this->insertWhen->DbValue = $row['insertWhen'];
        $this->modifyUserID->DbValue = $row['modifyUserID'];
        $this->modifyWhen->DbValue = $row['modifyWhen'];
        $this->core_languageID->DbValue = $row['core_languageID'];
        $this->core_statusID->DbValue = $row['core_statusID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("VehicleList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "VehicleView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VehicleEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VehicleAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "VehicleView";
            case Config("API_ADD_ACTION"):
                return "VehicleAdd";
            case Config("API_EDIT_ACTION"):
                return "VehicleEdit";
            case Config("API_DELETE_ACTION"):
                return "VehicleDelete";
            case Config("API_LIST_ACTION"):
                return "VehicleList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VehicleList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VehicleView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VehicleView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VehicleAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VehicleAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VehicleEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("VehicleAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("VehicleDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // vehicle_typeID

        // lpn

        // start_year

        // person

        // max_weight

        // insertUserID

        // insertWhen

        // modifyUserID

        // modifyWhen

        // core_languageID

        // core_statusID

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

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // vehicle_typeID
        $this->vehicle_typeID->setupEditAttributes();
        $this->vehicle_typeID->EditCustomAttributes = "";
        $this->vehicle_typeID->PlaceHolder = RemoveHtml($this->vehicle_typeID->caption());

        // lpn
        $this->lpn->setupEditAttributes();
        $this->lpn->EditCustomAttributes = "";
        if (!$this->lpn->Raw) {
            $this->lpn->CurrentValue = HtmlDecode($this->lpn->CurrentValue);
        }
        $this->lpn->EditValue = $this->lpn->CurrentValue;
        $this->lpn->PlaceHolder = RemoveHtml($this->lpn->caption());

        // start_year
        $this->start_year->setupEditAttributes();
        $this->start_year->EditCustomAttributes = "";
        $this->start_year->EditValue = $this->start_year->CurrentValue;
        $this->start_year->PlaceHolder = RemoveHtml($this->start_year->caption());
        if (strval($this->start_year->EditValue) != "" && is_numeric($this->start_year->EditValue)) {
            $this->start_year->EditValue = $this->start_year->EditValue;
        }

        // person
        $this->person->setupEditAttributes();
        $this->person->EditCustomAttributes = "";
        $this->person->EditValue = $this->person->CurrentValue;
        $this->person->PlaceHolder = RemoveHtml($this->person->caption());
        if (strval($this->person->EditValue) != "" && is_numeric($this->person->EditValue)) {
            $this->person->EditValue = FormatNumber($this->person->EditValue, null);
        }

        // max_weight
        $this->max_weight->setupEditAttributes();
        $this->max_weight->EditCustomAttributes = "";
        $this->max_weight->EditValue = $this->max_weight->CurrentValue;
        $this->max_weight->PlaceHolder = RemoveHtml($this->max_weight->caption());
        if (strval($this->max_weight->EditValue) != "" && is_numeric($this->max_weight->EditValue)) {
            $this->max_weight->EditValue = FormatNumber($this->max_weight->EditValue, null);
        }

        // insertUserID

        // insertWhen

        // modifyUserID

        // modifyWhen

        // core_languageID
        $this->core_languageID->setupEditAttributes();
        $this->core_languageID->EditCustomAttributes = "";
        $this->core_languageID->PlaceHolder = RemoveHtml($this->core_languageID->caption());

        // core_statusID
        $this->core_statusID->setupEditAttributes();
        $this->core_statusID->EditCustomAttributes = "";
        $this->core_statusID->PlaceHolder = RemoveHtml($this->core_statusID->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->vehicle_typeID);
                    $doc->exportCaption($this->lpn);
                    $doc->exportCaption($this->start_year);
                    $doc->exportCaption($this->person);
                    $doc->exportCaption($this->max_weight);
                    $doc->exportCaption($this->insertUserID);
                    $doc->exportCaption($this->insertWhen);
                    $doc->exportCaption($this->modifyUserID);
                    $doc->exportCaption($this->modifyWhen);
                    $doc->exportCaption($this->core_languageID);
                    $doc->exportCaption($this->core_statusID);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->vehicle_typeID);
                    $doc->exportCaption($this->lpn);
                    $doc->exportCaption($this->start_year);
                    $doc->exportCaption($this->person);
                    $doc->exportCaption($this->max_weight);
                    $doc->exportCaption($this->insertUserID);
                    $doc->exportCaption($this->insertWhen);
                    $doc->exportCaption($this->modifyUserID);
                    $doc->exportCaption($this->modifyWhen);
                    $doc->exportCaption($this->core_languageID);
                    $doc->exportCaption($this->core_statusID);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->vehicle_typeID);
                        $doc->exportField($this->lpn);
                        $doc->exportField($this->start_year);
                        $doc->exportField($this->person);
                        $doc->exportField($this->max_weight);
                        $doc->exportField($this->insertUserID);
                        $doc->exportField($this->insertWhen);
                        $doc->exportField($this->modifyUserID);
                        $doc->exportField($this->modifyWhen);
                        $doc->exportField($this->core_languageID);
                        $doc->exportField($this->core_statusID);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->vehicle_typeID);
                        $doc->exportField($this->lpn);
                        $doc->exportField($this->start_year);
                        $doc->exportField($this->person);
                        $doc->exportField($this->max_weight);
                        $doc->exportField($this->insertUserID);
                        $doc->exportField($this->insertWhen);
                        $doc->exportField($this->modifyUserID);
                        $doc->exportField($this->modifyWhen);
                        $doc->exportField($this->core_languageID);
                        $doc->exportField($this->core_statusID);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
