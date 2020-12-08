<?php

namespace Sitepilot\Block\Fields;

class Icon extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'icon',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
