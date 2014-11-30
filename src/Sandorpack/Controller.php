<?php

namespace Sandorpack;

use Sandorpack\Session;
use Sandorpack\Lang;

class Controller{
	// list of languages
	public $languages;
	public $selectedLang;
	private $db = null;
	// messages for pages
	public $mess;

	public function __construct(){
		$session = new Session();
		$this->dbconnect();
		if ($session->get('user_lang')) {
			$user_lang = $session->get('user_lang');
			$this->selectedLang = new Lang($user_lang);
		}else{
			//get the default lang, in this case 'en'
			$this->selectedLang = new Lang();
		}
		$this->mess = $this->selectedLang->lang;
		$this->languages = $this->selectedLang->langs();
	}
	/**
	 * simple model loader
	 * @param  [string] $model [model name]
	 * @return [object]    [models object with connected to database]
	 */
	protected function model($model)
	{
		require 'app/models/' . strtolower($model) . '.php';
		return new $model($this->db, $this->mess);
	}
	/**
	 * connect to db
	 */
	private function dbconnect()
	{
		$options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);
		
		$this->db = new \PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
		$this->db->exec("set names utf8");
	}

	/**
	 * check the  php version
	 * @return [type] [description]
	 */
	public function versionPhp(){
		if (version_compare(PHP_VERSION, '5.3.7', '<')) {
			exit("Sorry,Your PHP version smaller than 5.3.7 !");
		} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
			return true;
		}
	}
}