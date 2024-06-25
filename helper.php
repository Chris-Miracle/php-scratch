<?php


/**
 * Get base Path
 * 
 * @param string $path
 * @return string
 */

function getBasePath($path = "")
{
    return __DIR__.'/'. $path;
}

/**
 * load view Path
 * 
 * @param string $path
 * @return void
 */

function loadView($name)
{
    $viewPath = getBasePath("views/{$name}.view.php");

    if (file_exists($viewPath)) {
        require $viewPath;
    }else{
        echo "View {$name} not found";
    }
}

/**
 * load partial Path
 * 
 * @param string $path
 * @return void
 */

function loadPartial($name)
{
    $partialPath = getBasePath("views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial {$name} not found";
    }
}

/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */

function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

/**
 * Inspect a value(s) and die
 * 
 * @param mixed $value
 * @return void
 */

function inspectAndDie($value)
{
    echo "<pre>";
    die(var_dump($value));
    echo "</pre>";
}
