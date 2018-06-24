<?php


/**
 * Description of DataHelper
 *
 * @author nngao
 */
namespace app\utilities;

use Yii;
use yii\helpers\Html;
use yii\web\Response;

class DataHelper {
    //put your code here
    public function getModalButton($model, $viewfile, $title, $button_class,$label='New', $url='',$model_name=''){
        if($model_name == ""){
            $model_name = $this->getModelNameFromViewFile($viewfile);
        }
        $data = Html::a($label, ['#'], ['class' => $button_class,  'onclick'=>"showBSdialog('$model_name','$model->id','$viewfile','$title','$url'); return false;"]);
       
        
        return $data;
        
    }
    
    public function processResponse($controller, $model, $action, $status, $message, $gridid, $alert_div){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $form = $controller->renderAjax($action, ['model' => $model,'id'=>$model->id],false,false);
        return array(
            'status'=>$status, 
            'message'=>$message,
            'div'=>$form,
            'gridid'=>$gridid,
            'alert_div'=>$alert_div
            );
    }
    
    public function getModelNameFromViewFile($viewfile){
        $cleaner = explode('/', $viewfile);
        
        $array = explode('-', $cleaner[0]);
        $string = '';
        if(isset($array[1])){
            $string = ucfirst($array[0]).ucfirst($array[1]);
        }
        else{
            $string = ucfirst($array[0]);
        }
        
        return $string;
    }
    
     public static function getMonthOptions(){
        $array = []; 
        for($i=1; $i<=12; $i++){
            $array[$i] = $i;
        }
        return $array;
    }
    public static function getYearOptions(){
        
        
        return [
                
                2017=>2017, 
                2018=>2018, 
                2019=>2019, 
            ];
    }
    
    public static function calculateRangeWithIntervals($begin, $end, $interval){
        
        $return =[];
        for($i=$begin; $i<=$end; $i+=$interval ){
            $return[$i] = $i;
        }
        return $return;
    }
    
    public function processUploadedFile($fieldname, $folder_name){
            $tmp_name = $_FILES[$fieldname]["tmp_name"];   
            $temp = $_FILES[$fieldname]["name"];
            if(move_uploaded_file($tmp_name, "$folder_name/$temp")){
                return true;
            }
            else{
                return false;
            }
            
    }
    
    public function getSearchCriteria($search = ''){
        $criteria = '';
       // $except_array = ['search_price_range2'];
        if(is_array($search)){
            foreach($search as $key => $value){
                if($criteria == ''){
                  //check values one by one.
                   $criteria = $this->searchQueryCreator($search, $key, $value);
                
                }
                else{
                    $query = $this->searchQueryCreator($search, $key, $value);
                    if($query)
                     $criteria .= ' && '.$query;
                }
            }
        }
        
        return $criteria;
        
    }
    
    public function searchQueryCreator($search, $key, $value){
        $query = '';
        //make
        if($key == 'property_type'){
           $query = $key.' = '.$value;
        }
        //model
        if($key == 'search_sub_location'){
            //explode the location value to know where we are.
            $area = explode(':', $value);
            
            $query = 'property_location = ""';
        }
      
        if($key == 'search_price_range1'){
            $id_list = '';
            //get all properties with monthly rent above this range.
            $ids = \app\models\PropertyTerm::find()->where('fk_term_id = 1 && term_narration > '.$value)->all();
            if($ids){
                foreach($ids as $model){
                    $id_list .= $model->id.',';
                }
                //remove trailing comma.
                $id_list = substr($id_list, 0, -1);
            }
           if($id_list)
           $query = ' id IN ('.$id_list.') ';
        }
        if($key == 'search_price_range2'){
            $id_list = '';
            //get all properties with monthly rent below this range.
            $ids = \app\models\PropertyTerm::find()->where('fk_term_id = 1 && term_narration < '.$value)->all();
            if($ids){
                foreach($ids as $model){
                    if($model->id)
                      $id_list .= $model->id.',';
                }
                //remove trailing comma.
                if($id_list)
                  $id_list = substr($id_list, 0, -1);
            }
           if($id_list) 
           $query = ' id IN ('.$id_list.') ';
        }
        
        return $query;
        
    }
    
    public static function recordTimeStamp($model){
     
        if($model->isNewRecord){
            $model->date_created = date("Y-m-d H:i:s");
            $model->created_by = Yii::$app->user->identity->id;
            
        }
        else{
            $model->date_modified = date("Y-m-d H:i:s");
            $model->modified_by = Yii::$app->user->identity->id;
        }
        
    }
    
}
