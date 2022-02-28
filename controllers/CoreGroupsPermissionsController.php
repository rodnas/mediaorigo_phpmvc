<?php

namespace PHPMaker2022\phpmvc;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CoreGroupsPermissionsController extends ControllerBase
{
    // list
    public function list(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "CoreGroupsPermissionsList");
    }

    // add
    public function add(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "CoreGroupsPermissionsAdd");
    }

    // view
    public function view(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "CoreGroupsPermissionsView");
    }

    // edit
    public function edit(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "CoreGroupsPermissionsEdit");
    }

    // delete
    public function delete(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "CoreGroupsPermissionsDelete");
    }

    // search
    public function search(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "CoreGroupsPermissionsSearch");
    }

    protected function getKeyParams($args)
    {
        $sep = Container("core_groups_permissions")->RouteCompositeKeySeparator;
        if (array_key_exists("keys", $args)) {
            $keys = explode($sep, $args["keys"]);
            return count($keys) == 2 ? array_combine(["core_groupsID","_tablename"], $keys) : $args;
        }
        return $args;
    }
}
