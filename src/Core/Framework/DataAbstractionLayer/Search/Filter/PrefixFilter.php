<?php declare(strict_types=1);

namespace Shopware\Core\Framework\DataAbstractionLayer\Search\Filter;

/**
 * @deprecated tag:v6.5.0 - reason:becomes-final - Will be @final
 * @final
 */
class PrefixFilter extends SingleFieldFilter
{
    protected string $field;

    protected string $value;

    /**
     * @param string|float|int|null $value
     */
    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = (string) $value;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getFields(): array
    {
        return [$this->field];
    }
}
