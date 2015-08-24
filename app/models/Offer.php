<?php

class Offer extends Mongap {

	/**
	 * The database collection used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'offers';

	/**
	 * Relationship with User object.
	 *
	 * @return null
	 */
	public function company() {
		return $this->belongsTo('Company');
	}

		public function campaign() {
		return $this->belongsToMany('Campaigns');
	}

	public function toggleApproved(){
		if (is_null($this->approved_at)){
			$this->approved_at = time();
		}else{
			$this->approved_at = null;
		}

	}
}