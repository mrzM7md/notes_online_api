<?php
    function filterRequest($requestName){  // for sql injection !!
        return htmlspecialchars(strip_tags($_POST[$requestName]));
    }
?>