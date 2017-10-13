<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Repository\ItemRepository;
use Admin\Generator\Repository\ModuleRepository;
use Gephart\ORM\EntityManager;
use Gephart\Routing\Router;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class DeleteController
{

    /**
     * @var Router
     */
    private $router;

    /**
     * @var EntityManager
     */
    private $entity_manager;

    /**
     * @var ModuleRepository
     */
    private $module_repository;

    /**
     * @var ItemRepository
     */
    private $item_repository;

    public function __construct(
        Router $router,
        EntityManager $entity_manager,
        ModuleRepository $module_repository,
        ItemRepository $item_repository
    ) {
        $this->router = $router;
        $this->entity_manager = $entity_manager;
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
        $this->entity_manager->remove($module);

        $this->router->redirectTo("admin_generator");
    }

    private function removeItems(int $id)
    {
        $items = $this->item_repository->findBy(["module_id = %1", $id], ["ORDER BY" => "id"]);
        foreach ($items as $item) {
            $this->entity_manager->remove($item);
        }
    }
}
