<?php
    class SearchCtrl{
        static function GET ($request, $response, $args) {
            $params = Controller::defaultParams('search'); 
            SearchCtrl::search($params, $_GET);
            $template = Controller::$twig -> loadTemplate ('search.twig');    
            return $response->write( $template ->render ($params)); 
        }
        
        static function search(&$params, $get) {
            $getUrl = '';
            
            $name = '';
            if(!empty($get['name'])){
               $params['name'] = $name = $get['name'];
               $getUrl = $getUrl.'&name='.$name;
            }
            
            $min = 0;
            if(!empty($get['min'])){
               $params['min'] = $min = $get['min'];
               $getUrl = $getUrl.'&min='.$min;
            }
            
            $max = 9999999999;
            if(!empty($get['max'])){
               $params['max'] = $max = $get['max'];
               $getUrl = $getUrl.'&max='.$max;
            }
            
            $page = 1;
            if(!empty($get['page']) && (int)$get['page'] > 0){
               $params['page'] = $page = (int)$get['page'];
            }
            
            $sizePage = 20;
            if(!empty($get['sizePage']) && (int)$get['sizePage'] > 0){
               $sizePage = (int)$get['sizePage'];
            }
            $params['sizePage'] = $sizePage;
            
            $params['count'] = $count = ArticlesDAO::countItem($name, $min, $max);
            $nbPages = ceil((int)$count/(int)$sizePage);
            
            if($page > $nbPages){
                $params['page'] = $page = $nbPages;
            }
            
            if($page > 3){
                $params['isSepBegin'] = true;
            }
            if($page > 2){
                $params['_first'] = 1;
            }
            if($page > 1){
                $params['previus'] = $page-1;
            }
            
            $params['current'] = $page;
            
            if($page < $nbPages){
                $params['next'] = $page+1;
            }
            if($page < $nbPages-1){
                $params['_last'] = $nbPages;
            }
            if($page < $nbPages-2){
                $params['isSepEnd'] = true;
            }
            
            $params['itemList'] = ArticlesDAO::search($name, $min, $max, $page, $sizePage);
            $params['getUrl'] = $getUrl;
            
        }
    }
?>