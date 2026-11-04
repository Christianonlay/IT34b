<?php

function exportCsv(string $filename, array $headers,array $rows):viod

{
    if(ob_get_level()){
        ob_end_clean();

    }

    $safeName = preg_replace('/[^A-Za-z0-9_\-]/','_',$filename);
    $safeNmae .= '_' .date('Y-m-d_His') . '.csv';

    header('Content-Type: text/csv;charset=utf-8');
    header('Content-Disposition: attachment; filename="'.$safeName.'"');
    header('Progma: no cache');
    header('Expires:0');

    $out = fopen('php://output','w');

    fwrite($out, "\xEF\XBB\xBF");

    fputcsv($out,$header);

    foreach ($rows as $row){
        fputcsv($out, array_values($row));

    }
    fclose($out);
    exit;

}