<?php

namespace LaravelEnso\VueDatatable\app\Classes\Template;

use LaravelEnso\VueDatatable\app\Classes\Template\Builders\Style;
use LaravelEnso\VueDatatable\app\Classes\Template\Builders\Buttons;
use LaravelEnso\VueDatatable\app\Classes\Template\Builders\Columns;
use LaravelEnso\VueDatatable\app\Classes\Template\Builders\Structure;

class Builder
{
    private $template;
    private $params;

    public function __construct($template, array $params = [])
    {
        $this->template = $template;
        $this->params = $params;
    }

    public function run()
    {
        (new Structure($this->template, $this->params))
            ->build();

        (new Columns($this->template))
            ->build();

        (new Buttons($this->template))
            ->build();

        (new Style($this->template))
            ->build();

        $this->cleanUp();
    }

    private function cleanUp()
    {
        unset(
            $this->template->dataRouteSuffix,
            $this->template->routePrefix
        );
    }
}
