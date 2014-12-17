function loadCSSTables(){
    $counterTable = 1;
    $newStyles = "";            
    $("table").each(function() {
        $(this).addClass("qlTables" + $counterTable);
        $thisTableClass = "qlTables" + $counterTable;                   
        $tableRowCounter = 1;           
        $tableClass = "";               
        $("table." + $thisTableClass + " tr th").each(function() {                      
            $newStyles += "table." + $thisTableClass + " tr td:nth-of-type(" + $tableRowCounter + "):before {content:'" + $(this).text() + "';} ";            
            $tableRowCounter ++;
        });             
        $counterTable ++;
    }); 
    $('head').append("<style type='text/css'>@media (max-width: 767px){" + $newStyles + "}</style>");
    $("table tbody tr:odd").css("background", "#EFEFEF");
}