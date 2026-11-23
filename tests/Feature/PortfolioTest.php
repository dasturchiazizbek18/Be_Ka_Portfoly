<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_portfolio_renders_in_all_three_languages(): void
    {
        $this->seed(PortfolioSeeder::class);

        $this->get('/')
            ->assertOk()
            ->assertSee('Erkinjonov Bexruz')
            ->assertSee('Mobilograf')
            ->assertSee('data-logo-slot="navbar"', false)
            ->assertSee('data-logo-slot="showcase"', false);

        $this->get('/lang/ru')->assertRedirect();
        $this->get('/')->assertOk()->assertSee('Мобилограф');

        $this->get('/lang/en')->assertRedirect();
        $this->get('/')->assertOk()->assertSee('Mobilographer');
    }

    public function test_contact_form_saves_message_to_database(): void
    {
        $this->seed(PortfolioSeeder::class);

        $response = $this->post('/contact', [
            'name' => 'Sardor',
            'contact' => '+998 90 111 22 33',
            'service_type' => 'Reels / Shorts Start',
            'message' => 'Kafe uchun Reels syomka kerak.',
        ]);

        $response->assertRedirect(route('home') . '#contact');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Sardor',
            'contact' => '+998 90 111 22 33',
            'is_read' => false,
        ]);
    }

    public function test_authenticated_admin_can_access_all_admin_pages(): void
    {
        $this->seed(PortfolioSeeder::class);
        $admin = User::where('email', 'admin@beka.uz')->firstOrFail();

        $this->actingAs($admin)->get('/dashboard')->assertOk()->assertSee('Boshqaruv paneli');
        $this->actingAs($admin)->get('/admin/settings')->assertOk()->assertSee('Brend va Logotip');
        $this->actingAs($admin)->get('/admin/projects')->assertOk();
        $this->actingAs($admin)->get('/admin/projects/create')->assertOk();
        $this->actingAs($admin)->get('/admin/services')->assertOk();
        $this->actingAs($admin)->get('/admin/services/create')->assertOk();
        $this->actingAs($admin)->get('/admin/skills')->assertOk();
        $this->actingAs($admin)->get('/admin/experiences')->assertOk();
        $this->actingAs($admin)->get('/admin/experiences/create')->assertOk();
        $this->actingAs($admin)->get('/admin/messages')->assertOk();
    }
}
