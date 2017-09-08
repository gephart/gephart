<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Entity\Module;
use Admin\Generator\Entity\ModuleStatus;
use Admin\Generator\Repository\ModuleRepository;
use Admin\Response\BackendTemplateResponse;
use Gephart\ORM\Connector;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class IndexController
{

    /**
     * @var BackendTemplateResponse
     */
    private $template_response;

    /**
     * @var ModuleRepository
     */
    private $module_repository;

    /**
     * @var Connector
     */
    private $connector;

    public function __construct(
        BackendTemplateResponse $template_response,
        ModuleRepository $module_repository,
        Connector $connector
    )
    {
        $this->template_response = $template_response;
        $this->module_repository = $module_repository;
        $this->connector = $connector;
    }

    /**
     * @Route {
     *  "rule": "/",
     *  "name": "admin_generator"
     * }
     */
    public function index()
    {
        $modules = $this->module_repository->findBy();
        $modules_status = $this->getModulesStatus($modules);

        return $this->template_response->template("admin/generator/index.html.twig", [
            "modules" => $modules,
            "modules_status" => $modules_status
        ]);
    }

    private function getModulesStatus(array $modules): array
    {
        $status = [];

        /** @var Module $module */
        foreach ($modules as $module) {
            $status[$module->getEntityName()] = $this->getModuleStatus($module);
        }

        return $status;
    }

    private function getModuleStatus(Module $module): ModuleStatus
    {
        $status = new ModuleStatus();

        $entity_name = $module->getEntityName();

        $this->setStatusByController($status, $entity_name);
        $this->setStatusByEntity($status, $entity_name);
        $this->setStatusByRepository($status, $entity_name);
        $this->setStatusByView($status, $entity_name);
        $this->setStatusByTable($status, $module);

        return $status;
    }

    private function setStatusByController(ModuleStatus $status, string $entity_name) {
        $controller_dir = realpath(__DIR__ . "/../../Controller");

        if (file_exists($controller_dir . "/" . $entity_name . "Controller.php")) {
            $status->setController(true);
        }
    }

    private function setStatusByEntity(ModuleStatus $status, string $entity_name) {
        $entity_dir = realpath(__DIR__ . "/../../../App/Entity");

        if (file_exists($entity_dir . "/" . $entity_name . ".php")) {
            $status->setEntity(true);
        }
    }

    private function setStatusByRepository(ModuleStatus $status, string $entity_name) {
        $repository_dir = realpath(__DIR__ . "/../../../App/Repository");

        if (file_exists($repository_dir . "/" . $entity_name . "Repository.php")) {
            $status->setRepository(true);
        }
    }

    private function setStatusByView(ModuleStatus $status, string $entity_name) {
        $view_dir = realpath(__DIR__ . "/../../../../template/admin/");

        if (file_exists($view_dir . "/" . $entity_name . "/index.html.twig")
            && file_exists($view_dir . "/" . $entity_name . "/edit.html.twig")) {
            $status->setView(true);
        }
    }

    private function setStatusByTable(ModuleStatus $status, Module $module) {
        if ($result = $this->connector->getPdo()->query("SHOW TABLES LIKE '".$module->getSlugSingular()."'")) {
            if ($result->rowCount() == 1) {
                $status->setTable(true);
            }
        }
    }

}