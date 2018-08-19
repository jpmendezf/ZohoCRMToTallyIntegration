<?php



//ACCOUNT MASTERS
if(isset($_POST['accSubmit'])) 
{			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url_account = "https://crm.zoho.com/crm/private/xml/Accounts/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_account);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result_account = curl_exec($ch);
curl_close($ch);

$xmlcl_account=new SimpleXMLElement($result_account);
$len_acc=0;
$len_acc=count($xmlcl_account->result[0]->Accounts[0]);
$x1="";


$x1="";
$x1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';

/*$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="Sales" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME></MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME></CURRENCYNAME>
      <COUNTRYNAME></COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Sales Accounts</PARENT>
            <COUNTRYOFRESIDENCE></COUNTRYOFRESIDENCE>
      <LEDSTATENAME></LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>Sales</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';
	*/


for($l1=0;$l1<$len_acc;$l1++)
{
$accn="";
$add1="";
$add2="";
$add3="";
$ph="";
$f="";
$c="";
$bc="";
$bs="";

for($l=0;$l<=(count($xmlcl_account->result[0]->Accounts[0]->row[$l1]));$l++)
{
$tn= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l]['val'];
if($tn=="Account Name")
{
$accn= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing Street")
{
$add1= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing City")
{
$add2= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing Code")
{
$add3= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Phone")
{
$ph= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Fax")
{
$f= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Currency")
{
$c= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing Country.")
{
$bc= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing State")
{
$bs= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}

}


$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="'.$accn.'" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS>'.$add1.'</ADDRESS>
       <ADDRESS>'.$add2.'</ADDRESS>
       <ADDRESS>'.$add3.'</ADDRESS>
       <ADDRESS>'.$ph.'</ADDRESS>
       <ADDRESS>'.$f.'</ADDRESS>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME>'.$accn.'</MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME>'.$c.'</CURRENCYNAME>
      <COUNTRYNAME>'.$bc.'</COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Sundry Debtors</PARENT>
            <COUNTRYOFRESIDENCE>'.$bc.'</COUNTRYOFRESIDENCE>
      <LEDSTATENAME>'.$bs.'</LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>'.$accn.'</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';

//print_r($x[$l1]);

}


$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="Tax" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME></MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME>'.$c.'</CURRENCYNAME>
      <COUNTRYNAME></COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Current Liabilities</PARENT>
            <COUNTRYOFRESIDENCE></COUNTRYOFRESIDENCE>
      <LEDSTATENAME></LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>Tax</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';
$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="Sales" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME></MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME>'.$c.'</CURRENCYNAME>
      <COUNTRYNAME></COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Sales Accounts</PARENT>
            <COUNTRYOFRESIDENCE></COUNTRYOFRESIDENCE>
      <LEDSTATENAME></LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>Sales</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';

$x1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';



// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $x1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Account Masters into Tally successfully!";

curl_close($ch);
}







//UNIT MASTERS
if(isset($_POST['unitSubmit']))
{			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url = "https://crm.zoho.com/crm/private/xml/Products/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result = curl_exec($ch);

//echo ($result);
curl_close($ch);

/*$xml = new DOMDocument;
$xml->preserveWhiteSpace = FALSE;
$xml->loadXML($result);
//Save XML as a file
$xml->save('ResponseProducts.xml');*/
$xmlcl=new SimpleXMLElement($result);
$len=0;
$len=count($xmlcl->result[0]->Products[0]);

$p1="";
$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   
$pdu="";
for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=(count($xmlcl->result[0]->Products[0]->row[$l1]));$l++)
{
$tp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l]['val'];
if($tp=="Usage Unit")
{
$pdu= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
}
if($pdu!="")
{
$p1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<UNIT NAME="'.$pdu.'" RESERVEDNAME="">
<NAME>'.$pdu.'</NAME>
<ISSIMPLEUNIT>Yes</ISSIMPLEUNIT>
</UNIT>
</TALLYMESSAGE>';
}
}
$p1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';

// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Unit Masters into Tally successfully!";

curl_close($ch);
}






//PRODUCT MASTERS
if(isset($_POST['prodSubmit'])) 
{			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url = "https://crm.zoho.com/crm/private/xml/Products/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result = curl_exec($ch);

//echo ($result);
curl_close($ch);

/*$xml = new DOMDocument;
$xml->preserveWhiteSpace = FALSE;
$xml->loadXML($result);
//Save XML as a file
$xml->save('ResponseProducts.xml');*/
$xmlcl=new SimpleXMLElement($result);
$len=0;
$len=count($xmlcl->result[0]->Products[0]);
$p1="";

$p1="";
$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   

$pdu="";
for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=(count($xmlcl->result[0]->Products[0]->row[$l1]));$l++)
{
$tp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l]['val'];
if($tp=="Product Name")
{
$pdn= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
if($tp=="Unit Price")
{
$pdp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
if($tp=="Qty in Stock")
{
$pdq= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
if($tp=="Usage Unit")
{
$pdu= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
}
if($pdu!="")
{
$p1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<STOCKITEM NAME="'.$pdn.'" RESERVEDNAME="">
<PARENT/>
<CATEGORY/>
<TAXCLASSIFICATIONNAME/>
<COSTINGMETHOD>Avg. Cost</COSTINGMETHOD>
<VALUATIONMETHOD>Avg. Price</VALUATIONMETHOD>
<BASEUNITS>'.$pdu.'</BASEUNITS>
<ADDITIONALUNITS/>
<ISCOSTCENTRESON>No</ISCOSTCENTRESON>
<ISBATCHWISEON>No</ISBATCHWISEON>
<ISPERISHABLEON>No</ISPERISHABLEON>
<IGNOREPHYSICALDIFFERENCE>No</IGNOREPHYSICALDIFFERENCE>
<IGNORENEGATIVESTOCK>No</IGNORENEGATIVESTOCK>
<TREATSALESASMANUFACTURED>No</TREATSALESASMANUFACTURED>
<TREATPURCHASESASCONSUMED>No</TREATPURCHASESASCONSUMED>
<TREATREJECTSASSCRAP>No</TREATREJECTSASSCRAP>
<HASMFGDATE>No</HASMFGDATE>
<ALLOWUSEOFEXPIREDITEMS>No</ALLOWUSEOFEXPIREDITEMS>
<IGNOREBATCHES>No</IGNOREBATCHES>
<IGNOREGODOWNS>No</IGNOREGODOWNS>
<ISMRPINCLOFTA>No</ISMRPINCLOFTA>
<REORDERASHIGHER>No</REORDERASHIGHER>
<MINORDERASHIGHER>No</MINORDERASHIGHER>
<DENOMINATOR>1</DENOMINATOR>
<RATEOFVAT>0</RATEOFVAT>
<OPENINGBALANCE> '.$pdq.' '.$pdu.'</OPENINGBALANCE>
      <OPENINGVALUE>-'.($pdq*$pdp).'</OPENINGVALUE>
      <OPENINGRATE>'.$pdp.'/'.$pdu.'</OPENINGRATE>
<LANGUAGENAME.LIST>
<NAME.LIST>
<NAME>'.$pdn.'</NAME>
</NAME.LIST>
<LANGUAGEID>1033</LANGUAGEID>
</LANGUAGENAME.LIST>
<ADDITIONALLEDGERS.LIST></ADDITIONALLEDGERS.LIST>
</STOCKITEM>
</TALLYMESSAGE>';
}
}
$p1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';

// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Product Masters into Tally successfully!";

curl_close($ch);
}




//GROUP MASTERS
if(isset($_POST['grpSubmit'])) 
{			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url = "https://crm.zoho.com/crm/private/xml/Products/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result = curl_exec($ch);

//echo ($result);
curl_close($ch);

/*$xml = new DOMDocument;
$xml->preserveWhiteSpace = FALSE;
$xml->loadXML($result);
//Save XML as a file
$xml->save('ResponseProducts.xml');*/
$xmlcl=new SimpleXMLElement($result);
$len=0;
$len=count($xmlcl->result[0]->Products[0]);

$p1="";
$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   

for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=(count($xmlcl->result[0]->Products[0]->row[$l1]));$l++)
{
$tp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l]['val'];
if($tp=="Product Category")
{
$pdc= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
}
if($pdc!="")
{
$p1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<STOCKGROUP NAME="'.$pdc.'" RESERVEDNAME="">
<GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000b3</GUID>
<PARENT/>
<BASEUNITS/>
<ADDITIONALUNITS/>
<ISBATCHWISEON>No</ISBATCHWISEON>
<ISPERISHABLEON>No</ISPERISHABLEON>
<ISADDABLE>No</ISADDABLE>
<ISUPDATINGTARGETID>No</ISUPDATINGTARGETID>
<ASORIGINAL>Yes</ASORIGINAL>
<IGNOREPHYSICALDIFFERENCE>No</IGNOREPHYSICALDIFFERENCE>
<IGNORENEGATIVESTOCK>No</IGNORENEGATIVESTOCK>
<TREATSALESASMANUFACTURED>No</TREATSALESASMANUFACTURED>
<TREATPURCHASESASCONSUMED>No</TREATPURCHASESASCONSUMED>
<TREATREJECTSASSCRAP>No</TREATREJECTSASSCRAP>
<HASMFGDATE>No</HASMFGDATE>
<ALLOWUSEOFEXPIREDITEMS>No</ALLOWUSEOFEXPIREDITEMS>
<IGNOREBATCHES>No</IGNOREBATCHES>
<IGNOREGODOWNS>No</IGNOREGODOWNS>
<ALTERID>392</ALTERID>
<SERVICETAXDETAILS.LIST></SERVICETAXDETAILS.LIST>
<VATDETAILS.LIST></VATDETAILS.LIST>
<SALESTAXCESSDETAILS.LIST></SALESTAXCESSDETAILS.LIST>
<LANGUAGENAME.LIST>
<NAME.LIST TYPE="String">
<NAME>'.$pdc.'</NAME>
</NAME.LIST>
<LANGUAGEID>1033</LANGUAGEID>
</LANGUAGENAME.LIST>
<SCHVIDETAILS.LIST></SCHVIDETAILS.LIST>
<EXCISETARIFFDETAILS.LIST></EXCISETARIFFDETAILS.LIST>
<TCSCATEGORYDETAILS.LIST></TCSCATEGORYDETAILS.LIST>
<TDSCATEGORYDETAILS.LIST></TDSCATEGORYDETAILS.LIST>
<EXTARIFFDUTYHEADDETAILS.LIST></EXTARIFFDUTYHEADDETAILS.LIST>
</STOCKGROUP>
</TALLYMESSAGE>';
}
}
$p1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';

// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Group Masters into Tally successfully!";

curl_close($ch);
}






//INVOICE
if(isset($_POST['invSubmit'])) 
{			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url = "https://crm.zoho.com/crm/private/xml/Invoices/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  
$url1 = "https://crm.zoho.com/crm/private/xml/Products/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  
$urlSO = "https://crm.zoho.com/crm/private/xml/SalesOrders/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result = curl_exec($ch);

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_TIMEOUT, 30);
curl_setopt($ch1, CURLOPT_POST,1);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch1, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result1 = curl_exec($ch1);

$chSO = curl_init();
curl_setopt($chSO, CURLOPT_URL, $urlSO);
curl_setopt($chSO, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($chSO, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($chSO, CURLOPT_TIMEOUT, 30);
curl_setopt($chSO, CURLOPT_POST,1);
curl_setopt($chSO, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($chSO, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($chSO, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$resultSO = curl_exec($chSO);

//echo ($result);
curl_close($ch);
curl_close($ch1);
curl_close($chSO);

$xmlcl=new SimpleXMLElement($result);
$xmlcl1=new SimpleXMLElement($result1);
$xmlclSO=new SimpleXMLElement($resultSO);

$plen=count($xmlcl1->result[0]->Products[0]);
$len=0;
$len=count($xmlcl->result[0]->Invoices[0]);
$solen=count($xmlclSO->result[0]->SalesOrders[0]);


$tempid=array();
$unitarr=array();
for($x=0;$x<$plen;$x++)
{
	$tempid[$x]="".$xmlcl1->result[0]->Products[0]->row[$x]->FL[0]."";
	for($a=1;$a<=count($xmlcl1->result[0]->Products[0]->row[$x]);$a++)
	{
		if(($xmlcl1->result[0]->Products[0]->row[$x]->FL[$a]['val'])=="Usage Unit")
		{
			$unitarr[$x]=$xmlcl1->result[0]->Products[0]->row[$x]->FL[$a];
			
		}
	}
}
$SOid=array();
$SOno=array();
for($x=0;$x<$solen;$x++)
{
	 $SOid[$x]="".$xmlclSO->result[0]->SalesOrders[0]->row[$x]->FL[0]."";
	for($a=1;$a<=count($xmlclSO->result[0]->SalesOrders[0]->row[$x]);$a++)
	{
		if(($xmlclSO->result[0]->SalesOrders[0]->row[$x]->FL[$a]['val'])=="SO No.")
		{
			$SOno[$x]=$xmlclSO->result[0]->SalesOrders[0]->row[$x]->FL[$a];
			
		}
	}
}


$i1="";

$i1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
for($l1=0;$l1<$len;$l1++)
{
$rid="";
$in="";
$ind="";
$ian="";
$isubt="";
$taxn="";
$it="";
$iadj="";
$igt="";
$ibst="";
$isst="";
$ibct="";
$isct="";
$ibs="";
$iss="";
$ibc="";
$isc="";
$idd="";
$orderid="";
$orderno="";
for($l=0;$l<=(count($xmlcl->result[0]->Invoices[0]->row[$l1]));$l++)
{
$ti= $xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]['val'];
if($ti=="Invoice Number")
{
	$in=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Invoice Date")
{
	$ind=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Account Name")
{
	$ian=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Sub Total")
{
	$isubt=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Tax")
{
	$taxn=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]['val'];
	$it=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Adjustment")
{
	$iadj=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Grand Total")
{
	$igt=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Billing Street")
{
	$ibst=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Shipping Street")
{
	$isst=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Billing City")
{
	$ibct=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Shipping City")
{
	$isct=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Billing State")
{
	$ibs=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Shipping State")
{
	$iss=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Billing Country")
{
	$ibc=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Shipping Country")
{
	$isc=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="Due Date")
{
	$idd=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
if($ti=="SALESORDERID")
{
	$orderid=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
}
}
$idd=str_replace("-","",$idd);
$ind=str_replace("-","",$ind);
for($j=(8-strlen("".$l1.""));$j>0;$j--)
{ $rid.='0';
}
$rid.=($l1+1);

for($a=0;$a<$solen;$a++)
{
	
	if($orderid==$SOid[$a])
	{
		$orderno=$SOno[$a];
		
		
	}
}


$i1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<VOUCHER REMOTEID="'.$rid.'" VCHTYPE="Sales" ACTION="Create">
<ADDRESS.LIST>
<ADDRESS/>
<ADDRESS/>
<ADDRESS/>
<ADDRESS/>
<ADDRESS/>
</ADDRESS.LIST>
<BASICBUYERADDRESS.LIST>
<BASICBUYERADDRESS>'.$ibst.'</BASICBUYERADDRESS>
<BASICBUYERADDRESS>'.$ibct.'</BASICBUYERADDRESS>
<BASICBUYERADDRESS>'.$ibs.'</BASICBUYERADDRESS>
<BASICBUYERADDRESS>'.$ibc.'</BASICBUYERADDRESS>
<BASICBUYERADDRESS></BASICBUYERADDRESS>
</BASICBUYERADDRESS.LIST>
<BASICORDERTERMS.LIST>
<BASICORDERTERMS/>
</BASICORDERTERMS.LIST>
<DATE>20161001</DATE>
<GUID>
a456c560-d729-11d7-9f0f-0050bf2cc5d3
</GUID>
<NARRATION/>
<VOUCHERTYPENAME>Sales</VOUCHERTYPENAME>
<VOUCHERNUMBER>'.$in.'</VOUCHERNUMBER>
<REFERENCE>'.$in.'</REFERENCE>
<PARTYLEDGERNAME>'.$ian.'</PARTYLEDGERNAME>
<PARTYNAME>'.$ian.'</PARTYNAME>
<BASEPARTYNAME>'.$ian.'</BASEPARTYNAME>
<CSTFORMISSUETYPE/>
<CSTFORMRECVTYPE/>
<FBTPAYMENTTYPE>Default</FBTPAYMENTTYPE>
<BASICSHIPPEDBY/>
<BASICBUYERNAME/>
<BASICSHIPDOCUMENTNO/>
<BASICFINALDESTINATION/>
<BASICORDERREF/>
<BASICBUYERSSALESTAXNO/>
<BASICDUEDATEOFPYMT/>
<BASICDATETIMEOFINVOICE>/ / at</BASICDATETIMEOFINVOICE>
<BASICDATETIMEOFREMOVAL>/ / at</BASICDATETIMEOFREMOVAL>
<VCHGSTCLASS/>
<DIFFACTUALQTY>No</DIFFACTUALQTY>
<AUDITED>No</AUDITED>
<FORJOBCOSTING>No</FORJOBCOSTING>
<ISOPTIONAL>No</ISOPTIONAL>
<EFFECTIVEDATE>20161001</EFFECTIVEDATE>
<USEFORINTEREST>No</USEFORINTEREST>
<USEFORGAINLOSS>No</USEFORGAINLOSS>
<USEFORGODOWNTRANSFER>No</USEFORGODOWNTRANSFER>
<USEFORCOMPOUND>No</USEFORCOMPOUND>
<ALTERID>'.$in.'</ALTERID>
<ISCANCELLED>No</ISCANCELLED>
<HASCASHFLOW>No</HASCASHFLOW>
<ISPOSTDATED>No</ISPOSTDATED>
<USETRACKINGNUMBER>No</USETRACKINGNUMBER>
<ISINVOICE>Yes</ISINVOICE>
<MFGJOURNAL>No</MFGJOURNAL>
<HASDISCOUNTS>No</HASDISCOUNTS>
<ASPAYSLIP>No</ASPAYSLIP>
<ISDELETED>No</ISDELETED>
<ASORIGINAL>No</ASORIGINAL>
<INVOICEDELNOTES.LIST>
<BASICSHIPPINGDATE></BASICSHIPPINGDATE>
<BASICSHIPDELIVERYNOTE></BASICSHIPDELIVERYNOTE>
</INVOICEDELNOTES.LIST>
<INVOICEORDERLIST.LIST>
<BASICORDERDATE></BASICORDERDATE>
<BASICPURCHASEORDERNO></BASICPURCHASEORDERNO>
</INVOICEORDERLIST.LIST>
<INVOICEINDENTLIST.LIST></INVOICEINDENTLIST.LIST>
<LEDGERENTRIES.LIST>
<LEDGERNAME>'.$ian.'</LEDGERNAME>
<GSTCLASS/>
<ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
<LEDGERFROMITEM>No</LEDGERFROMITEM>
<REMOVEZEROENTRIES>No</REMOVEZEROENTRIES>
<ISPARTYLEDGER>Yes</ISPARTYLEDGER>
<AMOUNT>-'.$igt.'</AMOUNT>
<BILLALLOCATIONS.LIST>
<NAME>'.$in.'</NAME>
<BILLCREDITPERIOD></BILLCREDITPERIOD>
<BILLTYPE>New Ref</BILLTYPE>
<AMOUNT>-'.$igt.'</AMOUNT>
</BILLALLOCATIONS.LIST>
</LEDGERENTRIES.LIST>
<LEDGERENTRIES.LIST>
<REMOVEZEROENTRIES>No</REMOVEZEROENTRIES>
<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
<LEDGERFROMITEM>No</LEDGERFROMITEM>
<TAXCLASSIFICATIONNAME/>
<LEDGERNAME>'.$taxn.'</LEDGERNAME>
<AMOUNT>'.$it.'</AMOUNT>
<VATASSESSABLEVALUE>'.$isubt.'</VATASSESSABLEVALUE>
</LEDGERENTRIES.LIST>';

for($l=0;$l<=(count($xmlcl->result[0]->Invoices[0]->row[$l1]));$l++)
{
$ti= $xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]['val'];
if($ti=="Product Details")
{
	$temp=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l];
	$pd=count($temp);
	$pdn="";
	$up="";
	$qty="";
	$ttl="";
	$pid="";
	$unit="";
	$linetax="";
	$taxtype="";
	$linet="";
	$count=0;
	$linecount=0;
	$ttype=array();
	$ltax=array();
	$ltaxv=array();

for($j=0;$j<$pd;$j++)
{
		for($j1=0;$j1<=(count($xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]));$j1++)
		{
		$ti= $xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1]['val'];
		if($ti=="Product Id")
		{
			$pid="".$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1]."";
		}
		if($ti=="Product Name")
		{
			$pdn=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1];
		}
		if($ti=="Unit Price")
		{
			$up=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1];
		}
		if($ti=="Quantity")
		{
			$qty=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1];
		}
		if($ti=="Net Total")
		{
			$ttl=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1];
		}
		if($ti=="Line Tax")
		{	$linecount++;
			$linetax=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1];
			for($i=0;$i<strlen($linetax);$i++)
			{
				if(((ord(substr($linetax,$i,1))>=65)&&(ord(substr($linetax,$i,1))<=90))||((ord(substr($linetax,$i,1))>=97)&&(ord(substr($linetax,$i,1))<=122))||(ord(substr($linetax,$i,1))==32))
				{
					$taxtype.=substr($linetax,$i,1);
				}
				if(((ord(substr($linetax,$i,1))>=48)&&(ord(substr($linetax,$i,1))<=57))||(ord(substr($linetax,$i,1))==46))
				{
					$linet.=substr($linetax,$i,1);
				}
				if((substr($linetax,$i,3))==":::")
				{
					$templt=$linet;
					$linet="";
					//echo $ltax[$count];
					//echo "<br>";
				}
				if((substr($linetax,$i,1))==";")
				{
					$ttype[$count]=$taxtype;
					$ltaxv[$count]=$linet;
					$ltax[$count]=$templt;
					$taxtype="";
					$linet="";
					$templt="";
					//echo $ltaxv[$count];
					//echo "<br>";

					//echo $ttype[$count];
					
					//echo "<br>";
					
					$count++;
				}

			}
				
		}
		}
		
		
		
for($a=0;$a<$plen;$a++)
{
	
	if($pid==$tempid[$a])
	{
		$unit=$unitarr[$a];
		
	}
}
			
if($linecount!=0)
{	
	/*for($z=0;$z<$count;$z++)
	{
		echo $ttype[$z];
		echo "<br>";
		echo $ltax[$z];
		echo "<br>";
		echo $ltaxv[$z];
		echo "<br>";
	}*/
}

$i1.='<ALLINVENTORYENTRIES.LIST>
<STOCKITEMNAME>'.$pdn.'</STOCKITEMNAME>
<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
<ISAUTONEGATE>No</ISAUTONEGATE>
<RATE>'.$up.'/'.$unit.'</RATE>
<AMOUNT>'.$ttl.'</AMOUNT>
<ACTUALQTY>'.$qty.''.$unit.'</ACTUALQTY>
<BILLEDQTY>'.$qty.''.$unit.'</BILLEDQTY>
<ACCOUNTINGALLOCATIONS.LIST>
<TAXCLASSIFICATIONNAME></TAXCLASSIFICATIONNAME>
<LEDGERNAME>Sales</LEDGERNAME>
<GSTCLASS/>
<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
<LEDGERFROMITEM>No</LEDGERFROMITEM>
<REMOVEZEROENTRIES>No</REMOVEZEROENTRIES>
<ISPARTYLEDGER>No</ISPARTYLEDGER>
<AMOUNT>'.$ttl.'</AMOUNT>
</ACCOUNTINGALLOCATIONS.LIST>
<BATCHALLOCATIONS.LIST>
<MFDON></MFDON>
<GODOWNNAME></GODOWNNAME>
<BATCHNAME></BATCHNAME>
<INDENTNO/>
<ORDERNO></ORDERNO>
<TRACKINGNUMBER/>
<AMOUNT>'.$ttl.'</AMOUNT>
<ACTUALQTY>'.$qty.''.$unit.'</ACTUALQTY>
<BILLEDQTY>'.$qty.''.$unit.'</BILLEDQTY>
<ORDERDUEDATE>'.$idd.'</ORDERDUEDATE>
</BATCHALLOCATIONS.LIST>
</ALLINVENTORYENTRIES.LIST>';
}
	
}
}
$i1.='</VOUCHER>
</TALLYMESSAGE>';
}
$i1.='</REQUESTDATA>
</IMPORTDATA>
</BODY>
</ENVELOPE>';

/*$ledgerTax='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>
   <TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="'.$taxn.'" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
       <ADDRESS></ADDRESS>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME></MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME></CURRENCYNAME>
      <COUNTRYNAME></COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Duties & Taxes</PARENT>
            <COUNTRYOFRESIDENCE></COUNTRYOFRESIDENCE>
      <LEDSTATENAME></LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>Sales</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>
	</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';







// Insert XML data into Tally
$url1 = "http://localhost:9000";
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS,$ledgerTax);
curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch1, CURLOPT_TIMEOUT, 60);
$response1 = curl_exec($ch1);
//echo $response;
if (curl_errno($ch1))
	echo "Error : ".curl_error($ch1);
else
	echo "Imported Invoice into Tally successfully!";
curl_close($ch1);

*/
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $i1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Invoice into Tally successfully!";

curl_close($ch);
}



//All Masters
if(isset($_POST['AllMastersSubmit'])) {			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url_account = "https://crm.zoho.com/crm/private/xml/Accounts/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_account);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
$result_account = curl_exec($ch);
curl_close($ch);
//echo $result_account;
$xmlcl_account=new SimpleXMLElement($result_account);
$len_acc=0;
$len_acc=count($xmlcl_account->result[0]->Accounts[0]);


$x1 = "";

$x1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';


for($l1=0;$l1<$len_acc;$l1++)
{
$accn="";
$add1="";
$add2="";
$add3="";
$ph="";
$f="";
$c="";
$bc="";
$bs="";

for($l=0;$l<=(count($xmlcl_account->result[0]->Accounts[0]->row[$l1]));$l++)
{
$tn= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l]['val'];
if($tn=="Account Name")
{
$accn= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing Street")
{
$add1= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing City")
{
$add2= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing Code")
{
$add3= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Phone")
{
$ph= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Fax")
{
$f= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Currency")
{
$c= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing Country.")
{
$bc= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn=="Billing State")
{
$bs= $xmlcl_account->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}

}

$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="'.$accn.'" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS>'.$add1.'</ADDRESS>
       <ADDRESS>'.$add2.'</ADDRESS>
       <ADDRESS>'.$add3.'</ADDRESS>
       <ADDRESS>'.$ph.'</ADDRESS>
       <ADDRESS>'.$f.'</ADDRESS>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME>'.$accn.'</MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME>'.$c.'</CURRENCYNAME>
      <COUNTRYNAME>'.$bc.'</COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Sundry Debtors</PARENT>
            <COUNTRYOFRESIDENCE>'.$bc.'</COUNTRYOFRESIDENCE>
      <LEDSTATENAME>'.$bs.'</LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>'.$accn.'</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';
}
$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="Tax" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME></MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME>'.$c.'</CURRENCYNAME>
      <COUNTRYNAME></COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Current Liabilities</PARENT>
            <COUNTRYOFRESIDENCE></COUNTRYOFRESIDENCE>
      <LEDSTATENAME></LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>Tax</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';
$x1.= '<TALLYMESSAGE xmlns:UDF="TallyUDF">
     <LEDGER NAME="Sales" RESERVEDNAME="">
      <ADDRESS.LIST TYPE="String">
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
       <ADDRESS/>
      </ADDRESS.LIST>
      <MAILINGNAME.LIST TYPE="String">
       <MAILINGNAME></MAILINGNAME>
      </MAILINGNAME.LIST>
      <OLDAUDITENTRYIDS.LIST TYPE="Number">
       <OLDAUDITENTRYIDS>-1</OLDAUDITENTRYIDS>
      </OLDAUDITENTRYIDS.LIST>
      <GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000a1</GUID>
      <CURRENCYNAME>'.$c.'</CURRENCYNAME>
      <COUNTRYNAME></COUNTRYNAME>
      <VATDEALERTYPE>Regular</VATDEALERTYPE>
      <PARENT>Sales Accounts</PARENT>
            <COUNTRYOFRESIDENCE></COUNTRYOFRESIDENCE>
      <LEDSTATENAME></LEDSTATENAME>
             <NAME.LIST TYPE="String">
        <NAME>Sales</NAME>
       </NAME.LIST>
           </LEDGER>
    </TALLYMESSAGE>';


$x1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';


// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $x1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Accounts Master into Tally successfully!";

curl_close($ch);
 
echo "<br>"; 



//Unit Masters
$token= $_POST['authentication'];
$url_products = "https://crm.zoho.com/crm/private/xml/Products/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_products);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
$result = curl_exec($ch);

//echo ($result);
curl_close($ch);

/*$xml = new DOMDocument;
$xml->preserveWhiteSpace = FALSE;
$xml->loadXML($result);
//Save XML as a file
$xml->save('ResponseProducts.xml');*/
$xmlcl=new SimpleXMLElement($result);
$len=0;
$len=count($xmlcl->result[0]->Products[0]);

$p1="";
$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   
$pdu="";
for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=(count($xmlcl->result[0]->Products[0]->row[$l1]));$l++)
{
$tp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l]['val'];
if($tp=="Usage Unit")
{
$pdu= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
}
if($pdu!="")
{
$p1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<UNIT NAME="'.$pdu.'" RESERVEDNAME="">
<NAME>'.$pdu.'</NAME>
<ISSIMPLEUNIT>Yes</ISSIMPLEUNIT>
</UNIT>
</TALLYMESSAGE>';
}
}
$p1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';

// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Unit Masters into Tally successfully!";

curl_close($ch);
echo "<br>"; 




//Product Masters
$xmlcl=new SimpleXMLElement($result);
$len=0;
$len=count($xmlcl->result[0]->Products[0]);


$p1="";
$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   

$pdu="";
for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=(count($xmlcl->result[0]->Products[0]->row[$l1]));$l++)
{
$tp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l]['val'];
if($tp=="Product Name")
{
$pdn= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
if($tp=="Unit Price")
{
$pdp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
if($tp=="Qty in Stock")
{
$pdq= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
if($tp=="Usage Unit")
{
$pdu= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
}
if($pdu!="")
{
$p1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<STOCKITEM NAME="'.$pdn.'" RESERVEDNAME="">
<PARENT/>
<CATEGORY/>
<TAXCLASSIFICATIONNAME/>
<COSTINGMETHOD>Avg. Cost</COSTINGMETHOD>
<VALUATIONMETHOD>Avg. Price</VALUATIONMETHOD>
<BASEUNITS>'.$pdu.'</BASEUNITS>
<ADDITIONALUNITS/>
<ISCOSTCENTRESON>No</ISCOSTCENTRESON>
<ISBATCHWISEON>No</ISBATCHWISEON>
<ISPERISHABLEON>No</ISPERISHABLEON>
<IGNOREPHYSICALDIFFERENCE>No</IGNOREPHYSICALDIFFERENCE>
<IGNORENEGATIVESTOCK>No</IGNORENEGATIVESTOCK>
<TREATSALESASMANUFACTURED>No</TREATSALESASMANUFACTURED>
<TREATPURCHASESASCONSUMED>No</TREATPURCHASESASCONSUMED>
<TREATREJECTSASSCRAP>No</TREATREJECTSASSCRAP>
<HASMFGDATE>No</HASMFGDATE>
<ALLOWUSEOFEXPIREDITEMS>No</ALLOWUSEOFEXPIREDITEMS>
<IGNOREBATCHES>No</IGNOREBATCHES>

<IGNOREGODOWNS>No</IGNOREGODOWNS>
<ISMRPINCLOFTA>No</ISMRPINCLOFTA>
<REORDERASHIGHER>No</REORDERASHIGHER>
<MINORDERASHIGHER>No</MINORDERASHIGHER>
<DENOMINATOR>1</DENOMINATOR>
<RATEOFVAT>0</RATEOFVAT>
<OPENINGBALANCE> '.$pdq.' '.$pdu.'</OPENINGBALANCE>
      <OPENINGVALUE>-'.($pdq*$pdp).'</OPENINGVALUE>
      <OPENINGRATE>'.$pdp.'/'.$pdu.'</OPENINGRATE>
<LANGUAGENAME.LIST>
<NAME.LIST>
<NAME>'.$pdn.'</NAME>
</NAME.LIST>
<LANGUAGEID>1033</LANGUAGEID>
</LANGUAGENAME.LIST>
<ADDITIONALLEDGERS.LIST></ADDITIONALLEDGERS.LIST>
</STOCKITEM>
</TALLYMESSAGE>';
}
}
$p1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';

// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Product Masters into Tally successfully!";

curl_close($ch);
echo"<br>";


//Group Masters
$xmlcl=new SimpleXMLElement($result);
$len=0;
$len=count($xmlcl->result[0]->Products[0]);

$p1="";
$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>'.$_POST['company'].'</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   

for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=(count($xmlcl->result[0]->Products[0]->row[$l1]));$l++)
{
$tp= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l]['val'];
if($tp=="Product Category")
{
$pdc= $xmlcl->result[0]->Products[0]->row[$l1]->FL[$l];	
}
}
if($pdc!="")
{
$p1.='<TALLYMESSAGE xmlns:UDF="TallyUDF">
<STOCKGROUP NAME="'.$pdc.'" RESERVEDNAME="">
<GUID>841125cf-5c5f-48ac-9e29-2160fd004cc5-000000b3</GUID>
<PARENT/>
<BASEUNITS/>
<ADDITIONALUNITS/>
<ISBATCHWISEON>No</ISBATCHWISEON>
<ISPERISHABLEON>No</ISPERISHABLEON>
<ISADDABLE>No</ISADDABLE>
<ISUPDATINGTARGETID>No</ISUPDATINGTARGETID>
<ASORIGINAL>Yes</ASORIGINAL>
<IGNOREPHYSICALDIFFERENCE>No</IGNOREPHYSICALDIFFERENCE>
<IGNORENEGATIVESTOCK>No</IGNORENEGATIVESTOCK>
<TREATSALESASMANUFACTURED>No</TREATSALESASMANUFACTURED>
<TREATPURCHASESASCONSUMED>No</TREATPURCHASESASCONSUMED>
<TREATREJECTSASSCRAP>No</TREATREJECTSASSCRAP>
<HASMFGDATE>No</HASMFGDATE>
<ALLOWUSEOFEXPIREDITEMS>No</ALLOWUSEOFEXPIREDITEMS>
<IGNOREBATCHES>No</IGNOREBATCHES>
<IGNOREGODOWNS>No</IGNOREGODOWNS>
<ALTERID>392</ALTERID>
<SERVICETAXDETAILS.LIST></SERVICETAXDETAILS.LIST>
<VATDETAILS.LIST></VATDETAILS.LIST>
<SALESTAXCESSDETAILS.LIST></SALESTAXCESSDETAILS.LIST>
<LANGUAGENAME.LIST>
<NAME.LIST TYPE="String">
<NAME>'.$pdc.'</NAME>
</NAME.LIST>
<LANGUAGEID>1033</LANGUAGEID>
</LANGUAGENAME.LIST>
<SCHVIDETAILS.LIST></SCHVIDETAILS.LIST>
<EXCISETARIFFDETAILS.LIST></EXCISETARIFFDETAILS.LIST>
<TCSCATEGORYDETAILS.LIST></TCSCATEGORYDETAILS.LIST>
<TDSCATEGORYDETAILS.LIST></TDSCATEGORYDETAILS.LIST>
<EXTARIFFDUTYHEADDETAILS.LIST></EXTARIFFDUTYHEADDETAILS.LIST>
</STOCKGROUP>
</TALLYMESSAGE>';
}
}
$p1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';

// Insert XML data into Tally
$url = "http://localhost:9000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

$response = curl_exec($ch);
//echo $response;
if (curl_errno($ch))
	echo "Error : ".curl_error($ch);
else
	echo "Imported Group Masters into Tally successfully!";

curl_close($ch);

}


?>
<form name="frm" action="" method="post">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" cellpadding="1" cellspacing="1" width="39%" align="center" style="margin-top:10px; border-radius:10px; border:1px solid #333;">
   <tr>
    <th height="39" colspan="2"> ZOHO CRM TO TALLY</th></tr>
   <tr><td colspan="5">&nbsp;</td></tr>
   <tr><td colspan="10">&nbsp;</td></tr>
   <tr>
     <td width="50%" align="right">&nbsp;Authentication Token : </td>
     <td width="50%"><input type="text" name="authentication"  value=""></td>
   </tr>
   <tr><td colspan="10">&nbsp;</td></tr>
    <tr>
     <td align="right">&nbsp;Company Name :</td>
     <td><input type="text" name="company"  value=""></td>
   </tr>
   <tr><td colspan="10">&nbsp;</td></tr>
   <tr><td colspan="10">&nbsp;</td></tr>
   <tr>
     <td colspan="2" align="center"><input type="submit" name="accSubmit"  value="Account Master">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="unitSubmit"  value="Unit Master"></td>
   </tr>
     <td height="10" colspan="2">&nbsp;</td>
     <tr><td colspan="2" align="center">&nbsp;&nbsp;<input type="submit" name="prodSubmit"  value="Product Master">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="grpSubmit"  value="Group Master"></td>
    </tr>
      <td height="10" colspan="2">&nbsp;</td>
      <tr>
        <td align="center" height="39" colspan="2"><input type="submit" name="AllMastersSubmit"  value="All Masters"></td></tr>
      <tr>
        <td align="center" height="39" colspan="2"><input type="submit" name="invSubmit"  value="Invoice"></td></tr>
   <td height="10" colspan="2">&nbsp;</td>
</table>
</form>
