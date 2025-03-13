<?php

namespace AlexStewartJa\Didit\Traits;

use AlexStewartJa\Didit\Temporal\DateTime;
use AlexStewartJa\Didit\Temporal\DiditDateTime;
use AlexStewartJa\Didit\Temporal\DiditExtendedDateTime;

trait Arrayable
{
    public function __construct(?array $data = [])
    {
        $this->fromArray($data);
    }

    public function getClassListMappings(): array
    {
        return [];
    }

    public function fromArray(?array $data = []): self
    {
        $data = $data ?: [];

        foreach ($data as $prop => $value) {
            if (property_exists($this, $prop)) {
                /** @phpstan-ignore method.notFound */
                $propClass = (new \ReflectionProperty(self::class, $prop))->getType()->getName();

                if (class_exists($propClass)) {
                    $propClass = new \ReflectionClass($propClass);
                    $propClassName = $propClass->getName();

                    if (in_array(Arrayable::class, array_keys($propClass->getTraits()))) {
                        $this->{$prop} = new $propClassName($value);
                    } elseif ($propClass->isSubclassOf(DateTime::class)) {
                        if ($propClassName == DiditDateTime::class) {
                            $this->{$prop} = DiditDateTime::ofString($value);
                        } elseif ($propClassName == DiditExtendedDateTime::class) {
                            $this->{$prop} = DiditExtendedDateTime::ofString($value);
                        }
                    }
                } else {
                    $classListMappings = $this->getClassListMappings();
                    if (! empty($classListMappings) && in_array($prop, array_keys($classListMappings)) &&
                        is_array($value)) {
                        $propClass = $classListMappings[$prop];
                        $_value = [];

                        foreach ($value as $val) {
                            $_value[] = new $propClass($val);
                        }

                        $this->{$prop} = $_value;
                    } else {
                        $this->{$prop} = $value;
                    }
                }
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        $fields = get_object_vars($this);

        array_walk_recursive($fields, function (&$value, $prop) {
            if (is_object($value)) {
                if (in_array(Arrayable::class, class_uses($value))) {
                    $value = $value->toArray();
                } elseif (is_subclass_of($value, DateTime::class)) {
                    if (is_a($value, DiditDateTime::class)) {
                        $value = DiditDateTime::asString($value);
                    } elseif (is_a($value, DiditExtendedDateTime::class)) {
                        $value = DiditExtendedDateTime::asString($value);
                    }
                }
            }

            return $value;
        });

        return $fields;
    }
}
