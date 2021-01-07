<?php

namespace Sitepilot\Block\Fields;

class Select extends Field
{
    /**
     * The select options.
     *
     * @var array
     */
    public $options = [];

    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'select',
            'label' => $this->name,
            'default' => $this->default,
            'options' => $this->options
        ];
    }

    /**
     * Set the select options.
     *
     * @param array $options
     * @return self
     */
    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
