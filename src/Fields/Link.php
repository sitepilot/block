<?php

namespace Sitepilot\Block\Fields;

class Link extends Field
{
    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'link',
            'label' => $this->name,
            'show_target' => true
        ];
    }
}
