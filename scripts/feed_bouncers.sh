#!/bin/sh

#curl 'http://localhost:8000/api/bouncers' -H 'Cookie: XSRF-TOKEN=eyJpdiI6Imx1MGVCVFVNdXlUY0E1YkNOYnFtZ2c9PSIsInZhbHVlIjoiZUJWUVE3SFYyeWo0MFBLQWZcL1V5TUJHUW1ZWGNDTHIwNEJ1bkQ2c05KSnJhU3BwYTVzMk5hdjJVUFZZbnNFMzlFZW5EWWtEWGpGRVl0QkZScWsrVnRRPT0iLCJtYWMiOiIzMGRlNTU4ZGE0NmI3MzRjYjE2NTViYjQ3MTdmZTQ0OGU1ZDdjZDk2Zjc5MzI2NDdkM2M3ZDMxY2FkN2Y5OTRhIn0%3D; laravel_session=eyJpdiI6IlI4VGdCVzVsaUltbGJSQnlGMHdiaGc9PSIsInZhbHVlIjoiRlFCcThGdDJieWRpUUswSzZCbGdIR3gxNVNyT0c3T3hCZHAydWhpbVBUcWYzTzMxUWJyenRRWW1Pd2ROWmo4VUswQlhlVE1RanJDb2RlMTFCZDR6K0E9PSIsIm1hYyI6IjlmZjliZmM4NTE3ZjM2OTUxOTkyMzBiOGQyYWJjNzU2ZjFmOWEwZDgzY2ExYjhiZWFkNTY1YTRiOTk2YmRjYzMifQ%3D%3D' -H 'Origin: http://localhost:8000' -H 'Accept-Encoding: gzip, deflate, br' -H 'X-Requested-With: XMLHttpRequest' -H 'Accept-Language: en,en-US;q=0.9,nl;q=0.8,af;q=0.7,fr;q=0.6' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTIzMTc3MTUsImV4cCI6MTUxNzUwMTcxNSwibmJmIjoxNTEyMzE3NzE1LCJqdGkiOiJaUXNSWFRpVmxtY2d0dkZsIn0.mCHqvFp4yM01NLrHLv8zHXDsxsEsufbhVnDM2WkrVzY' -H 'Content-Type: application/json' -H 'Accept: */*' -H 'Referer: http://localhost:8000/console' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36' -H 'Connection: keep-alive' --data-binary '{"label":"bouncer2","category_id":"0","priority":0,"description":"First test bouncer", "dsn": "postgresql://gplas:2Hot4u22..!!@192.168.26.24:5432/pgbouncer"}' --compressed

#curl 'http://localhost:8000/api/bouncers' -H 'Cookie: XSRF-TOKEN=eyJpdiI6Imx1MGVCVFVNdXlUY0E1YkNOYnFtZ2c9PSIsInZhbHVlIjoiZUJWUVE3SFYyeWo0MFBLQWZcL1V5TUJHUW1ZWGNDTHIwNEJ1bkQ2c05KSnJhU3BwYTVzMk5hdjJVUFZZbnNFMzlFZW5EWWtEWGpGRVl0QkZScWsrVnRRPT0iLCJtYWMiOiIzMGRlNTU4ZGE0NmI3MzRjYjE2NTViYjQ3MTdmZTQ0OGU1ZDdjZDk2Zjc5MzI2NDdkM2M3ZDMxY2FkN2Y5OTRhIn0%3D; laravel_session=eyJpdiI6IlI4VGdCVzVsaUltbGJSQnlGMHdiaGc9PSIsInZhbHVlIjoiRlFCcThGdDJieWRpUUswSzZCbGdIR3gxNVNyT0c3T3hCZHAydWhpbVBUcWYzTzMxUWJyenRRWW1Pd2ROWmo4VUswQlhlVE1RanJDb2RlMTFCZDR6K0E9PSIsIm1hYyI6IjlmZjliZmM4NTE3ZjM2OTUxOTkyMzBiOGQyYWJjNzU2ZjFmOWEwZDgzY2ExYjhiZWFkNTY1YTRiOTk2YmRjYzMifQ%3D%3D' -H 'Origin: http://localhost:8000' -H 'Accept-Encoding: gzip, deflate, br' -H 'X-Requested-With: XMLHttpRequest' -H 'Accept-Language: en,en-US;q=0.9,nl;q=0.8,af;q=0.7,fr;q=0.6' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTIzMTc3MTUsImV4cCI6MTUxNzUwMTcxNSwibmJmIjoxNTEyMzE3NzE1LCJqdGkiOiJaUXNSWFRpVmxtY2d0dkZsIn0.mCHqvFp4yM01NLrHLv8zHXDsxsEsufbhVnDM2WkrVzY' -H 'Content-Type: application/json' -H 'Accept: */*' -H 'Referer: http://localhost:8000/console' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36' -H 'Connection: keep-alive' --data-binary '{"label":"bouncer2","category_id":"0","priority":0,"description":"First test bouncer", "dsn": "postgresql://bouncermon:bouncerpass@192.168.6.243:5432/pgbouncer"}' --compressed



