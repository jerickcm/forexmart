<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Cyrillic_partnership {
    /*do commit not change this library */
    function __construct(){

    }

    public static function check(){
        return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

    public static function email(){
        return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

    public static function fullname(){
        return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

    public static function phone(){
        return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

    public static function message(){
        return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

    public static function companyname(){
        return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

    public static function registrationnumber(){
       return '/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
�������������������������������ѿ�������ߵ������������������������������������������������������������������������.-_\-\_]/i';
    }

}