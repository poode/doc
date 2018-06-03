<?php

namespace App;

use App\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return null|int
     */
    public function getId():  ? int
    {
        return $this->getAttributeFromArray('id');
    }

    /**
     * @return null|string
     */
    public function getName() :  ? string
    {
        return $this->getAttributeFromArray('name');
    }
    /**
     * @param mixed $name
     */
    public function setName($name) : void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getEmail():  ? string
    {
        return $this->getAttributeFromArray('email');
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email) : void
    {
        $this->email = $email;
    }

}
