<?php

namespace Sitepilot\Block\Fields;

class Repeater extends Field
{
    /**
     * The form fields.
     *
     * @var array
     */
    public $fields = [];

    /**
     * The preview attribute name.
     *
     * @var string
     */
    private $preview_attribute;

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string $attribute
     * @param string $class
     * @return void
     */
    public function __construct($name, $attribute, $class)
    {
        parent::__construct($name, $attribute);

        $this->class = $class;
    }

    /**
     * Get the builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        $form = $this->class . '_' . $this->attribute;

        $fields = [];
        foreach ($this->fields as $key => $field) {
            $fields[$field->attribute] = $field->builder_field();
        }

        \FLBuilder::register_settings_form($form, array(
            'title' => __('Shortcode', 'sitepilot-block'),
            'tabs'  => array(
                'general' => array(
                    'title' => __('General', 'fl-builder'),
                    'sections' => array(
                        'general' => array(
                            'title' => '',
                            'fields' => $fields
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

    /**
     * Set the form fields.
     *
     * @param array $fields
     * @return self
     */
    public function fields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Set the preview attribute.
     *
     * @param string $attribute
     * @return self
     */
    public function preview_attribute($attribute): self
    {
        $this->preview_attribute = $attribute;

        return $this;
    }
}
