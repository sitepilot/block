<?php

namespace Sitepilot\Block;

class Shortcode
{
    /**
     * The block instance.
     *
     * @var Block
     */
    private $block;

    /**
     * Create a new shortcode instance.
     *
     * @param Block $block
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    /**
     * Register shortcode tag.
     *
     * @param string $tag
     * @return void
     */
    public function tag(string $tag): void
    {
        add_shortcode($tag, [$this, 'render']);
    }

    /**
     * Get the shortcode's arguments.
     *
     * @return array
     */
    public function args(): array
    {
        $args = [];
        $fields = $this->block->fields();

        foreach ($fields as $field) {
            if ($field->attribute != 'slot') {
                $args[$field->attribute] = $field->default;
            }
        }

        return $args;
    }

    /**
     * Render the shortcode.
     *
     * @param array $args
     * @param string $slot
     * @return string
     */
    public function render($args = [], $slot = ''): string
    {
        $data = array_merge([
            'slot' => $slot ? $slot : ''
        ], $this->args(), !$args ? [] : $args);

        return $this->block->render_view($data);
    }
}
