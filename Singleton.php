<?php
/*
 * SingletonFacotry
 * @author stealth35, Benjamin Delespierre
 */
class Singleton
{
    protected static $_instances;
   
    public static function __callStatic($name, array $arguments)
    {    
        if(empty(static::$_instances[$name]) || !empty($arguments))
        {
            if(strpos($name, '\\') === 0)
            {
                $name = substr($name, 1);
            }
               
            $classname = '\\' . $name;

            if(method_exists($classname, '__construct'))
            {
                $class = new \ReflectionClass($classname);
                static::$_instances[$name] = $class->newInstanceArgs($arguments);
            }
            else
            {
                static::$_instances[$name] = new \$classname;
            }
        }

        return static::$_instances[$name];
    }
}