# postgres | prd  | bouncer-ppc-arts | pgbouncer | 192.168.14.231 | SVDBPCAVR008 | arts    
# postgres | prd  | bouncer-arts     | pgbouncer | 192.168.16.7   | None         | arts    
# postgres | prd  | bouncer-ppc-smu  | pgbouncer | 192.168.14.232 | SVDBPCSVR007 | siamu   
# postgres | prd  | bouncer-smu      | pgbouncer | 192.168.16.8   | None         | siamu   
# postgres | prd  | bouncer-fidus    | pgbouncer | 192.168.26.24  | None         | vip     
# postgres | prd  | bouncer-vip      | pgbouncer | 192.168.17.202 | None         | vip     
# postgres | prd  | bouncer-ppc-vip  | pgbouncer | 192.168.14.233 | SVDBPCAVR008 | vip     


#curl -X GET 'http://localhost:8000/api/bouncers' -H 'Cookie: XSRF-TOKEN=eyJpdiI6Imx1MGVCVFVNdXlUY0E1YkNOYnFtZ2c9PSIsInZhbHVlIjoiZUJWUVE3SFYyeWo0MFBLQWZcL1V5TUJHUW1ZWGNDTHIwNEJ1bkQ2c05KSnJhU3BwYTVzMk5hdjJVUFZZbnNFMzlFZW5EWWtEWGpGRVl0QkZScWsrVnRRPT0iLCJtYWMiOiIzMGRlNTU4ZGE0NmI3MzRjYjE2NTViYjQ3MTdmZTQ0OGU1ZDdjZDk2Zjc5MzI2NDdkM2M3ZDMxY2FkN2Y5OTRhIn0%3D; laravel_session=eyJpdiI6IlI4VGdCVzVsaUltbGJSQnlGMHdiaGc9PSIsInZhbHVlIjoiRlFCcThGdDJieWRpUUswSzZCbGdIR3gxNVNyT0c3T3hCZHAydWhpbVBUcWYzTzMxUWJyenRRWW1Pd2ROWmo4VUswQlhlVE1RanJDb2RlMTFCZDR6K0E9PSIsIm1hYyI6IjlmZjliZmM4NTE3ZjM2OTUxOTkyMzBiOGQyYWJjNzU2ZjFmOWEwZDgzY2ExYjhiZWFkNTY1YTRiOTk2YmRjYzMifQ%3D%3D' -H 'Origin: http://localhost:8000' -H 'Accept-Encoding: gzip, deflate, br' -H 'X-Requested-With: XMLHttpRequest' -H 'Accept-Language: en,en-US;q=0.9,nl;q=0.8,af;q=0.7,fr;q=0.6' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTIzMTc3MTUsImV4cCI6MTUxNzUwMTcxNSwibmJmIjoxNTEyMzE3NzE1LCJqdGkiOiJaUXNSWFRpVmxtY2d0dkZsIn0.mCHqvFp4yM01NLrHLv8zHXDsxsEsufbhVnDM2WkrVzY' -H 'Content-Type: application/json' -H 'Accept: */*' -H 'Referer: http://localhost:8000/console' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36' -H 'Connection: keep-alive' --compressed

