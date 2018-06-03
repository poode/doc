<?php

namespace Tests\Feature\Controllers;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostIndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create([
            'name'  => 'John',
            'email' => 'foo@bar.baz',
        ]);
    }

    public function test_list()
    {
        factory(Post::class, 3)->make()->each(function ($post, $i) {
            $post->setUser($this->user);
            $post->setTitle('New post #' . $i);
            $post->setContent('With content #' . $i);
            $post->save();
        });
        $response = $this->actingAs($this->user)
            ->json('GET', '/posts?sort=-id&include=user');
        $response->assertStatus(200);
        $response->assertExactJson([
            'data'  => [
                [
                    'title'   => 'New post #2',
                    'slug'    => 'new-post-2',
                    'content' => 'With content #2',
                    'user'    => [
                        'name'  => 'John',
                        'email' => 'foo@bar.baz',
                    ],
                ],
                [
                    'title'   => 'New post #1',
                    'slug'    => 'new-post-1',
                    'content' => 'With content #1',
                    'user'    => [
                        'name'  => 'John',
                        'email' => 'foo@bar.baz',
                    ],
                ],
                [
                    'title'   => 'New post #0',
                    'slug'    => 'new-post-0',
                    'content' => 'With content #0',
                    'user'    => [
                        'name'  => 'John',
                        'email' => 'foo@bar.baz',
                    ],
                ],
            ],
            'links' => [
                'first' => url('/posts?sort=-id&include=user&page%5Bnumber%5D=1'),
                'last'  => url('/posts?sort=-id&include=user&page%5Bnumber%5D=1'),
                'prev'  => null,
                'next'  => null,
            ],
            'meta'  => [
                'current_page' => 1,
                'from'         => 1,
                'last_page'    => 1,
                'path'         => url('/posts'),
                'per_page'     => config('json-api-paginate.default_size'),
                'to'           => 3,
                'total'        => 3,
            ],
        ]
        );
    }
}
