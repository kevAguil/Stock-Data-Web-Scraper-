<!DOCTYPE html>
<html>

<h1> Top Active Stocks </h1>
<body>
    <?php
        require 'vendor/autoload.php';

        $client  = new MongoDB\Client;("mongodb://@localhost:27017/");
        $db = $client->stock_database;
        $collection = $db->top_active_stocks;

        $result = $collection->find([]);

        $sortField = "sort";

        if(isset($_GET["sort"]))
        {
            $sortField = $_GET["sort"];
        }

        $result = $collection->find([], ['sort'=>[$sortField => 1]]);

        # generate html table:
        # table header
        echo "<table border=\"1\"\n>";
        echo "<thead>\n";
        echo "<tr>\n";
        echo "<th><a href='?sort=Index'>Index</a></th>
              <th><a href='?sort=Symbol'>Symbol</a></th>
              <th><a href='?sort=Name'>Name</a></th>
              <th><a href='?sort=Price'>Price</a></th>
              <th><a href='?sort=Change'>Change</a></th>
              <th><a href='?sort=Volume'>Volume</a></th>";
        echo "</tr>\n";
        echo "</thead>\n";
        # table body
        echo "<tbody>\n";
        echo "<tr>\n";
        foreach ($result as $doc) { #each row
            echo "<tr>\n";
            foreach ($doc as $key => $value) {
                if ($key!='_id'){
                    if($key == 'Volume'){
                        echo "<td>";
                        $converted_val = (string) $value;
                        $converted_val .= "M";
                        echo "{$converted_val}";
                        echo "</td>";
                    }
                    else{
                        echo "<td>";
                        echo "{$value}";
                        echo "</td>";
                    }
                }
            }
            echo "\n</tr>\n";
        }
        echo "</tbody>\n";
        echo "</table>\n";
        
    ?>
</body>
</html>




