<?php

/************************************
Entry point of the project.
To be run from the command line.
 ************************************/
namespace App;

use App\Controller\JobController;
use Exception; 

define('RESSOURCES_DIR', __DIR__ . '/../resources/');

// replace __autoload depecrated with spl_autoload.
spl_autoload_register(function (string $classname) {
    $classname = str_replace("\\", "/", $classname);
    require_once (__DIR__ . '/' . $classname . '.php');
});

class App
{
    private $controllers;

    public function __construct()
    {
        $this->controllers["jobs"] = new JobController();
    }

    public function start()
    {
        echo sprintf("Starting...\n");

        /* import jobs from all files on ../resources to database */
        try
        {
            $count = $this->controllers["jobs"]->import(RESSOURCES_DIR);
            echo sprintf("> %d jobs imported.\n", $count);

            /* list all jobs */
            $jobs = $this->controllers["jobs"]->fetch();
            echo sprintf("> all jobs (%d):\n", count($jobs));
            foreach ($jobs as $job) {
                echo sprintf(" %d: %s - %s - %s\n", $job['id'],
                    $job['reference'], $job['title'], $job['publication']);
            }
            echo sprintf("Done.\n");
        } catch (Exception $e) {
            echo sprintf("Error: %s\n", $e->getMessage());
        }
    }
}

// lauching app.
$app = new App();
try
{
    $app->start();
} catch (Exception $e) {
    echo sprintf("Error: %s\n", $e->getMessage());
}
