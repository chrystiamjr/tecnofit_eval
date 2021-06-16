# tecnofit_eval

**Challenge to evaluate the knowledge and skills nedded for the company.**

- Implementation of an API application using the Phalcon Framework [https://phalcon.io](https://phalcon.io).

### Dependencies

- PHP 7.3 x64
- Phalcon PHP v3.4.5
- MySQL or MariaDB
- Apache or any other server tool

### Installation

##### Windows:

- Dowload [here](https://github.com/phalcon/cphalcon/releases/tag/v3.4.5) the Phalcon DLL that we'll need
- Copy/Paste or move the `php_phalcon.dll` to your `phpX.X > ext` folder
- Edit your `php.ini`, appending at the end of the file the following line: `extension=php_phalcon.dll`
    
##### Linux (Ubuntu/Debian):

- Execute the following commands on your terminal to install Phalcon:
    ```
    curl -s "https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh" | sudo bash
    
    sudo apt-get install php7-phalcon
    
    # Ubuntu 16.04+, Debian 9+
    sudo apt-get install php7.0-phalcon
    
    !! If you are missing apt-add-repository run the following command
    
    # Ubuntu 14.04+
    sudo apt-get install software-properties-common
    
    # Ubuntu 12.04
    sudo apt-get install python-software-properties
    ```

##### After default SO install:
- Check your `phpinfo()`to ensure that the extension has been imported correctly  
- Clone the project
    - Inside the `public > script` folder there is a sql file with all the tables and inserts nedded for this project
- Run the `default.sql` script on your database
- Configure your database credentials within `config > config.php`
- Hit the IP address with postman
- Be happy!

### Usage

##### Requests

- Due to the requirement of this challenge, there was a need to create only one route, but others will be implemented later.
- Available routes:

| Method | Route                        | Parameters             | Action                                                                  | 
|--------|------------------------------|------------------------|-------------------------------------------------------------------------|
| `GET`  | `/movement/leaderboard/{id}` | Numeric Id             | Get user leaderboard by movement id. Empty resultset if no data present |


##### Responses

The response main structure is divided into the following elements:
- `api-version` which contains the **version** of the api
- `data` which contains the returned data. Will not be presented if `erros` is displaying
- `errors` which is a collection of errors that occurred inside the request. Will not be presented if `data` is displaying
- `meta` which contains the `timestamp` and `hash` of the encoded `$data` or `$errors`

##### Samples

###### 404 (Not found)
```json
{
  "api_version": "1.0.0",
  "errors": [
    "404 not found"
  ],
  "meta": {
    "timestamp": "2021-06-16 02:53:06",
    "hash": "0abb5bb98794ba3ddddd74564d5cfc3344cbb075"
  }
}
```

###### 400 (Bad Request)
```json
{
  "api_version": "1.0.0",
  "errors": [
    "Error description 1",
    "Error description 2"
  ],
  "meta": {
    "timestamp": "2021-06-16 03:03:44",
    "hash": "921b5c03e2ca237b3f1b330fe66091a3468283f2"
  }
}

```

###### 200 (Success)
```json
{
  "api_version": "1.0.0",
  "data": [],
  "meta": {
    "timestamp": "2021-06-16 02:55:45",
    "hash": "1626cbb0a5ae971f337279faa94d5ded9186a6f1"
  }
}
```

###### `/movement/leaderboard/1`
```json
{
  "api_version": "1.0.0",
  "data": [
    {
      "position": 1,
      "movement": "Deadlift",
      "user": "Jose",
      "score": "190",
      "date": "2021-01-04 00:00:00"
    },
    {
      "position": 2,
      "movement": "Deadlift",
      "user": "Joao",
      "score": "180",
      "date": "2021-01-01 00:00:00"
    },
    {
      "position": 3,
      "movement": "Deadlift",
      "user": "Paulo",
      "score": "170",
      "date": "2021-01-01 00:00:00"
    }
  ],
  "meta": {
    "timestamp": "2021-06-16 03:16:55",
    "hash": "8a4cc32155c33db19900989b02bea211932999d7"
  }
}
```