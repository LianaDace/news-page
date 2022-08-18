<?php

namespace App;

class View
{
    private  $templatePath;
    private array $data;

    public function __construct( $templatePath, array $data = [])
    {

        $this->templatePath = $templatePath;
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getTemplatePath(): string
    {
        return $this->templatePath;
    }
}