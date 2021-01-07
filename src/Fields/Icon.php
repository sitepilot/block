<?php

namespace Sitepilot\Block\Fields;

class Icon extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'icon',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
