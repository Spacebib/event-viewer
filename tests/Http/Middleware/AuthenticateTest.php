<?php

namespace Spacebib\EventViewer\Tests\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Spacebib\EventViewer\Http\Middleware\Authenticate;
use Spacebib\EventViewer\Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function it_will_abort_403_with_the_user_has_no_access()
    {
        $userResolver = function () {
            return new User();
        };

        app()['auth']->resolveUsersUsing($userResolver);
        $request = new Request;
        $request->setUserResolver($userResolver);

        $middleware = new Authenticate;

        try {
            $middleware->handle($request, function () {
            });
            $this->fail('Expected exception HttpException(403) not shown');
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }
    }

    /** @test */
    public function it_will_pass_with_the_user_has_access()
    {
        $userResolver = function () {
            $user = new User();
            $user->email = 'admin@event-viewer.com';
            return $user;
        };

        app()['auth']->resolveUsersUsing($userResolver);
        $request = new Request;
        $request->setUserResolver($userResolver);

        $middleware = new Authenticate;

        $middleware->handle($request, function () {
            $this->assertTrue(true);
        });
    }
}
