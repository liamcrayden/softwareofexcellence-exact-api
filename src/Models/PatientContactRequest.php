<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\PatientMessageType;
use \ArrayAccess;

class PatientContactRequest implements ArrayAccess
{
    private $type;
    private $subject;
    private $body;
    private $scheduled;
    private $priority;    

    public function __construct($pcr)
    {
        isset($pcr->type) && $this->type = PatientMessageType($pcr->type);
        isset($pcr->subject) && $this->subject = $pcr->subject;
        isset($pcr->body) && $this->body = $pcr->body;
        isset($pcr->scheduled) && $this->scheduled = $pcr->scheduled;
        isset($pcr->priority) && $this->priority = $pcr->priority;
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
            'type' => $this->type, 
            'subject' => $this->subject, 
            'body' => $this->body, 
            'scheduled' => $this->scheduled, 
            'priority' => $this->priority, 
        ];
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(PatientMessageType $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    public function getScheduled()
    {
        return $this->scheduled;
    }

    public function setScheduled(DateTime $datetime)
    {
        $this->scheduled = $datetime;
        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority(bool $priority)
    {
        $this->priority = $priority;
        return $this;
    }
}