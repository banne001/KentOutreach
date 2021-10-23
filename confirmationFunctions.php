<?php

// Validate name
function validName($name)
{
    return !empty($name); //&& ctype_alpha($name);
}

// Validate needs
function validNeeds($needs){
    if($needs == 'Utilities' OR $needs == 'Rent' OR $needs == 'Gas' OR $needs == 'Clothing/Household Items'
        OR $needs == 'ID/Drivers License' OR $needs == 'Food' OR $needs = 'Other: ')
    {
        return true;
    }else{
        return false;
    }
}

// Validate email
function validEmail($email)
{
    if(empty($email)){
        return false;
    }
    else{
        return true;
    }

}

