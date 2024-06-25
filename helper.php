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
