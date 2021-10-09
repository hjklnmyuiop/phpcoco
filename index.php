<?php
require('vendor/autoload.php');
use \NoahBuscher\Macaw\Macaw;
Macaw::get('/', 'controllers\demoController@index');
Macaw::get('page', 'controllers\demoController@page');
Macaw::get('view/(:num)', 'controllers\demoController@view');
Macaw::get('temp/lists', 'controllers\TempController@lists');
Macaw::get('temp/view/(:num)', 'controllers\TempController@view');
Macaw::get('/paginator/lists/(:num)', 'controllers\PaginatorController@lists');

Macaw::dispatch();
