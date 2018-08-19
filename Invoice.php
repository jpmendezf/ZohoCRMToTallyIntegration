<?php
//header("Content-type: application/xml");
if(isset($_POST['btnSubmit'])) {			  
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
$result = curl_exec($ch);

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_TIMEOUT, 30);
curl_setopt($ch1, CURLOPT_POST,1);
$result1 = curl_exec($ch1);

$chSO = curl_init();
curl_setopt($chSO, CURLOPT_URL, $urlSO);
curl_setopt($chSO, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($chSO, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($chSO, CURLOPT_TIMEOUT, 30);
curl_setopt($chSO, CURLOPT_POST,1);
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




$i1.='<ENVELOPE>
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
for($l=0;$l<=40;$l++)
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
<VOUCHER REMOTEID="'.$rid.'" VCHTYPE="Sales-EIPL" ACTION="Create">
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
<VOUCHERTYPENAME>Sales-EIPL</VOUCHERTYPENAME>
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

for($l=0;$l<=40;$l++)
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
for($j=0;$j<$pd;$j++)
{
		for($j1=0;$j1<=12;$j1++)
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
		if($ti=="Total")
		{
			$ttl=$xmlcl->result[0]->Invoices[0]->row[$l1]->FL[$l]->product[$j]->FL[$j1];
		}
		
		}
for($a=0;$a<$plen;$a++)
{
	
	if($pid==$tempid[$a])
	{
		$unit=$unitarr[$a];
		
	}
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
<LEDGERNAME>Sales (CST2%)</LEDGERNAME>
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

$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($i1);
//Save XML as a file
$dom->save('INVOICE.xml');
$file="INVOICE.xml";
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
     <td width="40%" height="26" align="right">&nbsp;Authentication Token :</td>
     <td width="60%"><input type="text" name="authentication"  value=""></td>
   </tr>
   <tr><td colspan="10">&nbsp;</td></tr>
    <tr>
     <td align="right">&nbsp;Company Name :</td>
     <td><input type="text" name="company"  value=""></td>
   </tr>
   <tr><td colspan="10">&nbsp;</td></tr>
   <tr>
     <td>&nbsp;</td>
     <td><input type="submit" name="btnSubmit"  value="Generate Invoice"></td>
   </tr>
   <tr><td height="39" colspan="2">&nbsp;</td></tr>
</table>
</form>
