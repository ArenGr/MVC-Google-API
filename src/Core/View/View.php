<?php

namespace App\Core\View;

use App\Core\Config\ConfigHandler as Config;
use App\Core\Helpers\Dev;
use Exception;

class View implements ViewInterface
{
    /**
     * @var array
     */
    public array $data;

    /**
     * @param string $name
     * @return string
     */
    private function resolvePath(string $name): string
    {
        $name = str_replace('.', DIRECTORY_SEPARATOR, $name);

        $pathToViews = Config::get('path.views');

        return sprintf("%s/%s.php", $pathToViews, $name);
    }

    /**
     * @param string $name
     * @param array $params
     * @return void
     */
    public function render(string $name, array $params = []): void
    {
        $path = $this->resolvePath($name);

        $this->data = $params;
        if (file_exists($path)) {

            require_once($path);
        } else {
            throw new Exception(sprintf("Error: File %s not found.", $path));
        }
    }
}
