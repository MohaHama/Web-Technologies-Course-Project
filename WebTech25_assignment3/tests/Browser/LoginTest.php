<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;
use PHPUnit\Framework\Assert as PHPUnit;


class LoginTest extends DuskTestCase
{
    use DatabaseTruncation;

    protected function setUp(): void{
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testLoginLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->assertSeeLink('Log In')
                    ->clickLink('Log In');
        });
    }

    public function testLoginForm(): void 
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Log In')
                    ->assertInputPresent('email')
                    ->assertInputPresent('password');
            $form = $browser->element('form');
            PHPUnit::assertEquals(
                "post", strtolower($form->getAttribute("method")),
                "Form HTTP method is incorrect. Using: [{$form->getAttribute("method")}]"
            );
        });
    }

    public function testLogin(): void 
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Log In')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Submit')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }

    public function testIncorrectLogin(): void 
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Log In')
                    ->assertDontSee("Incorrect email or password")
                    ->type('email', "incorrect@incorrect.com")
                    ->type('password', 'incorrect')
                    ->press('Submit')
                    ->assertSee("Incorrect email or password")
                    ->assertGuest();
        });
    }
}
