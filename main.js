let fruitFormElt = document.querySelector('#fruitForm');
let nameFormElt = document.querySelector('#nameForm');
const urlTarget = 'traitement2.php';
function fetchPostRequest(url, data){
	return fetch(url, 
			{
				method: "POST",
				body: data
			}).then(function(res){				
				return res.json()
			})
}

fruitFormElt.addEventListener('submit', function(event){
	let selectElt = document.querySelector('#selectWeek');
	let selection = selectElt.value;
	let dataForm = new FormData();
	dataForm.append( "weekChoose", JSON.stringify( selection) );
	dataForm.append( "formToCompute", JSON.stringify("fruits") );
	
    fetchPostRequest(urlTarget, dataForm)
    .then(function(data){
    	let responseElt = document.querySelector('#responseBox');
		let errorElt = document.querySelector('#errorDisplayBox');
		responseElt.textContent = "";
		errorElt.textContent = "";
		if (!data.error){
			responseElt.textContent = `La liste est : ${data[0]}`;
		} else {			
			errorElt.textContent = data[0];
		}
    }).catch(function(error){
		console.error(error);
	});
	event.stopPropagation();
	event.preventDefault();
});
nameFormElt.addEventListener('submit', function (event){
	console.log(event.target);
	let nameInputElt = document.querySelector('#userName');
	let firstNameInputElt = document.querySelector('#userFirstName');
	let userName = nameInputElt.value;
	let userFirstName = firstNameInputElt.value;

	let data = new FormData();
	data.append( "userName", JSON.stringify( userName) );
	data.append( "userFirstName", JSON.stringify( userFirstName) );
	data.append( "formToCompute", JSON.stringify( "formEmail"));
	fetchPostRequest(urlTarget, data)
	.then(function(data){ 
		let responseBox2Elt = document.querySelector('#responseBox2');
		let errorDisplayBox2Elt = document.querySelector('#errorDisplayBox2');
		responseBox2Elt.textContent = "";
		errorDisplayBox2.textContent = "";
		if (!data.error){
			responseBox2Elt.textContent = data[0];
		} else {
			errorDisplayBox2Elt.textContent = data[0];
		}		
	});
	event.stopPropagation();
	event.preventDefault();
});
let townFormElt = document.querySelector('#townForm');
townFormElt.addEventListener('submit', function(event){
	let townInputElt = document.querySelector('#town');
	let townName = townInputElt.value;
	let data = new FormData;
	data.append('formToCompute', JSON.stringify('townForm'));
	data.append('town', JSON.stringify(townName));
	fetchPostRequest(urlTarget, data)
	.then(function(data){ 
		let responseBox3Elt = document.querySelector('#responseBox3');
		let errorDisplayBox3Elt = document.querySelector('#errorDisplayBox3');
		responseBox3Elt.textContent = "";
		errorDisplayBox3.textContent = "";
		if (!data.error){
			responseBox3Elt.textContent = data[0];
		} else {
			errorDisplayBox3Elt.textContent = data[0];
		}		
	});
	event.stopPropagation();
	event.preventDefault();
});