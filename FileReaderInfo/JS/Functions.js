

//Functions
function checkLastName()
{
	var lName=document.getElementById("lastName").value;
	var table=document.getElementById("phoneBook");
	
	var isTrue=false;
	
	for (var i = 1, row; row = table.rows[i]; i++) {
		
	   for (var j = 0, col; col = row.cells[j+2]; j++) {
			var rowStyle=table.rows[i].style;
			
			var name=col.innerHTML;
			var islName=name.indexOf(lName);
			
			if(islName>=0)
			{
					rowStyle.display="table-row";
				break;
			}
		else
		{
			
			rowStyle.display="none";
			break;
		}
	   }  
	   
}
	
}

$(document).on("ready",function(){var phoneBook=document.getElementById("phoneBook");
var people;


$.getJSON('./JS/j.js', function(data) { 
		var people=data;
		for(i=0;i<people['people'].length;i++)
{
	var parent=document.createElement("tr");
	
	var childOne=document.createElement("td");
	var childTwo=document.createElement("td");
	var childThree=document.createElement("td");
	var childFour=document.createElement("td");
		
		
	var id=document.createTextNode(people['people'][i].ID);
		childOne.appendChild(id);
		
	var firstName=document.createTextNode(people['people'][i].FirstName);
		childTwo.appendChild(firstName);
		
	var lastName=document.createTextNode(people['people'][i].LastName);
		childThree.appendChild(lastName);
		
	var tel=document.createTextNode(people['people'][i].Tel);
		childFour.appendChild(tel);
	
	
	parent.appendChild(childOne);
		parent.appendChild(childTwo);
			parent.appendChild(childThree);
				parent.appendChild(childFour);
				phoneBook.appendChild(parent);
}
});
	
});


