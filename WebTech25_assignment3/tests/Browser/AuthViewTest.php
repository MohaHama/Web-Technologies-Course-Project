<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;

class AuthViewTest extends DuskTestCase
{
    use DatabaseTruncation;

    protected function setUp(): void{
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testViewRegistrationLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->assertSeeLink('Sign Up')
                    ->loginAs(User::first())
                    ->visit('/')
                    ->assertDontSeeLink('Sign Up');
        });
    }

    public function testViewLoginLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->assertSeeLink('Log In')
                    ->loginAs(User::first())
                    ->visit('/')
                    ->assertDontSeeLink('Log In');
        });
    }

    public function testViewLogoutLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::first())
                    ->visit('/')
                    ->assertSee('Log Out')
                    ->logout()
                    ->visit('/')
                    ->assertDontSee('Log Out');
        });
    }

    public function testViewName(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee($user->name)
                    ->logout()
                    ->visit('/')
                    ->assertDontSee($user->name);
        });
    }
}
