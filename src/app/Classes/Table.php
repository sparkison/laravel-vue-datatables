<?php

namespace LaravelEnso\VueDatatable\app\Classes;

use LaravelEnso\Helpers\app\Classes\Obj;
use LaravelEnso\VueDatatable\app\Classes\Table\Builder;

abstract class Table
{
    protected $useScout = true; // default to using Laravel Scout for search
    protected $request;
    protected $templatePath;

    public function __construct(array $request = [])
    {
        $this->request = new Obj($request);
    }

    abstract public function query();

    public function request()
    {
        return $this->request;
    }

    public function init(array $params = [])
    {
        return (new Template($this->templatePath(), $params))
            ->get();
    }

    public function data()
    {
        return $this->builder()
            ->data();
    }

    public function excel()
    {
        return $this->builder()
            ->excel();
    }

    public function fetcher(int $chunk)
    {
        return $this->builder()
            ->fetcher($chunk);
    }

    public function templatePath()
    {
        return $this->templatePath;
    }

    private function builder()
    {
        return new Builder(
            $this->useScout,
            $this->request,
            $this->query()
        );
    }
}
