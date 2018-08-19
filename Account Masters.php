<?php

if(isset($_POST['btnSubmit'])) {			  
//header("Content-type: application/xml");
$token= $_POST['authentication'];
$url = "https://crm.zoho.com/crm/private/xml/Accounts/getRecords?authtoken=".$token."&scope=crmapi&fromIndex=1&toIndex=200";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST,1);
$result = curl_exec($ch);
curl_close($ch);

$xmlcl=new SimpleXMLElement($result);
$len=0;

$dom1 = new DOMDocument;
$dom1->loadXML($result);
$rows = $dom1->getElementsByTagName('row');
foreach ($rows as $row) {
    $len++;
}




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

$f1="Account Name";
$f2="Billing Street";
$f3="Billing City";
$f4="Billing Code";
$f5="Phone";
$f6="Fax";
$f7="Currency";
$f8="Billing Country.";
$f9="Billing State";


for($l1=0;$l1<$len;$l1++)
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

for($l=0;$l<=27;$l++)
{
$tn= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l]['val'];
if($tn==$f1)
{
$accn= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f2)
{
$add1= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f3)
{
$add2= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f4)
{
$add3= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f5)
{
$ph= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f6)
{
$f= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f7)
{
$c= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f8)
{
$bc= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
}
if($tn==$f9)
{
$bs= $xmlcl->result[0]->Accounts[0]->row[$l1]->FL[$l];	
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

print_r($x[$l1]);

}
$x1.='</REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>';



$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($x1);
//Save XML as a file
$dom->save('MASTERS.xml');
$file="ACCOUNT MASTERS.xml";
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
     <td><input type="submit" name="btnSubmit"  value="Generate Account Master"></td>
   </tr>
   <tr><td height="39" colspan="2">&nbsp;</td></tr>
</table>
</form>
