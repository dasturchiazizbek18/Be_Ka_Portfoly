<?php

namespace App\Models\Concerns;

trait HasTranslations
{
    public function t(string $field, ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $localizedKey = "{$field}_{$locale}";

        if (! empty($this->{$localizedKey})) {
            return (string) $this->{$localizedKey};
        }

        foreach (['uz', 'ru', 'en'] as $fallback) {
            $fallbackKey = "{$field}_{$fallback}";
            if (! empty($this->{$fallbackKey})) {
                return (string) $this->{$fallbackKey};
            }
        }

        return '';
    }
}
