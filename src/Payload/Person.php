<?php namespace Rollbar\Payload;

use Rollbar\UtilitiesTrait;

/**
 * Suppress PHPMD.ShortVariable for this class, since using property $id is
 * intended.
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Person implements \Serializable
{
    use UtilitiesTrait;

    public function __construct(
        private $id,
        private $username = null,
        private $email = null,
        private array $extra = []
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function __get($name)
    {
        return isset($this->extra[$name]) ? $this->extra[$name] : null;
    }

    public function __set($name, $val)
    {
        $this->extra[$name] = $val;
    }

    public function serialize()
    {
        $result = array(
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
        );
        foreach ($this->extra as $key => $val) {
            $result[$key] = $val;
        }
        
        return $this->utilities()->serializeForRollbarInternal($result, array_keys($this->extra));
    }
    
    public function unserialize(string $serialized)
    {
        throw new \Exception('Not implemented yet.');
    }
}
