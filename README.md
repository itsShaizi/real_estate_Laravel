## About Realtyhive

Realtyhive is a real estate company from Wiswonsin specialized in live auction events and marketing initiatives

## Setting up a local environment

after cloning the project, in order to recreate the local environment you need this .env file:

```
APP_NAME=RealtyHive
APP_ENV=local
APP_KEY=base64:tyT66qh8dlDgqYriIdd/JD1onx3q9DbzHidLINOvAPS=
APP_DEBUG=true
APP_URL=http://localv2.realtyhive.com

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=micoley
DB_USERNAME=micoley_user
DB_PASSWORD="yourpasswordforlocalenv"

#BROADCAST_DRIVER=redis
BROADCAST_DRIVER=pusher
CACHE_DRIVER=redis
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_CLIENT=predis

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=e6ba39b91130de
MAIL_PASSWORD=4f87a6487dbf04
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=contact@realtyhive.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=1235778
PUSHER_APP_KEY=463f9b84e136e0d07bd1
PUSHER_APP_SECRET=b49173b2b1e077779c81
PUSHER_APP_CLUSTER=us2

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

LISTHUB_API_KEY=realtyhive
LISTHUB_API_SECRET=90b04396c3e3ac54ce9a422b24adf24dc3e8f63c6fb3698c24932ad760be1427

#hubspot dev key:
HUBSPOT_API_KEY=2f9d4fc4-e3c5-41e1-a5a0-eb6265ed0a76
#HUBSPOT_API_KEY=production key

GOOGLE_MAPS_API_KEY=AIzaSyBqCLn0PkcVlSXmRMFBYWYvoB58UHjV7dw
GOOGLE_MAPS_API_KEY_BE=AIzaSyAsgbRv6Yd1mr4Xl6y39daFCzUZPXOo8VI
GOOGLE_RECAPTCHA_SECRET=6LdhVFcUAAAAAG_gjcl3jL_C0YOna3iW8LPy8XvS
GOOGLE_RECAPTCHA_KEY=6LdhVFcUAAAAAEZ0UgazY_9-Rpo735lDFemyzOqN

#Scout config
#this is to use the local db, remove to use algolia
#SCOUT_DRIVER=collection
#algolia credentials
ALGOLIA_APP_ID=0UHNAUUZ8H
ALGOLIA_SECRET=f7b8c13ebe2ec94a83e619d1363dea94
```

then:

- change the local DB credentials accordingly
- change the Mailtrap credentials
- run a migration
- run composer install
- php artisan storage:link

then you will need to import some listings:

`php artisan import:listings`

^ this is a very long process, please stop the process after a few records are added since there's around 60K records, and you only need to have a few tens of them in order to be able to work

then to sync with Algolia (export to an external search index):
`php artisan scout:import "App\Models\Listing"`

you will also need to have your local host (in linux or mac edit /etc/hosts) with the domain name **realtyhive.com** in order for Google not to block your requests to the Maps API: in my case I have it as: **localv2.realtyhive.com**

after that, just create yourself an account: (go to `/register` URI)

and then login, and then change your user's role to 1 so you can access the back-end dashboard (`/agebt-room`):

`update users set role_id = 1 where email = 'YOUREMAIL';`

If your setup is correct, you should be able to see some listings in `LOCAL_URL/agent-room/listings`

PS: don't forget about composer and npm to make sure you have everything you need, and also create the symlink: `php artisan storage:link` so the storage folder is linked to the publicly accessible directory


## GIT flow

regarding the git workflow we use:
Every new feature or task you are given, you start with a **new branch**. And before pushing your branch **make sure to pull from master** to resolve any conflicts locally since master is changing due to other merges and direct pushes (in my case).
so your workflow is...

- you start working on a feature so you create a new branch locally;
- you can be committing locally without pushing to the remote repo as you progress through the task,
- and when you are done with the feature/task/bug-fix, after your last commit, you need to pull from master,
- resolve any conflicts,
- and then commit the merge with conflict resolution (if any)
- and then push the new branch to the remote repo.

At that point I'll check the code and merge your branch with master and then delete your branch.

### Other considerations

In your IDEs plase make sure you use 4 spaces when using a tab key.

