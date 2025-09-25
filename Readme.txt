1.Extract the Project Files
Unzip the downloaded project to your desired location.

2.Start Local Server
Launch WAMP or XAMPP and ensure that both MySQL and Apache services are running.

3.Install Dependencies
Open a terminal in the project directory and run:

composer install


4.Run the Development Server
In the same terminal, start the Laravel development server by running:

php artisan serve


5.Migrate the Database
Open a new terminal (still inside the project directory) and run:

php artisan migrate
