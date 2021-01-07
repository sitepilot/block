<?php

namespace Sitepilot\Block\Fields;

class Textarea extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'textarea',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
