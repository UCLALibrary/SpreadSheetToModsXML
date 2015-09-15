The current php script, needs an xml file as a input to create separate mods files.
This document will outline how to convert a spreadsheet to a excel xml file format.
Follow the instructions from the link below to download the xmltools plugin for Microsoft excel software.
http://office.microsoft.com/en-us/excel-help/create-an-xml-data-file-and-xml-schema-file-from-worksheet-data-HA010263509.aspx

Open the given greenmovement spreadsheet in excel
In the opened excel worksheet, go to Addins tab, and see if the xmltools menu command appears.
Now click the xmltools menu and select the convert a range to xml list
On doing that a popup appears, 
select the radio button which says first row is column names
select the area on the worksheet
than a debug window will appear
fix the errors change "xmldocument50" to  "xmldocument"
continue refreshing the debug window till all the errors are fixed
there will  be one more dialog box asking about formatting , select the first option to keep the existing formatting 

Now the xml list is created
Now export that content to a xml file by going to the developers tab and than clicking the export menu and save to some folder.
 run program importGreenMovement.php on this xml to generate mods files for DEP projects
run program importAqueductUpdated.php for LAADP project.
run program importSSFMovement.php for Seeing Sunset project.