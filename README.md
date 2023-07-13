# Steeldoor

Job Board. The basic idea is that a company can publish any job opportunities they're trying to fill, and job-seekers can take a look at them and apply.

## Prerequisites

Make sure you have the following prerequisites installed on your system:

- PHP (version ^7.3)
- Composer (version ^2.0.8)
- Node.js (version ^20.4.0)
- MySQL 

## Installation

Follow these steps to install and set up the project locally:

1. Clone the repository:

   git clone https://github.com/cranez91/steeldoor.git

2.- Navigate to the project directory
   
    cd steeldoor

3.- Install PHP dependencies with Composer:

    composer install
    
4.- Create an .env file from the .env.example file and configure the necessary environment variables (e.g., database connection).

5.- Generate a unique application key

    php artisan key:generate

6.- Run the migrations to create the database tables:

    php artisan migrate

7.- Run the seeder to be able to see a list of jobs:

    php artisan db:seed --class=JobOpportunitySeeder

8.- Install JavaScript dependencies with npm:

    npm install

9.- Compile the assets:

    npm run dev

10.- Start the Laravel development server:

    php artisan serve
    
11.- Open your web browser and navigate to http://localhost:8000 (or the port shown in the console).
