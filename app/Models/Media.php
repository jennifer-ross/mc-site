<?php

namespace App\Models;

use App\Concerns\Cacheable;
use App\Observers\MediaObserver;
use Awcodes\Curator\Models\Media as CuratorMedia;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

#[ObservedBy([MediaObserver::class])]
class Media extends CuratorMedia
{
    use Cacheable;

    protected function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! config('curator.should_check_exists', true)) {
                    return Storage::disk($this->disk)->url($this->path);
                }

                if (Storage::disk($this->disk)->exists($this->path) === false) {
                    return '';
                }

                try {
                    $isPrivate = Storage::disk($this->disk)->getVisibility($this->path) === 'private';
                } catch (\Throwable) {
                    // ACL not supported on Storage Bucket, Laravel only throws exception here so need to be careful.
                    // so we assume it's private
                    $isPrivate = config(sprintf('filesystems.disks.%s.visibility', $this->disk)) !== 'public';
                }

                return $isPrivate ? Storage::disk($this->disk)->temporaryUrl(
                    $this->path,
                    now()->addMinutes(5)
                ) : Storage::disk($this->disk)->url($this->path);
            },
        );
    }
}
