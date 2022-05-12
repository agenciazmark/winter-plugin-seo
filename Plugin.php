<?php namespace Zmark\Seo;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Backend;
use App;
use Config;
use Illuminate\Foundation\AliasLoader;

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
            'zmark.seo.analyze' => [
                'tab'   => 'zmark.seo::lang.plugin.name',
                'label' => 'Análise',
            ],
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
                    'analyze' => [
                        'label' => 'Análise',
                        'icon' => 'icon-search',
                        'url' => Backend::url('zmark/seo/analyze'),
                        'permissions' => ['zmark.seo.analyze'],
                    ],
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


    /**
     * Runs right before the request route
     */
    public function boot()
    {    
        // Setup required packages
        $this->bootPackages();
    }
    
    /**
     * Boots (configures and registers) any packages found within this plugin's packages.load configuration value
     *
     * @see https://luketowers.ca/blog/how-to-use-laravel-packages-in-october-plugins
     * @author Luke Towers <octobercms@luketowers.ca>
     */
    public function bootPackages()
    {
        // Get the namespace of the current plugin to use in accessing the Config of the plugin
        $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));
        
        // Instantiate the AliasLoader for any aliases that will be loaded
        $aliasLoader = AliasLoader::getInstance();
        
        // Get the packages to boot
        $packages = Config::get($pluginNamespace . '::packages');
        
        // Boot each package
        foreach ($packages as $name => $options) {
            // Setup the configuration for the package, pulling from this plugin's config
            if (!empty($options['config']) && !empty($options['config_namespace'])) {
                Config::set($options['config_namespace'], $options['config']);
            }
            
            // Register any Service Providers for the package
            if (!empty($options['providers'])) {
                foreach ($options['providers'] as $provider) {
                    App::register($provider);
                }
            }
            
            // Register any Aliases for the package
            if (!empty($options['aliases'])) {
                foreach ($options['aliases'] as $alias => $path) {
                    $aliasLoader->alias($alias, $path);
                }
            }
        }
    }

}