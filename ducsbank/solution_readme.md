# DUCS BANK

## index.php
- it's a login page, enter password and go insides

## loginhandler.php
- checks entered username and password => then based on value, set session variable
- redirects to customerIndex.php | managerIndex.php  =>> based on value of this session variable.

## customerIndex.php
- customer info displayed on homepage

## managerIndex.php
- Branch manager info displayed on homepage

# Database schema

## Data

- bank_name =>> Constant => ducs bank


## Tables


- Branches
	- branch_id
	- branch_code - 046
	- branch_ifsc - ICIC00046
	- address
	- email
	- phone

- Managers
	- manager_id
	- branch_id_fk
	- manager_name
	- address
	- email 
	- phone

- Customers
	- cust_id
	- CIF_number
	- cust_name
	- email
	- phone


- Accounts
	- acc_id
	- acc_no
	- cust_id_fk
	- branch_id_fk
	- account_type
	- Balance
	- account_start_date
	- last_login => maybe
	- account status (Active/ Inactive) *


- Beneficiaries
 	- ben_id
 	- acc_id_fk
 	- ben_name
 	- ben_bank_acc_no
 	- ben_bank_IFSC_code
 	- transfer_limit

- Transactions
	- trans_id
	- sender_id
	- receiver_id
	- amount
	- date

# fine points

- password as md5 hash
- user should not be randomly accessing pages
- a manager can view only his branch accounts
- tranfer amount must be less than limit and available amount in account.
