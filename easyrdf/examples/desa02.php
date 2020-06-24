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

    // Setup some additional prefixes for DBpedia
    EasyRdf_Namespace::set('category', 'http://dbpedia.org/resource/Category:');
    EasyRdf_Namespace::set('dbpedia', 'http://dbpedia.org/resource/');
    EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
    EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');
EasyRdf_Namespace::set('thk', 'http://dpch.oss.web.id/Bali/TriHitaKarana.owl#');

    $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/thk/query');
?>
<html>
<head>
  <title>List of Villages</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>List of Villages in Bali</h1>

<h2>Lists of villages in Bali</h2>
<ul>
<?php
    $result = $sparql->query(
        "SELECT DISTINCT ?namadesa
      {    ?Desa rdf:type thk:Desa ;
          rdfs:label ?namadesa .
        } ORDER BY ?namadesa "
    );
    foreach ($result as $row) {
		$desa_name = explode("#",$row->namadesa);
    $desa_name_view = $desa_name[1];
		
    	echo "<li> <a href=".($row->namadesa)."> ".$desa_name_view."</a></li>\n";
    }
?>
</ul>
<p>Total number of Villages: <?= $result->numRows() ?></p>

</body>
</html>
