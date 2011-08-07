set :application, "mlpz"
set :domain,      "#{application}.mp"
set :deploy_to,   "/usr/share/nginx/www/#{application}"
set :app_path,    "app"


set :php_bin, "/usr/sbin/php5-fpm"
set :use_sudo, false
set :user, 'ubuntu'
set :repository,  "https://github.com/miguel250/#{application}.git"
set :git_enable_submodules, 1
set :deploy_via, :remote_cache
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, `subversion` or `none`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Rails migrations will run

set  :keep_releases,  3