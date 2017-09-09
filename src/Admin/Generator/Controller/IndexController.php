<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Entity\Module;
use Admin\Generator\Entity\ModuleStatus;
use Admin\Generator\Repository\ModuleRepository;
use Admin\Generator\Service\StatusProvider;
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
     * @var StatusProvider
     */
    private $status_provider;

    public function __construct(
        BackendTemplateResponse $template_response,
        ModuleRepository $module_repository,
        StatusProvider $status_provider
    )
    {
        $this->template_response = $template_response;
        $this->module_repository = $module_repository;
        $this->status_provider = $status_provider;
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
        $modules_status = $this->status_provider->getModulesStatus($modules);

        return $this->template_response->template("admin/generator/index.html.twig", [
            "modules" => $modules,
            "modules_status" => $modules_status
        ]);
    }

}