<?php

namespace PHPMaker2022\phpmvc;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(168, "mi_vehicle", $MenuLanguage->MenuPhrase("168", "MenuText"), $MenuRelativePath . "VehicleList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}vehicle'), false, false, "", "", false, true);
$sideMenu->addMenuItem(169, "mi_vehicle_type", $MenuLanguage->MenuPhrase("169", "MenuText"), $MenuRelativePath . "VehicleTypeList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}vehicle_type'), false, false, "", "", false, true);
$sideMenu->addMenuItem(164, "mi_driver", $MenuLanguage->MenuPhrase("164", "MenuText"), $MenuRelativePath . "DriverList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}driver'), false, false, "", "", false, true);
$sideMenu->addMenuItem(165, "mi_license_type", $MenuLanguage->MenuPhrase("165", "MenuText"), $MenuRelativePath . "LicenseTypeList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}license_type'), false, false, "", "", false, true);
$sideMenu->addMenuItem(163, "mi_cargo", $MenuLanguage->MenuPhrase("163", "MenuText"), $MenuRelativePath . "CargoList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}cargo'), false, false, "", "", false, true);
$sideMenu->addMenuItem(166, "mi_passanger", $MenuLanguage->MenuPhrase("166", "MenuText"), $MenuRelativePath . "PassangerList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}passanger'), false, false, "", "", false, true);
$sideMenu->addMenuItem(167, "mi_transport", $MenuLanguage->MenuPhrase("167", "MenuText"), $MenuRelativePath . "TransportList", -1, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}transport'), false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mci_Admin", $MenuLanguage->MenuPhrase("18", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_core_status", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "CoreStatusList", 18, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}core_status'), false, false, "", "", false, true);
$sideMenu->addMenuItem(3, "mi_core_language", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "CoreLanguageList", 18, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}core_language'), false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_core_users", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "CoreUsersList", 18, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}core_users'), false, false, "", "", false, true);
$sideMenu->addMenuItem(9, "mi_core_groups", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "CoreGroupsList", 18, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}core_groups'), false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_core_groups_permissions", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "CoreGroupsPermissionsList", 18, "", AllowListMenu('{28288783-E3B8-4152-BB03-BA57FA6729B8}core_groups_permissions'), false, false, "", "", false, true);
echo $sideMenu->toScript();
