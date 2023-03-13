<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;
use \ArrayAccess;

class SubscriptionList implements ArrayAccess
{
    private $subscriptions = array();

    public function __construct(array $subscriptions) 
    {
        $this->subscriptions = $subscriptions;
    }

    #[\ReturnTypeWillChange]
    public function offsetSet(mixed $offset, $value) 
    {
        if (is_null($offset)) {
            $this->subscriptions[] = $value;
        } else {
            $this->subscriptions[$offset] = $value;
        }
    }

    #[\ReturnTypeWillChange]
    public function offsetExists(mixed $offset) 
    {
        return isset($this->subscriptions[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset(mixed $offset) 
    {
        unset($this->subscriptions[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset) 
    {
        return isset($this->subscriptions[$offset]) ? $this->subscriptions[$offset] : null;
    }

    public function toArray()
    {
        return $this->subscriptions;
    }

    public function count()
    {
        return count( $this->subscriptions );
    }

    public function getSubscribers()
    {
        return $this->subscriptions;
    }

    public function hasSubscriber(string $subscriber)
    {
        return in_array( $subscriber, $this->subscriptions );
    }    
}