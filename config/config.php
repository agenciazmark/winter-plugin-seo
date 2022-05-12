<?php return [
    // This contains the Laravel Packages that you want this plugin to utilize listed under their package identifiers
    'packages' => [
        'madeitbelgium/seo-analyzer' => [
            // Service providers to be registered by your plugin
            'providers' => [
                '\MadeITBelgium\SeoAnalyzer\SeoServiceProvider',
            ],
            
            // Aliases to be registered by your plugin in the form of $alias => $pathToFacade
            'aliases' => [
                'SeoAnalyzer' => '\MadeITBelgium\SeoAnalyzer\SeoFacade',
            ],
            
            // The namespace to set the configuration under. For this example, this package accesses it's config via config('SeoAnalyzer.' . $key), so the namespace 'SeoAnalyzer' is what we put here
            'config_namespace' => 'SeoAnalyzer',
            
            // The configuration file for the package itself. Start this out by copying the default one that comes with the package and then modifying what you need.
            'config' => [
            ],
        ],
    ],
];