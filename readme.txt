Components/Packages/Scripts used in this project
-------------------------------------------------
Elevator – Metro UI Inspired Free Bootstrap HTML5 Template by graygrids.com
https://graygrids.com/item/elevator-metro-ui-inspired-responsive-bootstrap-template/

Twitter Bootstrap (& Jquery) http://getbootstrap.com/, https://jquery.com/
Font Awesome http://fontawesome.io/

Google Fonts http://fonts.googleapis.com/

Pear2 PHP API Client by boenrobot [Vasil Rangelov, a.k.a. boen_robot (boen [dot] robot [at] gmail [dot] com)]
https://github.com/pear2/Net_RouterOS
https://github.com/pear2/Net_RouterOS/wiki
https://wiki.mikrotik.com/wiki/API_PHP_package
http://pear2.php.net/support/
-------------------------------------------------
Developed by: Siby P Varkey, sibyperiyar@gmail.com
Assistance: Sonal Siby, sonalsiby@gmail.com
-------------------------------------------------
Visual Documentation at : hotspot.helloperiyar.com
-------------------------------------------------
Software and Hardware

As expected: HTML, CSS, JavaScript, PHP, MySql, PDO, Javascript/Ajax, Font Awesome, JQuery, Twitter Bootstrap ... &  PEAR2_Net_RouterOS are the major software component parts of the utility.  Above all the Mikrotik Router OS Based router or PC working with Router OS configured to an IP is the most important Hardware part involved.  

Requirements: Any web server supports PHP 5.x and all the above.
-------------------------------------------------
Prerequisites
A MySql database need to be created prior to operation, if it doesn't exist will be created automatically on initialisation.

The details of the database need to be corrected in the file 'dbconfig.php' file before operation. (Host, DB name, DB Username and DB Password)

The Details of the Router has to be entered in the 'config.php' file before operation. (Host(IP), username and password)
-------------------------------------------------
System Users: Who are operating this utility.
Any number of users can be created by the system Admin.  There are 3 levels of system users, Admin, Unit head and system users. A default system admin with username 'admin' and password 'admin' will be created automatically on initialisation. Admin user can reset passwords of all other users.  On resetting the password, it will be reset to 'password' for that user. All users can change their password using the change password option available in the system users section.

-------------------------------------------------
Documentation and Help
For more details of the opetations and features of the utility please refer the visual documentation available at hotspot.helloperiyar.com
-------------------------------------------------
Major features:

Creation of vouchers for Single person.
Creation of vouchers for Multiple persons.
