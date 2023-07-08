<?php

namespace App\Core;

class View
{
    protected $layout = "main";
    protected $params = [];

    /**
     * Set the layout for the view.
     *
     * @param string $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Render a component with the given parameters.
     *
     * @param string $component
     * @param array $params
     * @return string
     */
    public function component($component, $params = [])
    {
        $componentPath = ROOT_DIR  . '/src/views/components/' . $component . '.php';
        ob_start();
        extract($params, EXTR_SKIP);
        require $componentPath;
        return ob_get_clean();
    }

    /**
     * Render the view with the given parameters and layout.
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view, $params = [])
    {
        $this->params = $params;
        $content = $this->renderView($view);
        $this->params['content'] = $content;
        return $this->renderView("layouts/{$this->layout}");
    }

    /**
     * Render the specified view.
     *
     * @param string $view
     * @return string
     */
    protected function renderView($view)
    {
        ob_start();
        extract($this->params, EXTR_SKIP);
        require ROOT_DIR  . '/src/views/' . $view . '.php';
        return ob_get_clean();
    }
}
