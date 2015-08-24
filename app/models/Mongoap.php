<?php


class Mongap extends \Jenssegers\Mongodb\Model {

	/**
	 * Returns a string value of a MongoID
	 */
	public function id(){
		return ($this->attributes['_id'])? (string)$this->attributes['_id'] : '';
	}

	public function _find($id = ''){
		return parent::find($id);
	}

	public function save(array $options = array()){
		// Save to cache

		// Init parent save
		parent::save();
	}
}