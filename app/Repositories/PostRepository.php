<?php

namespace App\Repositories;

use App\Post;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends Base
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'user',
    ];

    /**
     * @param $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function listForUser(User $user): LengthAwarePaginator
    {
        return $this->queryFor(Post::where('user_id', $user->getId()))
            ->allowedIncludes($this->allowedIncludes)
            ->defaultSort('-updated_at')
            ->allowedSorts('id', 'created_at', 'updated_at')
            ->jsonPaginate();
    }
}
