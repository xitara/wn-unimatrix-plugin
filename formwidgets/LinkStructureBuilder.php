<?php

namespace Xitara\Unimatrix\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Xitara\Unimatrix\Models\Link;

class LinkStructureBuilder extends FormWidgetBase
{
    /**
     * @var string
     */
    protected $defaultAlias = 'linkstructurebuilder';

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('builder');
    }

    public function prepareVars()
    {
        $value = $this->normalizeStructure($this->getLoadValue());

        $this->vars['name'] = $this->getFieldName();
        $this->vars['value'] = $value;
        $this->vars['valueJson'] = json_encode($value, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        $this->vars['textsJson'] = json_encode([
            'sectionTitle' => trans('xitara.unimatrix::lang.link_pages.builder.section_title'),
            'sectionDescription' => trans('xitara.unimatrix::lang.link_pages.builder.section_description'),
        ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        $this->vars['availableLinks'] = Link::query()
            ->orderBy('title')
            ->get(['id', 'title', 'description', 'icon', 'is_active'])
            ->map(function ($link) {
                $data = $link->toArray();
                $data['icon_url'] = $this->normalizeIconPath($data['icon'] ?? null);

                return $data;
            })
            ->toArray();
        $this->vars['availableLinksJson'] = json_encode(
            $this->vars['availableLinks'],
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        );
    }

    public function getSaveValue($value)
    {
        if (\is_array($value)) {
            return $this->normalizeStructure($value);
        }

        $decoded = json_decode((string) $value, true);

        return $this->normalizeStructure($decoded);
    }

    protected function loadAssets()
    {
        $this->addCss('css/linkstructurebuilder.css');
        $this->addJs('js/linkstructurebuilder.js');
    }

    protected function normalizeStructure($value)
    {
        $sections = [];

        if (\is_array($value) && isset($value['sections']) && \is_array($value['sections'])) {
            $sections = $value['sections'];
        }

        return [
            'sections' => array_values(array_map(function ($section) {
                $items = [];

                if (\is_array($section) && isset($section['items']) && \is_array($section['items'])) {
                    $items = $section['items'];
                }

                return [
                    'id' => (string) ($section['id'] ?? uniqid('section_', true)),
                    'title' => (string) ($section['title'] ?? ''),
                    'description' => (string) ($section['description'] ?? ''),
                    'items' => array_values(array_map(function ($item) {
                        return [
                            'id' => (string) ($item['id'] ?? uniqid('item_', true)),
                            'link_id' => isset($item['link_id']) ? (int) $item['link_id'] : null,
                        ];
                    }, array_filter($items, function ($item) {
                        return \is_array($item) && \array_key_exists('link_id', $item);
                    }))),
                ];
            }, $sections)),
        ];
    }

    protected function normalizeIconPath($icon)
    {
        if (!$icon) {
            return null;
        }

        $icon = ltrim((string) $icon, '/');

        if (strpos($icon, 'storage/app/media/unimatrix/icons/') === 0) {
            return '/' . $icon;
        }

        if (strpos($icon, 'unimatrix/icons/') === 0) {
            return '/storage/app/media/' . $icon;
        }

        return '/storage/app/media/unimatrix/icons/' . basename($icon);
    }
}
