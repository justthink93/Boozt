<?php

namespace App\Controllers;

use App\Core\Template;

class BaseController
{
    private $template;

    public function __construct(Template $template = null)
    {
        $this->template = $template ?? new Template();
    }

    /**
     * @param $controller
     * @param array $variables
     * @return mixed
     * @throws \Exception
     */
    protected function getView($controller, array $variables = [])
    {
        return $this->template->getView($controller, $variables);
    }
}