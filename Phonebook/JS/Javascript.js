//JavaScript Functions


//Get files info
window.onload=function(){
	$.ajax({
	url: "./PHP/Functions.php",
	cache: false,
	success: function(obj){
		var dynamicDetail;
		var fileObjects=obj;
	
			var fileT=document.getElementById("fileT");
	
			for (i = 0; i < fileObjects.length; i++) { 
			var parent=document.createElement("tr");
				
				var elName=document.createElement("td");
					
				var fName=fileObjects[i].name;
					parent.id=fName;
				
				dynamicDetail=document.createTextNode(fName);
				elName.appendChild(dynamicDetail);
					parent.appendChild(elName);
						fileT.appendChild(parent);
						
				var elFType=document.createElement("td");
				var fFType=fileObjects[i].fType;
				dynamicDetail=document.createTextNode(fFType);
					elFType.appendChild(dynamicDetail);
						parent.appendChild(elFType);
						
				var elSize=document.createElement("td");
				var fFSize=fileObjects[i].size;
				dynamicDetail=document.createTextNode(fFSize);
					elSize.appendChild(dynamicDetail);
						parent.appendChild(elSize);
			
		}
		
		
//Open new page with content		
$("#fileT tr").click(function(event) {
	var elID=this.id;
	var elType=$(this).children('td').eq(1).html();
	console.log(elFType);
	$.ajax({
			url: "./PHP/ReadFile.php",
			cache: false,
			method:"POST",
			data:{file:elID,ftype:elType},
			success: function(item){
				
			var newTab = window.open("./secondPage.php","_self");
			}
	});
	});
	
  },
  error:function(){console.log("Error");}
});	
 };
	
	
//Search for string in files
$("#searchButton").on("click",function(ev){
		var textValue=$("#searchValue").val();
		
		var fileT=$("#fileT");
		
		var tableRows=$("#fileT > tr");	
		
		var isWhiteSpace=textValue.trim();
		if(isWhiteSpace=="")
		{
					for(var k=0;k<tableRows.length;k++)
					{
						
							$(tableRows[k]).css("display","table-row");
					}
			return false;
		}
		$.ajax({
			url: "./PHP/checkString.php",
			cache: false,
			method:"POST",
			data:{string:isWhiteSpace},
			success:function(item)
				{
					var tableRows=$("#fileT > tr");						
					item=$.parseJSON(item);
					var isTrue=false;
	
					for(var i=0;i<tableRows.length;i++)
					{
						if(item.length<=0)
						{
							$(tableRows[i]).css("display","table-row");
						}
						for(var j=0;j<item.length;j++)
						{
								if(tableRows[i].id==item[j])
								{
								isTrue=true;
								break;
								}
								else{
									isTrue=false;
								}
						}		
						
							if(isTrue==true)
							{
								$(tableRows[i]).css("display","table-row");
								isTrue=false;
							}
							else
							{
							$(tableRows[i]).css("display","none");							
							}
							
					}
				}
				
});
});