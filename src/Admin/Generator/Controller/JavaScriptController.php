<?php

namespace Admin\Generator\Controller;

use Gephart\Framework\Facade\Response;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class JavaScriptController
{
    /**
     * @Route {
     *  "rule": "/generator.js",
     *  "name": "admin_generator_javascript"
     * }
     */
    public function index()
    {
        return Response::template("admin/generator/js/index.js.twig");
    }
}
