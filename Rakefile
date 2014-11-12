env =  ENV['APPLICATION_ENV']

desc "Update all packages"
multitask :packages  => ['packages:bundle','packages:composer']
namespace :packages do
  task :bundle do
    system "bundle install"
  end
  task :composer do
    system "composer install -o"
  end
end

desc "Assets"
task :assets do
    system("php app/console assets:install web")
end

desc "Cache"
task :cache do
    system("php app/console cache:clear --env='#{env}'")
end

desc "Doctrine"
task :doctrine => ['doctrine:clear',]
namespace :doctrine do
   desc "Clear doctrine cache"
   task :clear do
      system("php app/console doctrine:cache:clear-metadata --env=#{env}")
      system("php app/console doctrine:cache:clear-query --env=#{env}")
      system("php app/console doctrine:cache:clear-result --env=#{env}")
   end
   desc "Create DB"
   task :createDB do
        system("php app/console doctrine:database:create")
   end
   desc "Update Schema"
   task :updateSchema do
        system("php app/console doctrine:schema:update")
   end
end


task :default => ['packages', 'assets', 'cache', 'doctrine']
