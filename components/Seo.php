<?php namespace Zmark\Seo\Components;

use Cms\Classes\ComponentBase;

class Seo extends ComponentBase
{
    public function componentDetails()
	{
		return [
			'name'			=> 'zmark.seo::lang.component_seo.name',
			'description'	=> 'zmark.seo::lang.component_seo.description'
		];
	}

    public function defineProperties()
    {
        return [
            'prepend' => [
                'title' => 'zmark.seo::lang.component_seo.property_prepend.title',
                'description' => 'zmark.seo::lang.component_seo.property_prepend.description',
                'default' => ''
            ],
            'append' => [
                'title' => 'zmark.seo::lang.component_seo.property_append.title',
                'description' => 'zmark.seo::lang.component_seo.property_append.description',
                'default' => ''
            ],
        ];
    }

    public function onRun()
    {
        $seo = NULL;
        $prepend = NULL;
        $append = NULL;

        //Load SEO data for this page
        if (isset($this->page->apiBag['staticPage'])) {
            $seo = \Zmark\Seo\Models\Seo::where('type', 'static-page')
            ->where('reference', $this->page->apiBag['staticPage']->getBaseFileName())->first();
        } else {
            $seo = \Zmark\Seo\Models\Seo::where('type', 'cms-page')
                ->where('reference', $this->page->baseFileName)->first();
        }

        if ($this->property('prepend')) {
            $prepend = $this->page->meta_title_prepend = $this->property('prepend');
        }
        if ($this->property('append')) {
            $append = $this->page->meta_title_append = $this->property('append');
        }

        if ($seo) {
            $this->page->hasSeo = true;
            $this->page->meta_title = $this->page->title = ($prepend ? ($prepend . ' ') : '') . $seo->title . ($append ? (' ' . $append) : '');
            $this->page->meta_description = $this->page->description = $seo->description;
            $this->page->meta_keywords = $this->page->keywords = $seo->keywords;
            $this->page->seo_image = $seo->image;
        } else {
            if ($this->page->meta_title && $prepend || $append) {
                $this->page->meta_title = $this->page->title = ($prepend ? ($prepend . ' ') : '') . ($this->page->meta_title ? $this->page->meta_title : $this->page->title) . ($append ? (' ' . $append) : '');
            }
        }
    }

}