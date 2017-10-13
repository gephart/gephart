<?php

namespace Admin\Generator\Controller;

use Admin\Facade\AdminResponse;
use Admin\Generator\Entity\Module;
use Gephart\Framework\Facade\EntityManager;
use Gephart\Framework\Facade\Request;
use Gephart\Framework\Facade\Router;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class NewController
{
    /**
     * @Route {
     *  "rule": "/new",
     *  "name": "admin_generator_new"
     * }
     */
    public function index()
    {
        $postData = Request::getParsedBody();

        if (!empty($postData["name"])) {
            $module = new Module();
            $this->mapEntityFromArray($module, $postData);

            EntityManager::save($module);

            Router::redirectTo("admin_generator_edit", [
                "id" => $module->getId()
            ]);
        }

        return AdminResponse::createResponse("admin/generator/new.html.twig");
    }

    private function mapEntityFromArray(Module $module, array $data)
    {
        $module->setName($data["name"]);
        $module->setSlugPlural($data["slug_plural"]);
        $module->setSlugSingular($data["slug_singular"]);
    }
}
