<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Repository\ItemRepository;
use Admin\Generator\Repository\ModuleRepository;
use Gephart\Framework\Facade\EntityManager;
use Gephart\Framework\Facade\Router;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class DeleteController
{

    /**
     * @var ModuleRepository
     */
    private $module_repository;

    /**
     * @var ItemRepository
     */
    private $item_repository;

    public function __construct(
        ModuleRepository $module_repository,
        ItemRepository $item_repository
    ) {
        $this->module_repository = $module_repository;
        $this->item_repository = $item_repository;
    }

    /**
     * @Route {
     *  "rule": "/delete/{id}",
     *  "name": "admin_generator_delete"
     * }
     */
    public function index($id)
    {
        $module = $this->module_repository->find($id);
        $this->removeItems($id);
        EntityManager::remove($module);

        Router::redirectTo("admin_generator");
    }

    private function removeItems(int $id)
    {
        $items = $this->item_repository->findBy(["module_id = %1", $id], ["ORDER BY" => "id"]);
        foreach ($items as $item) {
            EntityManager::remove($item);
        }
    }
}
