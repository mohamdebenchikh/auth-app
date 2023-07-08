<?php

namespace App\Core;

class Session
{
    /**
     * Start the session.
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            self::clearReadFlashMessages();
        }
    }

    /**
     * Set a session value with the specified key and value.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get the value of a session variable with the specified key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check if a session variable with the specified key exists.
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session variable with the specified key.
     *
     * @param string $key
     */
    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Set flash data in the session with the specified key and message.
     *
     * @param string $key
     * @param string $message
     */
    public static function setFlash($key, $message)
    {
        $_SESSION['flash'][$key] = $message;
    }

    /**
     * Check if a flash message with the specified key exists in the session.
     *
     * @param string $key
     * @return bool
     */
    public static function hasFlash($key)
    {
        return isset($_SESSION['flash'][$key]);
    }

    /**
     * Get the value of a flash message with the specified key from the session.
     * Marks the flash message as read, so it won't be available on subsequent requests.
     *
     * @param string $key
     * @return string|null
     */
    public static function getFlash($key)
    {
        if (self::hasFlash($key)) {
            $message = $_SESSION['flash'][$key];
            self::markFlashMessageAsRead($key);
            return $message;
        }
        return null;
    }

    /**
     * Clear all read flash messages from the session.
     */
    private static function clearReadFlashMessages()
    {
        $readFlashMessagesKeys = self::get('read_flash_messages_keys', []);
        foreach ($readFlashMessagesKeys as $key) {
            unset($_SESSION['flash'][$key]);
        }
        self::remove('read_flash_messages_keys');
    }

    /**
     * Mark a flash message as read by adding its key to the read flash messages keys list.
     *
     * @param string $key
     */
    private static function markFlashMessageAsRead($key)
    {
        $readFlashMessagesKeys = self::get('read_flash_messages_keys', []);
        $readFlashMessagesKeys[] = $key;
        self::set('read_flash_messages_keys', $readFlashMessagesKeys);
    }

    /**
     * Regenerate the session ID.
     */
    public static function regenerate()
    {
        session_regenerate_id(true);
    }
}
