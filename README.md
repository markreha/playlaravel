# A simple PHP Laravel application that can be used for testing in various Cloud Platforms like Azure and Heroku. See the following directions for deploying a PHP or PHP Laravel application to Azure, AWS, Heroku, and Google Cloud.

## Deployment to Cloud Platform Instructions
## Azure
1. Log into the Azure Portal. 
2. Click the '+ Create a resource' icon from the Azure Portal.
3. From the 'Search the Marketplace' search box select Web App + MySQL option. Click the Create button, give your App a name, make sure the Microsoft Azure for Students subscription is selected, and click the Create button. After a few minutes your application will be created. It is advised that you pin this application to your Dashboard. 
NOTE: with the Azure for Students Starter account you can only provision 2 containers in the same App Service Plan (i.e. within the same Region). If you provision more than 2 containers Microsoft will shut down all your applications. You will then either have to delete some of your applications or simply use a different region when you create your application.
4. Open your application from your Dashboard by clicking on it from your Dashboard. Select the Overview menu from the left pane and then click the URL from the right pane to open your application. Make sure the default Microsoft Azure Developer page is displayed. This is an important step! This will ensure that phpMyAdmin is accessible via single sign on. phpMyAdmin DOES NOT require any credentials to log in. If you get prompted for credentials, then access your application via its URL and/or simply wait and try again
5. Click on the Configuration menu from the left pane. Click the General Settings tab. Select the PHP stack and the version of PHP being used in your application development. It should be noted that the version of PHP you select needs to be compliant with the version of Laravel you are using. For example, if you are using Laravel 5.5.28 then your safest know working version of PHP should be 7.1
Initialize the MySQL Database:
Open your application.
    * Under the Settings section click the MySQL In App icon, make sure your Database is enabled, and click the Manage icon to open phpMyAdmin. Import your Database DDL.
    * Under the Development Tools section click the Console icon.
    * Navigate to the D:\home\data\mysql directory and display the ‘MYSQLCONNSTR_localdb.txt' file using the type command to get your MySQL Connection Properties. Note the DB connection information to get your DB hostname, post, and credentials.
6. Build and Deploy your Application:
    * Make sure you have built your PHP or PHP Laravel Project with the right version to match the version of PHP you are using.
    * Update your MySQL Database Connection properties in your application (note your hostname will need to be formatted as hostname:port).
    * For the local PHP Laravel codebase make sure to copy the web.config from the public directory to the root of your project.
    * For the local PHP Laravel codebase zip up your PHP project into a file named [appname].zip.
NOTE: make sure to zip up all of the hidden files and ensure the .env file is included as this is a required file to run a Laravel application.
    * Under the Development Tools section click the Advanced Tools icon, select the Go link, and select the Tools->Zip Push Deploy menu.
    * Delete the Azure created default files from the application (if they exist).
    * Drag and drop your zip file onto the page.

## Heroku
1. Create app in Heroku:
    * Click Create App button from the main page. Give your application a name. Click the Create App button.
    * On the Project page, select the Deploy Tab, and link your application to your GitHub repository (BitBucket is not supported on Heroku). If you are not using GiHub, you can either copy your BitBucket repository to GitHub or use the Heroku CLI, as documented below.
    * On the Project page, select the Settings Tab, click the Add Buildpack button, for PHP click the PHP button, click the Save Changes button.
    * On the Project page, select the Resources Tab, under the Add-ons search for JawsDB MySQL, select JawsDB MySQL from the search list, select the Free plan, click the Provision button.
NOTE: If you fail to connect too many times to the database Heroku may lock you out from connecting to your database. If you repeatedly cannot connect to your database and are sure your configuration is correct, then delete your current JawsDB MySQL database Add-on and add a new JawsDB MySQL database.
2. Update your App Configuration as necessary:
    * Update the database configuration parameters in your code.
    * For non-Laravel apps add an empty file (one with just { } as contents) named composer.json to your GitHub repository.
    * You can set the version of PHP using the following entry in your composer.json file: "require": { "php": "^7.1.0" }
    * See Heroku PHP Support located at https://devcenter.heroku.com/articles/php-support 
3. Connect MySQL Workbench to the instance of MySQL Database. Run your DDL Script to configure the database.
4. You can deploy your application either thru the Heroku GIT Repository or by using your own GitHub or Bitbucket GIT repository. Follow either steps 5 or 6 below.
NOTE: make sure to include all of the hidden files and the vendor folder in your GIT repository (you might need to modify the .gitignore file) and ensure the .env file is included as this is a required file to run a Laravel application. This should also be tested by cloning your GIT repository as a zip file, then deploying the clone files to your local MAMP, and validating that the application functions properly from the cloned repository. 
5. To deploy using the Heroku GIT repository use the following steps:
    * Clone the Heroku GIT repository provided by Heroku (go to your App Settings to get the URL).
    * Update your App Configuration as noted above.
    * Push your code from your local repository to the Heroku GIT repository.
    * Test the app: https://[APP NAME].herokuapp.com.
