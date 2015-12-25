	<meta charset="UTF-8">

<?php 
class CsvImporter 
{ 
    private $fp; 
    private $parse_header; 
    private $header; 
    private $delimiter; 
    private $length; 
    //-------------------------------------------------------------------- 
    function __construct($file_name, $parse_header=true, $delimiter=",", $length=90000) 
    { 
        $this->fp = fopen($file_name, "r"); 
        $this->parse_header = $parse_header; 
        $this->delimiter = $delimiter; 
        $this->length = $length; 
     //  $this->lines = $lines; 

        if ($this->parse_header) 
        { 
           $this->header = fgetcsv($this->fp, $this->length, $this->delimiter); 
        } 

    } 
    //-------------------------------------------------------------------- 
    function __destruct() 
    { 
        if ($this->fp) 
        { 
            fclose($this->fp); 
        } 
    } 
    //-------------------------------------------------------------------- 
    function get($max_lines=0) 
    { 
        //if $max_lines is set to 0, then get all the data 

        $data = array(); 

        if ($max_lines > 0) 
            $line_count = 0; 
        else 
            $line_count = -1; // so loop limit is ignored 

        while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) 
        { 
            if ($this->parse_header) 
            { 
                foreach ($this->header as $i => $heading_i) 
                { 
                    $row_new[$heading_i] = $row[$i]; 
                } 
                $data[] = $row_new; 
            } 
            else 
            { 
                $data[] = $row; 
            } 

            if ($max_lines > 0) 
                $line_count++; 
        } 
        return $data; 
    } 
    //-------------------------------------------------------------------- 

} ?>
<form enctype="multipart/form-data"
	action="index.php" method="post">
<input type="file" name="myfile"><br>
<input type="submit" value="Отправить">
</form>

<pre>
<?php
if (isset($_FILES['myfile']))
  {
$importer = new CsvImporter($_FILES['myfile']['tmp_name'],true); 
$data = $importer->get(); 
//$r= array_unique($data);

for ($b=1;$b<count($data);$b++){

$r[]=$data[$b]['Order Items: Product Name'];

}
 $result = array_unique($r);
for ($x=0;$x<count($r);$x++){
$s=$r[$x];
$rr[$s]=0;
}
for ($b=1;$b<count($data);$b++){
$s=$data[$b]['Order Items: Product Name'];
$v=$data[$b]['Order Items: Quantity'];
$rr[$s]=$rr[$s]+$v;


}
//var_dump($rr);
foreach($rr  as $key => $value ){ 
if ($key<>'') $bb[]=array($key,$value);

}


function array2csv($input_array, $delimiter = ',', $enclosure = '"', $force_enclose = false, $crlf = "\r\n")
{
        // filter incoming params
        if (!is_array($input_array))
                return false;
        $delimiter     = @trim($delimiter);
        $enclosure     = @trim($enclosure);
        $force_enclose = @(bool)$force_enclose;
        $crlf          = @(string)$crlf;

        // transform array into 2-d array of strings
        if (!is_array(array_shift(array_values($input_array))))
                $input_array = array($input_array);
        foreach (array_keys($input_array) as $k)
        {
                if (!is_array($input_array[$k]))
                        return false;
                foreach ($input_array[$k] as $j=>$value)
                        $input_array[$k][$j] = @(string)$value;
        }

        // process input array
        // RFC-compatible CSV (requires PHP 5)
        if (false === $force_enclose)
        {
                if (!function_exists('fputcsv'))
                        return false;
                // taken from http://www.php.net/manual/ru/function.fputcsv.php
                $csv = fopen('php://temp/maxmemory:'. (1048576), 'r+'); // try to allocate 1 MB of memory
                if (false === $csv)
                        return false;
                foreach ($input_array as $row)
                        if (false === fputcsv($csv, $row, $delimiter, $enclosure))
                                return false;
                rewind($csv);
                return stream_get_contents($csv);
        }
        // RFC-incompatible, self-made
        else
        {
                $csv_string = '';
                foreach ($input_array as $row)
                {
                        $row_enclosed = array();
                        foreach ($row as $element)
                                $row_enclosed[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $element) . $enclosure;
                        $csv_string .= implode($delimiter, $row_enclosed) . $crlf;
                }
                return $csv_string;
        }
}

$tt=array2csv($bb);
echo "Отчет готов. <a href='file.csv'>Скачать</a>";
$fp = fopen ('file.csv', "w+");

fwrite($fp, $tt);

 
fclose($fp);

}
?>