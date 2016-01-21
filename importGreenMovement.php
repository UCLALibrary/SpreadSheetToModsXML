<html>
  <head>
  <style>
table
{
border-collapse:collapse;
}
table, td, th
{
border:1px solid black;
}
</style>
  </head>
<body>
<?php
$data = array();
//if ( $_FILES['file']['tmp_name'] )
//{
  $dom1 = DOMDocument::load("C://projects//dep//12-11-2015//metadata_Protests_final_converted.xml");
 
  $rows = $dom1->getElementsByTagName( 'Row' );
   $index=1;
   echo "<table><tbody>";
    foreach ($rows as $row)
    {
       
      $dom = new DOMDocument('1.0');
         echo "<tr>";
          $cells = $row->childNodes;
         $datarow = array();
         $cellindex=1;
         $mods = $dom->appendChild($dom->createElement('mods:mods'));
         $modsxmlns=$dom->createAttribute("xmlns:mods");
         $modsxmlns->value = "http://www.loc.gov/mods/v3";
         $mods->appendChild($modsxmlns);
         $modsxsi=$dom->createAttribute("xmlns:xsi");
         $modsxsi->value = "http://www.w3.org/2001/XMLSchema-instance";
         $mods->appendChild($modsxsi);
         $modsxlink=$dom->createAttribute("xmlns:xlink");
         $modsxlink->value = "http://www.w3.org/1999/xlinks";
         $mods->appendChild($modsxlink);
         $modsschemalocation=$dom->createAttribute("xsi:schemaLocation");
         $modsschemalocation->value = "http://www.loc.gov/mods/v3 http://www.loc.gov/standards/mods/v3/mods-3-4.xsd";
         $mods->appendChild($modsschemalocation);
       
         $relatedItem = $dom->createElement("mods:relatedItem");
          $titleInfo = $dom->createElement("mods:titleInfo");
           $collectionName = $dom->createElement("mods:title","Green Movement collection");
           $titleInfo->appendChild($collectionName);
           $relatedItem->appendChild($titleInfo);
           $mods->appendChild($relatedItem);
           /*
            * <mods:name type="corporate" authority="naf">
                        <mods:namePart>University of California, Los Angeles. $b Library. $b Dept. of Special Collections</mods:namePart>
                        <mods:role>
                            <mods:roleTerm type="text">Repository</mods:roleTerm>
                            <mods:roleTerm type="code" authority="marcrelator">rps</mods:roleTerm>
                        </mods:role>
                    </mods:name>
            */
           $name = $dom->createElement("mods:name");
                    $typecorporate = $dom->createAttribute("type");
                    $typecorporate->value = "corporate";
                    $name->appendChild($typecorporate);  
                     $authorityName = $dom->createAttribute("authority");
                    $authorityName->value = "naf";
                    $name->appendChild($authorityName);
                    $namePart = $dom->createElement("mods:namePart","University of California, Los Angeles. \$b Library.");
                    $name->appendChild($namePart);
                    $role = $dom->createElement("mods:role");
                    $roleTerm = $dom->createElement("mods:roleTerm","repository");
                    $roleTermType = $dom->createAttribute("type");
                    $roleTermType->value = "text";
                    $roleTerm->appendChild($roleTermType);
                    $role->appendChild($roleTerm);   
                    $roleTerm = $dom->createElement("mods:roleTerm","rps");
                    $roleTermType = $dom->createAttribute("type");
                    $roleTermType->value = "code";
                     $roleTermAutority = $dom->createAttribute("authority");
                    $roleTermAutority->value = "marcrelator";
                    $roleTerm->appendChild($roleTermType);
                    $roleTerm->appendChild($roleTermAutority);
                    $role->appendChild($roleTerm);  
                    $name->appendChild($role);
                    $mods->appendChild($name);
         $fileName = "";
         foreach ($cells as $cell)
         {
              
           switch ($cell->nodeName) {
             
               case "File_name__no_extension_indicates_folder_name":
                   // Identifier
                   
                    $identifier = $dom->createElement("mods:identifier",  htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                    $type=$dom->createAttribute("type");
                    $type->value = "local";
                    $identifier->appendChild($type);                    
                    $mods->appendChild($identifier);
                    $fileName = trim($cell->nodeValue);                   
                     break;
               case 'file_name_no_extension_indicates_folder_name':
                   // Identifier
                   
                     $identifier = $dom->createElement("mods:identifier",  htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                    $type=$dom->createAttribute("type");
                    $type->value = "local";
                    $identifier->appendChild($type);                    
                    $mods->appendChild($identifier);
                    $fileName = trim($cell->nodeValue);                   
                     break;
               case 'Title__English':
                   //Title
                    $titleInfo = $dom->createElement("mods:titleInfo");
                    $titleTile = $dom->createElement("mods:title",htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                     $EngLang = $dom->createAttribute("lang");
                   $EngLang->value = "eng";
                   $titleTile->appendChild($EngLang);
                    $titleInfo->appendChild($titleTile);
                    $mods->appendChild($titleInfo);
                     break;
               case 'Title__Farsi':
                   //Title
                    $titleInfo = $dom->createElement("mods:titleInfo");
                    $titleTile = $dom->createElement("mods:title",trim($cell->nodeValue));
                    $farsiLang = $dom->createAttribute("lang");
                   $farsiLang->value = "per";
                   $titleTile->appendChild($farsiLang);
                    $titleInfo->appendChild($titleTile);
                    $mods->appendChild($titleInfo);
                     break;  
                  case 'Folder':
                   $relatedItemFolder = $dom->createElement("mods:relatedItem");
                   $relatedItemType=$dom->createAttribute("type");
                   $relatedItemType->value = "series";
                   $relatedItemFolder->appendChild($relatedItemType);
                   $titleInfo = $dom->createElement("mods:titleInfo");
                   $seriesTitle = $dom->createElement("mods:title",trim($cell->nodeValue));
                    $titleInfo->appendChild($seriesTitle);
                    $relatedItemFolder->appendChild($titleInfo);
                    $mods->appendChild($relatedItemFolder);
                    
                     break;  
               case 'Physical_Type':
                   // PhysicalDescription.extent
                   if(trim($cell->nodeValue) != false){
                   $PhysicalDescription = $dom->createElement("mods:physicalDescription"); 
                   $digitalOrigin = $dom->createElement("mods:digitalOrigin","born digital");
                   $reformattingQuality = $dom->createElement("mods:reformattingQuality","preservation");
                   if(trim($cell->nodeValue) == 'Video' || trim($cell->nodeValue) == 'video'){
                   $extent = $dom->createElement("mods:extent","moving image");
                   $PhysicalDescription->appendChild($extent);
                   $internetMediaType = $dom->createElement("mods:internetMediaType","video/mp4");
                   $PhysicalDescription->appendChild($internetMediaType);
                   $typeOfResource = $dom->createElement("mods:typeOfResource","moving image");
                   $mods->appendChild($typeOfResource);
                    $genre = $dom->createElement("mods:genre","streaming video");
                    $genreAuthority = $dom->createAttribute("authority");
         $genreAuthority->value = "aat";
         $genre->appendChild($genreAuthority);
        $mods->appendChild($genre);
                    $languageTerm = $dom->createElement("mods:languageTerm","per");
                     $language = $dom->createElement("mods:language"); 
         $languageTyepe = $dom->createAttribute("type");
         $languageTyepe->value="code";
         $languageTerm->appendChild($languageTyepe);
         $languaheAuthority = $dom->createAttribute("authority");
         $languaheAuthority->value="iso639-2b";
         $languageTerm->appendChild($languaheAuthority);
                   $language->appendChild($languageTerm);
                   $mods->appendChild($language);
                   }
                   if(trim($cell->nodeValue) == 'image'){
                   $extent = $dom->createElement("mods:extent","still image");
                    $PhysicalDescription->appendChild($extent);
                   $internetMediaType = $dom->createElement("mods:internetMediaType","image/jpeg");
                   $PhysicalDescription->appendChild($internetMediaType);
                   $typeOfResource = $dom->createElement("mods:typeOfResource","still image");
                   $mods->appendChild($typeOfResource);
                    $genre = $dom->createElement("mods:genre","digital images");
                    $genreAuthority = $dom->createAttribute("authority");
         $genreAuthority->value = "aat";
         $genre->appendChild($genreAuthority);
        $mods->appendChild($genre);
                     $languageTerm = $dom->createElement("mods:languageTerm","zxx");
                      $language = $dom->createElement("mods:language"); 
         $languageTyepe = $dom->createAttribute("type");
         $languageTyepe->value="code";
         $languageTerm->appendChild($languageTyepe);
         $languaheAuthority = $dom->createAttribute("authority");
         $languaheAuthority->value="iso639-2b";
         $languageTerm->appendChild($languaheAuthority);
                   $language->appendChild($languageTerm);
                   $mods->appendChild($language);
                   }
                   $PhysicalDescription->appendChild($digitalOrigin); 
                   $PhysicalDescription->appendChild($reformattingQuality); 
                   
                  
                   $mods->appendChild($PhysicalDescription);
                   
                   
         
       
                     }
                     break;
               case 'Lat__Lon':                   
                   if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $cartographics = $dom->createElement("mods:cartographics");
                   $latLong = trim($cell->nodeValue);                  
                    $coordinates = $dom->createElement("mods:coordinates",$latLong);
                   $cartographics->appendChild($coordinates);
                   $subject->appendChild($cartographics);
                   $mods->appendChild($subject);
                   }
                     break;
              case 'Lat_Lon':                   
                   if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $cartographics = $dom->createElement("mods:cartographics");
                   $latLong = trim($cell->nodeValue);                  
                    $coordinates = $dom->createElement("mods:coordinates",$latLong);
                   $cartographics->appendChild($coordinates);
                   $subject->appendChild($cartographics);
                   $mods->appendChild($subject);
                   }
                     break;       
               
               case 'Date__Farsi':
                   if(trim($cell->nodeValue) != false){
                   $dateCreatedInfo = $dom->createElement("mods:originInfo"); 
                   $dateCreated = $dom->createElement("mods:dateCreated",trim($cell->nodeValue));
                   $farsiLang = $dom->createAttribute("lang");
                   $farsiLang->value = "per";
                   $dateCreated->appendChild($farsiLang);
                   $dateCreatedInfo->appendChild($dateCreated);
                   $mods->appendChild($dateCreatedInfo);
                     }
                     break;
               case 'Date__Gregorian':
                    if(trim($cell->nodeValue) != false){
                   $dateCreatedInfo = $dom->createElement("mods:originInfo"); 
                   $dateCreated = $dom->createElement("mods:dateCreated",trim($cell->nodeValue));
                   $EngLang = $dom->createAttribute("lang");
                   $EngLang->value = "eng";
                   $dateCreated->appendChild($EngLang);
                   $dateCreatedInfo->appendChild($dateCreated);
                   $mods->appendChild($dateCreatedInfo);
                     }
                     break;
               case 'Date__Normalized':
                    if(trim($cell->nodeValue) != false){
                   $dateCreatedInfo = $dom->createElement("mods:originInfo"); 
                   $dateCreated = $dom->createElement("mods:dateCreated",trim($cell->nodeValue));
                   $encoding = $dom->createAttribute("encoding");
                   $encoding->value = "iso8601";
                   $dateCreated->appendChild($encoding);
                   $dateCreatedInfo->appendChild($dateCreated);
                   $mods->appendChild($dateCreatedInfo);
                     }
                     break;
               case 'Place__Transliterated':
                   //<mods:subject><mods:hierarchicalGeographic><mods:area transliteration="unspecified">
                    if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $area = $dom->createElement("mods:area",htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                   $lang = $dom->createAttribute("transliteration");
                   $lang->value = "unspecified";
                   $area->appendChild($lang);
                   $hierarchicalGeographic->appendChild($area);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;
               case 'Place__Farsi':
                   //<mods:subject><mods:hierarchicalGeographic><mods:area lang="per">

                    if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $area = $dom->createElement("mods:area",trim($cell->nodeValue));
                   $lang = $dom->createAttribute("lang");
                   $lang->value = "per";
                   $area->appendChild($lang);
                   $hierarchicalGeographic->appendChild($area);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;
               case 'City__LCSH_or_Transliterated':
                   //<mods:subject><mods:hierarchicalGeographic><mods:city lang="eng">
                    if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $city = $dom->createElement("mods:city",htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                   $lang = $dom->createAttribute("lang");
                   $lang->value = "eng";
                   $city->appendChild($lang);
                   $hierarchicalGeographic->appendChild($city);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;
               case 'City__Farsi':
                   //<mods:subject><mods:hierarchicalGeographic><mods:city lang="per">
                    if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $city = $dom->createElement("mods:city",trim($cell->nodeValue));
                   $lang = $dom->createAttribute("lang");
                   $lang->value = "per";
                   $city->appendChild($lang);
                   $hierarchicalGeographic->appendChild($city);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;  
               case 'Country__English':
                   //<mods:subject><mods:hierarchicalGeographic><mods:country lang="eng">
                    if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $country = $dom->createElement("mods:country",utf8_encode(trim($cell->nodeValue)));
                   $lang = $dom->createAttribute("lang");
                   $lang->value = "eng";
                   $country->appendChild($lang);
                   $hierarchicalGeographic->appendChild($country);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;  
               case 'Country__Farsi':
                   //<mods:subject><mods:hierarchicalGeographic><mods:country lang="per">
                    if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $country = $dom->createElement("mods:country",trim($cell->nodeValue));
                   $lang = $dom->createAttribute("lang");
                   $lang->value = "per";
                   $country->appendChild($lang);
                   $hierarchicalGeographic->appendChild($country);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;  
               case 'Description__English':
                   //<mods:note lang="eng">
                   if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note", htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                       $lang = $dom->createAttribute("lang");
                        $lang->value = "eng";
                        $note->appendChild($lang);
                      $mods->appendChild($note);
                 }
                     break;  
               case 'Description__Farsi':
                   ////<mods:note lang="per">
                   if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",$cell->nodeValue);
                       $lang = $dom->createAttribute("lang");
                        $lang->value = "per";
                        $note->appendChild($lang);
                      $mods->appendChild($note);
                 }
                     break; 
               case 'Keywords_Chants_Slogans__English':
                   //<mods:note lang="eng" displayLabel="Keywords/Chants/Slogans">
                    if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",  htmlspecialchars(trim($cell->nodeValue),ENT_XML1, 'UTF-8'));
                       $lang = $dom->createAttribute("lang");
                        $lang->value = "eng";
                        $displayLabel = $dom->createAttribute("displayLabel");
                        $displayLabel->value="Keywords/Chants/Slogans";
                        $note->appendChild($lang);
                        $note->appendChild($displayLabel);
                      $mods->appendChild($note);
                 }
                     break;  
               case 'Keywords_Chants_Slogans__Farsi':
                   //<mods:note lang="per" displayLabel="Keywords/Chants/Slogans">
                    if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",$cell->nodeValue);
                       $lang = $dom->createAttribute("lang");
                        $lang->value = "per";
                        $displayLabel = $dom->createAttribute("displayLabel");
                        $displayLabel->value="Keywords/Chants/Slogans";
                        $note->appendChild($lang);
                        $note->appendChild($displayLabel);
                      $mods->appendChild($note);
                 }
                     break;  
               case 'Names__Transliterated':
                   //<mods:note transliteration="unspecified" displayLabel="Names">
                    if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",trim($cell->nodeValue));
                       $lang = $dom->createAttribute("transliteration");
                        $lang->value = "unspecified";
                        $displayLabel = $dom->createAttribute("displayLabel");
                        $displayLabel->value="Names";
                        $note->appendChild($lang);
                        $note->appendChild($displayLabel);
                      $mods->appendChild($note);
                 }
                     break;  
               case 'Names__Farsi':
                   //<mods:note lang="per" displayLabel="Names">
                    if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",$cell->nodeValue);
                       $lang = $dom->createAttribute("lang");
                        $lang->value = "per";
                        $displayLabel = $dom->createAttribute("displayLabel");
                        $displayLabel->value="Names";
                        $note->appendChild($lang);
                        $note->appendChild($displayLabel);
                      $mods->appendChild($note);
                 }
                     break;  
             default:
               break;
           }
           echo "<td>";
             echo $cell->nodeValue;
             $datarow []= $cell->nodeValue;
             echo "</td>";
             $cellindex += 1;
         }
          $dom->encoding="UTF-8";
      $dom->formatOutput = true;
       $dom->save("C://projects//dep//12-11-2015//mods//metadata_Protests_final_converted//".$fileName.".xml");
          echo "</tr>";
     
    }
 
     echo "</tbody></table><br/><br/>";
 
//}

?>

</body>
</html>