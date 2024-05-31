# Task Developers

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/AbdelrahmanEldesoky/task_rgp.git
    ```

2. Switch to the repo folder:
    ```sh
    cd task_rgp
    ```

3. Install the dependencies:
    ```sh
    composer update
    ```

4. Create the database:
    ```sql
    CREATE DATABASE rgp;
    ```

5. Copy the environment configuration file and set up the application:
    ```sh
    cp .env.example .env
    ```

6. Run the migrations and seed the database:
    ```sh
    php artisan migrate
    php artisan migrate:refresh --seed
    ```

7. Create a symbolic link for storage:
    ```sh
    php artisan storage:link
    ```

8. Start the development server:
    ```sh
    php artisan serve
    ```

9. Admin Email:
    ```sh
    admin@admin.com
    ```

10. Admin passowrd:
    ```sh
    admin
    ```
# task_rgp
