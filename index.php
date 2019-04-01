<html>  
    <head>  
    <Title>azure submision 1 - Bintang Piaggi</Title>  
    </head>  
    <body>  
    <form method="post" action="?action=tambah" enctype="multipart/form-data" >  
    Nomer <input type="text" name="c_no" id="c_no"/></br>  
    Nama <input type="text" name="c_nama" id="c_nama"/></br>  
    Jumlah <input type="text" name="c_jumlah" id="c_jumlah"/></br>  
    Harga <input type="text" name="c_harga" id="c_harga"/></br>  
    <input type="submit" name="submit" value="Submit" />  
    </form>  
    <?php  
    /*Konek.*/  
    $serverName = "bintangwebdb.database.windows.net";  
    $connectionOptions = array(  
        "Database" => "bintangdb",  
        "UID" => "bintang",  
        "PWD" => "bb123oke.."  
    );  
    $conn = sqlsrv_connect($serverName, $connectionOptions);  
      
    if ($conn === false)  
        {  
        die(print_r(sqlsrv_errors() , true));  
        }  
      
    if (isset($_GET['action']))  
        {  
        if ($_GET['action'] == 'tambah')  
            {  
            /*Tambah data.*/  
            $insertSql = "INSERT INTO Barang (nomer,nama,jumlah,harga)   
    VALUES (?,?,?,?)";  
            $params = array(&$_POST['c_no'], &$_POST['c_nama'], &$_POST['c_jumlah'], &$_POST['c_harga']  
            );  
            $stmt = sqlsrv_query($conn, $insertSql, $params);  
            if ($stmt === false)  
                {  
                /*duplicate error.*/  
                $errors = sqlsrv_errors();  
                if ($errors[0]['code'] == 2601)  
                    {  
                    echo "Nama barang sudah ada.</br>";  
                    }  
      
                /*another error.*/  
                  else  
                    {  
                    die(print_r($errors, true));  
                    }  
                }  
              else  
                {  
                echo "Data berhasil ditambahkan</br>";  
                }  
            }  
        }
    /*tampilkan data.*/  
    $sql = "SELECT * FROM Barang ORDER BY nomer"; 
    $stmt = sqlsrv_query($conn, $sql); 
    if($stmt === false) 
    { 
    die(print_r(sqlsrv_errors(), true)); 
    } 
     
    if(sqlsrv_has_rows($stmt)) 
    { 
    print("<table border='1px'>"); 
    print("<tr><td>Nomer</td>"); 
    print("<td>Nama Barang</td>"); 
    print("<td>Jumlah</td>"); 
    print("<td>Harga</td></tr>"); 
     
    while($row = sqlsrv_fetch_array($stmt)) 
    { 
     
    print("<tr><td>".$row['nomer']."</td>"); 
    print("<td>".$row['nama']."</td>"); 
    print("<td>".$row['jumlah']."</td>"); 
    print("<td>".$row['harga']."</td></tr>"); 
    } 
     
    print("</table>"); 
    }
      
    ?>  
    </body>  
    </html>