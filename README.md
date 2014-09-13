# Schedules

This is a website intended to be hosted locally that can help you create and keep track of schedules for time management.

## Install

	composer create-project danzabar/schedule-platform directory --prefer-dist

After this you should go to config/database.php and update your mysql (other drivers will be added soon) details. Once you have valid mysql details you can run the command to build the tables, on the command inside the install directory run

	php vendor/bin/doctrine orm:schema-tool:create

This will create the relevant tables. Since this is a website you will need to create a vhost for it. Now you will able to create schedules and keep track of them on your local computer. 

### Contributing

Tools like this will get better with more people contributing, so if you have an idea or improvement and have the ability to, please update this and make it better for everyone. Just be sure to read the documentation and add your name to the contributors file. 
