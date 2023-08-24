# Project Name

Welcome to Stream Events Assignment! This repository contains a Laravel project that can list different events for live streaming.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP [>=7.4]
- MySQL or other preferred database system

## Getting Started

To set up and run this project locally, follow these steps:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/mailgagannow/stream-events-assignment.git
   cd stream-events-assignment

   Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the seeder for followers,subscribers,merchant sales,donations
    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

You can now access the events list by accessing the end point at http://localhost:8000/api/events

