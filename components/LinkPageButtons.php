<?php

namespace Xitara\Unimatrix\Components;

use Cms\Classes\ComponentBase;
use Xitara\Unimatrix\Models\Link;
use Xitara\Unimatrix\Models\LinkPage;

class LinkPageButtons extends ComponentBase
{
    /**
     * @var array<int, array<string, mixed>>
     */
    public $sections = [];

    /**
     * @var \Xitara\Unimatrix\Models\LinkPage|null
     */
    public $linkPage;

    public function componentDetails() : array
    {
        return [
            'name' => 'xitara.unimatrix::lang.components.link_page_buttons.name',
            'description' => 'xitara.unimatrix::lang.components.link_page_buttons.description',
        ];
    }

    public function defineProperties() : array
    {
        return [
            'linkPage' => [
                'title' => 'xitara.unimatrix::lang.components.link_page_buttons.properties.link_page.title',
                'description' => 'xitara.unimatrix::lang.components.link_page_buttons.properties.link_page.description',
                'type' => 'dropdown',
                'default' => '',
            ],
        ];
    }

    public function getLinkPageOptions() : array
    {
        return LinkPage::query()
            ->orderBy('title')
            ->get(['id', 'title', 'is_active'])
            ->mapWithKeys(function (LinkPage $linkPage) {
                $label = $linkPage->title;

                if (!$linkPage->is_active) {
                    $label .= ' (' . trans('xitara.unimatrix::lang.components.link_page_buttons.inactive') . ')';
                }

                return [(string) $linkPage->id => $label];
            })
            ->toArray();
    }

    public function onRun() : void
    {
        $this->prepareData();
        $this->addCss('/plugins/xitara/unimatrix/components/linkpagebuttons/assets/css/linkpagebuttons.css');
    }

    protected function prepareData() : void
    {
        $linkPageId = (int) $this->property('linkPage');

        if ($linkPageId <= 0) {
            $this->linkPage = null;
            $this->sections = [];

            return;
        }

        $this->linkPage = LinkPage::query()->find($linkPageId);

        if (!$this->linkPage) {
            $this->sections = [];

            return;
        }

        $sectionItems = collect((array) data_get($this->linkPage->structure, 'sections', []))
            ->flatMap(function ($section) {
                return (array) data_get($section, 'items', []);
            })
            ->pluck('link_id')
            ->filter()
            ->map(function ($linkId) {
                return (int) $linkId;
            })
            ->unique()
            ->values();

        $links = Link::query()
            ->whereIn('id', $sectionItems)
            ->get(['id', 'title', 'url', 'icon', 'is_active'])
            ->mapWithKeys(function (Link $link) {
                $data = $link->toArray();
                $data['icon_url'] = $this->normalizeIconPath($data['icon'] ?? null);

                return [$link->id => $data];
            });

        $this->sections = collect((array) data_get($this->linkPage->structure, 'sections', []))
            ->map(function ($section) use ($links) {
                $items = collect((array) data_get($section, 'items', []))
                    ->map(function ($item) use ($links) {
                        $linkId = (int) data_get($item, 'link_id');

                        return $links->get($linkId);
                    })
                    ->filter()
                    ->values()
                    ->all();

                return [
                    'title' => trim((string) data_get($section, 'title')),
                    'description' => trim((string) data_get($section, 'description')),
                    'items' => $items,
                ];
            })
            ->filter(function (array $section) {
                return !empty($section['items']);
            })
            ->values()
            ->all();
    }

    protected function normalizeIconPath($icon) : ?string
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
