 function operation (num1, num2) {
 	return num1 - num2
 }

 let opera = operation(44, 38);

 console.log(opera);

 console.log(operation (67, 45));
 console.log(operation (34, 12));
 console.log(operation (56, 78));

 let punk = operation(67, 45);
 let jazz = operation(34, 12);
 let ska = operation(56, 78);

 console.log(punk, ska, jazz, opera);

 (function operation () {
 		console.log('something')
 })();

function concatenateTwoStrings (string1, string2){
	return string1 + "SPACE" + string2;
}

console.log(concatenateTwoStrings('thingOne', 'thingTwo'));