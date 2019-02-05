<?php

namespace LaravelEnso\VueDatatable\app\Classes\Template\Builders;

use Illuminate\Support\Str;

class Structure
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function build()
    {
        $this->readPath()
            ->lengthMenu()
            ->debounce()
            ->method()
            ->selectable()
            ->defaults();
    }

    private function readPath()
    {
        $route = $this->template->routePrefix.'.'.(
            $this->template->dataRouteSuffix
                ?? config('enso.datatable.dataRouteSuffix')
        );

        $this->template->readPath = route($route, [], false);

        return $this;
    }

    private function lengthMenu()
    {
        if (! property_exists($this->template, 'lengthMenu')) {
            $this->template->lengthMenu = config('enso.datatable.lengthMenu');
        }

        return $this;
    }

    private function debounce()
    {
        if (! property_exists($this->template, 'debounce')) {
            $this->template->debounce = config('enso.datatable.debounce');
        }

        return $this;
    }

    private function method()
    {
        if (! property_exists($this->template, 'method')) {
            $this->template->method = config('enso.datatable.method');
        }

        return $this;
    }

    private function selectable()
    {
        if (! property_exists($this->template, 'selectable')) {
            $this->template->selectable = false;
        }

        return $this;
    }

    private function defaults()
    {
        $this->template->total = false;
        $this->template->enum = false;
        $this->template->money = false;
        $this->template->date = false;
        $this->template->searchable = false;
        $this->template->labels = config('enso.datatable.labels');
        $this->template->pathSegment = $this->pathSegment();
    }

    private function pathSegment()
    {
        $segment = collect(
                explode('.', $this->template->routePrefix)
            )->last();

        return Str::singular($segment);
    }
}
