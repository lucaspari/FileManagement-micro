# File Management

## Prerequisites

Before you begin, ensure you have the following software installed:

- PHP 8.1
- Composer
- Docker and Docker Compose (WSL is also needed on Windows)

## Getting Started

Follow these steps to set up and run the project:

1. Clone the repository to your local machine:

   ```sh
   git clone https://github.com/lucaspari/FileManagement-micro

2. Install the project dependencies using Composer:.

    ```sh
   composer install

3. Run the Sail binary from the vendor/bin directory to set up the project services and migrate the database:

    ```sh
   vendor/bin/sail up -d
   vendor/bin/sail artisan migrate

This may take a few minutes to complete. Once it's done, you can access the project at http://localhost.