#curl 'http://localhost:8000/api/bouncers' -H 'Cookie: XSRF-TOKEN=eyJpdiI6Imx1MGVCVFVNdXlUY0E1YkNOYnFtZ2c9PSIsInZhbHVlIjoiZUJWUVE3SFYyeWo0MFBLQWZcL1V5TUJHUW1ZWGNDTHIwNEJ1bkQ2c05KSnJhU3BwYTVzMk5hdjJVUFZZbnNFMzlFZW5EWWtEWGpGRVl0QkZScWsrVnRRPT0iLCJtYWMiOiIzMGRlNTU4ZGE0NmI3MzRjYjE2NTViYjQ3MTdmZTQ0OGU1ZDdjZDk2Zjc5MzI2NDdkM2M3ZDMxY2FkN2Y5OTRhIn0%3D; laravel_session=eyJpdiI6IlI4VGdCVzVsaUltbGJSQnlGMHdiaGc9PSIsInZhbHVlIjoiRlFCcThGdDJieWRpUUswSzZCbGdIR3gxNVNyT0c3T3hCZHAydWhpbVBUcWYzTzMxUWJyenRRWW1Pd2ROWmo4VUswQlhlVE1RanJDb2RlMTFCZDR6K0E9PSIsIm1hYyI6IjlmZjliZmM4NTE3ZjM2OTUxOTkyMzBiOGQyYWJjNzU2ZjFmOWEwZDgzY2ExYjhiZWFkNTY1YTRiOTk2YmRjYzMifQ%3D%3D' -H 'Origin: http://localhost:8000' -H 'Accept-Encoding: gzip, deflate, br' -H 'X-Requested-With: XMLHttpRequest' -H 'Accept-Language: en,en-US;q=0.9,nl;q=0.8,af;q=0.7,fr;q=0.6' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTIzMTc3MTUsImV4cCI6MTUxNzUwMTcxNSwibmJmIjoxNTEyMzE3NzE1LCJqdGkiOiJaUXNSWFRpVmxtY2d0dkZsIn0.mCHqvFp4yM01NLrHLv8zHXDsxsEsufbhVnDM2WkrVzY' -H 'Content-Type: application/json' -H 'Accept: */*' -H 'Referer: http://localhost:8000/console' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36' -H 'Connection: keep-alive' --data-binary '{"label":"bouncer4","category_id":"0","priority":0,"description":"First test bouncer", "dsn": "postgresql://gplas:2Hot4u22..!!@192.168.17.202:5432/pgbouncer"}' --compressed

