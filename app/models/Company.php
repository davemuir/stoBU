<?php

class Company extends Mongap {

  /**
   * The database collection used by the model.
   *
   * @var string
   */
  protected $collection = 'company_SI';
    function __construct()
    {
    $this->setImage = "/img/logoap1.png";
    }

/**
   * Relationship with User object.
   *
   * @return null
   */
  public function users() {
    return $this->hasMany('User');
  }

    public function surveys() {
    return $this->hasMany('Survey');
  }

   public function rooms() {
    return $this->hasMany('Room');
  }

    public function perks() {
    return $this->hasMany('Perk');
  }

  public function settings() {
    return $this->hasOne('AppSettings');
  }

      public function apiclients() {
    return $this->hasMany('Apiclient');
  }

        public function assets() {
    return $this->hasMany('Asset');
  }

    public function beacons() {
    return $this->hasMany('Beacon');
  }

      public function beams() {
    return $this->hasMany('Beam');
  }

    public function actions() {
    return $this->hasMany('Action');
  }
    public function activeCampaign(){
    return $this->campaigns()->where('active', true)->get();
  }

    public function floors() {
    return $this->hasMany('Floor');
  }


/**
   * Relationship with Branch object.
   *
   * @return null
   */
  public function branch() {
    return $this->hasMany('Branch');
  }
}