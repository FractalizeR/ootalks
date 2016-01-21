<?php

namespace FractalizeR\LibrarianBundle\Logic\Util;

use Exception;

/**
 * Trait helping to implement Uniform Access Principle.
 * Classes, used by this trait can define private property $fieldName, its private or protected accessors
 * getFieldName()/setFieldName() and then access $fieldName via accessor using $obj->field_name or $obj->fieldName.
 *
 * @package FHFW\Utility
 */
trait PropertyTrait
{
    /**
     * Magic method translating variable access to getters where possible
     *
     * @param string $name
     *
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        $accessor = $this->getAccessor($name, 'get');

        return $this->$accessor();
    }

    /**
     * Magic method translating variable access to setters where possible
     *
     * @param $name
     * @param $value
     *
     * @throws Exception
     */
    public function __set($name, $value)
    {
        $accessor = $this->getAccessor($name, 'set');
        $this->$accessor($value);

        return;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        $accessor = $this->getAccessor($name, 'get');

        return method_exists($this, $accessor);
    }

    /**
     * Method for mass setting data
     *
     * @param array|\ArrayAccess $data
     *
     * @return $this
     */
    public function fillProperties($data)
    {
        foreach ($data as $propertyName => $propertyValue) {
            $setter = $this->getAccessor($propertyName, 'set');
            $this->$setter($propertyValue);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param string $type
     *
     * @throws Exception
     * @return string
     */
    protected function getAccessor($name, $type)
    {
        $accessor = $type.$this->getStudlyFieldName($name);
        if (!method_exists($this, $accessor)) {
            throw new Exception("Accessor '$accessor' is not found for property '$name'");
        }

        return $accessor;
    }

    /**
     * @param $name
     *
     * @return string
     */
    protected function getStudlyFieldName($name)
    {
        return ucfirst($name);
    }
}
