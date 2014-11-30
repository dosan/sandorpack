<?php

namespace Sandorpack;

class View{

	public function __construct(){
		return $this;
	}
	/**
	 * Загрузка шаблона
	 * 
	 * @param string $layout название файла шаблона 
	 */
	public static function make($layout){
		require .'layouts/'.$layout . '.php';
	}

	public function template($layout){
		require .'layouts/'.$layout . '.php';
	}
	public function show('layouts', $layout, $withOutTempl = false){
		if ($withOutTempl == false) {
			$this->template('header');
			require .'layouts'.'/'.$layout;
			$this->template('sidebar');
			$this->template('footer');
		}else{
			require "application/views/".'layouts'."/".$layout;
		}
	}
}
