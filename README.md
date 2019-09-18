# houses

  login: admin 
  pass: robot

  git clone https://github.com/atyagin/houses.git
  
  composer install
  
  npm install
  
  ./node_modules/.bin/encore dev
  
  database setting -  .env
  
  bin/console doctrine:database:create
  
  bin/console make:migration
  
  bin/console doctrine:migrations:migrate
  
  bin/console doctrine:fixtures:load
  
  
