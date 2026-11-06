<?php

declare(strict_types=1);

use App\Support\Site;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update site_settings if any record exists
        if (Schema::hasTable('site_settings')) {
            $settings = DB::table('site_settings')->get();
            foreach ($settings as $setting) {
                $updates = [];
                foreach (['branding', 'contact', 'social', 'seo', 'footer'] as $col) {
                    if (!empty($setting->{$col})) {
                        $raw = is_string($setting->{$col}) ? $setting->{$col} : json_encode($setting->{$col});
                        $updated = str_replace(['Tnila', 'tnila', 'TNILA'], ['Tnela', 'tnela', 'TNELA'], $raw);
                        if ($updated !== $raw) {
                            $updates[$col] = $updated;
                        }
                    }
                }
                if (!empty($updates)) {
                    $updates['updated_at'] = now();
                    DB::table('site_settings')->where('id', $setting->id)->update($updates);
                }
            }
        }

        // 2. Update page_sections content
        if (Schema::hasTable('page_sections')) {
            $sections = DB::table('page_sections')->get();
            foreach ($sections as $section) {
                if (!empty($section->content)) {
                    $raw = is_string($section->content) ? $section->content : json_encode($section->content);
                    $updated = str_replace(['Tnila', 'tnila', 'TNILA'], ['Tnela', 'tnela', 'TNELA'], $raw);
                    if ($updated !== $raw) {
                        DB::table('page_sections')->where('id', $section->id)->update([
                            'content' => $updated,
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        // 3. Update admin user email if it exists
        if (Schema::hasTable('users')) {
            DB::table('users')->where('email', 'admin@tnila.test')->update(['email' => 'admin@tnela.test']);
        }

        // 4. Flush site cache
        if (class_exists(Site::class)) {
            Site::flushCache();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('site_settings')) {
            $settings = DB::table('site_settings')->get();
            foreach ($settings as $setting) {
                $updates = [];
                foreach (['branding', 'contact', 'social', 'seo', 'footer'] as $col) {
                    if (!empty($setting->{$col})) {
                        $raw = is_string($setting->{$col}) ? $setting->{$col} : json_encode($setting->{$col});
                        $updated = str_replace(['Tnela', 'tnela', 'TNELA'], ['Tnila', 'tnila', 'TNILA'], $raw);
                        if ($updated !== $raw) {
                            $updates[$col] = $updated;
                        }
                    }
                }
                if (!empty($updates)) {
                    $updates['updated_at'] = now();
                    DB::table('site_settings')->where('id', $setting->id)->update($updates);
                }
            }
        }

        if (Schema::hasTable('page_sections')) {
            $sections = DB::table('page_sections')->get();
            foreach ($sections as $section) {
                if (!empty($section->content)) {
                    $raw = is_string($section->content) ? $section->content : json_encode($section->content);
                    $updated = str_replace(['Tnela', 'tnela', 'TNELA'], ['Tnila', 'tnila', 'TNILA'], $raw);
                    if ($updated !== $raw) {
                        DB::table('page_sections')->where('id', $section->id)->update([
                            'content' => $updated,
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        if (Schema::hasTable('users')) {
            DB::table('users')->where('email', 'admin@tnela.test')->update(['email' => 'admin@tnila.test']);
        }

        if (class_exists(Site::class)) {
            Site::flushCache();
        }
    }
};
