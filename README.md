**SQL Import Script**

This script automates the process of importing SQL files into a MySQL server. It iterates through a specified directory, creates databases if they don't exist, and checks for the presence of tables before importing the SQL file.

**Prerequisites:**

- A MySQL server installed and accessible.
- PHP installed and configured.

**Usage:**

1. **Download the Script:**
   Download the PHP script `import_databases.php` and save it to a location of your choice.

2. **Configuration:**
   Open the script in a text editor and update the following variables:

   ```php
   $directory = 'path/to/sql/files'; // Update with the actual path of your SQL files
   $host = 'your_mysql_server_host';
   $username = 'your_mysql_username';
   $password = 'your_mysql_password'; // Update if you have a password
   ```

   Ensure that `$directory` is set to the path where your SQL files are located.

3. **Run the Script:**
   Open a terminal or command prompt, navigate to the directory where the script is located, and execute the following command:

   ```bash
   php import_databases.php
   ```

   The script will start importing SQL files, creating databases if necessary, and checking for existing tables.

**Script Logic:**

- **Database Creation:**
  - Checks if the specified database in the SQL file exists.
  - If not, creates the database using the `CREATE DATABASE IF NOT EXISTS` statement.

- **Table Check:**
  - Checks if the database already contains tables.
  - If not, imports the SQL file using the MySQL command.

- **Output:**
  - Provides feedback on the actions taken, such as creating databases, importing files, or skipping based on existing tables.

**Notes:**

- Ensure the MySQL server is running, and PHP is configured to connect to it.
- Customize the script according to your specific MySQL server environment if needed.

**Example:**

```bash
php import_databases.php
```

This executes the script, displaying output messages indicating progress and actions taken.

Feel free to reach out if you encounter any issues or have further questions.

---
