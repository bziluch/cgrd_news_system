<?php

namespace App\src\Components\Model;

class MatchedAction
{
    public function __construct(
        private readonly string $controller,
        private readonly string $method,
        private readonly array $params,
    ) {}

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}