<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;
use PHPUnit\Framework\Assert as PHPUnit;

class PersonalizationTest extends DuskTestCase
{

    use DatabaseTruncation;

    protected function setUp(): void{
        parent::setUp();
        $this->artisan('db:seed');
    }

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
                    ->assertDontSee('Resource added successfully');
        });
    }

    public function testResourceRegistrationBlockToGuest(): void
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

            $this->withoutMiddleware('Illuminate\Foundation\Http\Middleware\ValidateCsrfToken');
            $this->withoutExceptionHandling();
            $this->expectException('Illuminate\Auth\AuthenticationException');
            $response = $this->post($url);
            ////
        });
    }

    public function testResourceRegistrationLink(): void
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
                    ->press('Add Resource');

            // Tests
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSeeLink('Registered Resources')
                    ->clickLink('Registered Resources');

            foreach($user->registeredResources() as $resource) {
                $browser->assertSee($resource->name);
            }
        });
    }

    public function testResourceRegistrationLinkBlockToGuest(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->assertDontSeeLink('Registered Resources');
            
            $this->withoutExceptionHandling();
            $this->expectException('Illuminate\Auth\AuthenticationException');
            $url = route('registered.index');
            $response = $this->get($url);
            ////
        });
    }

    public function testResourceRegistrationMultipleUser(): void
    {
        $this->browse(function (Browser $browser) {
            //Prepare DB
            $user1 = User::find(1);
            $browser->loginAs($user1)
                    ->visit('/1')
                    ->press('Add Resource')
                    ->visit('/2')
                    ->press('Add Resource');

            $user2 = User::find(2);
            $browser->loginAs($user2)
                    ->visit('/3')
                    ->press('Add Resource');

            // Tests
            $browser->loginAs($user1)
                    ->visit('/')
                    ->assertSeeLink('Registered Resources')
                    ->clickLink('Registered Resources');
            foreach($user1->registeredResources() as $resource) {
                $browser->assertSee($resource->name);
            }

            $browser->loginAs($user2)
                    ->visit('/')
                    ->assertSeeLink('Registered Resources')
                    ->clickLink('Registered Resources');
            foreach($user2->registeredResources() as $resource) {
                $browser->assertSee($resource->name);
            }
        });
    }
}
