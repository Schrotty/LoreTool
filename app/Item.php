<?php

namespace App;

class Item extends Model
{
    protected $fillable = [
        'name', 'author', 'known', 'contributors', 'category', 'description'
    ];

    /* === FOREIGN VALUES === */
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'item_tags', 'item_id');
    }

    public function references()
    {
        return $this->belongsToMany('App\Item', 'item_references', 'source_item_id', 'target_item_id');
    }

    public function userWithReadAccess()
    {
        return $this->belongsToMany('App\User', 'item_access', 'item_id', 'user_id');
    }

    public function userWithWriteAccess()
    {
        return $this->belongsToMany('App\User', 'item_access', 'item_id', 'user_id')->where('write_access', '=', true);
    }

    /* === HAS VALUES === */
    public function hasTags()
    {
        return $this->tags()->count() > 0;
    }

    public function hasReferences()
    {
        return $this->references()->count() > 0;
    }

    public function hasUserWithReadAccess()
    {
        return $this->userWithReadAccess()->count() > 0;
    }

    public function hasUserWithWriteAccess()
    {
        return $this->userWithWriteAccess()->count() > 0;
    }

    /* === PRIVILEGES === */
    public function hasReadPrivileges(User $user)
    {
        return $this->isAuthor($user) || $this->isContributor($user) || $this->knownBy($user) || $user->isAdmin();
    }

    public function hasWritePrivileges(User $user)
    {
        return $this->isAuthor($user) || $this->isContributor($user) || $user->isAdmin();
    }

    public function hasDeletePrivileges(User $user)
    {
        return $this->isAuthor($user) || $user->isAdmin();
    }

    public function knownBy(User $user)
    {
        if($this->known != null) {
            return in_array($user->_id, $this->known);
        }

        return false;
    }

    public function isContributor(User $user)
    {
        if($this->contributors != null) {
            return in_array($user->_id, $this->contributors);
        }

        return false;
    }

    public function isAuthor(User $user)
    {
        return $user->_id == $this->author;
    }

    public static function byTag($id)
    {
        $tag = Tag::all()->where('_id', '=', $id)->first();
        if ($tag == null) return array();

        return Item::all()->where('tags', 'all', [$tag->_id]);
    }

    public static function getPlayer($value)
    {
        return Item::all()->where('category', '=', $value);
    }

    /**
     * @param $id
     * @return array|static
     */
    public static function byParty($id)
    {
        return Item::all()->where('party', 'all', $id) ?? array();
    }
}