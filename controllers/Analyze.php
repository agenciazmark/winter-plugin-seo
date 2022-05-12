<?php namespace Zmark\Seo\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use SeoAnalyzer;
use Input;

class Analyze extends Controller
{
    public $implement = [    ];
    
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Zmark.Seo', 'seo', 'analyze');

        $this->pageTitle = 'SEO - Análise';

        $this->addCss('/plugins/zmark/seo/assets/css/report.css');
    }

    public function index()
    {        
    }

    public function onAnalise() {

        $url = Input::get('url');
        $analise = SeoAnalyzer::analyze($url);

        $this->vars['result'] = $analise;

        return [
            '#result' => $this->makePartial('result')
        ];

        // return $analise;

        // echo "<pre>";
        // print_r($analise);

        // codeToTxtRatio  > 25%
        // word_count > 300
        // validar url invalida
        // validar quando não tiver alguma tag importante
        
 

        // die('fim');
    }
}