#curl 'http://localhost:8000/api/bouncers' -H 'Cookie: XSRF-TOKEN=eyJpdiI6Imx1MGVCVFVNdXlUY0E1YkNOYnFtZ2c9PSIsInZhbHVlIjoiZUJWUVE3SFYyeWo0MFBLQWZcL1V5TUJHUW1ZWGNDTHIwNEJ1bkQ2c05KSnJhU3BwYTVzMk5hdjJVUFZZbnNFMzlFZW5EWWtEWGpGRVl0QkZScWsrVnRRPT0iLCJtYWMiOiIzMGRlNTU4ZGE0NmI3MzRjYjE2NTViYjQ3MTdmZTQ0OGU1ZDdjZDk2Zjc5MzI2NDdkM2M3ZDMxY2FkN2Y5OTRhIn0%3D; laravel_session=eyJpdiI6IlI4VGdCVzVsaUltbGJSQnlGMHdiaGc9PSIsInZhbHVlIjoiRlFCcThGdDJieWRpUUswSzZCbGdIR3gxNVNyT0c3T3hCZHAydWhpbVBUcWYzTzMxUWJyenRRWW1Pd2ROWmo4VUswQlhlVE1RanJDb2RlMTFCZDR6K0E9PSIsIm1hYyI6IjlmZjliZmM4NTE3ZjM2OTUxOTkyMzBiOGQyYWJjNzU2ZjFmOWEwZDgzY2ExYjhiZWFkNTY1YTRiOTk2YmRjYzMifQ%3D%3D' -H 'Origin: http://localhost:8000' -H 'Accept-Encoding: gzip, deflate, br' -H 'X-Requested-With: XMLHttpRequest' -H 'Accept-Language: en,en-US;q=0.9,nl;q=0.8,af;q=0.7,fr;q=0.6' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTIzMTc3MTUsImV4cCI6MTUxNzUwMTcxNSwibmJmIjoxNTEyMzE3NzE1LCJqdGkiOiJaUXNSWFRpVmxtY2d0dkZsIn0.mCHqvFp4yM01NLrHLv8zHXDsxsEsufbhVnDM2WkrVzY' -H 'Content-Type: application/json' -H 'Accept: */*' -H 'Referer: http://localhost:8000/console' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36' -H 'Connection: keep-alive' --data-binary '{"label":"bouncer4","category_id":"0","priority":0,"description":"First test bouncer", "dsn": "postgresql://pghud:OVBx0iyJIM6qE@192.168.17.202:5432/pgbouncer"}' --compressed

curl 'http://localhost:8000/api/bouncers' -H 'Cookie: XSRF-TOKEN=eyJpdiI6Imx1MGVCVFVNdXlUY0E1YkNOYnFtZ2c9PSIsInZhbHVlIjoiZUJWUVE3SFYyeWo0MFBLQWZcL1V5TUJHUW1ZWGNDTHIwNEJ1bkQ2c05KSnJhU3BwYTVzMk5hdjJVUFZZbnNFMzlFZW5EWWtEWGpGRVl0QkZScWsrVnRRPT0iLCJtYWMiOiIzMGRlNTU4ZGE0NmI3MzRjYjE2NTViYjQ3MTdmZTQ0OGU1ZDdjZDk2Zjc5MzI2NDdkM2M3ZDMxY2FkN2Y5OTRhIn0%3D; laravel_session=eyJpdiI6IlI4VGdCVzVsaUltbGJSQnlGMHdiaGc9PSIsInZhbHVlIjoiRlFCcThGdDJieWRpUUswSzZCbGdIR3gxNVNyT0c3T3hCZHAydWhpbVBUcWYzTzMxUWJyenRRWW1Pd2ROWmo4VUswQlhlVE1RanJDb2RlMTFCZDR6K0E9PSIsIm1hYyI6IjlmZjliZmM4NTE3ZjM2OTUxOTkyMzBiOGQyYWJjNzU2ZjFmOWEwZDgzY2ExYjhiZWFkNTY1YTRiOTk2YmRjYzMifQ%3D%3D' -H 'Origin: http://localhost:8000' -H 'Accept-Encoding: gzip, deflate, br' -H 'X-Requested-With: XMLHttpRequest' -H 'Accept-Language: en,en-US;q=0.9,nl;q=0.8,af;q=0.7,fr;q=0.6' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTIzMTc3MTUsImV4cCI6MTUxNzUwMTcxNSwibmJmIjoxNTEyMzE3NzE1LCJqdGkiOiJaUXNSWFRpVmxtY2d0dkZsIn0.mCHqvFp4yM01NLrHLv8zHXDsxsEsufbhVnDM2WkrVzY' -H 'Content-Type: application/json' -H 'Accept: */*' -H 'Referer: http://localhost:8000/console' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36' -H 'Connection: keep-alive' --data-binary '{"label":"bouncer-fidus","category_id":"0","priority":0,"description":"First test bouncer", "dsn": "postgresql://pghud:OVBx0iyJIM6qE@192.168.26.24:5432/pgbouncer"}' --compressed
