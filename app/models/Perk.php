<?php

class Perk extends Mongap {

	/**
	 * The database collection used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'perks';

	/**
	 * Relationship with User object.
	 *
	 * @return null
	 */
	public function company() {
		return $this->belongsTo('Company');
	}

		public function campaign() {
		return $this->belongsToMany('Offers');
	}

	public function toggleApproved(){
		if (is_null($this->approved_at)){
			$this->approved_at = time();
		}else{
			$this->approved_at = null;
		}

	}
}