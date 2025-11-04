<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use PHPUnit\Framework\Assert as PHPUnit;

class RegistrationTest extends DuskTestCase
{
    use DatabaseTruncation;

    protected function setUp(): void{
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testRegistrationLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSeeLink('Sign Up')
                    ->clickLink('Sign Up');
        });
    }

    public function testRegistrationForm(): void 
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Sign Up')
                    ->assertInputPresent('name')
                    ->assertInputPresent('email')
                    ->assertInputPresent('password');
            $form = $browser->element('form');
            PHPUnit::assertEquals(
                "post", strtolower($form->getAttribute("method")),
                "Form HTTP method is incorrect. Using: [{$form->getAttribute("method")}]"
            );
        });
    }

    public function testRegistrationLogin(): void 
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Sign Up')
                    ->type('name', 'Testing Name')
                    ->type('email', 'testing_user_email@email.com')
                    ->type('password', 'password')
                    ->press('Submit')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }
}
