<?php

namespace App\Core;

class Redirect
{
    protected $url;

    /**
     * Set the destination URL for the redirect.
     *
     * @param string $url
     * @return $this
     */
    public function to($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Redirect the user back to the previous page.
     *
     * @return $this
     */
    public function back()
    {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        return $this->to($referer);
    }

    /**
     * Set flash data in the session with the provided key and value.
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function with($key, $value)
    {
        Session::setFlash($key, $value);
        return $this;
    }

    /**
     * Set flash data for errors in the session.
     *
     * @param array $errors
     * @return $this
     */
    public function withErrors(array $errors)
    {
        return $this->with('errors', $errors);
    }

    /**
     * Set flash data for error in the session.
     *
     * @param array $key
     * @param array $value
     * @return $this
     */
    public function withError($key,$value)
    {
        return $this->with('errors', [$key=>[$value]]);
    }

    /**
     * Set flash data for form inputs in the session.
     *
     * @param array $data
     * @return $this
     */
    public function withInputs(array $data)
    {
        return $this->with('inputs', $data);
    }

    /**
     * Perform the redirect by sending the redirect header and exiting the script execution.
     */
    public function execute()
    {
        header("Location: {$this->url}");
        die;
    }
}
