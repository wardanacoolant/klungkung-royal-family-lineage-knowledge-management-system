<?php
    /**
     * 
     * 
     *    
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
    require_once "EasyRdf.php";
    require_once "html_tag_helpers.php";

    // Setup some additional prefixes
    EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
	EasyRdf_Namespace::set('thk', 'http://dpch.oss.web.id/Bali/TriHitaKarana.owl#');

    $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/thk/query');
?>
<html>
<head>
  <title>List of Space</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>List of Space in Bali</h1>

<h2>Lists of villages in Bali</h2>
<ul>
<?php
    $result = $sparql->query(
        'SELECT * WHERE {'.
        '  ?Desa rdf:type thk:Desa .'.
        '} ORDER BY ?Desa'
    );
    foreach ($result as $row) {
                $desa_name = explode("#",$row->Desa);
                $desa_name_view = $desa_name[1];
                $desa_name_view = preg_replace('/(?<!\ )[A-Z]/', ' $0', $desa_name_view);
        echo "<li> <a href=".($row->Desa)."> ".$desa_name_view."</a></li>\n";
    }
?>
</ul>
<p>Total number of Villages: <?= $result->numRows() ?></p>

<h2>Lists of banjars in Bali</h2>
<ul>
<?php
    $result = $sparql->query(
        'SELECT * WHERE {'.
        '  ?Banjar rdf:type thk:Banjar .'.
        '} ORDER BY ?Banjar'
    );
    foreach ($result as $row) {
                $banjar_name = explode("#",$row->Banjar);
                $banjar_name_view = $banjar_name[1];
                $banjar_name_view = preg_replace('/(?<!\ )[A-Z]/', ' $0', $banjar_name_view);
        echo "<li> <a href=".($row->Banjar)."> ".$banjar_name_view."</a></li>\n";
    }
?>
</ul>
<p>Total number of Banjars: <?= $result->numRows() ?></p>
</body>
</html>
