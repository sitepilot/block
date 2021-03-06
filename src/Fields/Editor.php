<?php

namespace Sitepilot\Block\Fields;

class Editor extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'editor',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
