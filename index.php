<?php
require('vendor/autoload.php');
use \NoahBuscher\Macaw\Macaw;
Macaw::get('/', 'controllers\demoController@index');
Macaw::get('page', 'controllers\demoController@page');
Macaw::get('view/(:num)', 'controllers\demoController@view');
Macaw::get('temp/lists', 'controllers\TempController@lists');
Macaw::get('temp/view/(:num)', 'controllers\TempController@view');
Macaw::get('/paginator/lists/(:num)', 'controllers\PaginatorController@lists');
Macaw::post('temp/fileupload', 'controllers\TempController@fileupload');
Macaw::get('temp/watermark', 'controllers\TempController@watermark');
Macaw::dispatch();
