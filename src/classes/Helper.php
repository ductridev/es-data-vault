<?php
namespace ES_DataVault\Helper;

abstract class Enum
{
    private static $constCacheArray = NULL;

    /**
    *    Get all enum values from the cache array and convert them into enum values for later use in the Enum class methods.
    *    @return array
    */
    private static function getConstants()
    {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    /**
     * Check if the enum name is correct and exists in the cache array.
     * @param string $name
     * @param bool $strict
     * 
     * @return bool True if enum's name is exists, false if enum's name is not exists
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    /**
     * Check if value is exist in the cache array
     * @param string $value Enum's value to check
     * @param bool $strict
     * 
     * @return bool True if value is valid and False if value is invalid
     */
    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }

    /**
     * Get enum's value from name
     * @param string $name
     * 
     * @return bool|mixed Return enum's value if enum's name is valid and false otherwise
     */
    public static function fromString($name)
    {
        if (self::isValidName($name, $strict = true)) {
            $constants = self::getConstants();
            return $constants[$name];
        }

        return false;
    }

    /**
     * Convert enum's value to enum's name in string format according to enum constants.
     * @param mixed $value
     * 
     * @return bool|int|string False if enum's value is invalid or the key of Enum if it is found in the cache array
     */
    public static function toString($value)
    {
        if (self::isValidValue($value, $strict = true)) {
            return array_search($value, self::getConstants());
        }

        return false;
    }

    /**
     * Compare 2 enum values to determine if $valueNeedCompare is bigger than $value2Compare.
     * 
     * @return bool True if $valueNeedCompare is bigger than $value2Compare and false otherwise.
     */
    public static function ifBigger($valueNeedCompare, $value2Compare){
        if (self::isValidValue($value2Compare, $strict = true) && self::isValidValue($valueNeedCompare, $strict = true)) {
            if(array_search($valueNeedCompare, self::getConstants()) > array_search($value2Compare, self::getConstants())){
                return true;
            }
            return false;
        }
        return false;
    }
}
