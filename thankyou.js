
var orderid="";


var txt = document.documentElement.innerHTML;
var n=txt.split("\n"); 
for(var i=0; i<n.length; i++)
{
if(n[i].indexOf("Order ID") != -1)
{
orderid = n[i].replace("<p>Your Order ID is: <strong>","");
orderid = orderid.replace("</strong></p>","");
orderid = orderid.replace("#","");

break;
}


}

 
        // wait for the DOM to be loaded 
         $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#myForm').ajaxForm(function() { 
                alert("SMS has been sent."); 
            }); 
			
			$("#content").append('<form id="myForm" action="http://narutorealm.co/shopify/send.php" method="POST"><p>Send Order info to Phone Number:</p><input type="hidden" name="orderid"><input type="text" name="number" id="number"></br><input type="submit" value="Submit"></form>');

			
			
			
        }); 
 


//document.getElementById('content').innerHTML+='';


//document.getElementById("orderid").value = orderid;


