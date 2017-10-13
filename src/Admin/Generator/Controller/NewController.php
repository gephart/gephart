<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Entity\Module;
use Admin\Response\AdminResponseFactory;
use Gephart\ORM\EntityManager;
use Gephart\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class NewController
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

    public function __construct(
        AdminResponseFactory $template_response,
        Router $router,
        ServerRequestInterface $request,
        EntityManager $entity_manager
    ) {
        $this->template_response = $template_response;
        $this->router = $router;
        $this->request = $request;
        $this->entity_manager = $entity_manager;
    }

    /**
     * @Route {
     *  "rule": "/new",
     *  "name": "admin_generator_new"
     * }
     */
    public function index()
    {
        $postData = $this->request->getParsedBody();

        if (!empty($postData["name"])) {
            $module = new Module();
            $this->mapEntityFromArray($module, $postData);

            $this->entity_manager->save($module);

            $this->router->redirectTo("admin_generator_edit", [
                "id" => $module->getId()
            ]);
        }

        return $this->template_response->createResponse("admin/generator/new.html.twig");
    }

    private function mapEntityFromArray(Module $module, array $data)
    {
        $module->setName($data["name"]);
        $module->setSlugPlural($data["slug_plural"]);
        $module->setSlugSingular($data["slug_singular"]);
    }
}
