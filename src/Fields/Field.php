<?php

namespace Sitepilot\Block\Fields;

abstract class Field
{
    /**
     * The displayable name of the field.
     *
     * @var string
     */
    public $name;

    /**
     * The attribute name of the field.
     *
     * @var string
     */
    public $attribute;

    /**
     * The default value of the field.
     *
     * @var string
     */
    public $default;

    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string $attribute
     * @return void
     */
    public function __construct($name, $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute;
    }

    /**
     * Set the field's default value.
     *
     * @param mixed $value
     * @return $this
     */
    public function default_value($value)
    {
        $this->default = $value;

        return $this;
    }
}