6. To deploy using your GitHub repository and a Build Pipeline use the following steps:
    * Update your App Configuration as noted above and push the changes to your GitHub repository.
    * Create Heroku Pipeline and add your PHP app to it.
    * Go to your Heroku Pipeline and click on your PHP app, select the Deploy menu option, and make sure the Enable Automatic Deploys is enabled from your master branch.
    * Start a Build by performing either of one the following operations:
7. Go to your Heroku Pipeline and click on your PHP app, select the Deploy menu option, and then click the Deploy Branch button.
8. Push a code change to your GitHub repository.
    * Test your app at: https://[APP NAME].herokuapp.com.

## AWS
1.	Log into AWS and select Services from the main menu.
2.	Select RDS.
3.	Under the Create database section click the Create database button.
4.	Select the MySQL engine option and the 5.6 version edition radio button. Check the 'Enable options for free tier'. Click the Next button.
5.	Fill out the Specify DB details form:
    * From Settings enter DB instance identifier enter instance name (i.e., mydatabaseinstance).
    * From Settings enter Master username and password.
    * Click the Next button.
    * Leave all defaults in the Configure advanced settings form.
6.	From the RDS Dashboard select your database instance.
    * Your database URL is listed under the Connect section under the Endpoint value.
    * Make your database accessible from a Java application by clicking the Security groups link under the Details section for the database.
    * In the Security Group setup select the Inbound Tab. Click the Edit button. Under the Source dropdown select the Anywhere option.
    * In MySQL Workbench setup a connection using the AWS Database Endpoint URI and credentials. Create the 'cst-323' schema and tables by running the DDL script created from your development environment.
7. Create and Configure the AWS PHP Application:
    * Update app code in source control:
        * It is possible to set environment specific configuration in your .env file for a PHP Laravel project.
    * Log into AWS and select Services from the main menu.
    * Select Elastic Beanstalk service.
    * Click the 'Create new Application' link from the top right menu.
    * Give your Application Name (i.e., TestApp). Click the Create button.
    * Create your Application Environment by clicking the 'Create one now' link.
    * Select the 'Web server environment' and click the Select button.
    * Fill out the following fields in the Creating web server environment form:
        * From Environment Information Domain: Give your Application a name (i.e., test-app).
        * From Base configuration: Select PHP from the Preconfigured platform options. Upload a ZIP file of your PHP application.
        * Click the Create Environment button. Wait for environment to get built.
        * From the Elastic Beanstalk application screen click the App URL to validate application is running properly.
8. Deploy Manually:
    * Create a ZIP file with all your code (make sure to update APP_ENV to amazon in .env).
    * Log into AWS and select Services from the main menu.
    * Select Elastic Beanstalk. Select your Application.
    * Click the Upload and Deploy button. Upload your ZIP file and give your build a label. Click the Deploy button.
9. Deploy using a AWS Code Pipeline:
    * Add a buildspec.yml to the root of your application code.
    * Log into AWS and select Services from the main menu.
    * Select the CodePipeline service.
    * Click the Create Pipeline button.
    * Give your pipeline a name (i.e., TestAppPipeline). Click the Next step button.
    * Select GitHub from the Source provider dropdown. Click the Connect to GitHub button and select your repo and master branch. Click the Next step button.
    * Select AWS CodeBuild from the Build provider dropdown. Select the Create a new build project option. Give your build a name. Select Ubuntu operating system with the Base runtime.
    * Create a Service Role with a name (i.e., testapp-build-role)
    * Click the Save build project button. Click the Next step button.
    * Select AWS Elastic Beanstalk from the Deployment provider dropdown. Choose your Application and Environment from the dropdowns. Click the Next step button.
    * Create an AWS Service Role. Click the Next step button.
    * Click the Create pipeline button.
    * To build and deploy your application:
    * Select the CodePipeline service from the Services dashboard. Open the Pipeline.
    * Either make a change to code in GitHub or click the Release change button to start a build and deployment.
10.	To access your application:
    * Select the Elastic Beanstalk service from the Services dashboard. Open your Application.
    * Test your application: https://[APP NAME].[AWS REGION].elasticbeanstalk.com/

