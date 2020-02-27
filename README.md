# nedo-query

NedoQuery is a laravel library written in pure PHP and providing a set of classes that allow you to make Nedo Web Platform API call via http/https.

## Documentation

###### **Steps**:
  1. From the projects root folder, in the terminal, run composer to get the needed package.
     * Example:

      ```
         composer require sindika-id/nedo-query
      ```
  2. From the projects root folder run ```composer update```
  5. Add the Nedo API credentials to ``` /.env  ```
     * Example:

      ```
            NEDO_DOMAIN=http://YOURNEDODOMAIN/index.php
            NEDO_SERVICE_CODE=YOURSERVICECODE
            NEDO_SERVICE_SECRET=YOURSECRET
      ```



## License

NedoQuery is licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
