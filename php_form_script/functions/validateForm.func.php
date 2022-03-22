<?php
// this script contains all form validation functions for the registration and login pages


function checkEmpty($param){
    if(empty($param)){
        return true;
    }
}

function validateName($param){
    if(!ctype_alpha($param)){
        return true;
    }
}

function validateEmail($param){
    if(!filter_list($param, FILTER_VALIDATE_EMAIL)){
        return true;
    }
}

function validateNum($param){
    if(strlen($param)<12){
        if(!ctype_digit($param)){
            return true;
        }
    }
}

function validatePswd($param){
    if(strlen($param) < 8 || strlen($param) > 16 ){
        if(preg_match("/\d/",$param)){
            if(preg_match("/[a-z]/",$param)){
                if(preg_match("/[A-Z]/",$param)){
                    if(preg_match("/\s/",$param)){
                        if(preg_match("/\s/",$param)){
                            return true;
                        }
                    }
                }
            }
        }
    }
}

function checkPwsd_again($pass1, $pass2){
    if($pass1 !== $pass2){
        return true;
    }
}