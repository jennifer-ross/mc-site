<?php

namespace App\Concerns;;

use Awcodes\Curator\Glide\Contracts;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

class PublicServerFactory implements Contracts\ServerFactory
{
    public function getFactory(): ServerFactory|Server
    {
        return ServerFactory::create([
            'driver' => 'gd',
            'response' => new SymfonyResponseFactory(app('request')),
            'source' => public_path('/'),
            'source_path_prefix' => '',
            'cache' => public_path('/'),
            'cache_path_prefix' => '.cache',
            'max_image_size' => 2000 * 2000,
        ]);
    }
}
