Readme.txt

Home Admin website...

File Structure:
/HomeAdmin/
	/css
	/html
	/images
	/js
	/mysql
	/php
		/* reusable objects */
		DataTransfer.php: translates form data to database ready data and back
		DB.php: database access: connects to database and executes sql
		FORM.php: form access: creates arrays to match database records and writes forms in html
		/Forms
	
HomePage - or opening page: 
HomeAdmin/html/HomeAdmin.html (starts the whole thing off...)