<?php

namespace Admin\Generator\Service;

use Admin\Generator\Entity\Module;
use Admin\Generator\Entity\ModuleStatus;
use Gephart\ORM\Connector;

final class StatusProvider
{
    /**
     * @var Connector
     */
    private $connector;

    public function __construct(
        Connector $connector
    ) {
        $this->connector = $connector;
    }

    public function getModulesStatus(array $modules): array
    {
        $status = [];

        /** @var Module $module */
        foreach ($modules as $module) {
            $status[$module->getEntityName()] = $this->getModuleStatus($module);
        }

        return $status;
    }

    public function getModuleStatus(Module $module): ModuleStatus
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

    private function setStatusByController(ModuleStatus $status, string $entity_name)
    {
        $controller_dir = realpath(__DIR__ . "/../../Controller");

        if (file_exists($controller_dir . "/" . $entity_name . "Controller.php")) {
            $status->setController(true);
        }
    }

    private function setStatusByEntity(ModuleStatus $status, string $entity_name)
    {
        $entity_dir = realpath(__DIR__ . "/../../../App/Entity");

        if (file_exists($entity_dir . "/" . $entity_name . ".php")) {
            $status->setEntity(true);
        }
    }

    private function setStatusByRepository(ModuleStatus $status, string $entity_name)
    {
        $repository_dir = realpath(__DIR__ . "/../../../App/Repository");

        if (file_exists($repository_dir . "/" . $entity_name . "Repository.php")) {
            $status->setRepository(true);
        }
    }

    private function setStatusByView(ModuleStatus $status, string $entity_name)
    {
        $view_dir = realpath(__DIR__ . "/../../../../template/admin/");
        $entity_name = strtolower($entity_name);

        if (file_exists($view_dir . "/" . $entity_name . "/index.html.twig")
            && file_exists($view_dir . "/" . $entity_name . "/edit.html.twig")) {
            $status->setView(true);
        }
    }

    private function setStatusByTable(ModuleStatus $status, Module $module)
    {
        if ($result = $this->connector->getPdo()->query("SHOW TABLES LIKE '".$module->getSlugSingular()."'")) {
            if ($result->rowCount() == 1) {
                $status->setTable(true);
            }
        }
    }
}
