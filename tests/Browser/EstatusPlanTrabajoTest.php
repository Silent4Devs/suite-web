<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EstatusPlanTrabajoTest extends DuskTestCase
{
    public function testIndex()
    {
        $admin = App\Models\User::find(1);
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin);
            $browser->visit(route('admin.estatusplantrabajo.index'));
            $browser->assertRouteIs('admin.estatusplantrabajo.index');
        });
    }
}
