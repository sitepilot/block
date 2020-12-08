<?php

namespace Sitepilot\Block\Fields;

class Number extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'unit',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
