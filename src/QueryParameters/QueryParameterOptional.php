<?php

declare(strict_types=1);

namespace JacobDeKeizer\RedJePakketje\QueryParameters;

use JacobDeKeizer\RedJePakketje\Contracts\QueryParameter;

class QueryParameterOptional implements QueryParameter
{
    private string $parameter;

    private string|int|bool|null $value;

    public function __construct(string $parameter, string|int|bool|null $value)
    {
        $this->parameter = $parameter;
        $this->value = $value;
    }

    public function getParameter(): string
    {
        return $this->parameter;
    }

    public function getValue(): ?string
    {
        if ($this->value === null) {
            return null;
        }

        if (is_bool($this->value)) {
            return $this->value ? 'true' : 'false';
        }

        return (string) $this->value;
    }

    public function toQueryString(): ?string
    {
        if ($this->getValue() === null) {
            return null;
        }

        return $this->getParameter() . '=' . urlencode($this->getValue());
    }
}
