<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

trait Cacheable
{
    /**
     * Retrieves an object from the cache by its ID.
     *
     * @param  int  $id  The ID of the object to retrieve.
     * @return mixed The cached object or null if not found or invalid ID.
     */
    public static function getFromCacheById(int $id): mixed
    {
        if (empty($id) || $id <= 0) {
            return null;
        }

        return Cache::rememberForever(static::getClassName().':'.$id, function () use ($id) {
            return static::whereId($id)->first();
        });
    }

    /**
     * Gets the class name without the namespace.
     *
     * @return string The class name.
     */
    public static function getClassName(): string
    {
        if ($pos = strrpos(static::class, '\\')) {
            return substr(static::class, $pos + 1);
        }

        return static::class;
    }

    /**
     * Caches an object by its ID.
     *
     * @param  int  $id  The ID of the object to cache.
     * @return bool True if the object was cached successfully, false otherwise.
     */
    public static function cacheById(int $id): bool
    {
        if (empty($id) || $id <= 0) {
            return false;
        }

        $obj = static::whereId($id)->first();

        if (empty($obj)) {
            return false;
        }

        return Cache::put(static::getClassName().':'.$obj->id, $obj);
    }

    /**
     * Caches the current object.
     *
     * @return bool True if the object was cached successfully, false otherwise.
     */
    public function cache(): bool
    {
        if (! $this->getCacheKey()) {
            return false;
        }

        return Cache::put($this->getCacheKey(), $this);
    }

    /**
     * Generates a unique cache key for the current object.
     *
     * @return string|null The cache key or null if the object has no ID.
     */
    public function getCacheKey(): ?string
    {
        if (! $this->id) {
            return null;
        }

        return static::getClassName().':'.$this->id;
    }

    /**
     * Removes the current object from the cache.
     *
     * @return bool True if the object was removed successfully, false otherwise.
     *
     * @throws InvalidArgumentException If the cache key is invalid.
     */
    public function removeCache(): bool
    {
        if (! $this->getCacheKey()) {
            return false;
        }

        if (! Cache::has($this->getCacheKey())) {
            return false;
        }

        return Cache::delete($this->getCacheKey());
    }

    /**
     * Retrieves the current object from the cache.
     *
     * @return mixed The cached object or null if not found.
     */
    public function getFromCache(): mixed
    {
        if (! $this->getCacheKey()) {
            return null;
        }

        return Cache::get($this->getCacheKey());
    }
}
