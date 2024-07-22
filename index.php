<?php

namespace App;

include('src/Kernel.php');

use App\src\Kernel;

$kernel = Kernel::getInstance();
$kernel->execute();