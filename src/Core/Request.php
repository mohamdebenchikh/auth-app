<?php

namespace App\Core;

class Request
{
    /**
     * Get the current path of the request.
     *
     * @return string
     */
    public function path()
    {
        $path = $_SERVER['REQUEST_URI'];

        // Remove query string parameters if present
        if (($pos = strpos($path, '?')) !== false) {
            $path = substr($path, 0, $pos);
        }

        // Remove the base URL if it exists
        $baseUrl = BASE_PATH;
        if (strpos($path, $baseUrl) === 0) {
            $path = substr($path, strlen($baseUrl));
        }

        // Remove the trailing slash if present
        $path = $path === "/" ? $path : rtrim($path, '/');

        return $path;
    }

    /**
     * Get the HTTP request method.
     *
     * @return string
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Determine if the request is an AJAX request.
     *
     * @return bool
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * Get the request headers.
     *
     * @return array
     */
    public function headers()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headerKey = str_replace('_', ' ', substr($key, 5));
                $headerKey = str_replace(' ', '-', ucwords(strtolower($headerKey)));
                $headers[$headerKey] = $value;
            }
        }
        return $headers;
    }
    /**
     * Get all request data (GET and POST parameters).
     *
     * @return array
     */
    public function all()
    {
        $requestData = array_merge($_GET, $_POST);

        // Filter and sanitize the request data
        $filteredData = [];
        foreach ($requestData as $key => $value) {
            $filteredValue = $this->filterValue($value);
            $filteredData[$key] = $filteredValue;
        }

        return $filteredData;
    }
    /**
     * Filter and sanitize a single value.
     *
     * @param mixed $value
     * @return mixed
     */
    protected function filterValue($value)
    {
        if (is_array($value)) {
            return array_map([$this, 'filterValue'], $value);
        }

        // Apply any additional filtering or sanitization techniques here
        $filteredValue = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);

        return $filteredValue;
    }


    /**
     * Get a specific input value from the request data (GET or POST).
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public function input($key, $default = null)
    {
        return $this->all()[$key] ?? $default;
    }

    /**
     * Check if a specific input exists in the request data (GET or POST).
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->all()[$key]);
    }

    /**
     * Check if a file with the given name exists in the request.
     *
     * @param string $fileName
     * @return bool
     */
    public function hasFile($fileName)
    {
        return isset($_FILES[$fileName]) && $_FILES[$fileName]['error'] !== UPLOAD_ERR_NO_FILE;
    }

    /**
     * Get the file data for a specific file by its name or input name.
     *
     * @param string $fileName
     * @return array|null
     */
    public function file($fileName)
    {
        return $_FILES[$fileName] ?? null;
    }

    /**
     * Get only the specified keys from the request data.
     *
     * @param array $keys
     * @return array
     */
    public function only(array $keys)
    {
        $requestData = $this->all();
        return array_intersect_key($requestData, array_flip($keys));
    }
}
