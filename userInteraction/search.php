<?php
try
{
    $fieldName = array("firstName", "lastName", "team", "championships");

    $srchField = filter_input(INPUT_POST, "srchField"); #first parameter - method used to pass data || second parameter : "widget" data is being pulled from
    $srchValue = filter_input(INPUT_POST, "srchVal");

    //in_array je funkcija koja provjerava je li proslijedeni parametar u proslijedenom polju - prvi parametar funkcije je onaj koji provjeravamo je li u polju

    if(in_array($srchField, $fieldName))    
    {
        $field = $srchField;    //polje, tj. stupac u tablici koji pretrazujemo
        $value = "%$srchValue%";     //vrijednost koju trazimo u odredeno stupcu - u ovom slucaju je to korisnicki unos koji je sam po sebi opasan 
        
        $db_conn = new PDO('mysql:host = localhost; dbname = testing', "root", "");
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $db_conn->prepare("SELECT * FROM testing.f1_data WHERE $field LIKE ?"); 
        //preparan statement - $field predstavlja stupac koji pretrazujemo, ? predstavlja placeholder za korisnicki unos koji ce se traziti u stupcu    
        $statement->execute(array($value));

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(empty($result))
        {
            print "No matches found";
        }
        else
        {
            foreach($result as $row)    //udes u row
            {       
                foreach($row as $field=>$value) //iteriras u rowu po key-value parovima
                {
                    print "<strong>$field:</strong> $value <br />";
                }
                print "<br />";
            }
        }
    }
    else
    {   
        print "That is not a valid field name";
    }
}
catch(PDOException $exception)
{
    echo 'Error : ' .$exception->getMessage();
}
?>