## Google Cloud
1. Create an App Engine application of type PHP using the following steps:
    * Select App Engine from the Main Menu.
    * Click the ‘Select a Project’ dropdown list and then click the New Project icon.
    * Give your Project a Name and click the Create button.
    * From the Welcome to App Engine screen click the Create Application button.
    * Select a Region from the US and click the Create App button.
    * Select PHP from Language list and a Flexible Environment. Click the Next button.
2. Clone your Application Code from GIT (from Google Cloud Shell) using the following steps:
    * Open up a Cloud Shell from the Activate Cloud Shell icon in the top menu. From the Cloud Shell perform the following operations.
        * NOTE: if you click on the Pencil icon this will open a tree view of your code, which allows you to edit some of your configuration files.
    * Run the following command from the Cloud Shell:
        * git clone [URL to your Test App Repo] 
3. Configure your application using the following steps:
    * Add an app.yaml configuration for a PHP app into the root directory of the application. In order to get MySQL database connectivity, you must add the following entry and replace the cloud_sql_instances setting with the Instance Connection Name for your MySQL database instance. There are sample files available in the Google Cloud documentation or one can be provided by your instructor.
 
    * To Update your APP_KEY in the app.yaml run: php artisan key:generate --show
    * NOTE: Apache Web Server is not used in Google App Engine so the public rewrite rule is invalid, you must set your document_root to public and copy all JS, CSS, and IMG from /resources/assets to /public/resources/assets.
    * If using PHP Laravel you can update environment specific configuration in the .env file. Refer to Run Laravel on Google App Engine Flexible Environment
    * Update composer.son require section (PHP v7.2 does not work at this point), ensure your Laravel version is correct, and run the following post install commands (for non-Laravel PHP applications see the notes below):
"require": {
        	"php": "7.1.*",
        	"laravel/framework": "5.4.*",
        	"laravel/tinker": "~1.0"
    },

	            "post-install-cmd": [
			"Illuminate\\Foundation\\ComposerScripts::postInstall",
			"mkdir -p bootstrap/cache",
			"chmod -R 755 app bootstrap storage",
			"mkdir -p storage”,
			"mkdir -p storage/app",
			"mkdir -p storage/framework/cache",
			"mkdir -p storage/framework/sessions",
			"mkdir -p storage/framework/views",
			"mkdir -p storage/logs

	],			

    * NOTE: if you are deploying a non-Laravel application then you must configure the runtime_config section in your yaml.xml as shown below, replacing the cloud_sql_instances setting with the Instance Connection Name for your MySQL database instance, and make sure you copy all your PHP code files into a public direction in your project.
 
    * NOTE: if you are deploying a non-Laravel application then you must configure the composer.json file as shown below and set the version of PHP accordingly.
 
4. Create the MySQL Database Container and initialize the schema in the Google Cloud Platform using the following steps:
    * Select SQL menu item from the Main Menu.
    * Select MySQL Database Engine and click the Next button.
    * Select the MySQL Second Generation type.
    * Fill out the Instance ID, root password, region, and click the Create button.
    * Expand the Show Configuration Options. Select the desired MySQL version under the ‘Choose data version” dropdown. Expand the ‘Configure machine type and storage’ dropdown. Click the Change button. Select the db-f1-micro under the Shared-core machines options. Click the Select button. NOTE: it is extremely important that these options are set to avoid being charged by Google for your database usage.
    * Open the instance of the new Database and note your Public IP Address.
    * Select the Users menu and then create a new user [DB_USERNAME]/[DB_PASSWORD] that is available for all hosts. Click the Create button.
    * Select the Database menu and then create a new Database (your schema).
    * Get your public IP Address by going to your browser and in the search bar enter ‘My IP’. Note your IP Address for the next step.
    * Select the Connections menu and under Authorization Networks click Add Network button, name of GCU, network of your IP Address (from previous step), click Done and Save buttons.
    * Setup a MySQL Workbench connection using the databases IP address (listed in the Overview menu) and your database credentials (setup from the prior step).
    * Connect to the database in MySQL Workbench and run your DDL script.
    * In the main Google menu go to APIs & Services, click on the Library menu, search for Google Cloud SQL, and make sure both Cloud SQL and Cloud SQL Admin API are enabled.
        * Update your database configuration for your application.
5.	Build and deploy your application using the following steps:
    * Open your Cloud Shell
    * cd to your cloned project root directory
    * Optionally Test locally in Shell: php -S 0.0.0.0:8080 -t ./
    * Deploy to App Engine: gcloud app deploy
        * Test at https://[PROJECT_NAME].appspot.com/
        * To view application logs you can go to the Home menu item and go under the Error Reporting section to view your most recent errors.
        * To view application logs go to App Engine Versions and select Logs from the Tools dropdown.




