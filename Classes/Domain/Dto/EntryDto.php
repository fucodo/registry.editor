<?php
namespace fucodo\registry\editor\Domain\Dto;

use Neos\Flow\Annotations as Flow;

class EntryDto implements \JsonSerializable
{
    /**
     * @Flow\Transient
     * @Flow\InjectConfiguration(package="fucodo.registry", path="defaults")
     * @var array
     */
    protected ?array $options;

    /**
     * @var string
     */
    public string $namespace;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var ?string
     */
    public ?string $value;

    public function __construct(
        string $namespace,
        string $name,
        ?string $value
    )
    {
        $this->namespace = $namespace;
        $this->name = $name;
        $this->value = $value;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'namespace' => $this->namespace,
            'name' => $this->name,
            'value' => $this->value
        ];
    }

    public function getIdentifier(): string
    {
        return $this->namespace . ' / ' . $this->name;
    }

    public function getLabel(): string
    {
        return $this->options[$this->namespace]['items'][$this->name]['label'] ?? $this->getIdentifier();
    }

    public function getDescription(): string
    {
        return $this->options[$this->namespace]['items'][$this->name]['description'] ?? '';
    }

    public function getType(): string
    {
        return $this->options[$this->namespace]['items'][$this->name]['type'] ?? 'Text';
    }

    public function getDefault(): string
    {
        return $this->options[$this->namespace]['items'][$this->name]['default'] ?? '';
    }


    public static function fromArray(array $a): self
    {
        return new self($a['namespace'], $a['name'], $a['value'] ?? null);
    }
}
