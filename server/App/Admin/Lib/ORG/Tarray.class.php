<?php
/**
 * Class TArray.
 *
 * 应用中所有常用静态函数.
 */
class TArray
{

    const FLAG_ALLOW_SCALAR_TO_ARRAY_CONVERSION = 1;

    const FLAG_OVERWRITE_NUMERIC_KEY = 2;

    const FLAG_PREVENT_DOUBLE_VALUE_WHEN_APPENDING_NUMERIC_KEYS = 4;

    protected $default;

    protected $precedence;

    protected $flags;

    /**
     * Construct.
     *
     * @param array   $default    数组.
     * @param array   $precedence 数组.
     * @param integer $flags      数组.
     */
    public function __construct(array $default, array $precedence, $flags = 0)
    {
        $this->default = $default;
        $this->precedence = $precedence;
        $this->flags = $flags;
    }

    /**
     * MERGEdATA.
     *
     * @return mixed
     */
    public function mergeData()
    {
        $precedence = $this->precedence;
        $default = $this->default;

        return static::doMerge($default, $precedence, $this->flags);
    }

    /**
     * 合并数组.
     *
     * @param array   $default    数组.
     * @param array   $precedence 数组.
     * @param integer $flags      深度.
     *
     * @return mixed
     */
    public static function doMerge(array $default, array $precedence, $flags = 0)
    {
        foreach ($precedence as $key => $pVal) {
            if (\is_numeric($key) && (0 === ($flags & self::FLAG_OVERWRITE_NUMERIC_KEY))) {
                if (0 === ($flags & self::FLAG_PREVENT_DOUBLE_VALUE_WHEN_APPENDING_NUMERIC_KEYS)
                    || !\in_array($pVal, $default)
                ) {
                    $default[] = $pVal;
                }
                continue;
            }
            if (\array_key_exists($key, $default)) {
                $default[$key] = static::mergeRecursively($default[$key], $pVal, $flags);
            } else {
                $default[$key] = $pVal;
            }
        }
        return $default;
    }

    /**
     * Setter for flag FLAG_ALLOW_SCALAR_TO_ARRAY_CONVERSION.
     *
     * @param mixed $flagAllowConversion 标记.
     *
     * @return $this
     */
    public function allowConversionFromScalarToArray($flagAllowConversion)
    {
        if ($flagAllowConversion) {
            $this->setFlag(self::FLAG_ALLOW_SCALAR_TO_ARRAY_CONVERSION);
        } else {
            $this->unsetFlag(self::FLAG_ALLOW_SCALAR_TO_ARRAY_CONVERSION);
        }
        return $this;
    }

    /**
     * Setter for flag FLAG_OVERWRITE_NUMERIC_KEY.
     *
     * @param mixed $flagOverwrite 标记.
     *
     * @return $this
     */
    public function overwriteNumericKey($flagOverwrite)
    {
        if ($flagOverwrite) {
            $this->setFlag(self::FLAG_OVERWRITE_NUMERIC_KEY);
        } else {
            $this->unsetFlag(self::FLAG_OVERWRITE_NUMERIC_KEY);
        }
        return $this;
    }

    /**
     * Setter for flag FLAG_PREVENT_DOUBLE_VALUE_WHEN_APPENDING_NUMERIC_KEYS.
     *
     * @param mixed $flag 标记.
     *
     * @return $this
     */
    public function preventDoubleValuesWhenAppendingNumericKeys($flag)
    {
        if ($flag) {
            $this->setFlag(self::FLAG_PREVENT_DOUBLE_VALUE_WHEN_APPENDING_NUMERIC_KEYS);
        } else {
            $this->unsetFlag(self::FLAG_PREVENT_DOUBLE_VALUE_WHEN_APPENDING_NUMERIC_KEYS);
        }
        return $this;
    }

    /**
     * Setter for flag mergeRecursively.
     *
     * @param mixed $default    标记.
     * @param mixed $precedence 标记.
     * @param mixed $flags      标记.
     *
     * @return $this
     * @throws \UnexpectedValueException 报错.
     */
    protected static function mergeRecursively($default, $precedence, $flags)
    {
        if (\is_array($default) && \is_array($precedence)) {
            return static::doMerge($default, $precedence, $flags);
        }
        if (! \is_array($default) && ! \is_array($precedence)) {
            return $precedence; // overwrite default by precedence
        }
        if (! ($flags & self::FLAG_ALLOW_SCALAR_TO_ARRAY_CONVERSION)) {
            $logMsg = "doMerge: different dimensions \n";
            \ScrmCore\EsnInterface::log($logMsg);
            // throw new \Exception($logMsg, Status::ERR_IS_REQUIRED);
        }
        if (! \is_array($default)) {
            $default = array(0 => $default);
        } else {
            $precedence = array(0 => $precedence);
        }
        return static::doMerge($default, $precedence, $flags);
    }

    /**
     * Setter for flag setFlag.
     *
     * @param mixed $flag 标记.
     *
     * @return mixed
     */
    private function setFlag($flag)
    {
        $this->flags = $this->flags | $flag;
    }

    /**
     * Setter for flag unsetFlag.
     *
     * @param mixed $flag 标记.
     *
     * @return mixed
     */
    private function unsetFlag($flag)
    {
        $this->flags = $this->flags & ~$flag;
    }

    /**
     * Setter for flag unsetFlag.
     *
     * @param mixed $array 标记.
     *
     * @return mixed
     */
    public static function arrayDepth($array)
    {
        if(!is_array($array)) return 0;
        $max_depth = 1;
        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = self::arrayDepth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }
        return $max_depth;
    }

}
