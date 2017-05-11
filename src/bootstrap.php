<?php

/**
 * Include our helper functions
 */
require_once(__DIR__ . '/Utils/helpers.php');


try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}