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
  $dom1 = DOMDocument::load("C://projects//see sunset//SSF-27//sample.xml");
 
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
       
        
         $fileName = "";
         foreach ($cells as $cell)
         {
             
           switch ($cell->nodeName) {
             
               case 'Collection_Number':
                     if(trim($cell->nodeValue) != false){
                   $collectionNumber = $dom->createElement("mods:identifier",trim($cell->nodeValue));
                    $displayLabel=$dom->createAttribute("displayLabel");
                    $displayLabel->value = "Collection number";
                    $collectionNumber->appendChild($displayLabel);                    
                    $mods->appendChild($collectionNumber);
                     }
                    break;
               case 'Collection_Name':          
                     if(trim($cell->nodeValue) != false){
                     $relatedItem = $dom->createElement("mods:relatedItem");
                    $titleInfo = $dom->createElement("mods:titleInfo");
                    $collectionName = $dom->createElement("mods:title",trim($cell->nodeValue));
                    $titleInfo->appendChild($collectionName);
                    $relatedItem->appendChild($titleInfo);
                    $mods->appendChild($relatedItem);
                     }
                     break;
               case 'Box':
                     if(trim($cell->nodeValue) != false){
                     }
                     
                   
                     break;  
                  case 'Folder':
                        if(trim($cell->nodeValue) != false){
                   $relatedItemFolder = $dom->createElement("mods:relatedItem");
                   $relatedItemType=$dom->createAttribute("type");
                   $relatedItemType->value = "series";
                   $relatedItemFolder->appendChild($relatedItemType);
                   $titleInfo = $dom->createElement("mods:titleInfo");
                   $seriesTitle = $dom->createElement("mods:title",htmlentities(trim($cell->nodeValue)));
                    $titleInfo->appendChild($seriesTitle);
                    $relatedItemFolder->appendChild($titleInfo);
                    $mods->appendChild($relatedItemFolder);
                        }
                     break;  
               case 'OAC_Finding_Aid_URL':
                     if(trim($cell->nodeValue) != false){
                  $findingAidUrl = $dom->createElement("mods:location");
                    $url = $dom->createElement("mods:url",trim($cell->nodeValue));
                    $displayLabel=$dom->createAttribute("displayLabel");
                     $displayLabel->value = "Finding Aid";
                     $url->appendChild($displayLabel);                     
                    $findingAidUrl->appendChild($url);
                    $mods->appendChild($findingAidUrl);
                     }
                     break;
               case 'Title':
                   if(trim($cell->nodeValue) != false){
                   $titleInfo = $dom->createElement("mods:titleInfo");
                    $titleTile = $dom->createElement("mods:title",htmlentities(trim($cell->nodeValue)));
                    $titleInfo->appendChild($titleTile);
                    $mods->appendChild($titleInfo);
                   }
                     break;
               
               case 'Identifier':
                   if(trim($cell->nodeValue) != false){
                    $identifier = $dom->createElement("mods:identifier",trim($cell->nodeValue));
                    $type=$dom->createAttribute("type");
                    $type->value = "local";
                    $identifier->appendChild($type);                    
                    $mods->appendChild($identifier);
                    $fileName = $cell->nodeValue;
                     }
                     break;
               case 'Date':
                   if(trim($cell->nodeValue) != false){
                   $dateCreatedInfo = $dom->createElement("mods:originInfo"); 
                   $dateCreated = $dom->createElement("mods:dateCreated",trim($cell->nodeValue));
                   $dateCreatedInfo->appendChild($dateCreated);
                   $mods->appendChild($dateCreatedInfo);
                     }
                     break;
               case 'Date_normalized':
                   if(trim($cell->nodeValue) != false){
                  $dateNormalizedInfo = $dom->createElement("mods:originInfo"); 
                   $dateNormalized = $dom->createElement("mods:dateCreated",trim($cell->nodeValue));
                   $encoding = $dom->createAttribute("encoding");
                   $encoding->value = "iso8601";
                   $dateNormalized->appendChild($encoding);
                   $dateNormalizedInfo->appendChild($dateNormalized);
                   $mods->appendChild($dateNormalizedInfo);
                 }
                 
                     break;
               case 'Neighborhood__Geolocation':
                   
                               if(trim($cell->nodeValue) != false){
                   $subject = $dom->createElement("mods:subject"); 
                   $hierarchicalGeographic = $dom->createElement("mods:hierarchicalGeographic");
                   $city = $dom->createElement("mods:citySection",trim($cell->nodeValue));                  
                   $hierarchicalGeographic->appendChild($city);
                   $subject->appendChild($hierarchicalGeographic);
                   $mods->appendChild($subject);
                   }
                     break;
               case 'Type_genre':
                   
                     if(trim($cell->nodeValue) != false){
                   $genre = $dom->createElement("mods:genre",trim($cell->nodeValue));                             
                  
                   $mods->appendChild($genre);
                     }
                     break;
               case 'Language':
                   
                    if(trim($cell->nodeValue) != false){
                   $language = $dom->createElement("mods:language"); 
                    $languageTyepe = $dom->createAttribute("type");  
                    $languageTyepe->value="code";
                    $languageTerm = $dom->createElement("mods:languageTerm",trim($cell->nodeValue));
                     $language->appendChild($languageTerm);
                   $mods->appendChild($language);
                    
                   }
                     break;
               case 'Subject_conceptTopic_1':
                   if(trim($cell->nodeValue) != false){
                      
                      $subjectconceptTopic1 = $dom->createElement("mods:subject");
                      $subjectAuthorityURI1 = $dom->createAttribute("authorityURI");
                      $subjectAuthorityURI1->value = "http://id.loc.gov/authorities/subjects";
                      $subjectconceptTopic1->appendChild($subjectAuthorityURI1);
                      
                         
                                             
                          $topic1 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $subjectconceptTopic1->appendChild($topic1);
                          
                      $mods->appendChild($subjectconceptTopic1);
                    
                      
                      
                      
                      
                  }
                  
                     break;  
               case 'Subject_conceptTopic_2':
                   if(trim($cell->nodeValue) != false){
                       $subjectconceptTopic2 = $dom->createElement("mods:subject");
                      $subjectAuthorityURI2 = $dom->createAttribute("authorityURI");
                      $subjectAuthorityURI2->value = "http://id.loc.gov/authorities/subjects";
                      $subjectconceptTopic2->appendChild($subjectAuthorityURI2);
                                         
                                             
                          $topic2 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $subjectconceptTopic2->appendChild($topic2);
                          
                      $mods->appendChild($subjectconceptTopic2);
                  }
                     break;  
               case 'Subject_conceptTopic_3':
                   if(trim($cell->nodeValue) != false){
                      $subjectconceptTopic3 = $dom->createElement("mods:subject");
                      $subjectAuthorityURI3 = $dom->createAttribute("authorityURI");
                      $subjectAuthorityURI3->value = "http://id.loc.gov/authorities/subjects";
                      $subjectconceptTopic3->appendChild($subjectAuthorityURI3);
                      
                         
                                             
                          $topic3 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $subjectconceptTopic3->appendChild($topic3);
                          
                      $mods->appendChild($subjectconceptTopic3);
                  }
                     break;  
               case 'Contributor_repository':
                  
                   if(trim($cell->nodeValue) != false){
                    $nameCorporate = $dom->createElement("mods:name");
                    $typeCorporate = $dom->createAttribute("type");
                    $typeCorporate->value = "corporate";
                    $nameCorporate->appendChild($typeCorporate);
                    $role = $dom->createElement("mods:role");
                    $roleTerm = $dom->createElement("mods:roleTerm","repository");
                    $roleTermType = $dom->createAttribute("type");
                    $roleTermType->value = "text";
                    $roleTerm->appendChild($roleTermType);
                    $role->appendChild($roleTerm);
                    $nameCorporate->appendChild($role);
                    $namePartCorporate = $dom->createElement("mods:namePart",trim($cell->nodeValue));
                    $nameCorporate->appendChild($namePartCorporate);
                     $mods->appendChild($nameCorporate);
                    
                    }
                     break;  
               case 'Type_typeOfResource':
                    if(trim($cell->nodeValue) != false){
                   $genre = $dom->createElement("mods:typeOfResource",trim($cell->nodeValue));                             
                  
                   $mods->appendChild($genre);
                     }
                     break; 
             
               case 'Creator_CN':
                    if(trim($cell->nodeValue) != false){
                     $nameCorporate = $dom->createElement("mods:name");
                    $typeCorporate = $dom->createAttribute("type");
                    $typeCorporate->value = "corporate";
                    $nameCorporate->appendChild($typeCorporate);
                    
                    $namePartCorporate = $dom->createElement("mods:namePart",htmlentities(trim($cell->nodeValue)));
                    $nameCorporate->appendChild($namePartCorporate);
                    $mods->appendChild($nameCorporate);
                     }
                     break; 
                     /*
                      * <Creator_CN_Authority>Foster and Kleiser Company</Creator_CN_Authority>
                      */
                    case 'Creator_CN_Authority':
                         if(trim($cell->nodeValue) != false){
                             $authorityCorporate = $dom->createAttribute("authority");
                    $authorityCorporate->value = htmlentities(trim($cell->nodeValue));
                    $nameCorporate->appendChild($authorityCorporate);
                         }
                   break;
               case 'Creator_PN':
                   if(trim($cell->nodeValue) != false){
                    $namePersonal = $dom->createElement("mods:name");
                    $typePersonal = $dom->createAttribute("type");
                    $typePersonal->value = "personal";
                    $namePersonal->appendChild($typePersonal);                    
                    $namePartPersonal = $dom->createElement("mods:namePart",trim($cell->nodeValue));
                    $namePersonal->appendChild($namePartPersonal);                    
                     $mods->appendChild($namePersonal);
                     }
                    
                     break;  
                /*
                * <Creator_PN_Authority>Curtis, Luther Wayne</Creator_PN_Authority>
                */ 
               case 'Creator_PN_Authority':
                    if(trim($cell->nodeValue) != false){
                             $authorityPersonal = $dom->createAttribute("authority");
                    $authorityPersonal->value = trim($cell->nodeValue);
                    $namePersonal->appendChild($authorityPersonal);
                         }
                   break;
               case 'Subject_conceptTopic_4':
                    if(trim($cell->nodeValue) != false){
                          $subjectconceptTopic4 = $dom->createElement("mods:subject");
                      $subjectAuthorityURI4 = $dom->createAttribute("authorityURI");
                      $subjectAuthorityURI4->value = "http://id.loc.gov/authorities/subjects";
                      $subjectconceptTopic4->appendChild($subjectAuthorityURI4);
                      
                         
                                             
                          $topic4 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $subjectconceptTopic4->appendChild($topic4);
                          
                      $mods->appendChild($subjectconceptTopic4);
                  }
                     break;  
                     
case 'CLA_Topic_1':
                   if(trim($cell->nodeValue) != false){
                      
                      $claSubjectTopic1 = $dom->createElement("mods:subject");
                     
                       $claSubjectAuthority1 = $dom->createAttribute("authority");
                      $claSubjectAuthority1->value = "cla_topics";
                      $claSubjectTopic1->appendChild($claSubjectAuthority1);
                         
                                             
                          $claTopic1 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $claSubjectTopic1->appendChild($claTopic1);
                          
                      $mods->appendChild($claSubjectTopic1);
                    
                      
                      
                      
                      
                  }
                  
                     break;  
               case 'CLA_Topic_2':
                   if(trim($cell->nodeValue) != false){
                         $claSubjectTopic2 = $dom->createElement("mods:subject");
                     
                       $claSubjectAuthority2 = $dom->createAttribute("authority");
                      $claSubjectAuthority2->value = "cla_topics";
                      $claSubjectTopic2->appendChild($claSubjectAuthority2);
                         
                                             
                          $claTopic2 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $claSubjectTopic2->appendChild($claTopic2);
                          
                      $mods->appendChild($claSubjectTopic2);
                      
                  }
                     break;    
                case 'CLA_Topic_3':
                   if(trim($cell->nodeValue) != false){
                          $claSubjectTopic3 = $dom->createElement("mods:subject");
                     
                       $claSubjectAuthority3 = $dom->createAttribute("authority");
                      $claSubjectAuthority3->value = "cla_topics";
                      $claSubjectTopic3->appendChild($claSubjectAuthority3);
                         
                                             
                          $claTopic3 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $claSubjectTopic3->appendChild($claTopic3);
                          
                      $mods->appendChild($claSubjectTopic3);
                      
                  }
                     break;  
                     
 case 'CLA_Topic_4':
                   if(trim($cell->nodeValue) != false){
                         $claSubjectTopic4 = $dom->createElement("mods:subject");
                     
                       $claSubjectAuthority4 = $dom->createAttribute("authority");
                      $claSubjectAuthority4->value = "cla_topics";
                      $claSubjectTopic4->appendChild($claSubjectAuthority4);
                         
                                             
                          $claTopic4 = $dom->createElement("mods:topic",trim($cell->nodeValue));
                          $claSubjectTopic4->appendChild($claTopic4);
                          
                      $mods->appendChild($claSubjectTopic4);
                      
                  }
                     break; 
                     /*<Description_note>The Plaza 1888. At the Plaza. PROPERTY OF THE LOS ANGELES HISTORICAL SOCIETY. </Description_note>*/
               case 'Description_note':
                    if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",htmlentities($cell->nodeValue));                       
                      $mods->appendChild($note);
                 }
                   break;
               
		/*<Description_inscription>At the Plaza LA 1888 " No 190 Photo MB"</Description_inscription>*/
               case 'Description_inscription':
                   if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",htmlentities($cell->nodeValue));  
                      $displayLabel = $dom->createAttribute("displayLabel");
                        $displayLabel->value="inscription";                       
                        $note->appendChild($displayLabel);
                      $mods->appendChild($note);
                 }
                   break;
               
		/*<note_imageDescription>815 N Alameda St.</note_imageDescription>*/
               case 'note_imageDescription':
                   if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",htmlentities($cell->nodeValue));  
                      $displayLabel = $dom->createAttribute("displayLabel");
                        $displayLabel->value="location";                       
                        $note->appendChild($displayLabel);
                      $mods->appendChild($note);
                 }
                   break;
               
		/*<Lat_Long>34.056944,-118.237778</Lat_Long>*/
               case 'Lat_Long':
                   
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
                   
                   case 'Lat__Long':
                   
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
                   
                   
                   
 case 'PhysicalDescription__dimensions':
                   // PhysicalDescription.extent
                   if(trim($cell->nodeValue) != false){
                   $PhysicalDescription = $dom->createElement("mods:physicalDescription"); 
                  
                   $extent = $dom->createElement("mods:extent",trim($cell->nodeValue));                
                   
                   $PhysicalDescription->appendChild($extent);
                   $mods->appendChild($PhysicalDescription);
                   
                     }
                     break;                   
                     
                  
             default:
               break;
           }
           echo "<td>";
             echo "$cell->nodeValue";
             $datarow []= $cell->nodeValue;
             echo "</td>";
             $cellindex += 1;
         }
          $dom->encoding="UTF-8";
      $dom->formatOutput = true;
       $dom->save("C://projects//see sunset//SSF-27//mods//".$fileName.".xml");
          echo "</tr>";
      }
     
 
     echo "</tbody></table><br/><br/>";
 
//}

?>

</body>
</html>