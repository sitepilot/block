<?php

namespace Sitepilot\Block\Fields;

class Image extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'photo',
            'label' => $this->name,
            'show_remove' => !empty($this->default)
        ];
    }
}
