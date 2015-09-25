A php library to connect to the ONET API: https://services.onetcenter.org/

Currently Implemented:

* Detailed Work Activities: https://services.onetcenter.org/reference/online#details_detailed_work_activities
* Job Outlook: https://services.onetcenter.org/reference/mnm#outlook
* Knowledge Details: https://services.onetcenter.org/reference/online#details_knowledge

Each Resource object connects to an endpoint.  The Resource owns the connection to the endpoint knowing about the request and response XML format.

The Config object holds configuration

The Connection object makes the call to the API

The Resource Object will create Entity objects which are read only value objects.

Examples:

```php

$config = new \ONET\Config('asdfvaesfjaivoe', 'https://services.onetcenter.org/ws');
$connection = new \ONET\Connection($config);

$resource = new \ONET\Resource\Online\WorkActivityDetailed('17-2112.00');

$response = $connection->call($resource);

$entity = $resource->map($response);

```