<?php

namespace Admin\Generator\Controller;

use Admin\Facade\AdminResponse;
use Admin\Generator\Repository\ModuleRepository;
use Admin\Generator\Service\StatusProvider;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class IndexController
{
    /**
     * @var ModuleRepository
     */
    private $module_repository;

    /**
     * @var StatusProvider
     */
    private $status_provider;

    public function __construct(
        ModuleRepository $module_repository,
        StatusProvider $status_provider
    ) {
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

        return AdminResponse::createResponse("admin/generator/index.html.twig", [
            "modules" => $modules,
            "modules_status" => $modules_status
        ]);
    }
}
