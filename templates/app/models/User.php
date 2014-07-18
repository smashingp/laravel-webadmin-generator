<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait,
        SoftDeletingTrait;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $appends= array('photofullpath');
    protected $guarded = array('id','created_at','updated_at','deleted_at');
    
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }
    
    public function getPhotofullpathAttribute() {
        $path = "/img/";
        if($this->photo == "") {
            $path .= "avatar2.png";
        } else {
            $path .= $this->photo;
        }
        return $path;
    }    
    
}
