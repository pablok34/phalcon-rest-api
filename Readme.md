# Phone book RESTful API

## URLS

## GET

| URL                                       | Description                                                     |
| ----------------------------------------- | --------------------------------------------------------------- |
| phalcon.devel/api/phones                  | Returns the first 10 phones.                                    |
| phalcon.devel/api/phones/1                | Returns the phone with id 1.                                    |
| phalcon.devel/api/phones?firstName=John   | Returns the first 10 phones with first name starting with John. |
| phalcon.devel/api/phones?lastName=Doe     | Returns the first 10 phones with last name starting with Doe.   |
| phalcon.devel/api/phones?limit=2&offset=0 | Returns the first 2 phones.                                     |

## POST

| URL                      | Description          |
| ------------------------ | -------------------- |
| phalcon.devel/api/phones | Creates a new phone. |

JSON:

```json
{
    "firstName": "John",
    "lastName": "Doe",
    "phoneNumber": "+12223444224455",
    "countryCode": "US",
    "timezone": "Europe/Madrid"
}
```

## PUT

| URL                        | Description              |
| -------------------------- | ------------------------ |
| phalcon.devel/api/phones/1 | Updates phone with id 1. |

JSON:

```json
{
    "phoneNumber": "+12223444224455"
}
```

## DELETE

| URL                        | Description              |
| -------------------------- | ------------------------ |
| phalcon.devel/api/phones/1 | Deletes phone with id 1. |
