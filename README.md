# MC

Here lives a beautiful starting point to quickly bootstrap your next [TALL stack](https://tallstack.dev/) application utilizing [Filament](https://filamentphp.com/) for the admin panel.

## Requirements

Make sure all dependencies have been installed before moving on:

- [PHP](https://secure.php.net/manual/en/install.php) >= 8.4
- [Composer](https://getcomposer.org/download/)
- [Node.js](http://nodejs.org/) >= 18
- [Npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm?ref=meilisearch-blog)

## Getting Started

Configuring the `.env` file:

```sh
mv .env.example .env
```

After `.env` is configured, you can proceed to migrate & seed the database:

```sh
php artisan migrate:fresh --seed
```

Once the database is seeded, you can login at `/admin` using the default admin user:

```yaml
Username: admin
Password: admin
```

### Build Assets

The project assets are compiled using Vite. This can be done by installing the dependencies and running the build command with Npm.

```sh
npm install
npm build
```

## Plugins Used for Admin

The following [Filament plugins](https://filamentphp.com/plugins) come fully implemented and configured out of the box:

| **Plugin**                                                                           | **Description**                                                                    | **Author**                                      |
|:-------------------------------------------------------------------------------------|:-----------------------------------------------------------------------------------|:------------------------------------------------|
| [Curator](https://github.com/awcodes/filament-curator)                               | A beautiful media library.                                                         | [awcodes](https://github.com/awcodes)           |
| [Gravatar](https://github.com/awcodes/filament-gravatar)                             | Easy avatar integration powered by Gravatar.                                       | [awcodes](https://github.com/awcodes)           |
| [Exceptions](https://github.com/bezhansalleh/filament-exceptions)                    | A simple but powerful Exception viewer.                                            | [bezhansalleh](https://github.com/bezhansalleh) |
| [Jobs Monitor](https://github.com/croustibat/filament-jobs-monitor)                  | Easily monitor background jobs and their progress.                                 | [croustibat](https://github.com/croustibat)     |
| [Peek](https://github.com/pboivin/filament-peek)                                     | Quick & efficient front-end previews of resources.                                 | [pboivin](https://github.com/pboivin)           |
| [Logger](https://github.com/z3d0x/filament-logger)                                   | Zero-config resource activity logging.                                             | [z3d0x](https://github.com/z3d0x)               |
| [Spatie Laravel Backup](https://github.com/shuvroroy/filament-spatie-laravel-backup) | Create backup of your application                                                  | [shuvroroy](https://github.com/shuvroroy)       |
| [Resource Lock](https://github.com/kenepa/resource-lock)                             | Adds resource locking functionality to your site.                                  | [kenepa](https://github.com/kenepa)             |
| [Shield](https://github.com/bezhanSalleh/filament-shield)                            | The easiest and most intuitive way to add access management to your Filament Admin | [bezhanSalleh](https://github.com/bezhanSalleh) |

## License

Provided under the [MIT License](LICENSE).
