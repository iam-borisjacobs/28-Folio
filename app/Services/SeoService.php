<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SeoService
{
    protected $settings;

    public function __construct(SettingService $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Generate SEO metadata for a page.
     *
     * @param array $pageData
     * @return array
     */
    public function generate(array $pageData = [])
    {
        // Get defaults
        $siteName = $this->settings->get('site_name', 'Folio');
        $tagline = $this->settings->get('site_tagline', '');
        $titleFormat = $this->settings->get('meta_title_format', '%page% | %site%');
        $defaultDesc = $this->settings->get('meta_description_default', '');
        $allowIndexing = $this->settings->get('allow_indexing', '0');
        $socialImage = $this->settings->get('social_image_url', '');

        // Resolve Page Title
        $pageTitle = $pageData['title'] ?? 'Home';
        
        // Format Title
        $title = str_replace(
            ['%page%', '%site%', '%tagline%'],
            [$pageTitle, $siteName, $tagline],
            $titleFormat
        );

        // Resolve Description
        $description = $pageData['description'] ?? $defaultDesc;
        $description = Str::limit(strip_tags($description), 160);

        // Resolve Image
        $image = $pageData['image'] ?? $socialImage;
        if ($image && !Str::startsWith($image, 'http')) {
            $image = asset('storage/' . $image);
        }

        // Canonical URL
        $canonical = $pageData['canonical'] ?? url()->current();

        return [
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'url' => $canonical,
            'site_name' => $siteName,
            'type' => $pageData['type'] ?? 'website',
            'robots' => $allowIndexing == '1' ? 'index, follow' : 'noindex, nofollow',
            'twitter_handle' => $this->settings->get('social_twitter', ''),
            'alternates' => $this->generateAlternates($pageData),
        ];
    }

    protected function generateAlternates($pageData)
    {
        if (isset($pageData['alternates'])) {
            return $pageData['alternates'];
        }

        // Auto-generate for simple routes
        $alternates = [];
        $activeLanguages = app(LanguageService::class)->getActiveLanguages(); // Assumes singleton/bound
        $route = \Illuminate\Support\Facades\Route::current();

        if ($route && $route->getName()) {
            foreach ($activeLanguages as $lang) {
                // Keep all parameters but switch locale
                $params = $route->parameters();
                $params['locale'] = $lang->code;
                
                // If route has 'slug' and we didn't provide explicit alternates, 
                // we risk generating wrong URL if slug is localized and we don't know the translation.
                // So only auto-generate if NO slug parameter, OR if we accept that it might be wrong (better not).
                if (!isset($params['slug'])) {
                     try {
                        $alternates[$lang->code] = route($route->getName(), $params);
                     } catch (\Exception $e) {
                         // Route might not support locale param or other issue
                     }
                }
            }
        }
        return $alternates;
    }

    /**
     * Get injected scripts for head or body.
     */
    public function getScripts(string $location)
    {
        return $this->settings->get("scripts_{$location}", '');
    }
}
