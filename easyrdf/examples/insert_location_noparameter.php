<?php
     /** 
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     *
     *
        * This code will insert a location into thk ontology
        * The input base on a file ../../form_location.html
     */



    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
    require_once "EasyRdf.php";
    require_once "html_tag_helpers.php";

    // Setup prefix
EasyRdf_Namespace::set ('rdf' , 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
EasyRdf_Namespace::set ('owl' , 'http://www.w3.org/2002/07/owl#');
EasyRdf_Namespace::set ('rdfs' , 'http://www.w3.org/2000/01/rdf-schema#');
EasyRdf_Namespace::set ('thk' ,  'http://dpch.oss.web.id/Bali/TriHitaKarana.owl#');
EasyRdf_Namespace::set('thk', 'http://dpch.oss.web.id/Bali/TriHitaKarana.owl#');

    $client = new EasyRdf_Sparql_Client('http://dpch.oss.web.id:3030/thk/update');
    $client->update(
        'INSERT DATA {
thk:KecDenpasarBarat a thk:Kecamatan;
thk:isPartOf thk:Denpasar.
thk:DesaAdatPenamparan a thk:Desa;
thk:isPartOf thk:KecDenpasarBarat.
thk:BanjarAdatPenamparan a thk:Banjar;
    thk:isPartOf thk:DesaAdatPenamparan.
}');
?>
