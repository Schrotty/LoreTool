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
 */
class Continent extends BaseModel implements IModel
{
    /**
     * @var string
     */
    public $sParentModel = 'Realm';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'continent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'fk_realm', 'shortDescription', 'description', 'url'
    ];

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->realm();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function realm()
    {
        return $this->hasOne('App\Models\Realm', 'id', 'fk_realm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function landscapes()
    {
        return $this->hasMany('App\Models\Landscape', 'parent_id', 'id')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownContinent', 'fk_continent', 'fk_user');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->realm->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function isOpenRealm()
    {
        return $this->realm->isOpen;
    }
}