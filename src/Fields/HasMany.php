<?php

namespace Sitepilot\Block\Fields;

use FLBuilder;

class HasMany extends Field
{
    private $block;
    private $preview_attribute;

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string $attribute
     * @return void
     */
    public function __construct($name, $attribute, $class)
    {
        parent::__construct($name, $attribute);

        $this->block = new $class();
    }

    public function preview_attribute($attribute)
    {
        $this->preview_attribute = $attribute;
    }

    public function builder_field()
    {
        $form = get_class($this->block) . 'Form';

        FLBuilder::register_settings_form($form, array(
            'title' => __('Shortcode', 'sitepilot-theme'),
            'tabs'  => array(
                'general' => array(
                    'title' => __('General', 'fl-builder'),
                    'sections' => array(
                        'general' => array(
                            'title' => '',
                            'fields' => $this->block->builder->fields()
                        )
                    )
                )
            )
        ));

        return [
            'type' => 'form',
            'label' => $this->name,
            'form' => $form,
            'preview_text' => $this->preview_attribute,
            'multiple' => true
        ];
    }
}
