<?php
/**
 * SingletonFactory
 * @author stealth35, Benjamin Delespierre
 */
class Singleton
{
    protected static $_instances;
    public static $namespace = __NAMESPACE__;
   
    public static function __callStatic($name, array $arguments = array())
    {    
        $name = ltrim(static::$namespace, '\\') . '\\' . ltrim($name, '\\');
        
        if(empty(static::$_instances[$name]) || !empty($arguments))
        {
            if(method_exists($name, '__construct'))
            {
                $class = new \ReflectionClass($name);
                static::$_instances[$name] = $class->newInstanceArgs($arguments);
            }
            else
            {
                static::$_instances[$name] = new $name;
            }
        }

        return static::$_instances[$name];
    }
}