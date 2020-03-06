<?php

namespace App\Classes;

use Exception;
Use eftec\bladeone\BladeOne;

if(!class_exists('PageTemplate')) {
    class PageTemplate extends Page
    {
        /**
         * @param $view
         * @param $params
         */
        public function render_by_template($view, $params)
        {
            $header = $this->getOUTPUT()->header();
            $footer = $this->getOUTPUT()->footer();

            $internal_params = [
                'header' => $header,
                'footer' => $footer
            ];

            $params = array_merge($params, $internal_params);

            $views = __DIR__ . '/../views';
            $cache = $this->getCFG()->dataroot . '/cache';

            if(!file_exists($cache)){
                mkdir($cache);
            }
            try{
                $blade = new BladeOne($views, $cache,BladeOne::MODE_DEBUG);
                echo $blade->run($view, $params);
            }catch(Exception $e){
                error_log("Error: " . $e->getMessage());
            }
        }
    }
}
