<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 24/03/2015
 * Time: 12:06
 */

class PhpTemplateEngine
{
    private $templateDir;

    public function __construct($templateDir)
    {
        $this->templateDir = $templateDir;
    }

    public function render($template, array $parameters = [])
    {
        extract($parameters);

        ob_start();
        include $this->templateDir.DIRECTORY_SEPARATOR.$template;
        return ob_get_clean();
    }
}