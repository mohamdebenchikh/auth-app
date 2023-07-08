<?php

namespace App\Core;

class Response
{
    protected int $statusCode;
    protected array $headers;
    protected $content;

    public function __construct($content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    protected function sendHeaders()
    {
        // Set the status code
        http_response_code($this->statusCode);

        // Set the headers
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
    }

    protected function sendContent()
    {
        if ($this->isJson()) {
            // Set the Content-Type header for JSON
            $this->headers['Content-Type'] = 'application/json';

            // Convert the content to JSON
            $jsonContent = json_encode($this->content);

            // Output the JSON content
            echo $jsonContent;
        } else {
            // Output the content as-is
            echo $this->content;
        }
    }

    protected function isJson()
    {
        return is_array($this->content) || is_object($this->content);
    }
}
