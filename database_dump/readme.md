# DUCS BANK

## Database schema

- Branches
	- branch_id
	- branch_code - 011
	- branch_ifsc - DUCS00011
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
	- account status (Active/ Inactive)

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

