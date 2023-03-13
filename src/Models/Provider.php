<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\ProviderType;

use \ArrayAccess;

class Provider implements ArrayAccess
{
    private $id;
    private $type;
    private $name;

    public function __construct($provider)
    {
        isset($provider->id) && $this->id = $provider->id;
        isset($provider->type) && $this->type = new ProviderType($provider->type);
        isset($provider->name) && $this->name = $provider->name;
    }

    #[\ReturnTypeWillChange]
    public function offsetSet(mixed $offset, $value) 
    {
        return;
    }

    #[\ReturnTypeWillChange]
    public function offsetExists(mixed $offset) 
    {
        return isset($this->{$offset});
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset(mixed $offset) 
    {
        return;
    }

    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset) 
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

    public function toArray()
    {
        return [ 
            'id' => $this->id, 
            'type' => $this->type, 
            'name' => $this->name, 
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;        
    }

    public function getName()
    {
        return $this->name;
    } 
}