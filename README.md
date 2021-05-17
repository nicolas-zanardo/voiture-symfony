# SITE DEMO SYMFONY 5

## installation Procedure

```bash
# 1 - Git clone
git clone git@github.com:nicolas-zanardo/voiture-symfony.git

# 2 - Install vendor
composer install 

# 3 - Create a file .env.local
DATABASE_URL="mysql://YOUR_USERNAME:YOUR_PASSWORD@127.0.0.1:3306/cars_park"
APP_ENV=dev
APP_SECRET_LOCAL=f326d1a00dc7227ae196b7eb6faee7ec

# 4 - Create database
php bin/console doctrine:database:create

# 5 - Migration
php bin/console doctrine/migrations:migrate

# 6 - Create DATA Fixture
php bin/console doctrine:fixtures:load

# 7 - create USER on website

# 8 - Give administrator access rights
sudo mysql -u root -p
use cars_park
UPDATE user SET roles = 'ROLE_ADMIN' WHERE id = YOUR_ID;
# If you don't know your ID 
SELECT * FROM user 
```