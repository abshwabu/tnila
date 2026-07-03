<?php

namespace Tests\Feature;

use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;
use App\Filament\Resources\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;
use App\Models\Customer;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CustomerResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::findOrCreate('Admin');

        $admin = User::factory()->create([
            'email' => 'admin@tnila.test',
            'name' => 'Admin',
        ]);

        $admin->assignRole('Admin');

        $this->actingAs($admin);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_it_can_create_a_customer(): void
    {
        Livewire::test(CreateCustomer::class)
            ->fillForm([
                'name' => 'Acme Builders',
                'email' => 'contact@acme.test',
                'phone' => '+254700000100',
                'company_name' => 'Acme Builders Ltd',
                'address' => '123 Industrial Way, Nairobi',
                'status' => 'lead',
                'source' => 'website',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('customers', [
            'email' => 'contact@acme.test',
            'status' => 'lead',
            'source' => 'website',
        ]);
    }

    public function test_it_can_edit_a_customer(): void
    {
        $customer = Customer::factory()->create([
            'name' => 'Legacy Group',
            'email' => 'legacy@example.com',
            'status' => 'lead',
        ]);

        Livewire::test(EditCustomer::class, [
            'record' => $customer->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => 'Legacy Group',
                'email' => 'legacy@example.com',
            ])
            ->fillForm([
                'name' => 'Legacy Group Updated',
                'email' => 'legacy-updated@example.com',
                'phone' => '+254700000200',
                'company_name' => 'Legacy Group',
                'address' => '45 Business Park, Mombasa',
                'status' => 'active',
                'source' => 'referral',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'name' => 'Legacy Group Updated',
            'email' => 'legacy-updated@example.com',
            'status' => 'active',
            'source' => 'referral',
        ]);
    }

    public function test_it_can_delete_a_customer(): void
    {
        $customer = Customer::factory()->create();

        Livewire::test(EditCustomer::class, [
            'record' => $customer->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }

    public function test_it_can_search_and_filter_customers(): void
    {
        $lead = Customer::factory()->create([
            'name' => 'Atlas Holdings',
            'email' => 'atlas@example.com',
            'status' => 'lead',
            'source' => 'website',
        ]);

        $active = Customer::factory()->create([
            'name' => 'Beacon Infrastructure',
            'email' => 'beacon@example.com',
            'status' => 'active',
            'source' => 'referral',
        ]);

        $past = Customer::factory()->create([
            'name' => 'Crest Partners',
            'email' => 'crest@example.com',
            'status' => 'past',
            'source' => 'ads',
        ]);

        Livewire::test(ListCustomers::class)
            ->assertCanSeeTableRecords([$lead, $active, $past])
            ->searchTable('Beacon')
            ->assertCanSeeTableRecords([$active])
            ->assertCanNotSeeTableRecords([$lead, $past]);

        Livewire::test(ListCustomers::class)
            ->filterTable('status', 'lead')
            ->assertCanSeeTableRecords([$lead])
            ->assertCanNotSeeTableRecords([$active, $past]);
    }
}
