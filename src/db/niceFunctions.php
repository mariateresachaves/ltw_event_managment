<?php
    function searchSubArray(Array $array, $key, $value) {
        foreach ($array as $subarray){
            if (isset($subarray[$key]) && $subarray[$key] == $value)
              return true;
        }
        return false;
    }
?>