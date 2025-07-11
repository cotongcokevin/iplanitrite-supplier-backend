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

NEED TO RUN docker-phpunit for testing. Below is a guide to install some of the commands that are usually used.

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
function docker-php {
    docker compose run --rm php @args
}

function docker-phpunit {
    docker compose run --rm php php artisan migrate:fresh --seed
    docker compose run --rm php ./vendor/bin/phpunit @args
}

function docker-phpunit-update-snapshots {
    docker compose run --rm php php artisan migrate:fresh --seed
    docker compose run --rm php sh -c "UPDATE_SNAPSHOTS=true vendor/bin/phpunit $args"
}

function docker-pint {
    docker compose run --rm php ./vendor/bin/pint
}
```

Load the commands
```
. $PROFILE
```
