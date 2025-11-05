<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;
use PHPUnit\Framework\Assert as PHPUnit;

class PersonalizationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testResourceRegistration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::first())
                    ->visit('/1');
            $form = $browser->element('@resource-registration');
            PHPUnit::assertEquals(
                "post", strtolower($form->getAttribute("method")),
                "Form HTTP method is incorrect. Using: [{$form->getAttribute("method")}]"
            );

            $browser->press('Add Resource')
                    ->assertPathIs('/1')
                    ->assertSee('Resource added successfully')
                    ->visit('/1')
                    ->assertDontSee('Resource added successfully')
                    ;
        });
    }

    public function testRegistrationBlockToGuest(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/1')
                    ->assertNotPresent('@resource-registration');

            // add resource action
            $browser->loginAs(User::first())
                    ->visit('/1');
            $form = $browser->element('@resource-registration');
            $url = $form->getAttribute("action");
            $browser->logout()
                    ;

            $this->withoutMiddleware('Illuminate\Foundation\Http\Middleware\ValidateCsrfToken');
            $this->withoutExceptionHandling();
            $this->expectException('Illuminate\Auth\AuthenticationException');
            $response = $this->post($url);
            ////
        });
    }

    public function testRegistrationLinkAuth(): void
    {

        $this->browse(function (Browser $browser) {
            
            $user = User::first();

            //Prepare DB
            $browser->loginAs($user)
                    ->visit('/1')
                    ->press('Add Resource')
                    ->visit('/2')
                    ->press('Add Resource')
                    ->visit('/3')
                    ->press('Add Resource')
                    ;

            // Tests
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSeeLink('Registered Resources')
                    ->clickLink('Registered Resources')
                    ;

            foreach($user->registeredResources() as $resource) {
                $browser->assertSee($resource->name);
            }
        });
    }

    public function testRegistrationLinkBlockToGuest(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->assertDontSeeLink('Registered Resources')
                    ;
            
            $this->withoutExceptionHandling();
            $this->expectException('Illuminate\Auth\AuthenticationException');
            $url = route('registered.index');
            $response = $this->get($url);
            ////
        });
    }

    public function testRegistrationMultipleUser(): void
    {
        $this->browse(function (Browser $browser) {
            //Prepare DB
            $user = User::find(1);
            $browser->loginAs($user)
                    ->visit('/1')
                    ->press('Add Resource')
                    ->visit('/2')
                    ->press('Add Resource');

            // Tests
            $resources = $user->registeredResources();
            $browser->visit('/')
                    ->assertSeeLink('Registered Resources')
                    ->clickLink('Registered Resources')
                    ;
            foreach($resources as $resource) {
                $browser->assertSee($resource->name);
            }
          
        });

        $this->browse(function (Browser $browser) {
            //Prepare DB
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/3')
                    ->press('Add Resource');

            // Tests
            $resources = $user->registeredResources();
            $browser->visit('/')
                    ->assertSeeLink('Registered Resources')
                    ->clickLink('Registered Resources')
                    ;
            foreach($resources as $resource) {
                $browser->assertSee($resource->name);
            }
           
        });
    }

    protected function afterRefreshingDatabase(): void
    {
        $this->artisan('db:seed');
    }
}
