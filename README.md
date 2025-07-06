# README

## Upgrading Guide
- When PHP, PGSQL, Nginx has updates make sure to update `docker-compose.yml`
- For laravel update the `composer.json`
  - Also check if there are updates with `pint`
  - If yes need to update the `.github/workflows/pint.yml` to the new php version.

## Admin Section Contains:
- Users
    - (Not for now) Roles & Permissions
- Company
    - Subscriptions

## LAYER GUIDE
- Controllers > Services
  - receives request from frontend
  - converts the request to Dto
  - pass the Dto to service
- Services > Repositories
  - receives Dto from controllers
  - converts to RepoData
  - pass the RepoData to repositories
- Repositories > Services
  - receives RepoData from services
  - returns ModelData to services
- Services > Controllers
  - Returns the ModelData to services
- Controllers
  - Converts the ModelData to dto

## TESTS GUIDE

Tests has a custom bootstrapper in phpunit.xml 
`bootstrap=tests/bootstrap.php` Which we create all data that we need for testing.

Create the $PROFILE file if not does not exist
```
if (!(Test-Path -Path $PROFILE)) { New-Item -Type File -Path $PROFILE -Force }
```

Create Custom Command for Easy Testing
```
Set-ExecutionPolicy -Scope CurrentUser RemoteSigned
```

To edit 
```notepad $PROFILE```

```
function dockerRunTest {
    docker compose run --rm php php artisan migrate:fresh --seed
    docker compose run --rm php ./vendor/bin/phpunit @args
}

function dockerArtisan {
    docker compose run --rm php php artisan $args
}

function dockerRemigrate {
    docker compose run --rm php php artisan migrate:refresh --seed
}
```

Load the commands
```
. $PROFILE
```
