<?php

namespace Sitepilot\Block\Fields;

class Code extends Field
{
    /**
     * The code field language.
     *
     * @var string
     */
    public $language = 'html';

    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        return [
            'type' => 'code',
            'label' => $this->name,
            'default' => $this->default,
            'editor' => $this->language
        ];
    }

    /**
     * Set the code field language.
     *
     * @return self
     */
    public function language($language): self
    {
        $this->language = $language;

        return $this;
    }
}
