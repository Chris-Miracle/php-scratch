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

function loadView($name, $data = [])
{
    $viewPath = getBasePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
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

function loadPartial($name, $data = [])
{
    $partialPath = getBasePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
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

/**
 * Formar Salary
 * 
 * @param string $salary
 * @return string formatted salary
*/
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}
