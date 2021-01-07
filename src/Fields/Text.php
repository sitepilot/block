<?php

namespace Sitepilot\Block\Fields;

class Text extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'text',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
