<?php

/**
 * Provides a session-based feedback mechanism that persists across
 * application requests.
 *
 * @ingroup Zrt_Feedback
 */
class Zrt_Feedback
{

    protected static $_session = null;

    const INFO = 'info';
    const WARNING = 'warning';
    const ERROR = 'error';

    /**
     * Gets the session object.
     *
     * @return Zend_Session_Namespace
     */
    protected static function _ensureSession()
    {
        if (null === self::$_session) {
            self::$_session = new Zend_Session_Namespace( 'Feedback' );
        }

    }

    /**
     * Adds a message to the feedback stack and preserves it across the current session.
     *
     * @param string     $type
     * @param string|int $message
     * @param string     $callback The URL to put to to acknowledge the message.
     */
    public static function add($type , $message , $callback = null)
    {
        self::_ensureSession();

        switch ($type) {
        case Zrt_Feedback::INFO:
        case Zrt_Feedback::WARNING:
        case Zrt_Feedback::ERROR:
            self::$_session->{$type}[] = array(
                'message' => $message ,
                'callback' => $callback
            );
            break;

        default:
            throw new Zrt_Exception( 'Invalid type "' . $type . '" specified.' );
        }

    }

    public static function clean()
    {
        Zend_Session_Namespace::resetSingleInstance( 'Feedback' );
        self::$_session = null;

    }

    /**
     * Gets the currently buffered feedback.
     *
     * @param  string|array $types
     * @return unknown
     */
    public static function get( $types = array( ) , $clean = true )
    {
        self::_ensureSession();

        if ( !is_array( $types ) ) {
            $types = array( $types );
        }
        if ( !count( $types ) ) {
            $types = array(
                Zrt_Feedback::INFO ,
                Zrt_Feedback::WARNING ,
                Zrt_Feedback::ERROR ,
            );
        }

        $return = array( );
        foreach ($types as $type) {
            switch ($type) {
            case Zrt_Feedback::INFO:
            case Zrt_Feedback::ERROR:
            case Zrt_Feedback::WARNING:
                if ( isset( self::$_session->$type ) && self::$_session->$type ) {
                    $return[$type] = self::$_session->$type;
                }
                if (true === $clean) {
                    unset( self::$_session->$type );
                }
                break;

            default:
                throw new Zrt_Exception( 'Invalid type "' . $type . '" specified.' );
            }
        }

        return $return;

    }

}
