# Sistem Pengurusan Pertandingan Catur (SPPC)

SPPC is a program to manage chess competitions (round robin). The system language is Malay.

## Installation
❗ xampp is required

⚠️ path and url can differ based on operating system

1. Start xampp.
2. Save and unzip this folder in ```C:/xampp/htdocs/``` 
    - Additionally, you can move the inner folder to htdocs, then rename it to something shorter
3. Create a database in phpMyAdmin through localhost in your browser ```http://localhost/phpmyadmin/```
4. In sambungan.php, change the database name to the name of the database you created earlier. ```$database = 'database_name';```
5. Go to login.php through localhost in your browser. ```localhost/folder_name/login.php```

## Progress
### DATABASE (TABLES)
- urusetia #COMPLETE
- hakim #COMPLETE
- peserta #COMPLETE
- scores #COMPLETE
- matches #COMPLETE

### PAGES
- login.php #COMPLETE #CHECKED
- info.php #COMPLETE
- urusetia.php #COMPLETE #CHECKED
- hakim.php #COMPLETE #CHECKED
- peserta.php #COMPLETE #CHECKED
- pusingan.php #COMPLETE #CHECKED
- keputusan.php #COMPLETE #CHECKED

### COMPONENTS
- styles.css #COMPLETE
- head.php #COMPLETE
- header.php #COMPLETE
- navbar_1.php #COMPLETE
- navbar_2.php #COMPLETE
- sambungan.php #COMPLETE
- log_keluar.php #COMPLETE
- algorithm.php #COMPLETE

## Screenshots
![alt text](screenshots/login.png)
![alt text](screenshots/info.png)
![alt text](screenshots/hakim.png)
![alt text](screenshots/peserta_sebelum.png)
![alt text](screenshots/peserta_selepas.png)
![alt text](screenshots/pusingan_sebelum.png)
![alt text](screenshots/pusingan_selepas.png)
![alt text](screenshots/keputusan.png)
![alt text](screenshots/urusetia.png)
