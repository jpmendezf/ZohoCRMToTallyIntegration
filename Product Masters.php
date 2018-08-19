<?php
if(isset($_POST['btnSubmit'])) {			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url = "https://crm.zoho.com/crm/private/xml/Products/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";			  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
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



$p1.='<ENVELOPE>
 <HEADER>
  <TALLYREQUEST>Import Data</TALLYREQUEST>
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>All Masters</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>Goldenlion Consulting Services Private Limited</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>';
   


for($l1=0;$l1<$len;$l1++)
{
for($l=0;$l<=24;$l++)
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

$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($p1);
//Save XML as a file
$dom->save('PRODUCT MASTERS.xml');
$file="PRODUCT MASTERS.xml";
header('Content-Disposition: attachment; filename='.$file);
header('Content-type: text/xml');
echo $dom->saveXML();

}

?>
<form name="frm" action="" method="post">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" cellpadding="1" cellspacing="1" width="39%" align="center" style="margin-top:10px; border-radius:10px; border:1px solid #333;">
   <tr><td height="39" colspan="2">&nbsp;</td></tr>
   <tr>
     <td width="39%" height="26" align="right">&nbsp;Authentication Token :</td>
     <td width="61%"><input type="text" name="authentication"  value=""></td>
   </tr>
   <tr><td colspan="10">&nbsp;</td></tr>
    <tr>
     <td align="right">&nbsp;Company Name :</td>
     <td><input type="text" name="company"  value=""></td>
   </tr>
   <tr><td colspan="10">&nbsp;</td></tr>
   <tr>
     <td>&nbsp;</td>
     <td><input type="submit" name="btnSubmit"  value="Generate Product Masters"></td>
   </tr>
   <tr><td height="39" colspan="2">&nbsp;</td></tr>
</table>
</form>
