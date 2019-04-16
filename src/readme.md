# DUCS BANK

## Source

- `dbconnection.php`
  - enter your database credentials here

- `index.php` 
  - it's a login page, enter password and go inside

- `loginhandler.php`
  - checks entered username and password => then based on value, set session variable
  - redirects to customerIndex.php | managerIndex.php  => based on value of this session variable.

- `customerIndex.php`
  - customer info displayed on homepage

- `managerIndex.php`
  - Branch manager info displayed on homepage

## Points to note

- password as md5 hash
- user should not be randomly accessing pages
- a manager can view only his branch accounts
- transfer amount must be less than limit and available amount in account.
