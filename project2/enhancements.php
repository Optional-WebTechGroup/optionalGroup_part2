Page Written by Nikolas Popovic (Stu No. 105920284)

I began by making a login/logout function. I added the login, logout and signup.php files. These included the 
necessary code for the login, logout and signup functions, which are all connected to the users table in our group database

Next I helped with adding code for resctricted access to the manage.php page through the validation code on each
of the pages, to restrict access to users without permission to the manage page. 

I added a control access to the manage.php page. Rather than restricting it to a username or a password,
I added another field in the users table in our database which included a status field. Therefore, users who
has this true will gain access to the manage.php tab/page 

In the login page some code was also added to implement a timer function which restricts users for a certain amount of time
if they have attempted to login too many times. This lasts for the session, so even if they try to reload the page
they will not be able to log in until the set time has elapsed