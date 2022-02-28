<?php

namespace PHPMaker2022\phpmvc;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // core_language
    $app->map(["GET","POST","OPTIONS"], '/CoreLanguageList[/{id:.*}]', CoreLanguageController::class . ':list')->add(PermissionMiddleware::class)->setName('CoreLanguageList-core_language-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CoreLanguageAdd[/{id:.*}]', CoreLanguageController::class . ':add')->add(PermissionMiddleware::class)->setName('CoreLanguageAdd-core_language-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CoreLanguageView[/{id:.*}]', CoreLanguageController::class . ':view')->add(PermissionMiddleware::class)->setName('CoreLanguageView-core_language-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CoreLanguageEdit[/{id:.*}]', CoreLanguageController::class . ':edit')->add(PermissionMiddleware::class)->setName('CoreLanguageEdit-core_language-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CoreLanguageDelete[/{id:.*}]', CoreLanguageController::class . ':delete')->add(PermissionMiddleware::class)->setName('CoreLanguageDelete-core_language-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/CoreLanguageSearch', CoreLanguageController::class . ':search')->add(PermissionMiddleware::class)->setName('CoreLanguageSearch-core_language-search'); // search
    $app->group(
        '/core_language',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id:.*}]', CoreLanguageController::class . ':list')->add(PermissionMiddleware::class)->setName('core_language/list-core_language-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id:.*}]', CoreLanguageController::class . ':add')->add(PermissionMiddleware::class)->setName('core_language/add-core_language-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id:.*}]', CoreLanguageController::class . ':view')->add(PermissionMiddleware::class)->setName('core_language/view-core_language-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id:.*}]', CoreLanguageController::class . ':edit')->add(PermissionMiddleware::class)->setName('core_language/edit-core_language-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id:.*}]', CoreLanguageController::class . ':delete')->add(PermissionMiddleware::class)->setName('core_language/delete-core_language-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CoreLanguageController::class . ':search')->add(PermissionMiddleware::class)->setName('core_language/search-core_language-search-2'); // search
        }
    );

    // core_status
    $app->map(["GET","POST","OPTIONS"], '/CoreStatusList[/{id}]', CoreStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('CoreStatusList-core_status-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CoreStatusAdd[/{id}]', CoreStatusController::class . ':add')->add(PermissionMiddleware::class)->setName('CoreStatusAdd-core_status-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CoreStatusView[/{id}]', CoreStatusController::class . ':view')->add(PermissionMiddleware::class)->setName('CoreStatusView-core_status-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CoreStatusEdit[/{id}]', CoreStatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('CoreStatusEdit-core_status-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CoreStatusDelete[/{id}]', CoreStatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('CoreStatusDelete-core_status-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/CoreStatusSearch', CoreStatusController::class . ':search')->add(PermissionMiddleware::class)->setName('CoreStatusSearch-core_status-search'); // search
    $app->group(
        '/core_status',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CoreStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('core_status/list-core_status-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CoreStatusController::class . ':add')->add(PermissionMiddleware::class)->setName('core_status/add-core_status-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CoreStatusController::class . ':view')->add(PermissionMiddleware::class)->setName('core_status/view-core_status-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CoreStatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('core_status/edit-core_status-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CoreStatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('core_status/delete-core_status-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CoreStatusController::class . ':search')->add(PermissionMiddleware::class)->setName('core_status/search-core_status-search-2'); // search
        }
    );

    // core_users
    $app->map(["GET","POST","OPTIONS"], '/CoreUsersList[/{id}]', CoreUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('CoreUsersList-core_users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CoreUsersAdd[/{id}]', CoreUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('CoreUsersAdd-core_users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CoreUsersView[/{id}]', CoreUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('CoreUsersView-core_users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CoreUsersEdit[/{id}]', CoreUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('CoreUsersEdit-core_users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CoreUsersDelete[/{id}]', CoreUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('CoreUsersDelete-core_users-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/CoreUsersSearch', CoreUsersController::class . ':search')->add(PermissionMiddleware::class)->setName('CoreUsersSearch-core_users-search'); // search
    $app->group(
        '/core_users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CoreUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('core_users/list-core_users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CoreUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('core_users/add-core_users-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CoreUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('core_users/view-core_users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CoreUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('core_users/edit-core_users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CoreUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('core_users/delete-core_users-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CoreUsersController::class . ':search')->add(PermissionMiddleware::class)->setName('core_users/search-core_users-search-2'); // search
        }
    );

    // core_groups
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsList[/{id}]', CoreGroupsController::class . ':list')->add(PermissionMiddleware::class)->setName('CoreGroupsList-core_groups-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsAdd[/{id}]', CoreGroupsController::class . ':add')->add(PermissionMiddleware::class)->setName('CoreGroupsAdd-core_groups-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsView[/{id}]', CoreGroupsController::class . ':view')->add(PermissionMiddleware::class)->setName('CoreGroupsView-core_groups-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsEdit[/{id}]', CoreGroupsController::class . ':edit')->add(PermissionMiddleware::class)->setName('CoreGroupsEdit-core_groups-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsDelete[/{id}]', CoreGroupsController::class . ':delete')->add(PermissionMiddleware::class)->setName('CoreGroupsDelete-core_groups-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsSearch', CoreGroupsController::class . ':search')->add(PermissionMiddleware::class)->setName('CoreGroupsSearch-core_groups-search'); // search
    $app->group(
        '/core_groups',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CoreGroupsController::class . ':list')->add(PermissionMiddleware::class)->setName('core_groups/list-core_groups-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CoreGroupsController::class . ':add')->add(PermissionMiddleware::class)->setName('core_groups/add-core_groups-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CoreGroupsController::class . ':view')->add(PermissionMiddleware::class)->setName('core_groups/view-core_groups-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CoreGroupsController::class . ':edit')->add(PermissionMiddleware::class)->setName('core_groups/edit-core_groups-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CoreGroupsController::class . ':delete')->add(PermissionMiddleware::class)->setName('core_groups/delete-core_groups-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CoreGroupsController::class . ':search')->add(PermissionMiddleware::class)->setName('core_groups/search-core_groups-search-2'); // search
        }
    );

    // core_groups_permissions
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsPermissionsList[/{keys:.*}]', CoreGroupsPermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('CoreGroupsPermissionsList-core_groups_permissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsPermissionsAdd[/{keys:.*}]', CoreGroupsPermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('CoreGroupsPermissionsAdd-core_groups_permissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsPermissionsView[/{keys:.*}]', CoreGroupsPermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('CoreGroupsPermissionsView-core_groups_permissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsPermissionsEdit[/{keys:.*}]', CoreGroupsPermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('CoreGroupsPermissionsEdit-core_groups_permissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsPermissionsDelete[/{keys:.*}]', CoreGroupsPermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('CoreGroupsPermissionsDelete-core_groups_permissions-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/CoreGroupsPermissionsSearch', CoreGroupsPermissionsController::class . ':search')->add(PermissionMiddleware::class)->setName('CoreGroupsPermissionsSearch-core_groups_permissions-search'); // search
    $app->group(
        '/core_groups_permissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', CoreGroupsPermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('core_groups_permissions/list-core_groups_permissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', CoreGroupsPermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('core_groups_permissions/add-core_groups_permissions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', CoreGroupsPermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('core_groups_permissions/view-core_groups_permissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', CoreGroupsPermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('core_groups_permissions/edit-core_groups_permissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', CoreGroupsPermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('core_groups_permissions/delete-core_groups_permissions-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CoreGroupsPermissionsController::class . ':search')->add(PermissionMiddleware::class)->setName('core_groups_permissions/search-core_groups_permissions-search-2'); // search
        }
    );

    // cargo
    $app->map(["GET","POST","OPTIONS"], '/CargoList[/{id}]', CargoController::class . ':list')->add(PermissionMiddleware::class)->setName('CargoList-cargo-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CargoAdd[/{id}]', CargoController::class . ':add')->add(PermissionMiddleware::class)->setName('CargoAdd-cargo-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CargoView[/{id}]', CargoController::class . ':view')->add(PermissionMiddleware::class)->setName('CargoView-cargo-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CargoEdit[/{id}]', CargoController::class . ':edit')->add(PermissionMiddleware::class)->setName('CargoEdit-cargo-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CargoDelete[/{id}]', CargoController::class . ':delete')->add(PermissionMiddleware::class)->setName('CargoDelete-cargo-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/CargoSearch', CargoController::class . ':search')->add(PermissionMiddleware::class)->setName('CargoSearch-cargo-search'); // search
    $app->group(
        '/cargo',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CargoController::class . ':list')->add(PermissionMiddleware::class)->setName('cargo/list-cargo-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CargoController::class . ':add')->add(PermissionMiddleware::class)->setName('cargo/add-cargo-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CargoController::class . ':view')->add(PermissionMiddleware::class)->setName('cargo/view-cargo-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CargoController::class . ':edit')->add(PermissionMiddleware::class)->setName('cargo/edit-cargo-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CargoController::class . ':delete')->add(PermissionMiddleware::class)->setName('cargo/delete-cargo-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CargoController::class . ':search')->add(PermissionMiddleware::class)->setName('cargo/search-cargo-search-2'); // search
        }
    );

    // driver
    $app->map(["GET","POST","OPTIONS"], '/DriverList[/{id}]', DriverController::class . ':list')->add(PermissionMiddleware::class)->setName('DriverList-driver-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DriverAdd[/{id}]', DriverController::class . ':add')->add(PermissionMiddleware::class)->setName('DriverAdd-driver-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DriverView[/{id}]', DriverController::class . ':view')->add(PermissionMiddleware::class)->setName('DriverView-driver-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DriverEdit[/{id}]', DriverController::class . ':edit')->add(PermissionMiddleware::class)->setName('DriverEdit-driver-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DriverDelete[/{id}]', DriverController::class . ':delete')->add(PermissionMiddleware::class)->setName('DriverDelete-driver-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/DriverSearch', DriverController::class . ':search')->add(PermissionMiddleware::class)->setName('DriverSearch-driver-search'); // search
    $app->group(
        '/driver',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', DriverController::class . ':list')->add(PermissionMiddleware::class)->setName('driver/list-driver-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', DriverController::class . ':add')->add(PermissionMiddleware::class)->setName('driver/add-driver-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', DriverController::class . ':view')->add(PermissionMiddleware::class)->setName('driver/view-driver-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', DriverController::class . ':edit')->add(PermissionMiddleware::class)->setName('driver/edit-driver-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', DriverController::class . ':delete')->add(PermissionMiddleware::class)->setName('driver/delete-driver-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', DriverController::class . ':search')->add(PermissionMiddleware::class)->setName('driver/search-driver-search-2'); // search
        }
    );

    // license_type
    $app->map(["GET","POST","OPTIONS"], '/LicenseTypeList[/{id}]', LicenseTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('LicenseTypeList-license_type-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/LicenseTypeAdd[/{id}]', LicenseTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('LicenseTypeAdd-license_type-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/LicenseTypeView[/{id}]', LicenseTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('LicenseTypeView-license_type-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/LicenseTypeEdit[/{id}]', LicenseTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('LicenseTypeEdit-license_type-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/LicenseTypeDelete[/{id}]', LicenseTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('LicenseTypeDelete-license_type-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/LicenseTypeSearch', LicenseTypeController::class . ':search')->add(PermissionMiddleware::class)->setName('LicenseTypeSearch-license_type-search'); // search
    $app->group(
        '/license_type',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', LicenseTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('license_type/list-license_type-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', LicenseTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('license_type/add-license_type-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', LicenseTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('license_type/view-license_type-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', LicenseTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('license_type/edit-license_type-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', LicenseTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('license_type/delete-license_type-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', LicenseTypeController::class . ':search')->add(PermissionMiddleware::class)->setName('license_type/search-license_type-search-2'); // search
        }
    );

    // passanger
    $app->map(["GET","POST","OPTIONS"], '/PassangerList[/{id}]', PassangerController::class . ':list')->add(PermissionMiddleware::class)->setName('PassangerList-passanger-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PassangerAdd[/{id}]', PassangerController::class . ':add')->add(PermissionMiddleware::class)->setName('PassangerAdd-passanger-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PassangerView[/{id}]', PassangerController::class . ':view')->add(PermissionMiddleware::class)->setName('PassangerView-passanger-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PassangerEdit[/{id}]', PassangerController::class . ':edit')->add(PermissionMiddleware::class)->setName('PassangerEdit-passanger-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PassangerDelete[/{id}]', PassangerController::class . ':delete')->add(PermissionMiddleware::class)->setName('PassangerDelete-passanger-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/PassangerSearch', PassangerController::class . ':search')->add(PermissionMiddleware::class)->setName('PassangerSearch-passanger-search'); // search
    $app->group(
        '/passanger',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PassangerController::class . ':list')->add(PermissionMiddleware::class)->setName('passanger/list-passanger-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PassangerController::class . ':add')->add(PermissionMiddleware::class)->setName('passanger/add-passanger-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PassangerController::class . ':view')->add(PermissionMiddleware::class)->setName('passanger/view-passanger-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PassangerController::class . ':edit')->add(PermissionMiddleware::class)->setName('passanger/edit-passanger-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PassangerController::class . ':delete')->add(PermissionMiddleware::class)->setName('passanger/delete-passanger-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', PassangerController::class . ':search')->add(PermissionMiddleware::class)->setName('passanger/search-passanger-search-2'); // search
        }
    );

    // transport
    $app->map(["GET","POST","OPTIONS"], '/TransportList[/{id}]', TransportController::class . ':list')->add(PermissionMiddleware::class)->setName('TransportList-transport-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TransportAdd[/{id}]', TransportController::class . ':add')->add(PermissionMiddleware::class)->setName('TransportAdd-transport-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TransportView[/{id}]', TransportController::class . ':view')->add(PermissionMiddleware::class)->setName('TransportView-transport-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TransportEdit[/{id}]', TransportController::class . ':edit')->add(PermissionMiddleware::class)->setName('TransportEdit-transport-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TransportDelete[/{id}]', TransportController::class . ':delete')->add(PermissionMiddleware::class)->setName('TransportDelete-transport-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/TransportSearch', TransportController::class . ':search')->add(PermissionMiddleware::class)->setName('TransportSearch-transport-search'); // search
    $app->group(
        '/transport',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', TransportController::class . ':list')->add(PermissionMiddleware::class)->setName('transport/list-transport-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', TransportController::class . ':add')->add(PermissionMiddleware::class)->setName('transport/add-transport-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', TransportController::class . ':view')->add(PermissionMiddleware::class)->setName('transport/view-transport-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', TransportController::class . ':edit')->add(PermissionMiddleware::class)->setName('transport/edit-transport-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', TransportController::class . ':delete')->add(PermissionMiddleware::class)->setName('transport/delete-transport-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', TransportController::class . ':search')->add(PermissionMiddleware::class)->setName('transport/search-transport-search-2'); // search
        }
    );

    // vehicle
    $app->map(["GET","POST","OPTIONS"], '/VehicleList[/{id}]', VehicleController::class . ':list')->add(PermissionMiddleware::class)->setName('VehicleList-vehicle-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/VehicleAdd[/{id}]', VehicleController::class . ':add')->add(PermissionMiddleware::class)->setName('VehicleAdd-vehicle-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/VehicleView[/{id}]', VehicleController::class . ':view')->add(PermissionMiddleware::class)->setName('VehicleView-vehicle-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/VehicleEdit[/{id}]', VehicleController::class . ':edit')->add(PermissionMiddleware::class)->setName('VehicleEdit-vehicle-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/VehicleDelete[/{id}]', VehicleController::class . ':delete')->add(PermissionMiddleware::class)->setName('VehicleDelete-vehicle-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/VehicleSearch', VehicleController::class . ':search')->add(PermissionMiddleware::class)->setName('VehicleSearch-vehicle-search'); // search
    $app->group(
        '/vehicle',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', VehicleController::class . ':list')->add(PermissionMiddleware::class)->setName('vehicle/list-vehicle-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', VehicleController::class . ':add')->add(PermissionMiddleware::class)->setName('vehicle/add-vehicle-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', VehicleController::class . ':view')->add(PermissionMiddleware::class)->setName('vehicle/view-vehicle-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', VehicleController::class . ':edit')->add(PermissionMiddleware::class)->setName('vehicle/edit-vehicle-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', VehicleController::class . ':delete')->add(PermissionMiddleware::class)->setName('vehicle/delete-vehicle-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', VehicleController::class . ':search')->add(PermissionMiddleware::class)->setName('vehicle/search-vehicle-search-2'); // search
        }
    );

    // vehicle_type
    $app->map(["GET","POST","OPTIONS"], '/VehicleTypeList[/{id}]', VehicleTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('VehicleTypeList-vehicle_type-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/VehicleTypeAdd[/{id}]', VehicleTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('VehicleTypeAdd-vehicle_type-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/VehicleTypeView[/{id}]', VehicleTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('VehicleTypeView-vehicle_type-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/VehicleTypeEdit[/{id}]', VehicleTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('VehicleTypeEdit-vehicle_type-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/VehicleTypeDelete[/{id}]', VehicleTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('VehicleTypeDelete-vehicle_type-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/VehicleTypeSearch', VehicleTypeController::class . ':search')->add(PermissionMiddleware::class)->setName('VehicleTypeSearch-vehicle_type-search'); // search
    $app->group(
        '/vehicle_type',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', VehicleTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('vehicle_type/list-vehicle_type-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', VehicleTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('vehicle_type/add-vehicle_type-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', VehicleTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('vehicle_type/view-vehicle_type-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', VehicleTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('vehicle_type/edit-vehicle_type-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', VehicleTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('vehicle_type/delete-vehicle_type-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', VehicleTypeController::class . ':search')->add(PermissionMiddleware::class)->setName('vehicle_type/search-vehicle_type-search-2'); // search
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->map(["GET","POST","OPTIONS"], '/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
