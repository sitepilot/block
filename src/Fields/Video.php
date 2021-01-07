<?php

namespace Sitepilot\Block\Fields;

class Video extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'video',
            'label' => $this->name,
            'show_remove' => !empty($this->default)
        ];
    }
}
