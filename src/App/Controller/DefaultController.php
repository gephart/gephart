<?php

namespace App\Controller;

use Gephart\Framework\Facade\Response;

final class DefaultController
{
    /**
     * @Route /
     */
    public function index()
    {
        return Response::template("_framework/default.html.twig");
    }
}
