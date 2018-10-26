<HTML>
<HEAD>
<style>
body {
background: green;
}
#main {
position:fixed;
top: 30%;
left: 54%;
width:20em;
height:35em;
margin-top: -9em;
margin-left: -15em;
padding: 10px;
box-shadow: 10px 10px darkgreen;
border: 1px solid #ccc;
background-color: #f3f3f3;
}

#list {
background: white;
}

.button {
background-color: #4CAF50; /* Green */
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
}
</style>

</HEAD>
<BODY>
<?php
    echo "<h1 style='color: white;'>PHP Recipe Ingredient Shopper</h1>";
    echo "<div id='main'>";
    
    echo "<p><i>Input all the ingredients you need to buy at the grocery store to complete your recipe.</i></p>";
    
    echo "<form onsubmit='danielbutton_complex.php' method='post'>";
    echo "Ingredient: <input style='width: 100%; font-size: 20px;' type='text' name='item' placeholder='ex: milk'>";
    echo "Amount needed of above item: <input type='text' style='width: 100%; font-size: 20px;' type='text' name='amount' placeholder='ex: 1/2 gallon'>";
    echo "<input class='button' type='submit' value='Add' name='submit'>";
    echo "</form>";
    
    echo "<p style='text-align: center;'> <b>Your Recipe Ingredient Shopping List</b> </p>";
    
    echo "<div id='list'>";
    $myfile = fopen("list.xml", "r") or die("Unable to open file!");
    $list = fread($myfile,filesize("list.xml"));
    echo nl2br($list);
    fclose($myfile);
    echo "</div>";
    
    echo "<br><br>";
    echo "<form style='text-align: center;' onsubmit='danielbutton_complex.php' method='post'>";
    echo "<input class='button' style='background-color: black;' type='submit' name='delete' value='Delete Last Row'>";
    echo "</form>";
    
    echo "<form style='text-align: center;' onsubmit='danielbutton_complex.php' method='post'>";
    echo "<input class='button' style='background-color: #f44336;' type='submit' name='deleteAll' value='Delete Entire List'>";
    echo "</form>";
    
    echo "</div>";
    
    function addItem()
    {
        $myfile2 = fopen("list.xml", "a") or die("Unable to open file!");
        $txt = "\r\n" . $_POST["item"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST["amount"];
        fwrite($myfile2, $txt);
        fclose($myfile2);
        header("Refresh:0");
    }
    if(isset($_POST['submit']))
    {
        addItem();
    }

    function delete()
    {
        $lines = file('list.xml');
        $last = sizeof($lines) - 1 ;
        unset($lines[$last]);
        $fp = fopen('list.xml', 'w');
        fwrite($fp, implode('', $lines));
        fclose($fp);
        header("Refresh:0");
    }
    if(isset($_POST['delete']))
    {
        delete();
    }
    
    function deleteAll()
    {
        $myfile3 = fopen("list.xml", "w") or die("Unable to open file!");
        $txt = "";
        fwrite($myfile3, $txt);
        fclose($myfile3);
        header("Refresh:0");
    }
    if(isset($_POST['deleteAll']))
    {
        deleteAll();
    }
    ?>
</BODY>
</HTML>
