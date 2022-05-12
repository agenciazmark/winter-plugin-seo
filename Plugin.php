<?php namespace Zmark\Seo;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Backend;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Translate'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
	{
		return [
			'name'		  => 'zmark.seo::lang.plugin.name',
			'description' => 'zmark.seo::lang.plugin.description',
			'author'	  => 'Zmark',
			'icon'		  => 'icon-line-chart',
            'homepage'    => 'https://github.com/agenciazmark/winter-plugin-seo'
		];
	}

	public function registerComponents()
	{
		return [
			'\Zmark\Seo\Components\Seo' => 'seo',
			'\Zmark\Seo\Components\SeoModel' => 'seoModel',
    	];
	}

    public function registerPermissions()
    {
        return [
            'zmark.seo.manage'  => [
                'tab'   => 'zmark.seo::lang.plugin.name',
                'label' => 'zmark.seo::lang.plugin.manage_seo'
            ],
            // 'zmark.seo.sitemap' => [
            //     'tab'   => 'zmark.seo::lang.plugin.name',
            //     'label' => 'zmark.seo::lang.plugin.manage_sitemap',
            // ],
        ];
    }

    public function registerNavigation() {
        $menu =  [
            'seo' => [
                'label'       => 'zmark.seo::lang.plugin.name',
                'description' => 'zmark.seo::lang.plugin.description',
                'icon'        => 'icon-line-chart',
                'iconSvg'     => 'plugins/zmark/seo/assets/images/seo-icon.svg',
                'url'         => Backend::url('zmark/seo/seo'),
                'permissions' => ['zmark.seo.manage'],
                'sideMenu' => [
                    'seo' => [
                        'label' => 'zmark.seo::lang.seo.menu',
                        'icon' => 'icon-line-chart',
                        'url' => Backend::url('zmark/seo/seo'),
                        'permissions' => ['zmark.seo.manage'],
                    ],
                    // 'sitemap' => [
                    //     'label' => 'zmark.seo::lang.sitemap.menu',
                    //     'icon' => 'icon-sitemap',
                    //     'url' => Backend::url('zmark/seo/sitemap'),
                    //     'permissions' => ['zmark.seo.sitemap'],
                    // ],
                ]
            ]
        ];
        
        return $menu;
    }

    public function registerFormWidgets()
    {
        return [
            'Zmark\Seo\FormWidgets\SeoTab' => 'zmark_seotab',
        ];
    }

}