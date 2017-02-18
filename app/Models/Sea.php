<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 16:00
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\IModel;

/**
 * @property mixed realm
 * @property mixed ocean
 */
class Sea extends BaseModel implements IModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sea';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'fk_ocean', 'shortDescription', 'description', 'url'
    ];

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->ocean();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ocean()
    {
        return $this->hasOne('App\Models\Ocean', 'id', 'fk_ocean');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function islands()
    {
        return $this->hasMany('App\Models\Island', 'fk_sea', 'id')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownSea', 'fk_sea', 'fk_user');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->ocean->realm->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function isOpenRealm()
    {
        return $this->ocean->realm->isOpen;
    }
}