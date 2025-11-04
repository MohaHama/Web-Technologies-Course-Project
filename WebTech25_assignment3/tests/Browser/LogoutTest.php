<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;
use PHPUnit\Framework\Assert as PHPUnit;


class LogoutTest extends DuskTestCase
{

    use DatabaseTruncation;

    protected function setUp(): void{
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testLogoutLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::first())
                    ->visit('/')
                    ->assertSee('Log Out');

            $form = $browser->element('@logout');
            PHPUnit::assertEquals(
                "post", strtolower($form->getAttribute("method")),
                "Form HTTP method is incorrect. Using: [{$form->getAttribute("method")}]"
            );
        });
    }

    public function testLogout(): void 
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::first())
                    ->visit('/')
                    ->press('Log Out')
                    ->assertPathIs('/')
                    ->assertGuest();
        });
    }
}
