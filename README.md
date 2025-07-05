# test

### TESTS

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
