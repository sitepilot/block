<?php

namespace Sitepilot\Block\Fields;

class Number extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'unit',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
