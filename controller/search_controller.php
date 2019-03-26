<?php
    class SearchCtrl{
        static function GET ($request, $response, $args) {
            $params = Controller::defaultParams('search'); 
            SearchCtrl::search($params, $_GET);
            $template = Controller::$twig -> loadTemplate ('search.twig');    
            return $response->write( $template ->render ($params)); 
        }
        
        static function search(&$params, $get) {
            //url debut bouton sizepage
            $getUrlSizePage = '';
            //url debut bouton page
            $getUrlPage = '';
            
            //Récupération des variable GET
            $name = '';
            if(!empty($get['name'])){
                $params['name'] = $name = $get['name'];
                
                $getUrlSizePage = $getUrlSizePage.'&name='.$name;
                $getUrlPage = $getUrlPage.'&name='.$name;
                $getUrlName = $getUrlName.'&name='.$name;
                $getUrlPrice = $getUrlPrice.'&name='.$name;
            }
            
            $min = 0;
            if(!empty($get['min'])){
                $params['min'] = $min = $get['min'];
                
                $getUrlSizePage = $getUrlSizePage.'&min='.$min;
                $getUrlPage = $getUrlPage.'&min='.$min;
                $getUrlName = $getUrlName.'&min='.$min;
                $getUrlPrice = $getUrlPrice.'&min='.$min;
            }
            
            $max = 9999999999;
            if(!empty($get['max'])){
                $params['max'] = $max = $get['max'];
                
                $getUrlSizePage = $getUrlSizePage.'&max='.$max;
                $getUrlPage = $getUrlPage.'&max='.$max;
                $getUrlName = $getUrlName.'&max='.$max;
                $getUrlPrice = $getUrlPrice.'&max='.$max;
            }
            
            $orderBy = 'name';
            if(!empty($get['orderBy']) && ($get['orderBy'] == 'name' || $get['orderBy'] == 'price')){
                $orderBy = $get['orderBy'];
                $params['isOrderBy'] = true;
                
                $getUrlSizePage = $getUrlSizePage.'&orderBy='.$orderBy;
                $getUrlPage = $getUrlPage.'&orderBy='.$orderBy;
            }else{
                $params['isOrderBy'] = false;
            }
            $params['orderBy'] = $orderBy;
            
            $sens = 'ASC';
            if(!empty($get['sens']) && ($get['sens'] == 'ASC' || $get['sens'] == 'DESC')){
                $sens = $get['sens'];
                $params['isSens'] = true;
                
                $getUrlSizePage = $getUrlSizePage.'&sens='.$sens;
                $getUrlPage = $getUrlPage.'&sens='.$sens;
            }else{
                $params['isSens'] = false;
            }
            $params['sens'] = $sens;
            
            $page = 1;
            if(!empty($get['page']) && (int)$get['page'] > 0){
                $params['page'] = $page = (int)$get['page'];
            }
            
            $sizePage = 20;
            if(!empty($get['sizePage']) && (int)$get['sizePage'] > 0){
                $sizePage = (int)$get['sizePage'];
                $params['isSizePage'] = true;
                
                $getUrlPage = $getUrlPage.'&sizePage='.$sizePage;
            }else{
                $params['isSizePage'] = false;
            }
            $params['sizePage'] = $sizePage;
            
            //stockage des variable get pour les boutons
            $params['getUrlSizePage'] = $getUrlSizePage;
            $params['getUrlPage'] = $getUrlPage;
            if($orderBy == 'name'){
                if($sens == 'ASC'){
                    $params['getUrlOrderByName'] = $getUrlPage.'&orderBy=name&sens=DESC';
                }else{//sens == 'DESC'
                    $params['getUrlOrderByName'] = $getUrlPage.'&orderBy=name&sens=ASC';
                }
                $params['getUrlOrderByPrice'] = $getUrlPage.'&orderBy=price&sens=ASC';
            }else{ //orderby == 'price'
                if($sens == 'ASC'){
                    $params['getUrlOrderByPrice'] = $getUrlPage.'&orderBy=price&sens=DESC';
                }else{//sens == 'DESC'
                    $params['getUrlOrderByPrice'] = $getUrlPage.'&orderBy=price&sens=ASC';
                }
                $params['getUrlOrderByName'] = $getUrlPage.'&orderBy=name&sens=ASC';
            }
            
            
            //Comptage du nombre de pages 
            $params['count'] = $count = ArticlesDAO::countItem($name, $min, $max);
            if ($count > 0){
                //si la page est trop élevé chercher la dernière
                $nbPages = ceil((int)$count/(int)$sizePage);
                if($page > $nbPages){
                    $params['page'] = $page = $nbPages;
                }
                
                //récupération de la liste
                $params['itemList'] = ArticlesDAO::search($name, $min, $max, $orderBy, $sens, $page, $sizePage);
                
                //mise en place du pager
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
            }
            
        }
    }
?>