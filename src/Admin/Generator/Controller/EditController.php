<?php

namespace Admin\Generator\Controller;

use Admin\Facade\AdminResponse;
use Admin\Generator\Entity\Item;
use Admin\Generator\Entity\Module;
use Admin\Generator\Repository\ItemRepository;
use Admin\Generator\Repository\ModuleRepository;
use Admin\Generator\Service\StatusProvider;
use Admin\Generator\Service\Types;
use Gephart\Framework\Facade\EntityManager;
use Gephart\Framework\Facade\Request;
use Gephart\Framework\Facade\Router;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class EditController
{
    /**
     * @var ModuleRepository
     */
    private $module_repository;

    /**
     * @var ItemRepository
     */
    private $item_repository;

    /**
     * @var StatusProvider
     */
    private $status_provider;

    /**
     * @var Types
     */
    private $types;

    public function __construct(
        ModuleRepository $module_repository,
        ItemRepository $item_repository,
        StatusProvider $status_provider,
        Types $types
    ) {
        $this->module_repository = $module_repository;
        $this->item_repository = $item_repository;
        $this->status_provider = $status_provider;
        $this->types = $types;
    }

    /**
     * @Route {
     *  "rule": "/edit/{id}",
     *  "name": "admin_generator_edit"
     * }
     */
    public function index($id)
    {
        $module = $this->module_repository->find($id);

        $postData = Request::getParsedBody();

        if (!empty($postData["name"])) {
            $this->saveModule($module, $postData);
        }

        $items = $this->item_repository->findBy(["module_id = %1", $id], ["ORDER BY" => "id"]);
        $modules = $this->module_repository->findBy();
        $status = $this->status_provider->getModuleStatus($module);
        $types = $this->types->getTypes()->all();

        return AdminResponse::createResponse("admin/generator/edit.html.twig", [
            "modules" => $modules,
            "module" => $module,
            "items" => $items,
            "status" => $status,
            "types" => $types
        ]);
    }

    private function saveModule(Module $module, array $data)
    {
        $this->mapModuleFromArray($module, $data);
        EntityManager::save($module);

        $this->saveItems($module->getId(), $data);

        Router::redirectTo("admin_generator_edit", [
            "id" => $module->getId()
        ]);
    }

    private function saveItems(int $id, array $data)
    {
        if (is_array($data["items"])) {
            $this->removeItems($id);
            $items = $this->mapItemsFromArray($id, $data);
            foreach ($items as $item) {
                EntityManager::save($item);
            }
        }
    }

    private function removeItems(int $id)
    {
        $items = $this->item_repository->findBy(["module_id = %1", $id], ["ORDER BY" => "id"]);
        foreach ($items as $item) {
            EntityManager::remove($item);
        }
    }

    private function mapModuleFromArray(Module $module, array $data)
    {
        $module->setName($data["name"]);
        $module->setSlugPlural($data["slug_plural"]);
        $module->setSlugSingular($data["slug_singular"]);
        $module->setInMenu((bool)isset($data["in_menu"]) ? $data["in_menu"] : false);
        $module->setIcon($data["icon"]);
    }

    private function mapItemsFromArray(int $id, array $data): array
    {
        $items = [];

        $items_data = $data["items"];
        foreach ($items_data as $item_data) {
            $item = new Item();
            $item->setName($item_data["name"]);
            $item->setSlug($item_data["slug"]);
            $item->setType($item_data["type"]);
            $item->setModuleId($id);

            $items[] = $item;
        }

        return $items;
    }
}
