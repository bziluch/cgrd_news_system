<?php

namespace App;

include('src/Kernel.php');

use App\src\Kernel;

$kernel = Kernel::getInstance();
$kernel->execute();

?>

<html lang="EN">

<head>
    <title>CGRD - news system</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
</head>

<body>

<div class="page-content">
    <div class="header">
        <img src="assets/images/logo.svg">
    </div>

    <div class="section">
        <div class="section-header">All news</div>

        <div class="section-row">
            <div class="section-row-content">
                <div class="section-row-title">Title</div>
                <div class="section-row-text">Lorem ipsum dolor sit amet</div>
            </div>
            <div class="section-row-buttons">
                <a href="javascript:void(0)">
                    <img src="assets/images/pencil.svg" height="16">
                </a>
                <a href="javascript:void(0)">
                    <img src="assets/images/close.svg" height="16">
                </a>
            </div>
        </div>
    </div>

    <div class="section">
        <form method="post">
            <input type="text" name="title" placeholder="Title"/>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="submit" value="Save">
        </form>
        <button>Logout</button>
    </div>

</div>

</body>

</html>