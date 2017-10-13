<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Entity\Item;
use Admin\Generator\Entity\Module;
use Admin\Generator\Repository\ItemRepository;
use Admin\Generator\Repository\ModuleRepository;
use Admin\Generator\Service\StatusProvider;
use Admin\Response\AdminResponseFactory;
use Gephart\ORM\EntityManager;
use Gephart\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class EditController
{

    /**
     * @var AdminResponseFactory
     */
    private $template_response;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var ServerRequestInterface
     */
    private $request;

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

    /**
     * @var StatusProvider
     */
    private $status_provider;

    public function __construct(
        AdminResponseFactory $template_response,
        Router $router,
        ServerRequestInterface $request,
        EntityManager $entity_manager,
        ModuleRepository $module_repository,
        ItemRepository $item_repository,
        StatusProvider $status_provider
    )
    {
        $this->template_response = $template_response;
        $this->router = $router;
        $this->request = $request;
        $this->entity_manager = $entity_manager;
        $this->module_repository = $module_repository;
        $this->item_repository = $item_repository;
        $this->status_provider = $status_provider;
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

        $postData = $this->request->getParsedBody();

        if (!empty($postData["name"])) {
            $this->saveModule($module, $postData);
        }

        $items = $this->item_repository->findBy(["module_id = %1", $id], ["ORDER BY" => "id"]);
        $modules = $this->module_repository->findBy();
        $status = $this->status_provider->getModuleStatus($module);

        return $this->template_response->createResponse("admin/generator/edit.html.twig", [
            "modules" => $modules,
            "module" => $module,
            "items" => $items,
            "status" => $status
        ]);
    }

    private function saveModule(Module $module, array $data)
    {
        $this->mapModuleFromArray($module, $data);
        $this->entity_manager->save($module);

        $this->saveItems($module->getId(), $data);

        $this->router->redirectTo("admin_generator_edit", [
            "id" => $module->getId()
        ]);
    }

    private function saveItems(int $id, array $data)
    {
        if (is_array($data["items"])) {
            $this->removeItems($id);
            $items = $this->mapItemsFromArray($id, $data);
            foreach ($items as $item) {
                $this->entity_manager->save($item);
            }
        }
    }

    private function removeItems(int $id)
    {
        $items = $this->item_repository->findBy(["module_id = %1", $id], ["ORDER BY" => "id"]);
        foreach ($items as $item) {
            $this->entity_manager->remove($item);
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