

1. DEFAULT PARAMETER
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(8),
@record_count AS INT

2.naming (best practice)
SP: [wiss]_[company]_[system]_[report]
API: [wiss]-_[company]-[system]-[report]


Note
1. Database config at config/database
2. .env keep database name constance for database config
3. .env uploads to git as .env.example (after pull git, need to rename .env.example to .env)


