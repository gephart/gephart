<?php

namespace Admin\Generator\Service;

use Admin\Generator\Entity\Module;
use Admin\Generator\Repository\ItemRepository;
use Admin\Generator\Repository\ModuleRepository;
use Gephart\Framework\Template\Engine;
use Gephart\ORM\EntityManager;

class ViewGenerator
{
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
     * @var Engine
     */
    private $template_engine;

    /**
     * @var Types
     */
    private $types;

    public function __construct(
        EntityManager $entity_manager,
        ModuleRepository $module_repository,
        ItemRepository $item_repository,
        Engine $template_engine,
        Types $types
    ) {
        $this->entity_manager = $entity_manager;
        $this->module_repository = $module_repository;
        $this->item_repository = $item_repository;
        $this->template_engine = $template_engine;
        $this->view_dir = realpath(__DIR__ . "/../../../../template/admin/");
        $this->types = $types;
    }

    public function isGenerated(int $module_id)
    {
        $module = $this->module_repository->find($module_id);
        $filename = $module->getEntityName();

        return file_exists($this->view_dir . "/" . $filename . "/index.html.twig");
    }

    public function generate(int $module_id)
    {
        $module = $this->module_repository->find($module_id);
        $items = $this->item_repository->findBy(["module_id = %1", $module_id], ["ORDER BY" => "id"]);
        $types = $this->types->getTypes()->all();

        $this->generateFolder($module);
        $this->generateFile("edit", $module, $items, $types);
        $view_index_template = $this->generateFile("index", $module, $items, $types);

        return htmlspecialchars($view_index_template);
    }

    private function generateFolder(Module $module)
    {
        $folder = $module->getSlugSingular();

        if (!is_dir($this->view_dir . "/" . $folder)) {
            @mkdir($this->view_dir . "/" . $folder);
        }

        try {
            @chmod($this->view_dir . "/" . $folder, 0777);
        } catch (\Exception $e) {
        }
    }

    private function generateFile(string $file, Module $module, array $items, array $types)
    {
        $filename = $module->getSlugSingular();

        $view_template = $this->template_engine->render("admin/generator/template/view/$file.html.twig", [
            "module" => $module,
            "items" => $items,
            "types" => $types
        ]);

        file_put_contents($this->view_dir . "/" . $filename . "/$file.html.twig", $view_template);

        try {
            @chmod($this->view_dir . "/" . $filename. "/$file.html.twig", 0777);
        } catch (\Exception $e) {
        }

        return $view_template;
    }
}
