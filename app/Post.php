<?php

namespace App;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user()->associate($user);
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * @return null|string
     */
    public function getTitle():  ? string
    {
        return $this->getAttributeFromArray('title');
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title) : void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
    /**
     * @return null|string
     */
    public function getContent():  ? string
    {
        return $this->getAttributeFromArray('content');
    }
    /**
     * @param mixed $content
     */
    public function setContent($content) : void
    {
        $this->content = $content;
    }
}
