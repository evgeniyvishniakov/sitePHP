<?php 

namespace core\admin\controllers;

use core\base\settings\Settings;

class ShowController extends BaseAdmin{
	
	protected function inputData(){
		
		$this->exectBase();

		$this->createTableData();

		$this->createData();

        return $this->expansion(get_defined_vars());

	}
	
	protected function outputData(){

	    $args = func_get_arg(0);
	    $vars = $args ? $args : [];

	    if(!$this->template) $this->template = ADMIN_TEMPLATE . 'show';

	    $this->content = $this->render($this->template, $vars);

	    return parent::outputData();

	}

    protected function createData($arr = []){

        $fields = [];
        $order = [];
        $order_direction =[];

        if(!$this->columns['id_row']) return $this->data = [];

        $fields[] = $this->columns['id_row'] . ' as id';

        if($this->columns['name']) $fields['name'] = 'name';
        if($this->columns['img']) $fields['img'] = 'img';

        if(count($fields) < 3){ //если в масиве меньше трех елеметов, нет img или name, тогда нужно пройтись по collumns может есть поля похожее{
            foreach ($this->columns as $key => $item){
                if(!$fields['name'] && strrpos($key, 'name') !== false) {
                    $fields['name'] = $key . ' as name';
                }
                if(!$fields['img'] && strrpos($key, 'img') === 0) {
                    $fields['img'] = $key . ' as img';
                }
            }
        }

        if($arr['fields']){ // склеиваем два массива
            if(is_array($arr['fields'])){
                $fields = Settings::instance()->arrayMergeRecursive($fields, $arr['fields']);
            }else{
                $fields[] =  $arr['fields'];
            }
        }

        if($this->columns['parent_id']){
            if(!in_array('parent_id', $fields)) $fields[] = 'parent_id';
            $order[]='parent_id';
        }

        if($this->columns['menu_position']) $order[] = 'menu_position';
        elseif($this->columns['date']){

            if($order) $order_direction = ['ASC', 'DESC'];
            else $order_direction[] = 'DESC';

            $order[] = 'date';
        }

        if($arr['order']){ // склеиваем два массива
            if(is_array($arr['order'])){
                $order = Settings::instance()->arrayMergeRecursive($order, $arr['order']);
            }else{
                $order[] =  $arr['order'];
            }
        }
        if($arr['order_direction']){ // склеиваем два массива
            if(is_array($arr['order_direction'])){
                $order_direction = Settings::instance()->arrayMergeRecursive($order_direction, $arr['order_direction']);
            }else{
                $order_direction[] =  $arr['order_direction'];
            }
        }

        $this->data = $this->model->get($this->table, [
            'fields' => $fields,
            'order' => $order,
            'order_direction' => $order_direction
        ]);

    }

}

?>