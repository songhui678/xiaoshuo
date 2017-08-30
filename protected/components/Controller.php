<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
 
    public $keywords = '';
    public $description = '';
    public $title = '';
  
    protected function beforeAction($action) {
        if(parent::beforeAction($action)){
    
            // Yii::app()->theme = 'bootstrap';
            // $this->bootstrapInit();
 
            return true;
        }else{
            return false;
        }
    }
    public function bootstrapInit(){
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->theme->baseUrl;

        /**
         * StyleSHeets
         */
        $cs
            ->registerCssFile($themePath.'/css/bootstrap.css')
            ->registerCssFile($themePath.'/css/bootstrap-theme.css');

        /**
         * JavaScripts
         */
        $cs
            ->registerCoreScript('jquery')
            ->registerCoreScript('jquery.ui')
            ->registerScriptFile($themePath.'/js/bootstrap.min.js',CClientScript::POS_END)
            ->registerScript('tooltip',
                "$('[data-toggle=\"tooltip\"]').tooltip();
                $('[data-toggle=\"popover\"]').tooltip()"
                ,CClientScript::POS_READY);
    }
}