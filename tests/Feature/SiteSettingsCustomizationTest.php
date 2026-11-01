<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Filament\Pages\SiteSettings;
use App\Filament\Resources\PageSectionResource\Pages\EditPageSection;
use App\Filament\Resources\PageSectionResource\Pages\ListPageSections;
use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Models\User;
use App\Support\ColorHelper;
use App\Support\Site;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SiteSettingsCustomizationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::findOrCreate('Admin');

        $this->admin = User::factory()->create([
            'email' => 'admin@tnila.test',
            'name' => 'Admin',
        ]);

        $this->admin->assignRole('Admin');
        $this->actingAs($this->admin);

        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_admin_can_mount_and_save_site_settings(): void
    {
        Livewire::test(SiteSettings::class)
            ->assertSuccessful()
            ->fillForm([
                'branding.site_name' => 'Apex Construction',
                'branding.tagline' => 'Premier Engineering & Builds',
                'theme.primary' => '#059669',
                'theme.secondary' => '#1e293b',
                'theme.accent' => '#f59e0b',
                'theme.background' => '#f8fafc',
                'theme.surface' => '#ffffff',
                'theme.text' => '#0f172a',
                'theme.heading_font' => 'Poppins',
                'theme.body_font' => 'Inter',
                'theme.corner_radius' => 'pill',
                'contact.email' => 'hello@apexconstruct.test',
                'contact.notification_email' => 'leads@apexconstruct.test',
                'contact.phone' => '+254 788 123 456',
                'contact.address' => 'Nairobi Commercial Park, Kenya',
                'contact.working_hours' => 'Mon - Sat: 7:30 AM - 5:00 PM',
                'seo.meta_title' => 'Apex Construction | Leading Building Firm',
                'seo.meta_description' => 'Apex delivers modern construction with precision.',
                'footer.about_blurb' => 'Apex is an award-winning construction and infrastructure partner.',
                'footer.copyright_text' => 'Apex Construction Co. All rights reserved.',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertEquals('Apex Construction', Site::setting('branding.site_name'));
        $this->assertEquals('#059669', Site::setting('theme.primary'));
        $this->assertEquals('pill', Site::setting('theme.corner_radius'));
        $this->assertEquals('rounded-full', Site::setting('theme.radius_style'));
        $this->assertEquals('hello@apexconstruct.test', Site::setting('contact.email'));
        $this->assertEquals('leads@apexconstruct.test', Site::setting('contact.notification_email'));
    }

    public function test_frontend_reflects_customized_settings(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'branding' => [
                    'site_name' => 'Horizon Builders',
                    'tagline' => 'Solid Foundations',
                    'logo_light' => null,
                ],
                'theme' => [
                    'primary' => '#2563eb',
                    'secondary' => '#1e293b',
                    'accent' => '#e11d48',
                    'background' => '#f1f5f9',
                    'surface' => '#ffffff',
                    'text' => '#0f172a',
                    'heading_font' => 'Outfit',
                    'body_font' => 'Inter',
                    'corner_radius' => 'sharp',
                    'radius_style' => 'rounded-none',
                ],
                'contact' => [
                    'email' => 'contact@horizonbuilders.test',
                    'phone' => '+254 700 999 888',
                    'address' => 'Upper Hill, Nairobi',
                ],
                'social' => [
                    ['platform' => 'linkedin', 'url' => 'https://linkedin.com/company/horizon'],
                ],
                'seo' => [
                    'meta_title' => 'Horizon Builders — Commercial & Infrastructure',
                    'meta_description' => 'Top-tier infrastructure works.',
                ],
                'footer' => [
                    'about_blurb' => 'Horizon Builders delivers reliable civil construction.',
                    'copyright_text' => 'Horizon Builders Ltd.',
                ],
            ]
        );

        Site::flushCache();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Horizon Builders');
        $response->assertSee('--color-primary: #2563eb', false);
        $response->assertSee('--site-radius: 0px', false);
        $response->assertSee('contact@horizonbuilders.test');
        $response->assertSee('+254 700 999 888');
        $response->assertSee('Horizon Builders delivers reliable civil construction.');
    }

    public function test_page_sections_can_be_listed_and_customized(): void
    {
        $hero = PageSection::query()->updateOrCreate(
            ['key' => 'hero'],
            [
                'type' => 'hero',
                'sort_order' => 1,
                'is_visible' => true,
                'nav_label' => 'Home',
                'anchor' => 'hero',
                'content' => [
                    'eyebrow' => 'Master Builders',
                    'heading' => 'Building Tomorrow with Precision Today',
                    'subheading' => 'Custom residential and industrial infrastructure.',
                ],
            ]
        );

        Livewire::test(ListPageSections::class)
            ->assertCanSeeTableRecords([$hero])
            ->assertSuccessful();

        Livewire::test(EditPageSection::class, ['record' => $hero->id])
            ->fillForm([
                'content.heading' => 'Customized Hero Heading for Tnila',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertEquals(
            'Customized Hero Heading for Tnila',
            PageSection::query()->where('key', 'hero')->first()->content['heading']
        );

        Site::flushCache();

        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('Customized Hero Heading for Tnila');
    }

    public function test_color_helper_utilities(): void
    {
        $this->assertTrue(ColorHelper::isDark('#000000'));
        $this->assertFalse(ColorHelper::isDark('#ffffff'));
        $this->assertEquals('#ffffff', ColorHelper::contrastTextColor('#000000'));
        $this->assertEquals('#0f172a', ColorHelper::contrastTextColor('#ffffff'));

        $this->assertEquals('0px', ColorHelper::radiusValue('sharp'));
        $this->assertEquals('9999px', ColorHelper::radiusValue('pill'));
        $this->assertEquals('0.75rem', ColorHelper::radiusValue('soft'));

        $url = ColorHelper::googleFontsUrl('Poppins', 'Inter');
        $this->assertNotNull($url);
        $this->assertStringContainsString('family=Poppins', $url);
        $this->assertStringContainsString('family=Inter', $url);

        $darker = ColorHelper::adjustBrightness('#ffffff', -20);
        $this->assertNotEquals('#ffffff', $darker);
    }

    public function test_section_visibility_and_ordering_dynamically_updates_homepage(): void
    {
        PageSection::query()->updateOrCreate(
            ['key' => 'services'],
            [
                'type' => 'services',
                'sort_order' => 2,
                'is_visible' => false,
                'content' => [
                    'heading' => 'Invisible Services Heading',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'about'],
            [
                'type' => 'about',
                'sort_order' => 1,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Promoted About Section Heading',
                ],
            ]
        );

        Site::flushCache();

        $response = $this->get('/');
        $response->assertOk();
        $response->assertDontSee('Invisible Services Heading');
        $response->assertSee('Promoted About Section Heading');
    }

    public function test_subpages_reflect_respective_section_settings(): void
    {
        PageSection::query()->updateOrCreate(
            ['key' => 'about'],
            [
                'type' => 'about',
                'sort_order' => 1,
                'is_visible' => true,
                'content' => [
                    'eyebrow' => 'Unique About Eyebrow',
                    'heading' => 'Customized About Heading For Test',
                    'mission' => 'Our custom mission statement for test',
                    'vision' => 'Our custom vision statement for test',
                    'story' => '<p>Custom HTML story paragraph for testing.</p>',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'services'],
            [
                'type' => 'services',
                'sort_order' => 2,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Customized Services Section Heading For Test',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'industries'],
            [
                'type' => 'industries',
                'sort_order' => 3,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Customized Industries Section Heading For Test',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'projects'],
            [
                'type' => 'projects',
                'sort_order' => 4,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Customized Projects Section Heading For Test',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'faq'],
            [
                'type' => 'faq',
                'sort_order' => 5,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Customized FAQs Section Heading For Test',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'testimonials'],
            [
                'type' => 'testimonials',
                'sort_order' => 6,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Customized Testimonials Section Heading For Test',
                ],
            ]
        );

        PageSection::query()->updateOrCreate(
            ['key' => 'blog'],
            [
                'type' => 'blog',
                'sort_order' => 7,
                'is_visible' => true,
                'content' => [
                    'heading' => 'Customized Blog Section Heading For Test',
                ],
            ]
        );

        Site::flushCache();

        // Check About subpages
        $aboutResponse = $this->get('/about');
        $aboutResponse->assertOk();
        $aboutResponse->assertSee('Customized About Heading For Test');
        $aboutResponse->assertSee('Unique About Eyebrow');

        $storyResponse = $this->get('/about/our-story');
        $storyResponse->assertOk();
        $storyResponse->assertSee('Custom HTML story paragraph for testing.');

        $missionResponse = $this->get('/about/mission');
        $missionResponse->assertOk();
        $missionResponse->assertSee('Our custom mission statement for test');
        $missionResponse->assertSee('Our custom vision statement for test');

        // Check Services index
        $servicesResponse = $this->get('/services');
        $servicesResponse->assertOk();
        $servicesResponse->assertSee('Customized Services Section Heading For Test');

        // Check Industries index
        $industriesResponse = $this->get('/industries');
        $industriesResponse->assertOk();
        $industriesResponse->assertSee('Customized Industries Section Heading For Test');

        // Check Projects index
        $projectsResponse = $this->get('/projects');
        $projectsResponse->assertOk();
        $projectsResponse->assertSee('Customized Projects Section Heading For Test');

        // Check FAQs index
        $faqsResponse = $this->get('/faqs');
        $faqsResponse->assertOk();
        $faqsResponse->assertSee('Customized FAQs Section Heading For Test');

        // Check Testimonials index
        $testimonialsResponse = $this->get('/testimonials');
        $testimonialsResponse->assertOk();
        $testimonialsResponse->assertSee('Customized Testimonials Section Heading For Test');

        // Check Blog index
        $blogResponse = $this->get('/blog');
        $blogResponse->assertOk();
        $blogResponse->assertSee('Customized Blog Section Heading For Test');
    }
}
