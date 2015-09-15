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
  $dom1 = DOMDocument::load("C://projects//LAADP//03062015//sample.xml");
 
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
         $corporate = false;
         $personal = false;
          $corporate1 = false;
         $personal1 = false;
         $conceptTopicFlag=false;
         $conceptTopicFlag1=false;
         $conceptTopicFlag2=false;
         $geographicTopicFlag = false;
         $descriptiveTopicFlag = false;
         $genreFlag = false;
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
              
               case 'OAC_Finding_Aid_URL':
                     if(trim($cell->nodeValue) != false){
                          $relatedItem = $dom->createElement("mods:relatedItem");
                  $findingAidUrl = $dom->createElement("mods:location");
                    $url = $dom->createElement("mods:url",htmlentities(trim($cell->nodeValue)));
                    $displayLabel=$dom->createAttribute("displayLabel");
                     $displayLabel->value = "Finding Aid";
                     $url->appendChild($displayLabel);                     
                    $findingAidUrl->appendChild($url);
                    $relatedItem->appendChild($findingAidUrl);
                    $mods->appendChild($relatedItem);
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
               case 'Creator_CN': 
                    if(trim($cell->nodeValue) != false){
                    $nameCorporate = $dom->createElement("mods:name");
                    $typeCorporate = $dom->createAttribute("type");
                    $typeCorporate->value = "corporate";
                    $nameCorporate->appendChild($typeCorporate);
                    
                    $namePartCorporate = $dom->createElement("mods:namePart",  htmlentities($cell->nodeValue));
                    $nameCorporate->appendChild($namePartCorporate);
                     $corporateAuthority = $dom->createAttribute("authority");
                    
                        $corporateAuthority->value = "LCNAF"; 
                   
                    $nameCorporate->appendChild($corporateAuthority);
                     $mods->appendChild($nameCorporate);
                   
                    }  
                    break;
                 
               
               
               case 'Creator_CN2':
                   
                    if(trim($cell->nodeValue) != false){
                    $nameCorporate1 = $dom->createElement("mods:name");
                    $typeCorporate1 = $dom->createAttribute("type");
                    $typeCorporate1->value = "corporate";
                    $nameCorporate1->appendChild($typeCorporate1);
                    
                    $namePartCorporate1 = $dom->createElement("mods:namePart",  htmlentities($cell->nodeValue));
                    $nameCorporate1->appendChild($namePartCorporate1);
                     $corporateAuthority1 = $dom->createAttribute("authority");
                       $corporateAuthority1->value = "local"; 
                       $nameCorporate1->appendChild($corporateAuthority1);
                     $mods->appendChild($nameCorporate1);
                    
                    }  
                    break;
                   
               
               case 'Creator_PN':
                   
                     if(trim($cell->nodeValue) != false){
                    $namePersonal = $dom->createElement("mods:name");
                    $typePersonal = $dom->createAttribute("type");
                    $typePersonal->value = "personal";
                    $namePersonal->appendChild($typePersonal);                    
                    $namePartPersonal = $dom->createElement("mods:namePart",htmlentities($cell->nodeValue));
                    $namePersonal->appendChild($namePartPersonal);
                     $personalAuthority = $dom->createAttribute("authority");
                   
                        $personalAuthority->value = "LCNAF"; 
                    
                    $namePersonal->appendChild($personalAuthority);
                    $mods->appendChild($namePersonal);
                  
                     }
                     break;
                     
              
               
              case 'Creator_PN2':
                   
                     if(trim($cell->nodeValue) != false){
                    $namePersonal1 = $dom->createElement("mods:name");
                    $typePersonal1 = $dom->createAttribute("type");
                    $typePersonal1->value = "personal";
                    $namePersonal1->appendChild($typePersonal1);                    
                    $namePartPersonal1 = $dom->createElement("mods:namePart",htmlentities($cell->nodeValue));
                    $namePersonal1->appendChild($namePartPersonal1);
                    $personalAuthority1 = $dom->createAttribute("authority");
                   
                        $personalAuthority1->value = "local"; 
                   
                    $namePersonal1->appendChild($personalAuthority1);
                    $mods->appendChild($namePersonal1);
                    
                     }
                     break;
                     
              
               case 'Date_creation':
                   if(trim($cell->nodeValue) != false){
                   $dateCreatedInfo = $dom->createElement("mods:originInfo"); 
                   $dateCreated = $dom->createElement("mods:dateCreated",trim($cell->nodeValue));
                   $dateCreatedInfo->appendChild($dateCreated);
                   $mods->appendChild($dateCreatedInfo);
                     }
                     break;
                case 'Date_publication':
                 // DATE.publication
                     if(trim($cell->nodeValue) != false){
                   $dateIssuedInfo = $dom->createElement("mods:originInfo"); 
                   $dateIssued = $dom->createElement("mods:dateIssued",$cell->nodeValue);
                   $dateIssuedInfo->appendChild($dateIssued);
                   $mods->appendChild($dateIssuedInfo);
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
               case 'PhysicalDescription_extent':
                   
                                 if(trim($cell->nodeValue) != false){
                   $PhysicalDescription = $dom->createElement("mods:physicalDescription"); 
                   $extent = $dom->createElement("mods:extent",$cell->nodeValue);
                   $PhysicalDescription->appendChild($extent);
                   $mods->appendChild($PhysicalDescription);
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
                    $namePartCorporate = $dom->createElement("mods:namePart",$cell->nodeValue);
                    $nameCorporate->appendChild($namePartCorporate);
                     $mods->appendChild($nameCorporate);
                    
                    }
                     break;  
               
               case 'Type_genre':
                   
                    $genreFlag = false;
                     if(trim($cell->nodeValue) != false){
                   $genre = $dom->createElement("mods:genre",$cell->nodeValue);                             
                  
                   $genreFlag = true;
                     }
                   
                 
               break;
                case 'Type_genre_Authority':
                   
                    //Type.genre Authority
                 if($genreFlag == true){
                    $genreAuthority = $dom->createAttribute("authority");
                    $genreAuthority->value = $cell->nodeValue;
                    $genre->appendChild($genreAuthority);
                    $mods->appendChild($genre);
                 }
                 
                 break;
               case 'Rights_copyrightStatus':
                 //Rights.copyrightStatus
                  if(trim($cell->nodeValue) != false){
                 $rightsCopyRightStatus= $dom->createElement("mods:accessCondition",$cell->nodeValue);  
                 $rightsType = $dom->createAttribute("type");
                 $rightsType->value = "use and reproduction";
                 $rightsCopyRightStatus->appendChild($rightsType);
                 $mods->appendChild($rightsCopyRightStatus);
                  }
                 break;
                 
            case 'Access_conditions':
                 //copyright.status (copyrightMD)
                  if(trim($cell->nodeValue) != false){
                      
                       $copyRightMdCopyright = $dom->createElement("copyrightMD:copyright");
                       
                       $copytrightMDxmnls = $dom->createAttribute("xmlns:copyrightMD");
                       $copytrightMDxmnls->value="http://www.cdlib.org/inside/diglib/copyrightMD";
                       $copyrightMDxsi = $dom->createAttribute("xsi:schemaLocation");
                       $copyrightMDxsi->value="http://www.cdlib.org/inside/diglib/copyrightMD http://www.cdlib.org/groups/rmg/docs/copyrightMD.xsd";
                       $copyRightMdCopyright->appendChild($copyrightMDxsi);
                       $copyRightMdCopyright->appendChild($copytrightMDxmnls);
                       $copyrightStatus = $dom->createAttribute("copyright.status");
                       $copyrightStatus->value=trim($cell->nodeValue);
                       $copyRightMdCopyright->appendChild($copyrightStatus);                    
                       $copyRightMdCopyright->appendChild($copyrightMDxsi);
                       $copyRightMdCopyright->appendChild($copytrightMDxmnls);
                      
                  }
                  
                 break;     
                 
                 
             case 'Rights_publicationStatus':
                 //Rights.publicationStatus
                  if(trim($cell->nodeValue) != false){
                       
                       $rightsPublicationStatus= $dom->createElement("mods:accessCondition");
                       $publicationStatus = $dom->createAttribute("publication.status");
                      if(strcasecmp(trim($cell->nodeValue),"Published") == 0){
                          $generalnote = $dom->createElement("copyrightMD:general.note","This work is published");
                         $copyRightMdCopyright->appendChild($generalnote);
                         $publicationStatus->value = "published";
                      } else if(strcasecmp(trim($cell->nodeValue), "Unpublished") == 0){
                           $generalnote = $dom->createElement("copyrightMD:general.note","This work is unpublished");
                           $copyRightMdCopyright->appendChild($generalnote);
                            $publicationStatus->value = "unpublished";
                      }else
                       {
                           $generalnote = $dom->createElement("copyrightMD:general.note","This work is Public domain – dedicated"); 
                           $copyRightMdCopyright->appendChild($generalnote);
                            $publicationStatus->value = "unknown";
                      }
                      
                      $copyRightMdCopyright->appendChild($publicationStatus);
                     
                      $rightsPublicationStatus->appendChild($copyRightMdCopyright);
                       $mods->appendChild($rightsPublicationStatus);
                  }
                  
                 break;
             case 'Contributor_publisher':
                 //Contributor.publisher
                 if(trim($cell->nodeValue) != false){
                   $contributerInfo = $dom->createElement("mods:originInfo"); 
                   $publisher = $dom->createElement("mods:publisher",$cell->nodeValue);
                   $contributerInfo->appendChild($publisher);
                   $mods->appendChild($contributerInfo);
                  }
                 break;
             case 'Description_note':
                 

                 //Description.note
                 if(trim($cell->nodeValue) != false){
                      $note = $dom->createElement("mods:note",htmlentities($cell->nodeValue));
                      $mods->appendChild($note);
                 }
                 break;
                 
             case 'PhysicalDescription_dimensions':
                 //PhysicalDescription.dimensions
                 if(trim($cell->nodeValue) != false){
                   $dimensions = $dom->createElement("mods:PhysicalDescription"); 
                   $dimensionsExtent = $dom->createElement("mods:extent",$cell->nodeValue);
                   $dimensions->appendChild($dimensionsExtent);
                   $mods->appendChild($dimensions);
                     }
                     break;     
             case 'Subject_conceptTopic':
                 //Subject.conceptTopic
                 //<subject authority="lcsh" authorityURI="http://id.loc.gov/authorities/subjects"><topic>
                
                  if(trim($cell->nodeValue) != false){
                      $subjects = explode(';', trim($cell->nodeValue));
                      $subjectconceptTopic = $dom->createElement("mods:subject");
                      $subjectAuthorityURI = $dom->createAttribute("authorityURI");
                      $subjectAuthorityURI->value = "http://id.loc.gov/authorities/subjects";
                      $subjectconceptTopic->appendChild($subjectAuthorityURI);
                     
                      foreach ($subjects as $value) { 
                          $topic = $dom->createElement("mods:topic",htmlentities($value));
                          $subjectconceptTopic->appendChild($topic);
                          
                      }
                    
                       $subjectAuthorityconceptTopic = $dom->createAttribute("authority");
                     $subjectAuthorityconceptTopic->value = "lcsh";
                     $subjectconceptTopic->appendChild($subjectAuthorityconceptTopic);   
                      $mods->appendChild($subjectconceptTopic);
                      
                      
                  }
                 break;
             
             case 'Subject_conceptTopic2':
                 //Subject.conceptTopic
                 //<subject authority="local" authorityURI="http://id.loc.gov/authorities/subjects"><topic>
                  
                  if(trim($cell->nodeValue) != false){
                      $subjects1 = explode(';', trim($cell->nodeValue));
                      $subjectconceptTopic1= $dom->createElement("mods:subject");
                      $subjectAuthorityURI1 = $dom->createAttribute("authorityURI");
                      $subjectAuthorityURI1->value = "http://id.loc.gov/authorities/subjects";
                      $subjectconceptTopic1->appendChild($subjectAuthorityURI1);
                      
                      foreach ($subjects1 as $value) { 
                          $topic1 = $dom->createElement("mods:topic",htmlentities($value));
                          $subjectconceptTopic1->appendChild($topic1);
                          
                      }
                    
                       $subjectAuthorityconceptTopic1 = $dom->createAttribute("authority");
                     $subjectAuthorityconceptTopic1->value = "local";
                     $subjectconceptTopic1->appendChild($subjectAuthorityconceptTopic1);  
                      $mods->appendChild($subjectconceptTopic1);
                      
                      
                  }
                 break;
            
            
                          
             
             case 'Subject_descriptiveTopic':
                 //Subject.descriptiveTopic
                 //<subject authority="lcsh" authorityURI="http://id.loc.gov/authorities/subjects"><topic>
                 $descriptiveTopicFlag = false;
                  if(trim($cell->nodeValue) != false){
                      $subjects = explode(';', trim($cell->nodeValue));
                       $subjectdescriptiveTopic = $dom->createElement("mods:subject");
                       $subjectAuthorityURI = $dom->createAttribute("authorityURI");
                       $subjectAuthorityURI->value = "http://id.loc.gov/authorities/subjects";
                       $subjectdescriptiveTopic->appendChild($subjectAuthorityURI);
                       $descriptiveTopicFlag = true;
                      foreach ($subjects as $value) {                   
                         
                         
                          $topic = $dom->createElement("mods:topic",$value);
                          $subjectdescriptiveTopic->appendChild($topic);
                         
                      }
                      
                      
                      $mods->appendChild($subjectdescriptiveTopic);
                      
                  }
                 break;
                 
                 case 'Subject_descriptiveTopic_Authority':
                 if(trim($cell->nodeValue) != false && $descriptiveTopicFlag == true){
                     $subjectAuthoritydescriptiveTopic = $dom->createAttribute("authority");
                     $subjectAuthoritydescriptiveTopic->value = strtolower(trim($cell->nodeValue));
                     $subjectdescriptiveTopic->appendChild($subjectAuthoritydescriptiveTopic);      
                     //$mods->appendChild($subjectdescriptiveTopic);
                 }
                 break;
                 
             case 'Subject_name':
                 //Subject.name
                 //<subject><name>
                  if(trim($cell->nodeValue) != false){                       
                       $subjectNames = explode(';', trim($cell->nodeValue));
                        foreach ($subjectNames as $value) {
                            $subject = $dom->createElement("mods:subject");
                            $name = $dom->createElement("mods:name"); 
                            $namePart = $dom->createElement("mods:namePart",htmlentities($value));
                            $name->appendChild($namePart);
                            $subject->appendChild($name);
                           
                        }  
                         $subjectAuthorityName = $dom->createAttribute("authority");
                            $subjectAuthorityName->value = "LCNAF";
                            $subject->appendChild($subjectAuthorityName);
                            $mods->appendChild($subject);
                  }
                 break;
                        
                 
              case 'Subject_name2':
                 //Subject.name
                 //<subject><name>
                  if(trim($cell->nodeValue) != false){                       
                       $subjectNames = explode(';', trim($cell->nodeValue));
                        foreach ($subjectNames as $value) {
                            $subject = $dom->createElement("mods:subject");
                            $name = $dom->createElement("mods:name"); 
                            $namePart = $dom->createElement("mods:namePart",htmlentities($value));
                            $name->appendChild($namePart);
                            $subject->appendChild($name);
                            
                        }  
                        $subjectAuthorityName = $dom->createAttribute("authority");
                            $subjectAuthorityName->value = "local";
                            $subject->appendChild($subjectAuthorityName);
                            $mods->appendChild($subject);
                  }
                 break;
                
              
                 
             case 'Subect_geographicTopic':
                 //Subect.geographicTopic
                 //<subject><geographic>
                 $geographicTopicFlag = false;
                  if(trim($cell->nodeValue) != false){
                      
                       $subjects = explode(';', trim($cell->nodeValue));
                        $subjectgeographicTopic = $dom->createElement("mods:subject");
                         $subjectAuthorityURI = $dom->createAttribute("authorityURI");
                          $subjectAuthorityURI->value = "http://id.loc.gov/authorities/subjects";
                          $subjectgeographicTopic->appendChild($subjectAuthorityURI);
                          $geographicTopicFlag = true;
                      foreach ($subjects as $value) {                
                         
                         
                         $geograhic = $dom->createElement("mods:geographic",$value);                       
                            $subjectgeographicTopic->appendChild($geograhic);
                          
                      }
                      $subjectAuthoritygeographicTopic = $dom->createAttribute("authority");
                     $subjectAuthoritygeographicTopic->value = "LCSH";
                     $subjectgeographicTopic->appendChild($subjectAuthoritygeographicTopic);      
                      $mods->appendChild($subjectgeographicTopic);
                       
                  }
                 break;
                 
            
                 
                 case 'Subect_geographicTopic2':
                 //Subect.geographicTopic
                 //<subject><geographic>
                 $geographicTopicFlag = false;
                  if(trim($cell->nodeValue) != false){
                      
                       $subjects = explode(';', trim($cell->nodeValue));
                        $subjectgeographicTopic = $dom->createElement("mods:subject");
                         $subjectAuthorityURI = $dom->createAttribute("authorityURI");
                          $subjectAuthorityURI->value = "http://id.loc.gov/authorities/subjects";
                          $subjectgeographicTopic->appendChild($subjectAuthorityURI);
                          $geographicTopicFlag = true;
                      foreach ($subjects as $value) {                
                         
                         
                         $geograhic = $dom->createElement("mods:geographic",$value);                       
                            $subjectgeographicTopic->appendChild($geograhic);
                          
                      }
                      
                      $subjectAuthoritygeographicTopic = $dom->createAttribute("authority");
                     $subjectAuthoritygeographicTopic->value = "local";
                     $subjectgeographicTopic->appendChild($subjectAuthoritygeographicTopic);      
                     $mods->appendChild($subjectgeographicTopic);
                       
                  }
                 break;
                 
               case 'Preferred_Citation':
                   if(trim($cell->nodeValue) != false){
                   $note = $dom->createElement("mods:note",htmlentities($cell->nodeValue));
                   $type=$dom->createAttribute("type");
                    $type->value = "preferred citation";
                    $note->appendChild($type);
                      $mods->appendChild($note);
                   }
                   break;
               case 'Geographic_Coordinates':
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
       $dom->save("C://projects//LAADP//03062015//mods//".$fileName.".xml");
          echo "</tr>";
      }
     
 
     echo "</tbody></table><br/><br/>";
 
//}

?>

</body>
</html>